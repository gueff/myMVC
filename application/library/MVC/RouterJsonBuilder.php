<?php
/**
 * RouterJsonBuilder.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
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
 * ***************************************
 * *** YOU DO NOT EDIT THIS CLASS
 * ***************************************
 * 
 * if you want an alternative json building algorithm
 * 
 * 1.	just build a new class for that
 * 		(do not forget to implement the Interface
 * 		\MVC\MVCInterface\RouterJsonBuilder)
 * 
 * 2.	edit the config file and place the name of the new class:
 * 		$aConfig['MVC_ROUTING_JSON_BUILDER'] = ??
 */
class RouterJsonBuilder implements \MVC\MVCInterface\RouterJsonBuilder
{
	/**
	 * Constructor
	 * @return void
	 */
	public function __construct ()
	{
		;
	}

	/**
	 * gets routing JSON string
     * @return string
     * @throws \ReflectionException
     */
	public function getRoutingJson ()
	{
        if (false === file_exists(Config::get_MVC_ROUTING_JSON()))
        {
            return '';
        }

        $mContent = file_get_contents (Config::get_MVC_ROUTING_JSON());
        (false === $mContent) ? $mContent = '' : false;

        return $mContent;
	}

	/**
	 * Destructor
	 * @return void
	 */
	public function __destruct ()
	{
		;
	}
}