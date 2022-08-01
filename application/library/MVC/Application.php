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

		// add a CLI wrapper to enable requests from command line
		(true === Request::isCli()) ? Request::cliWrapper() : false;

        // save + prepare Request
        Request::init();

        // handle Routing
		Router::init();

		// Run target Controller's __preconstruct()
		Controller::runTargetClassPreconstruct();

		// Session
		self::initSession();

		// consider Policy Rules
		// e.g. maybe the requested target controller may not be called due to some reason 
		// and should be protected from any requesting
		Policy::apply();

        // Run the requested target Controller
        Controller::init();

		Event::run ('mvc.application.construct.after', DTArrayObject::create());
	}

	/**
	 * inits a session and copies it to the registry
     * @return void
     * @throws \ReflectionException
     */
	private static function initSession ()
	{
		Event::run ('mvc.application.setSession.before', DTArrayObject::create());

        (!file_exists (Config::get_MVC_SESSION_PATH())) ? mkdir (Config::get_MVC_SESSION_PATH()) : false;

        $oSession = Session::is();
        $iMicrotime = microtime (true);
        $sMicrotime = sprintf ("%06d", ($iMicrotime - floor ($iMicrotime)) * 1000000);
        $oSession->set ('startDateTime', new \DateTime (date ('Y-m-d H:i:s.' . $sMicrotime, $iMicrotime)));
        $oSession->set ('uniqueid', Config::get_MVC_UNIQUE_ID());
        
        // copy Session Object to registry
        Config::set_MVC_SESSION($oSession);

		Event::run ('mvc.application.setSession.after',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oSession')->set_sValue($oSession)
                )
        );
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
