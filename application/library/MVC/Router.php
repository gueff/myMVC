<?php
/**
 * Router.php
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
use MVC\DataType\DTRoute;

/**
 * Router
 */
class Router
{
    /**
     * Router constructor.
     * @throws \ReflectionException
     */
	public function __construct ()
	{
		// default: class \MVC\RouterJsonfile
		// @see /application/config/config*.php
		$sClass = Registry::get ('MVC_ROUTING_HANDLING');

		$oRouterObject = new $sClass;

		$sClassToCheck = Registry::get ('MVC_ROUTER_JSON');
		$sInterfaceToCheck = Registry::get ('MVC_INTERFACE_ROUTER_JSON');

		if (false === is_subclass_of ($oRouterObject, $sClassToCheck))
		{
			$sMsg = 'ERROR: Make sure `' . $sClass . '` extends ' . $sClassToCheck;
			Error::addERROR (
                DTArrayObject::create()
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($sMsg))
            );
			Log::WRITE (strip_tags ($sMsg));
			Helper::STOP ($sMsg);
		}

		if (false === filter_var (($oRouterObject instanceof $sInterfaceToCheck), FILTER_VALIDATE_BOOLEAN))
		{
			$sMsg = 'ERROR: Make sure `' . $sClass . '` implements ' . $sInterfaceToCheck;
			Error::addERROR (
                DTArrayObject::create()
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($sMsg))
            );
			Log::WRITE (strip_tags($sMsg));
			Helper::STOP($sMsg);
		}

		// save to registry
		$oRouterObject::SAVEROUTINGTOREGISTRY($oRouterObject->_aRouting, $oRouterObject->_sRequestUri);
	}

    /**
     * @return array
     * @throws \ReflectionException
     */
	public static function getRouting()
    {
        if (Registry::isRegistered('MVC_ROUTING'))
        {
            return Registry::get('MVC_ROUTING');
        }

        return array();
    }

    public static function getRoutingObject()
    {
        $aRouting = self::getRouting();
        $aFinal = [];

        foreach ($aRouting as $sKey => $aRoute)
        {
            $aFinal[$sKey] = DTRoute::create()
                ->set_path($aRoute['path'])
                ->set_query($aRoute['query'])
                ->set_title($aRoute['title'])
                ->set_class($aRoute['class'])
                ->set_method($aRoute['method'])
                ->set_layout($aRoute['template']['layout'])
                ->set_style($aRoute['template']['style'])
                ->set_load($aRoute['template']['load'])
                ->set_script($aRoute['template']['script'])
            ;
        }

        return $aFinal;
    }
}
