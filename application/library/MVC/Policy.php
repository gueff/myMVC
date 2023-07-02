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
use MVC\DataType\DTRoute;

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
     * @return void
     * @throws \ReflectionException
     */
    public static function init()
    {
        \MVC\Event::RUN('mvc.policy.init.before');

        $sPolicyDir = Config::get_MVC_MODULE_CURRENT_ETC_DIR() . '/policy';

        if (true === file_exists($sPolicyDir))
        {
            //  require recursively all php files in module's policy dir
            /** @var \SplFileInfo $oSplFileInfo */
            foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($sPolicyDir)) as $oSplFileInfo)
            {
                if ('php' === strtolower($oSplFileInfo->getExtension()))
                {
                    require_once $oSplFileInfo->getPathname();
                }
            }
        }

        self::apply();

        \MVC\Event::RUN('mvc.policy.init.after');
    }

    /**
     * sets a policy rule
     * @param $sClass
     * @param $sMethod
     * @param $mTarget string|array
     * @return void
     * @throws \ReflectionException
     */
    public static function set($sClass = '', $sMethod = '', $mTarget = null)
    {
        $aPolicy = Config::get_MVC_POLICY();

        \MVC\Event::RUN('mvc.policy.set.before', $aPolicy);

        if (true === isset($aPolicy[$sClass]))
        {
            if (true === isset($aPolicy[$sClass][$sMethod]))
            {
                if (is_array($mTarget))
                {
                    foreach ($mTarget as $sTarget)
                    {
                        if (false === in_array($sTarget, $aPolicy[$sClass][$sMethod]))
                        {
                            $aPolicy[$sClass][$sMethod][] = $sTarget;
                        }
                    }
                }
                else
                {
                    if (false === in_array($mTarget, $aPolicy[$sClass][$sMethod]))
                    {
                        $aPolicy[$sClass][$sMethod][] = $mTarget;
                    }
                }
            }
            else
            {
                $aPolicy[$sClass][$sMethod] = $mTarget;
            }
        }
        else
        {
            (is_array($mTarget))
                ? $aPolicy[$sClass] = array($sMethod => $mTarget)
                : $aPolicy[$sClass] = array($sMethod => array($mTarget))
            ;
        }

        \MVC\Event::RUN('mvc.policy.set.after', $aPolicy);

        Config::set_MVC_POLICY($aPolicy);
    }

    /**
     * unsets a policy rule
     * @param $sClass
     * @param $sMethod
     * @param $mTarget
     * @return void
     * @throws \ReflectionException
     */
    public static function unset($sClass = '', $sMethod = '', $mTarget = null)
    {
        $aPolicy = Config::get_MVC_POLICY();

        \MVC\Event::RUN('mvc.policy.unset.before', $aPolicy);

        // Unset all rules set to controller
        if ('' !== $sClass && '' === $sMethod && null === $mTarget)
        {
            if (isset($aPolicy[$sClass]))
            {
                $aPolicy[$sClass] = null;
                unset($aPolicy[$sClass]);
            }
        }
        // Unset all target methods set to controller
        elseif ('' !== $sClass && '' !== $sMethod && null === $mTarget)
        {
            if (isset($aPolicy[$sClass][$sMethod]))
            {
                $aPolicy[$sClass][$sMethod] = null;
                unset($aPolicy[$sClass][$sMethod]);
            }

            if (true === empty($aPolicy[$sClass]))
            {
                $aPolicy[$sClass] = null;
                unset($aPolicy[$sClass]);
            }
        }
        // Unset certain target method(s)
        elseif ('' !== $sClass && '' !== $sMethod && null !== $mTarget)
        {
            if (is_array($mTarget))
            {
                foreach ($mTarget as $sTarget)
                {
                    if (isset($aPolicy[$sClass][$sMethod]) && in_array($sTarget, $aPolicy[$sClass][$sMethod], true))
                    {
                        $iKey = array_search($sTarget, $aPolicy[$sClass][$sMethod]);
                        $aPolicy[$sClass][$sMethod][$iKey] = null;
                        unset($aPolicy[$sClass][$sMethod][$iKey]);
                    }
                }

                if (true === empty($aPolicy[$sClass][$sMethod]))
                {
                    $aPolicy[$sClass][$sMethod] = null;
                    unset($aPolicy[$sClass][$sMethod]);
                }

                if (true === empty($aPolicy[$sClass]))
                {
                    $aPolicy[$sClass] = null;
                    unset($aPolicy[$sClass]);
                }
            }
            else
            {
                if (isset($aPolicy[$sClass][$sMethod]) && in_array($mTarget, $aPolicy[$sClass][$sMethod], true))
                {
                    $iKey = array_search($mTarget, $aPolicy[$sClass][$sMethod]);
                    $aPolicy[$sClass][$sMethod][$iKey] = null;
                    unset($aPolicy[$sClass][$sMethod][$iKey]);
                }

                if (true === empty($aPolicy[$sClass][$sMethod]))
                {
                    $aPolicy[$sClass][$sMethod] = null;
                    unset($aPolicy[$sClass][$sMethod]);
                }

                if (true === empty($aPolicy[$sClass]))
                {
                    $aPolicy[$sClass] = null;
                    unset($aPolicy[$sClass]);
                }
            }
        }

        \MVC\Event::RUN('mvc.policy.unset.after', $aPolicy);

        Config::set_MVC_POLICY($aPolicy);
    }

    /**
     * gets the policy rules; if one matches to the current request, it will be executed
     * @return void
     * @throws \ReflectionException
     */
    protected static function apply()
    {
        $aPolicy = self::getPolicyRuleOnCurrentRequest();

        \MVC\Event::RUN('mvc.policy.apply.before', $aPolicy);

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
        $aPolicy = array();

        // check if there is a policy for this request
        $sClass = (substr ($oDTRoute->get_class(), 0, 1) !== '\\') ? '\\' . $oDTRoute->get_class() : $oDTRoute->get_class();

        if (array_key_exists ($sClass, $aPolicyRule))
        {
            if (array_key_exists ('*', $aPolicyRule[$sClass]))
            {
                $aPolicy = array_merge(
                    $aPolicy,
                    $aPolicyRule[$sClass]['*']
                );
            }

            if (array_key_exists ($oDTRoute->get_m(), $aPolicyRule[$sClass]))
            {
                $aPolicy = array_merge(
                    $aPolicyRule[$sClass][$oDTRoute->get_m()],
                    $aPolicy
                );
            }
        }

        return $aPolicy;
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

    /**
     * @param \MVC\DataType\DTRoute $oDTRoute
     * @param                       $mTarget
     * @return void
     * @throws \ReflectionException
     */
    public static function bindOnRoute(DTRoute $oDTRoute, $mTarget = null)
    {
        self::set(
            '\\' . $oDTRoute->get_class(),
            $oDTRoute->get_m(),
            $mTarget
        );
    }

    /**
     * @param \MVC\DataType\DTRoute $oDTRoute
     * @param                       $mTarget
     * @return void
     * @throws \ReflectionException
     */
    public static function unbindRoute(DTRoute $oDTRoute, $mTarget = null)
    {
        self::unset(
            '\\' . $oDTRoute->get_class(),
            $oDTRoute->get_m(),
            $mTarget
        );
    }
}