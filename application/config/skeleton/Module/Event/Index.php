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
 * @name ${module}Event
 */
namespace {module}\Event;

use MVC\DataType\DTArrayObject;
use MVC\Event;
use MVC\Registry;
use MVC\Request;

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
        if (true === Registry::isRegistered('MODULE_{module}'))
        {
            $aEvent = Registry::get('MODULE_{module}');

            if (isset($aEvent['EVENT_BIND']))
            {
				foreach ($aEvent['EVENT_BIND'] as $sEvent => $mData)
				{
					if (true === is_array($mData))
					{
						foreach ($mData as $oClosure)
						{
							Event::BIND($sEvent, $oClosure, null);
						}

						continue;
					}

					Event::BIND($sEvent, $mData);
				}				
            }
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
 
