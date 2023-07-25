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

/**
 * Interface to be implemented in a Target Controller Class
 */
interface Controller
{	
	/**
	 * this method is autom. called by MVC_Application::runTargetClassPreconstruct()<br />
	 * this methodname is noted in the config:<br />
	 * $aConfig['MVC_METHODNAME_PRECONSTRUCT']
	 */	
	public static function __preconstruct ();

	/**
	 * Constructor
	 */
	public function __construct ();
	
	/**
	 * Destructor
	 */
	public function __destruct();
}