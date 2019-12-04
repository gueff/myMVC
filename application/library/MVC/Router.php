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

		if (FALSE === is_subclass_of ($oRouterObject, $sClassToCheck))
		{
			$sMsg = 'ERROR: Make sure `' . $sClass . '` extends ' . $sClassToCheck;
			Error::addERROR (
                DTArrayObject::create()
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($sMsg))
            );
			Log::WRITE (strip_tags ($sMsg));
			Helper::STOP ($sMsg);
		}

		if (FALSE === filter_var (($oRouterObject instanceof $sInterfaceToCheck), FILTER_VALIDATE_BOOLEAN))
		{
			$sMsg = 'ERROR: Make sure `' . $sClass . '` implements ' . $sInterfaceToCheck;
			Error::addERROR (
                DTArrayObject::create()
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($sMsg))
            );
			Log::WRITE (strip_tags ($sMsg));
			Helper::STOP ($sMsg);
		}
		
		// save to registry
		$oRouterObject::SAVEROUTINGTOREGISTRY($oRouterObject->_aRouting, $oRouterObject->_sRequestUri);
	}
}
