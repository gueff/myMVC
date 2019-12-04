<?php
/**
 * Application.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVC
 */
namespace MVC;

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;

/**
 * Application
 */
class Application
{

	/**
     * Application constructor.
	 * 
	 * @access public
	 * @param array $aConfig configuration array 
	 * @return void
     * @throws \Exception
     */
	public function __construct (array $aConfig = array ())
	{
		// write configs into registry
		$this->saveConfigToRegistry ($aConfig);

        // handle Errors
        $oError = new Error();

		// add a CLI wrapper to enable requests from command line
		(true === filter_var (Registry::get ('MVC_CLI'), FILTER_VALIDATE_BOOLEAN)) ? $this->cliWrapper () : false;

		Log::WRITE (
			str_repeat ('#', 10) . "\tnew Request"
			. "\t" . php_sapi_name ()
			. "\t" . (array_key_exists ('REQUEST_METHOD', $_SERVER) ? $_SERVER['REQUEST_METHOD'] : '')
			. ' ' . (array_key_exists ('REQUEST_URI', $_SERVER) ? $_SERVER['REQUEST_URI'] : '')
		);

		// handle Routing
		$oRouter = new Router();

		// Run target Controller's __preconstruct()
		self::runTargetClassPreconstruct ();

		// Set Session
		self::setSession ();

		// consider Policy Rules
		// e.g. maybe the requested target controller may not be called due to some reason 
		// and should be protected from any requesting
		$oPolicy = new Policy();

		// Run the requested target Controller
		$oController = new Controller (Request::getInstance ());

		Event::RUN ('mvc.application.construct.done',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oError')->set_sValue($oError)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oRouter')->set_sValue($oRouter)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oPolicy')->set_sValue($oPolicy)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oController')->set_sValue($oController)
                )
        );
	}

	/**
	 * save config array to registry in key value manner
	 * 
	 * @access private
	 * @param array $aConfig
	 * @return void
	 */
	private function saveConfigToRegistry (array $aConfig = array ())
	{
		// save config array to registry in key value manner
		foreach ($aConfig as $sKey => $sValue)
		{
			Registry::set ($sKey, $sValue);
		}
	}

	/**
	 * inits a session if MVC_SESSION_ENABLE is set to 1 
     * and copies it to the registry
	 * 
	 * @access private
	 * @static
	 * @return void
     * @throws \Exception
     */
	private static function setSession ()
	{
		Event::RUN ('mvc.setSession.begin', DTArrayObject::create());

        (!file_exists (Registry::get ('MVC_SESSION_PATH'))) ? mkdir (Registry::get ('MVC_SESSION_PATH')) : false;

        $oSession = Session::is();
        $iMicrotime = microtime (true);
        $sMicrotime = sprintf ("%06d", ($iMicrotime - floor ($iMicrotime)) * 1000000);
        $oSession->set ('startDateTime', new \DateTime (date ('Y-m-d H:i:s.' . $sMicrotime, $iMicrotime)));
        $oSession->set ('uniqueid', Registry::get ('MVC_UNIQUE_ID'));
        
        // copy Session Object to registry
        Registry::set ('MVC_SESSION', $oSession);

		Event::RUN ('mvc.setSession.done',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oSession')->set_sValue($oSession)
                )
        );
	}

	/**
	 * calls the "BEFORE" method
	 * inside the requested Controller. To be executed
	 * before Session, IDS and all the Main Functionalities.
	 * 
	 * @access private
	 * @static
	 * @return void
	 */
	private static function runTargetClassPreconstruct ()
	{
        $aQueryArray = Request::getInstance ()->getQueryArray ();

		// identify target class
		$sClass = '\\' . $aQueryArray['GET'][Registry::get ('MVC_GET_PARAM_MODULE')] . '\\Controller\\' . $aQueryArray['GET'][Registry::get ('MVC_GET_PARAM_C')];

		// identify target class as file
		$sFile = Registry::get ('MVC_MODULES') . '/' . str_replace ('\\', '/', $sClass) . '.php';

		// Fallback: read "__preconstruct()" method from MVC_ROUTING_FALLBACK (e.g. Standard\Controller\Index)
		if (!file_exists ($sFile))
		{
			parse_str (Registry::get ('MVC_ROUTING_FALLBACK'), $aParse);
			$sClass = '\\' . ucfirst ($aParse[Registry::get ('MVC_GET_PARAM_MODULE')]) . '\\' . ucfirst ($aParse[Registry::get ('MVC_GET_PARAM_C')]);
			$sFile = Registry::get ('MVC_MODULES') . '/' . str_replace ('\\', '/', $sClass) . '.php';
		}

		if (class_exists ($sClass))
		{
			$sMethod = Registry::get ('MVC_METHODNAME_PRECONSTRUCT');

			if (method_exists ($sClass, $sMethod))
			{
				$sClass::$sMethod ();
			}
		}
		else
		{
			Event::RUN ('mvc.error',
                DTArrayObject::create()
                    ->add_aKeyValue(
                        DTKeyValue::create()->set_sKey('iLevel')->set_sValue(1)
                    )
                    ->add_aKeyValue(
                        DTKeyValue::create()->set_sKey('sMessage')->set_sValue(__FILE__ . ', ' . __LINE__ . "\t" . 'Class does not exist: `' . $sClass . '`')
                    )
            );
		}

		Event::RUN ('mvc.runTargetClassPreconstruct.done',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sClass')->set_sValue($sClass)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sMethod')->set_sValue($sMethod)
                )
        );
	}

	/**
	 * enables using myMvc via commandline
	 * example usage
	 * 		$ php index.php "/"
	 * 
	 * @access private
	 */
	private function cliWrapper ()
	{
		// check user/file permission
		$sIndex = realpath (__DIR__ . '/../../../public') . '/index.php';

		if (posix_getuid () != Helper::GETFILEINFO ($sIndex, 'uid'))
		{
			$aUser = posix_getpwuid (posix_getuid ());
			$aFileInfo = Helper::GETFILEINFO ($sIndex);

			die (
				"\n\tERROR\tCLI - access granted for User `" . $aFileInfo['name'] . "` only "
				. "(User `" . $aUser['name'] . "`, uid:" . $aUser['uid'] . ", not granted).\t"
				. __FILE__ . ', ' . __LINE__ . "\n\n"
			);
		}

		(!array_key_exists (1, $GLOBALS['argv'])) ? $GLOBALS['argv'][1] = '' : false;
		$aParseUrl = parse_url ($GLOBALS['argv'][1]);

		$_SERVER = array ();
		$_SERVER['REQUEST_URI'] = $GLOBALS['argv'][1];
		$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
		$_SERVER['HTTP_HOST'] = 'localhost';

		if (array_key_exists ('query', $aParseUrl))
		{
			$_SERVER['QUERY_STRING'] = $aParseUrl['query'];
			parse_str ($aParseUrl['query'], $_GET);
		}
	}

	/**
	 * Destructor; 
	 * runs Event mvc.application.destruct
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct ()
	{
		Event::RUN ('mvc.application.destruct',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oController')->set_sValue($this)
                )
        );
	}

}
