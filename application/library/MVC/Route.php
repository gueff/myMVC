<?php
/**
 * Route.php
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

class Route
{
    /**
     * @var DTRoute[]
     */
    public static $aRoute = array();

    /**
     * @var array
     */
    public static $aMethod = array();

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function init()
    {
        $sRoutingDir = Config::get_MVC_MODULE_CURRENT_ETC_DIR() . '/routing';
        $aRouteFile = glob( $sRoutingDir . '/*php');

        foreach ($aRouteFile as $sRouteFile)
        {
            require_once $sRouteFile;
        }
    }

    /**
     * @param $sPath
     * @param $sQuery
     * @param $mOptional
     * @return void
     * @throws \ReflectionException
     */
    public static function get($sPath = '', $sQuery = '', $mOptional = '')
    {
        self::add('get', $sPath, $sQuery, $mOptional);
    }

    /**
     * @param $sPath
     * @param $sQuery
     * @param $mOptional
     * @return void
     * @throws \ReflectionException
     */
    public static function post($sPath = '', $sQuery = '', $mOptional = '')
    {
        self::add('post', $sPath, $sQuery, $mOptional);
    }

    /**
     * @param $sPath
     * @param $sQuery
     * @param $mOptional
     * @return void
     * @throws \ReflectionException
     */
    public static function put($sPath = '', $sQuery = '', $mOptional = '')
    {
        self::add('put', $sPath, $sQuery, $mOptional);
    }

    /**
     * @param $sPath
     * @param $sQuery
     * @param $mOptional
     * @return void
     * @throws \ReflectionException
     */
    public static function delete($sPath = '', $sQuery = '', $mOptional = '')
    {
        self::add('delete', $sPath, $sQuery, $mOptional);
    }

    /**
     * @param $sMethod
     * @param $sPath
     * @param $sQuery
     * @param $mOptional
     * @return void
     * @throws \ReflectionException
     */
    protected static function add($sMethod = 'get', $sPath = '', $sQuery = '', $mOptional = '')
    {
        parse_str(get($sQuery), $aQuery);
        $sClass = ucfirst(get($aQuery[Config::get_MVC_GET_PARAM_MODULE()])) . '\\Controller\\' . ucfirst(get($aQuery[Config::get_MVC_GET_PARAM_C()]));

        self::$aRoute[$sPath] = DTRoute::create()
            ->set_path($sPath)
            ->set_method(strtolower($sMethod))
            ->set_query($sQuery)
            ->set_class($sClass)
            ->set_classFile(Config::get_MVC_MODULES() . '/' . str_replace ('\\', '/', $sClass) . '.php')
            ->set_module($aQuery[Config::get_MVC_GET_PARAM_MODULE()])
            ->set_c($aQuery[Config::get_MVC_GET_PARAM_C()])
            ->set_m($aQuery[Config::get_MVC_GET_PARAM_M()])
            ->set_additional(
                (true === Strings::isJson($mOptional)) ? $mOptional : json_encode($mOptional)
            )
        ;
        self::$aMethod[strtolower($sMethod)][] = $sPath;
    }

    /**
     * @param $bWildcardsOnly
     * @return array|false
     */
    public static function getIndices($bWildcardsOnly = false)
    {
        $aIndex = (array) array_keys(self::$aRoute);

        if (false === $bWildcardsOnly)
        {
            return $aIndex;
        }

        // wildcards only
        $aIndex = preg_grep("/\/\*/i", $aIndex);

        return $aIndex;
    }

    /**
     * @param $sKey
     * @param $sValue
     * @return array
     */
    public static function getRouteIndexArrayOnKey($sKey = 'query', $sValue = '')
    {
        $aRoute = Convert::objectToArray(self::$aRoute);
        $aIndex = array();

        foreach ($aRoute as $iIndex => $aValue)
        {
            (get($aValue[$sKey]) === $sValue) ? $aIndex[] = $iIndex : false;
        }

        return $aIndex;
    }

    /**
     * @return \MVC\DataType\DTRoute
     * @throws \ReflectionException
     */
    public static function getCurrent()
    {
        // Request
        $sPath = Request::getCurrentRequest()->get_path();

        // Path 1:1 Match; e.g: /foo/bar/
        if (in_array($sPath, self::getIndices(), true))
        {
            return self::$aRoute[$sPath];
        }

        // Path 1:1 + Wildcard (/*) Match; e.g: /foo/bar/*
        $sIndex = self::getIndexOnWildcard($sPath);

        if (!empty($sIndex))
        {
            return self::$aRoute[$sIndex];
        }

        // Path Placeholder Match; e.g: /foo/bar/:id/:name/*
        $sIndex = self::getPathOnPlaceholderIndex($sPath);

        if (!empty($sIndex))
        {
            return self::$aRoute[$sIndex];
        }

        return self::handleFallback();
    }

    /**
     * @param $sPath
     * @return int|mixed|string
     */
    public static function getIndexOnWildcard($sPath = '')
    {
        $aIndex = self::getIndices(true);

        foreach ($aIndex as $sIndex)
        {
            // cutt off "*"
            $sIndexCutOff = substr($sIndex, 0, -1);

            if (substr($sPath, 0, strlen($sIndexCutOff)) === $sIndexCutOff)
            {
                return $sIndex;
            }
        }

        return '';
    }

    /**
     * @param $sPath
     * @return int|mixed|string|void
     */
    public static function getPathOnPlaceholderIndex($sPath = '')
    {
        // Request
        $aPartPath = preg_split('@/@', $sPath, null, PREG_SPLIT_NO_EMPTY);
        $iLengthPath = count($aPartPath);
        $aIndex = self::getIndices();

        foreach ($aIndex as $iKey => $sValue)
        {
            $aPartMatch = array_diff(preg_split('@/@', $sValue, null, PREG_SPLIT_NO_EMPTY), array('*')); # delete "*"
            $sLastCharRight = substr($sValue, -1);
            $bIsWildcard = ('*' === $sLastCharRight) ? true : false;
            $iLengthFoo = count($aPartMatch);

            // string part before first placeholder has to match
            $sStrToK = strtok($sValue, ':');
            $bPartBeforePlaceholderMatch = (substr($sPath, 0, strlen($sStrToK)) === $sStrToK) ? true : false;
            $sPart = '/';

            for ($i = 0; $i < $iLengthFoo; $i++)
            {
                $sPart.= get($aPartPath[$i]) . '/';
            }

            $sTail = substr($sPath, strlen($sPart));

            // detect placeholder route match
            if (
                true === $bPartBeforePlaceholderMatch &&
                (
                    // has exact same amount of / parts
                    $iLengthPath === $iLengthFoo
                    OR
                    // has minimum amount of / parts and is wildcard (has tail)
                    (true === $bIsWildcard && $iLengthPath >= $iLengthFoo)
                )
            )
            {
                $aPlaceholder = preg_grep('/:/i', $aPartMatch);
                $aPathParam = array();

                foreach ($aPlaceholder as $iIndex => $sPlaceholder)
                {
                    $sPlaceholder = substr($sPlaceholder, 1);
                    $aPathParam[$sPlaceholder] = $aPartPath[$iIndex];
                }

                $aPathParam['_tail'] = $sTail;
                Request::setPathParam($aPathParam);

                return $aIndex[$iKey];
            }
        }
    }

    /**
     * @return \MVC\DataType\DTRoute
     * @throws \ReflectionException
     */
    protected static function handleFallback()
    {
        $sIndex = current(self::getRouteIndexArrayOnKey('query', Config::get_MVC_ROUTING_FALLBACK()));

        /** @var DTRoute $oRoutingCurrent */
        $oRoutingCurrent = get(self::$aRoute[$sIndex], array());

        if (true === empty($oRoutingCurrent))
        {
            return DTRoute::create();
        }

        Event::run (
            'mvc.route.handleFallback.after',
            DTArrayObject::create()
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sRequest')->set_sValue(Request::getServerRequestUri()))
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sForward')->set_sValue($sIndex))
        );

        return $oRoutingCurrent;
    }
}