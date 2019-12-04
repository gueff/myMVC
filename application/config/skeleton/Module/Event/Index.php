<?php
/**
 * Index.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

use MVC\DataType\DTArrayObject;
use MVC\Event;
use MVC\Registry;
use MVC\Request;

/**
 * @name ${module}Event
 */
namespace {module}\Event;

/**
 * Index
 */
class Index
{
	/**
	 * \{module}\Event\Index
	 * 
	 * @var \{module}\Event\Index
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
        $aEvent = Registry::get('MODULE_{module}');

        foreach ($aEvent['EVENT_BIND'] as $sEvent => $oClosure)
        {
            Event::BIND($sEvent, $oClosure);
        }
    }

    /**
     * Singleton instance
     * @return \{module}\Event\Index
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
     * @param DTArrayObject $oDTArrayObject
     * @throws \ReflectionException
     */
    public static function enableSession(\MVC\DataType\DTArrayObject $oDTArrayObject)
    {
        // Request via GUI
        $bIsGuiRequest = in_array(
            Request::getInstance()->getController(),
            Registry::get('MODULE_{module}')['SESSION']['aEnableSessionForController']
        );

        if (true === $bIsGuiRequest &&
            isset($_COOKIE['myMVC_cookieConsent']) &&
            "true" == $_COOKIE['myMVC_cookieConsent'])
        {
            \MVC\Registry::set('MVC_SESSION_ENABLE', true);
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
 
