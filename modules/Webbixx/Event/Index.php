<?php
/**
 * Index.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $WebbixxEvent
 */
namespace Webbixx\Event;

use MVC\Config;
use MVC\DataType\DTArrayObject;
use MVC\Event;
use MVC\Helper;
use MVC\Registry;
use MVC\Request;
use MVC\Session;
use Webbixx\DataType\DTConfig;

/**
 * Index
 */
class Index
{
	/**
	 * \Webbixx\Event\Index
	 * 
	 * @var \Webbixx\Event\Index
	 * @access private
	 * @static
	 */
	private static $_oInstance = NULL;

    /**
     * Index constructor.
     * @throws \ReflectionException
     */
    protected function __construct()
    {
        if (true === Registry::isRegistered('MODULE_Webbixx'))
        {
            $aEvent = Registry::get('MODULE_Webbixx');

            if (isset($aEvent['EVENT_BIND']))
            {
                foreach ($aEvent['EVENT_BIND'] as $sEvent => $mData)
                {
                    if (true === is_array($mData))
                    {
                        foreach ($mData as $oClosure)
                        {
                            Event::bind($sEvent, $oClosure, null);
                        }

                        continue;
                    }

                    Event::bind($sEvent, $mData);
                }
            }
        }
    }

    /**
     * Singleton instance
     * @return \Webbixx\Event\Index
     * @throws \ReflectionException
     */
    public static function getInstance()
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self ();
        }

        return self::$_oInstance;
    }

    /**
     * prevent any cloning
     *
     * @access private
     * @return void
     */
    private function __clone()
    {
        ;
    }

    /**
     * activates Session for Frontend Calls
     * gets active by triggered event "mvc.application.setSession.before"
     * @see /modules/{module}/etc/config/{module}/config/{env}.php
     * @param DTArrayObject $oDTArrayObject
     * @throws \ReflectionException
     */
    public static function enableSession(\MVC\DataType\DTArrayObject $oDTArrayObject)
    {
        $aEnableSessionForController = Registry::get('MODULE_Webbixx')['SESSION']['aEnableSessionForController'];
        $aDisableSessionForController = Registry::get('MODULE_Webbixx')['SESSION']['aDisableSessionForController'];

        $bEnable = (
            // current controller
            in_array(Request::getControllerName(), $aEnableSessionForController)
            ||
            // any
            in_array('*', $aEnableSessionForController)
        );

        $bDisable = (
            // current controller
            in_array(Request::getControllerName(), $aDisableSessionForController)
            ||
            // any
            in_array('*', $aDisableSessionForController)
        );

        if (true == $bEnable
            && false == $bDisable
            && isset($_COOKIE['myMVC_cookieConsent'])
            && "true" == $_COOKIE['myMVC_cookieConsent']
        )
        {
            Config::set_MVC_SESSION_ENABLE();
        }
    }
	
	/**
	 * Destructor
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct()
	{
		;
	}
}
 
