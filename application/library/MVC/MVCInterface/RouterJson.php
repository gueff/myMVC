<?php
/**
 * RouterJson.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVC\MVCInterface
 */
namespace  MVC\MVCInterface;

/**
 * Interface to be implemented in a RouterJson class
 */
interface RouterJson
{
	/**
	 * Constructor
	 */
	public function __construct ();
	
	/**
	 * returns the routing as array
	 */
	public static function GETROUTINGARRAY();
	
	/**
	 * returns the routing as JSON
	 */
	public static function GETROUTINGJSON();
	
	/**
	 * saves routing array to MVC_ROUTING<br /> 
	 * and the current one to MVC_ROUTING_CURRENT
	 * 
	 * @param array $aRouting Routing Array
	 * @param string $sRequestUri Request URI
	 */
	public static function SAVEROUTINGTOREGISTRY (array $aRouting, $sRequestUri);
	
	/**
	 * Destructor
	 */
	public function __destruct ();
}