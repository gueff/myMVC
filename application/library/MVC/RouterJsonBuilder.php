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
 * @name $MVC
 */
namespace MVC;

/**
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */


/**
 * RouterJsonBuilder
 * 
 * @implements \MVC\MVCInterface\RouterJsonBuilder
 * 
 * ***************************************<br />
 * *** YOU SHOULD NOT EDIT THIS CLASS     <br />
 * ***************************************
 * 
 * if you want an alternative json building algorithm
 * 
 * 1.	just build a new class for that<br />
 * 		(do not forget to implement the Interface<br />
 * 		\MVC\MVCInterface\RouterJsonBuilder)
 * 
 * 2.	edit the config file and place the name of the new class:<br />
 * 		$aConfig['MVC_ROUTING_JSON_BUILDER'] = ??
 */
class RouterJsonBuilder implements \MVC\MVCInterface\RouterJsonBuilder
{
	/**
	 * Constructor
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct ()
	{
		;
	}

	/**
	 * gets routing JSON string
     * @return false|string
     * @throws \ReflectionException
     */
	public function getRoutingJson ()
	{
		return file_get_contents (Registry::get ('MVC_ROUTING_JSON'));
	}

	/**
	 * Destructor
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct ()
	{
		;
	}
}
