<?php
/**
 * Policy.php
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
 * Policy
 */
class Policy
{
	
    /**
     * Policy constructor.
     */
	public function __construct ()
	{
        $this->apply();
	}

    /**
     * gets the policy rules; if one matches to the current request, it will be executed
     */
	protected function apply()
    {
        $aPolicy = $this->getPolicyRuleOnCurrentRequest ();

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
                        Event::RUN ('mvc.error',
                            DTArrayObject::create()
                                ->add_aKeyValue(
                                    DTKeyValue::create()->set_sKey('sMessage')->set_sValue("Policy could not be executed: " . $sPolicy)
                                )
                        );
                    }

                    Event::RUN ('mvc.policy.apply.execute',
                        DTArrayObject::create()
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('bSuccess')->set_sValue($bSuccess)
                            )
                            ->add_aKeyValue(
                                DTKeyValue::create()->set_sKey('sPolicy')->set_sValue($sPolicy)
                            )
                    );
                }
            }
        }
    }

	/**
	 * gets the policy rules from registry
	 * 
	 * @access public
	 * @static
	 * @return array
	 */
	public static function getPolicyRules ()
	{
		return Registry::get ('MVC_POLICY');
	}

	/**
	 * gets the matching policy rules on the current request
	 * 
	 * @access public
	 * @static
	 * @return array Class/Methods to run | empty
	 */
	public static function getPolicyRuleOnCurrentRequest ()
	{
		$aPolicyRule = self::getPolicyRules ();
		$aCurrent = Registry::get ('MVC_ROUTING_CURRENT');

		// check if there is a policy for this request
		if (array_key_exists ('class', $aCurrent))
		{
			$sClass = (substr ($aCurrent['class'], 0, 1) !== '\\') ? '\\' . $aCurrent['class'] : $aCurrent['class'];

			if (array_key_exists ($sClass, $aPolicyRule))
			{
				if (array_key_exists (Request::getInstance ()->getMethod (), $aPolicyRule[$sClass]))
				{
					$aPolicy = $aPolicyRule[$sClass][Request::getInstance ()->getMethod ()];

					return $aPolicy;
				}
			}
		}

		return array();
	}
}
