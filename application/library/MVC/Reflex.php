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
	 * 
	 * @access public
	 * @param array $aQueryArray
	 * @return boolean
	 */
	public function reflect (array $aQueryArray = array ())
	{
		Event::RUN ('mvc.reflect.start');

		if (empty ($aQueryArray))
		{
			return FALSE;
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

				if (FALSE === filter_var (($oReflectionObject instanceof \MVC\MVCInterface\Controller), FILTER_VALIDATE_BOOLEAN))
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
						return FALSE;
					}

					// run an event and store the object of the target class within
					Event::RUN ('mvc.reflect.targetObject.before', $oReflectionObject);

					// run an event which KEY is
					//		Class::method 
					// of the requested Target
					// and store the object of the target class within
					Event::RUN ($sControllerClassName . '::' . $sMethod, $oReflectionObject);
					
					// static Method or not-static
					if (true === filter_var ($oReflectionMethod->isStatic (), FILTER_VALIDATE_BOOLEAN))
					{
						$oReflectionObject::$sMethod ($sArgs);
					}
					else
					{
						$oReflectionObject->$sMethod ($sArgs);
					}
					
					Event::RUN ('mvc.reflect.targetObject.after', $oReflectionObject);
					return true;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				return FALSE;
			}
		}

		return FALSE;
	}

	/**
	 * runs event 'mvc.reflex.destruct'
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct ()
	{
		Event::RUN ('mvc.reflex.destruct');
	}

}
