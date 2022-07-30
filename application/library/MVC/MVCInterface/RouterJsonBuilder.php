<?php
/**
 * RouterJsonBuilder.php
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
 * Interface to be implemented in a RouterJsonBuilder class
 */
interface RouterJsonBuilder
{
	/**
	 * Constructor
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct ();
	
	/**
	 * gets routing JSON string
	 * 
	 * @access public
	 * @return string JSON
	 */	
	public function getRoutingJson ();
	
	/**
	 * Destructor
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct ();
}