<?php
/**
 * Reflex.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;

/**
 * Reflex
 */
class Reflex
{
	public function __construct()
	{
		;
	}

	/**
	 * executes the target (requested) controller class and its method
     * @return bool
     * @throws \ReflectionException
     */
	public function reflect() : bool
	{
        $oDTRoute = Route::getCurrent();
        $sModule = $oDTRoute->get_module();
        $sClass = $oDTRoute-> get_c();
        $sMethod = $oDTRoute->get_m();

        Event::run ('mvc.reflex.reflect.before',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('Route.getCurrent')->set_sValue($oDTRoute)
                )
        );

        // Fallback Target
		if ($sModule == '' && $sClass == '')
		{
			parse_str (Config::get_MVC_ROUTING_FALLBACK(), $aParse);
			$sControllerClassName = '\\' . ucfirst ($aParse[Config::get_MVC_ROUTE_QUERY_PARAM_MODULE()]) . '\\Controller\\' . ucfirst ($aParse[Config::get_MVC_ROUTE_QUERY_PARAM_C()]);
		}
		// Regular Target
		else
		{
			$sControllerClassName = '\\' . ucfirst ($sModule) . '\\Controller\\' . ucfirst ($sClass);
		}

		$sControllerFilename = $oDTRoute->get_classFile();

		if (file_exists ($sControllerFilename))
		{
			if (class_exists ($sControllerClassName))
			{
				// Singleton or New
				if (method_exists ($sControllerClassName, 'getInstance'))
				{
					$oReflectionObject = $sControllerClassName::getInstance(Request::getCurrentRequest(), $oDTRoute);

                    // run an event which KEY is
                    //		Class::method
                    // of the requested Target
                    // and store the object of the target class within
                    Event::run ($sControllerClassName . '::getInstance',
                        DTArrayObject::create()
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('oReflectionObject')->set_sValue($oReflectionObject)
                            )
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('sMethod')->set_sValue('getInstance')
                            )
                    );
				}
				else
				{
					$oReflectionObject = new $sControllerClassName(Request::getCurrentRequest(), $oDTRoute);

                    // run an event which KEY is
                    //		Class::method
                    // of the requested Target
                    // and store the object of the target class within
                    Event::run ($sControllerClassName . '::__construct',
                        DTArrayObject::create()
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('oReflectionObject')->set_sValue($oReflectionObject)
                            )
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('sMethod')->set_sValue('__construct')
                            )
                    );
				}

				if (false === filter_var (($oReflectionObject instanceof \MVC\MVCInterface\Controller), FILTER_VALIDATE_BOOLEAN))
				{
					$sMsg = 'ERROR: <br />Make sure `' . $sControllerClassName . '` <b>implements</b> \MVC\MVCInterface\Controller';
                    Error::error(strip_tags ($sMsg));
					Debug::stop ($sMsg);
				}

				if ($sMethod != '')
				{
					try
					{
						$oReflectionMethod = new \ReflectionMethod($sControllerClassName, $sMethod);
					}
					catch (\ReflectionException $oReflectionException)
					{
                        Error::exception($oReflectionException);

						return false;
					}

					// run an event and store the object of the target class within
					Event::run ('mvc.reflex.reflect.targetObject.before',
                        DTArrayObject::create()
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('oReflectionObject')->set_sValue($oReflectionObject)
                            )
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('sMethod')->set_sValue($sMethod)
                            )
                    );

                    // run an event which KEY is
                    //		Class::method
                    // of the requested Target
                    // and store the object of the target class within
                    Event::run ($sControllerClassName . '::' . $sMethod,
                        DTArrayObject::create()
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('oReflectionObject')->set_sValue($oReflectionObject)
                            )
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('sMethod')->set_sValue($sMethod)
                            )
                    );

					// static Method or not-static
					if (true === filter_var ($oReflectionMethod->isStatic(), FILTER_VALIDATE_BOOLEAN))
					{
						$oReflectionObject::$sMethod(Request::getCurrentRequest(), $oDTRoute);
					}
					else
					{
						$oReflectionObject->$sMethod(Request::getCurrentRequest(), $oDTRoute);
					}
					
					Event::run ('mvc.reflex.reflect.targetObject.after',
                        DTArrayObject::create()
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('oReflectionObject')->set_sValue($oReflectionObject)
                            )
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('sMethod')->set_sValue($sMethod)
                            )
                    );

					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}

		return false;
	}

	/**
	 * runs event 'mvc.reflex.destruct'
     * @throws \ReflectionException
     */
	public function __destruct ()
	{
        Event::run ('mvc.reflex.destruct.before',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oReflex')->set_sValue($this)
                )
        );
	}
}