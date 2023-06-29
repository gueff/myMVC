<?php
/**
 * Controller.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
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
     * Controller constructor.
     * @return bool
     * @throws \ReflectionException
     */
	public static function init()
	{
		Event::run ('mvc.controller.init.before', DTArrayObject::create());

		// start requested Module/Class/Method
		$oReflex = new Reflex();
		$bSuccess = $oReflex->reflect ();

        Event::run ('mvc.controller.init.after',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('bSuccess')->set_sValue($bSuccess)
                )
        );
        return $bSuccess;
	}

    /**
     * calls the "__preconstruct()" method
     * at the requested Controller
     * @throws \ReflectionException
     */
    public static function runTargetClassPreconstruct ()
    {
        $sTargetModule = Config::get_MVC_MODULES_DIR() . '/' . Route::getCurrent()->get_module();
        $sTargetClass = Route::getCurrent()->get_class();
        $sTargetClassFile = Route::getCurrent()->get_classFile();
        $sMethodNamePreconstruct = Config::get_MVC_METHODNAME_PRECONSTRUCT();

        if (false === file_exists($sTargetModule))
        {
            $sMessage = "\n"
                        . "Module missing\n" . Route::getCurrent()->get_module() . "\n\n"
                        . "Expected Filepath Target Controller\n" . $sTargetClassFile . "\n\n"
                        . "Abort.\n\n"
                        . str_repeat('-', 80) . "\n\n"
                        . "Documentation\nhttps://mymvc.ueffing.net/creating-a-module/\n\n"
            ;
            (Request::isHttp()) ? $sMessage = nl2br($sMessage) : false;
            echo $sMessage;
            Error::error(trim($sMessage));
            die();
        }

        if (!file_exists ($sTargetClassFile))
        {
            parse_str (Config::get_MVC_ROUTING_FALLBACK(), $aParse);
            $sTargetClass = '\\' . ucfirst ($aParse[Config::get_MVC_ROUTE_QUERY_PARAM_MODULE()]) . '\\' . ucfirst ($aParse[Config::get_MVC_ROUTE_QUERY_PARAM_C()]);
        }

        if (class_exists ($sTargetClass))
        {
            if (method_exists ($sTargetClass, $sMethodNamePreconstruct))
            {
                $sTargetClass::$sMethodNamePreconstruct();
            }
        }
        else
        {
            Event::run ('mvc.error',
                DTArrayObject::create()
                    ->add_aKeyValue(
                        DTKeyValue::create()->set_sKey('iLevel')->set_sValue(1)
                    )
                    ->add_aKeyValue(
                        DTKeyValue::create()->set_sKey('sMessage')->set_sValue(__FILE__ . ', ' . __LINE__ . "\t" . 'Class does not exist: `' . $sTargetClass . '`')
                    )
            );
        }

        Event::run ('mvc.controller.runTargetClassPreconstruct.after',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sClass')->set_sValue($sTargetClass)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sMethod')->set_sValue($sMethodNamePreconstruct)
                )
        );
    }

    /**
     * @throws \ReflectionException
     */
	public function __destruct ()
	{
        Event::run ('mvc.controller.destruct.before',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oController')->set_sValue($this)
                )
        );
	}
}