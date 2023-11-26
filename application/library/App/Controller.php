<?php
/**
 * Controller.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace App;

use MVC\DataType\DTRequestCurrent;
use MVC\DataType\DTRoute;

/**
 * Controller
 */
class Controller implements \MVC\MVCInterface\Controller
{
    /**
     * @return void
     */
    public static function __preconstruct()
    {
        ;
    }

    /**
     * @param \MVC\DataType\DTRequestCurrent $oDTRequestCurrent
     * @param \MVC\DataType\DTRoute          $oDTRoute
     * @throws \ReflectionException
     */
    public function __construct(DTRequestCurrent $oDTRequestCurrent, DTRoute $oDTRoute)
    {

    }

    /**
     *
     */
    public function __destruct()
    {
        ;
    }
}
