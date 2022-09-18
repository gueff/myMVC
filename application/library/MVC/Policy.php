<?php
/**
 * Policy.php
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
 * Policy
 */
class Policy
{
    /**
     * @var array error
     */
    private static $aApplied = array();

    /**
     * gets the policy rules; if one matches to the current request, it will be executed
     */
	public static function apply()
    {
        $aPolicy = self::getPolicyRuleOnCurrentRequest();

        if (!empty ($aPolicy))
        {
            foreach ($aPolicy as $sPolicy)
            {
                if ('' !== $sPolicy)
                {
                    $bSuccess = true;

                    // execute policy
                    if (false === call_user_func ($sPolicy))
                    {
                        $bSuccess = false;
                        Event::run ('mvc.error',
                            DTArrayObject::create()
                                ->add_aKeyValue(
                                    DTKeyValue::create()->set_sKey('sMessage')->set_sValue("Policy could not be executed: " . $sPolicy)
                                )
                        );
                    }

                    $oDTArrayObject = DTArrayObject::create()
                        ->add_aKeyValue(
                            DTKeyValue::create()->set_sKey('bSuccess')->set_sValue($bSuccess)
                        )
                        ->add_aKeyValue(
                            DTKeyValue::create()->set_sKey('sPolicy')->set_sValue($sPolicy)
                        );
                    self::$aApplied[] = $oDTArrayObject;
                    Event::run ('mvc.policy.apply.execute', $oDTArrayObject);
                }
            }
        }
    }

	/**
	 * gets the matching policy rules on the current request
     * @return array|mixed
     * @throws \ReflectionException
     */
	public static function getPolicyRuleOnCurrentRequest ()
	{
		$aPolicyRule = Config::get_MVC_POLICY();
		$oDTRoute = Route::getCurrent();

		// check if there is a policy for this request
        $sClass = (substr ($oDTRoute->get_class(), 0, 1) !== '\\') ? '\\' . $oDTRoute->get_class() : $oDTRoute->get_class();

        if (array_key_exists ($sClass, $aPolicyRule))
        {
            if (array_key_exists ($oDTRoute->get_method(), $aPolicyRule[$sClass]))
            {
                $aPolicy = $aPolicyRule[$sClass][$oDTRoute->get_method()];

                return $aPolicy;
            }
        }

		return array();
	}

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getRules()
    {
        return Config::get_MVC_POLICY();
    }

    /**
     * @return array
     */
    public static function getRulesApplied()
    {
        return self::$aApplied;
    }
}
