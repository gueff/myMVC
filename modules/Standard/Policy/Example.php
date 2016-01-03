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
 * @name $StandardPolicy
 */
namespace Standard\Policy;

/**
 * Index
 */
class Example
{
	/**
	 * method to run on policy rule
	 * 
	 * @access public
	 * @static
	 * @return void
	 */	
	public static function test1 ()
	{
//		\MVC\Helper::DISPLAY(\MVC\Policy::getPolicyRules());
		\MVC\Log::WRITE(\MVC\Policy::getPolicyRules());
	}
	
	/**
	 * method to run on policy rule
	 * 
	 * @access public
	 * @static
	 * @return void
	 */	
	public static function test2 ()
	{
//		\MVC\Helper::DISPLAY(\MVC\Policy::getPolicyRuleOnCurrentRequest());
		\MVC\Log::WRITE(\MVC\Policy::getPolicyRuleOnCurrentRequest());
	}	
}
