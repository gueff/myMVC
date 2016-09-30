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

/**
 * Application
 */
class Application
{

	/**
	 * constructor;
	 * 
	 * @access public
	 * @param array $aConfig configuration array 
	 * @return void
	 */
	public function __construct (array $aConfig = array ())
	{
		// write configs into registry
		$this->saveConfigToRegistry ($aConfig);

		// add a CLI wrapper to enable requests from command line
		(true === filter_var (Registry::get ('MVC_CLI'), FILTER_VALIDATE_BOOLEAN)) ? $this->cliWrapper () : false;

		Log::WRITE (
			str_repeat ('#', 10) . "\tnew Request"
			. "\t" . php_sapi_name ()
			. "\t" . (array_key_exists ('REQUEST_METHOD', $_SERVER) ? $_SERVER['REQUEST_METHOD'] : '')
			. ' ' . (array_key_exists ('REQUEST_URI', $_SERVER) ? $_SERVER['REQUEST_URI'] : '')
		);

		// handle Errors
		new Error();

		// handle Routing
		new Router();

		// Run target Controller's __preconstruct()
		self::runTargetClassPreconstruct (Request::getInstance ()->getQueryArray ());

		// Set Session
		self::setSession ();

		// Run Intrusion Detection System (phpids)
		new IDS();

		// consider Policy Rules
		// e.g. maybe the requested target controller may not be called due to some reason 
		// and should be protected from any requesting
		new Policy();

		// Run the requested target Controller
		new Controller (Request::getInstance ());

		Event::RUN ('mvc.application.construct.finished');
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
	 * inits a session and copies it to the registry
	 * 
	 * @access private
	 * @static
	 * @return void
	 */
	private static function setSession ()
	{
		Event::RUN ('mvc.session.before');

		// Start a default Session, if no session was started before
		if (!session_id ())
		{
			(!file_exists (Registry::get ('MVC_SESSION_PATH'))) ? mkdir (Registry::get ('MVC_SESSION_PATH')) : false;

			$oSession = Session::getInstance ();
			$iMicrotime = microtime (true);
			$sMicrotime = sprintf ("%06d", ($iMicrotime - floor ($iMicrotime)) * 1000000);
			$oSession->set ('startDateTime', new \DateTime (date ('Y-m-d H:i:s.' . $sMicrotime, $iMicrotime)));
			$oSession->set ('uniqueid', Registry::get ('MVC_UNIQUE_ID'));

			// copy Session Object to registry
			Registry::set ('MVC_SESSION', $oSession);
		}

		Event::RUN ('mvc.session');
	}

	/**
	 * calls the "BEFORE" method<br />
	 * inside the requested Controller. To be executed<br />
	 * before Session, IDS and all the Main Functionalities.<br />
	 * 
	 * @access private
	 * @static
	 * @param array $aQueryArray
	 * @return void
	 */
	private static function runTargetClassPreconstruct (array $aQueryArray = array ())
	{
		// identify target class
		$sClass = '\\' . $aQueryArray['GET'][Registry::get ('MVC_GET_PARAM_MODULE')] . '\\Controller\\' . $aQueryArray['GET'][Registry::get ('MVC_GET_PARAM_C')];

		// identify target class as file
		$sFile = Registry::get ('MVC_MODULES') . '/' . str_replace ('\\', '/', $sClass) . '.php';

		// Fallback: read MVC_BEFORE method from MVC_ROUTING_FALLBACK (e.g. Standard\Controller\Index)
		if (!file_exists ($sFile))
		{
			parse_str (Registry::get ('MVC_ROUTING_FALLBACK'), $aParse);
			$sClass = '\\' . ucfirst ($aParse[Registry::get ('MVC_GET_PARAM_MODULE')]) . '\\' . ucfirst ($aParse[Registry::get ('MVC_GET_PARAM_C')]);
			$sFile = Registry::get ('MVC_MODULES') . '/' . str_replace ('\\', '/', $sClass) . '.php';
		}

		if (class_exists ($sClass))
		{
			$sBeforeMethod = Registry::get ('MVC_METHODNAME_PRECONSTRUCT');

			if (method_exists ($sClass, $sBeforeMethod))
			{
				$sClass::$sBeforeMethod ();
			}
		}
		else
		{
			//@todo Error
			Event::RUN ('mvc.error', array (
				'level' => 1,
				'message' => __FILE__ . ', ' . __LINE__ . "\t" . 'Class does not exist: `' . $sClass . '`'
			));
		}

		Event::RUN ('mvc.targetClassBeforeMethod.after');
	}

	/**
	 * enables using myMvc via commandline
	 * example usage
	 * 		$ php index.php "/"
	 * 
	 * @access private
	 * @return void
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
		Event::RUN ('mvc.application.destruct');
	}

}
