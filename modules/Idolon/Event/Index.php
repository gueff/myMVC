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
 * @name $IdolonEvent
 */
namespace Idolon\Event;

use MVC\Registry;

/**
 * Index
 */
class Index
{
	/**
	 * \Idolon\Event\Index
	 * 
	 * @var \Idolon\Event\Index
	 * @access private
	 * @static
	 */
	private static $_oInstance = NULL;
	
	/**
	 * Constructor
	 * 
	 * @access protected
	 * @return void
	 */
	protected function __construct()
	{
        ;
	}

	/**
	 * Singleton instance
	 *
	 * @access public
	 * @static
	 * @return \Idolon\Event\Index
	 */
	public static function getInstance ()
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
	private function __clone ()
	{
		;
	}

    /**
     * Serving Images
     */
    public static function startIdolon()
    {
        // get token
        $sToken = current(preg_split('@/@', \MVC\Request::getInstance()->getCurrentRequest()['path'], NULL, PREG_SPLIT_NO_EMPTY));

        if (isset(\MVC\Registry::get('MODULE_IDOLON')[$sToken]))
        {
            $aConfig = \MVC\Registry::get('MODULE_IDOLON')[$sToken];
            $aConfig['IDOLON_TOKEN'] = $sToken;

            (!isset($aConfig['IDOLON_MAX_CACHE_FILES_FOR_IMAGE']))
                ? $aConfig['IDOLON_MAX_CACHE_FILES_FOR_IMAGE'] = \MVC\Registry::get('MODULE_IDOLON')['IDOLON_MAX_CACHE_FILES_FOR_IMAGE']
                : false;
            (!isset($aConfig['IDOLON_PREVENT_OVERSIZING']))
                ? $aConfig['IDOLON_PREVENT_OVERSIZING'] = \MVC\Registry::get('MODULE_IDOLON')['IDOLON_PREVENT_OVERSIZING']
                : false;
            (!isset($aConfig['IDOLON_CACHE_PATH']))
                ? $aConfig['IDOLON_CACHE_PATH'] = \MVC\Registry::get('MODULE_IDOLON')['IDOLON_CACHE_PATH']
                : false;

            // Start Idolon
            $oControllerIdolon = new \Idolon\Controller\Index($aConfig);
            $oControllerIdolon->index();
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
 
