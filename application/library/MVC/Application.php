<?php
/**
 * Application.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
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
     * Application constructor
     * @throws \ReflectionException
     */
	public function __construct()
	{
        // get config via global
		// write configs into registry
        Config::init($GLOBALS['aConfig']);

        // handle Errors
        Error::init();

        // Caching
        Cache::init();

		// add a CLI wrapper to enable requests from command line
		(true === Request::isCli()) ? Request::cliWrapper() : false;

        // handle Routing
        Route::init();

        // Policy Rules
        Policy::apply();

		// Run target Controller's __preconstruct()
		Controller::runTargetClassPreconstruct();

		// Session
		self::initSession();

        // Run the requested target Controller
        Controller::init();

		Event::run ('mvc.application.construct.after');
	}

	/**
	 * inits a session and copies it to the registry
     * @return bool init
     * @throws \ReflectionException
     */
	public static function initSession()
	{
        // don't run again if this already has been run
        if (null !== Config::get_MVC_SESSION())
        {
            return false;
        }

		Event::run ('mvc.application.setSession.before');

        (!file_exists (Config::get_MVC_SESSION_PATH())) ? mkdir (Config::get_MVC_SESSION_PATH()) : false;

        $oSession = Session::is();
        $fMicrotime = microtime (true);
        $sMicrotime = sprintf ("%06d", ($fMicrotime - floor ($fMicrotime)) * 1000000);
        $oSession->set ('startDateTime', new \DateTime (date ('Y-m-d H:i:s.' . $sMicrotime)));
        $oSession->set ('uniqueid', Config::get_MVC_UNIQUE_ID());
        
        // copy Session Object to registry
        Config::set_MVC_SESSION($oSession);

		Event::run ('mvc.application.setSession.after',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oSession')->set_sValue($oSession)
                )
        );

        return true;
	}

    /**
     * Destructor;
     * runs Event mvc.application.destruct
     * @throws \ReflectionException
     */
    public function __destruct ()
    {
        Event::run ('mvc.application.destruct.before',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oController')->set_sValue($this)
                )
        );
    }
}
