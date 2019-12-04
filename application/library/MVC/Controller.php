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

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;

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
		Event::RUN ('mvc.controller.begin',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oRequest')->set_sValue($oRequest)
                )
        );

		// get Request Array
		$aQueryArray = $oRequest->getQueryArray ();

		// start requested Module/Class/Method/Arguments
		$oReflex = new Reflex();
		$bSuccess = $oReflex->reflect ($aQueryArray);

		// Request not handable
		if ($bSuccess === FALSE)
		{
			Event::RUN ('mvc.controller.invalidRequest',
                DTArrayObject::create()
                    ->add_aKeyValue(
                        DTKeyValue::create()->set_sKey('oRequest')->set_sValue($oRequest)
                    )
            );
		}

        Event::RUN ('mvc.controller.done',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('bStatus')->set_sValue($bSuccess)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oRequest')->set_sValue($oRequest)
                )
        );
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
        Event::RUN ('mvc.controller.destruct',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oController')->set_sValue($this)
                )
        );
	}
	
}
