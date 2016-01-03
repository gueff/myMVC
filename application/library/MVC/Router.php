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

/**
 * Router
 */
class Router
{
	/**
	 * Constructor
	 * 
	 * @access public
	 * @return void
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
			$sMsg = 'ERROR: <br />Make sure `' . $sClass . '` <b>extends</b> ' . $sClassToCheck;
			Error::addERROR ($sMsg);
			Log::WRITE (strip_tags ($sMsg));
			Helper::STOP ($sMsg);
		}

		if (FALSE === filter_var (($oRouterObject instanceof $sInterfaceToCheck), FILTER_VALIDATE_BOOLEAN))
		{
			$sMsg = 'ERROR: <br />Make sure `' . $sClass . '` <b>implements</b> ' . $sInterfaceToCheck;
			Error::addERROR ($sMsg);
			Log::WRITE (strip_tags ($sMsg));
			Helper::STOP ($sMsg);
		}
		
		// save to registry
		$oRouterObject::SAVEROUTINGTOREGISTRY($oRouterObject->_aRouting, $oRouterObject->_sRequestUri);
	}
}
