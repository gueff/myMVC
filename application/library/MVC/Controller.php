<?php
/**
 * Controller.php
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
 * Controller
 */
class Controller
{

	/**
	 * constructor; calls the requested MVC
	 * 
	 * @access public
	 * @param Request $oRequest
	 * @return void
	 */
	public function __construct (Request $oRequest)
	{
		Event::RUN ('mvc.controller.before');

		// get Request Array
		$aQueryArray = $oRequest->getQueryArray ();

		// start requested Module/Class/Method/Arguments
		$oReflex = new Reflex();
		$bStatus = $oReflex->reflect ($aQueryArray);

		// Request not handable
		if ($bStatus === FALSE)
		{
			Event::RUN ('mvc.invalidRequest');
		}
	}

	/**
	 * Destructor; 
	 * runs Event mvc.controller.destruct
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct ()
	{
		Event::RUN ('mvc.controller.destruct');
	}

}
