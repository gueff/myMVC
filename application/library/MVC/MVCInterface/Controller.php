<?php
/**
 * Controller.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVC\MVCInterface
 */
namespace  MVC\MVCInterface;

use MVC\DataType\DTRequestCurrent;
use MVC\DataType\DTRoute;

/**
 * Interface to be implemented in a Target Controller Class
 */
interface Controller
{	
	/**
	 * this method is autom. called by MVC_Application::runTargetClassPreconstruct()
	 * this methodname is noted in the config:
	 * $aConfig['MVC_METHODNAME_PRECONSTRUCT']
	 */	
	public static function __preconstruct();

    /**
     * @param \MVC\DataType\DTRequestCurrent $oDTRequestCurrent
     * @param \MVC\DataType\DTRoute          $oDTRoute
     */
	public function __construct(DTRequestCurrent $oDTRequestCurrent, DTRoute $oDTRoute);
	
	/**
	 * Destructor
	 */
	public function __destruct();
}