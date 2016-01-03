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

/**
 * Policy
 */
class Policy
{
	
	/**
	 * gets the policy rules; if one matches to the current request, it will be executed
	 *
	 * @access public
	 * @return void
	 */
	public function __construct ()
	{
		Event::RUN ('mvc.policy.before');

		Event::BIND ('mvc.error', function($mPackage)
		{
			\MVC\Error::addERROR ($mPackage);
		});

		$aPolicy = $this->getPolicyRuleOnCurrentRequest ();

		if (!empty ($aPolicy))
		{
			foreach ($aPolicy as $sPolicy)
			{
				if ('' !== $sPolicy)
				{
					// execute policy
					if (call_user_func ($sPolicy) === FALSE)
					{
						\MVC\Event::RUN ('mvc.error', "Policy could not be executed: " . $sPolicy);
					}
				}
			}
		}

		Event::RUN ('mvc.policy.after');
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
