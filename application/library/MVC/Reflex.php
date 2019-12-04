<?php
/**
 * Reflex.php
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
 * Reflex
 */
class Reflex
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
	 * executes the target (requested) controller class and its method
     * @param array $aQueryArray
     * @return bool
     * @throws \ReflectionException
     */
	public function reflect (array $aQueryArray = array ())
	{
		Event::RUN ('mvc.reflex.reflect.begin',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('aQueryArray')->set_sValue($aQueryArray)
                )
        );

		if (empty ($aQueryArray))
		{
			return false;
		}

		(array_key_exists (Registry::get ('MVC_GET_PARAM_MODULE'), $aQueryArray['GET'])) ? $sModule = $aQueryArray['GET'][Registry::get ('MVC_GET_PARAM_MODULE')] : $sModule = '';
		(array_key_exists (Registry::get('MVC_GET_PARAM_C'), $aQueryArray['GET'])) ? $sClass = $aQueryArray['GET'][Registry::get('MVC_GET_PARAM_C')] : $sClass = '';
		(array_key_exists (Registry::get ('MVC_GET_PARAM_M'), $aQueryArray['GET'])) ? $sMethod = $aQueryArray['GET'][Registry::get ('MVC_GET_PARAM_M')] : $sMethod = '';
		(array_key_exists (Registry::get ('MVC_GET_PARAM_A'), $aQueryArray['GET'])) ? $sArgs = $aQueryArray['GET'][Registry::get ('MVC_GET_PARAM_A')] : $sArgs = '';

		// Fallback Target
		if ($sModule == '' && $sClass == '')
		{
			parse_str (Registry::get ('MVC_ROUTING_FALLBACK'), $aParse);
			$sControllerClassName = '\\' . ucfirst ($aParse[Registry::get ('MVC_GET_PARAM_MODULE')]) . '\\Controller\\' . ucfirst ($aParse[Registry::get('MVC_GET_PARAM_C')]);
		}
		// Regular Target
		else
		{
			$sControllerClassName = '\\' . ucfirst ($sModule) . '\\Controller\\' . ucfirst ($sClass);
		}
		
		$sControllerFilename = Registry::get ('MVC_MODULES') . '/' . $sModule . '/Controller/' . $sClass . '.php';
		$sFile = Registry::get ('MVC_MODULES') . '/' . str_replace ('\\', '/', $sControllerClassName) . '.php';

		if (file_exists ($sControllerFilename))
		{
			if (class_exists ($sControllerClassName))
			{
				// Singleton or New
				if (method_exists ($sControllerClassName, 'getInstance'))
				{
					$oReflectionObject = $sControllerClassName::getInstance ($sArgs);
				}
				else
				{
					$oReflectionObject = new $sControllerClassName ($sArgs);
				}

				if (false === filter_var (($oReflectionObject instanceof \MVC\MVCInterface\Controller), FILTER_VALIDATE_BOOLEAN))
				{
					//@todo ERROR
					$sMsg = 'ERROR: <br />Make sure `' . $sControllerClassName . '` <b>implements</b> \MVC\MVCInterface\Controller';
					Log::WRITE (strip_tags ($sMsg));
					Helper::STOP ($sMsg);
				}

				if ($sMethod != '')
				{
					try
					{
						$oReflectionMethod = new \ReflectionMethod ($sControllerClassName, $sMethod);
					}
					catch (\ReflectionException $oReflectionException)
					{
						return false;
					}

					// run an event and store the object of the target class within
					Event::RUN ('mvc.reflex.reflect.targetObject.before',
                        DTArrayObject::create()
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('oReflectionObject')->set_sValue($oReflectionObject)
                            )
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('sMethod')->set_sValue($sMethod)
                            )
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('sArgs')->set_sValue($sArgs)
                            )
                    );

					// run an event which KEY is
					//		Class::method 
					// of the requested Target
					// and store the object of the target class within
					Event::RUN ($sControllerClassName . '::' . $sMethod,
                        DTArrayObject::create()
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('oReflectionObject')->set_sValue($oReflectionObject)
                            )
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('sMethod')->set_sValue($sMethod)
                            )
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('sArgs')->set_sValue($sArgs)
                            )
                    );
					
					// static Method or not-static
					if (true === filter_var ($oReflectionMethod->isStatic (), FILTER_VALIDATE_BOOLEAN))
					{
						$oReflectionObject::$sMethod ($sArgs);
					}
					else
					{
						$oReflectionObject->$sMethod ($sArgs);
					}
					
					Event::RUN ('mvc.reflex.reflect.targetObject.after',
                        DTArrayObject::create()
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('oReflectionObject')->set_sValue($oReflectionObject)
                            )
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('sMethod')->set_sValue($sMethod)
                            )
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('sArgs')->set_sValue($sArgs)
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
        Event::RUN ('mvc.reflex.destruct',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oReflex')->set_sValue($this)
                )
        );
	}

}
