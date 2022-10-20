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
        //  require recursively all php files in module's routing dir
        /** @var \SplFileInfo $oSplFileInfo */
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(Config::get_MVC_MODULE_CURRENT_ETC_DIR() . '/routing')) as $oSplFileInfo)
        {
            if ('php' === strtolower($oSplFileInfo->getExtension()))
            {
                require_once $oSplFileInfo->getPathname();
            }
        }
    }

    /**
     * @param string $sPath
     * @param string $sQuery
     * @param        $mOptional
     * @return void
     * @throws \ReflectionException
     */
    public static function ANY(string $sPath = '', string $sQuery = '', $mOptional = '')
    {
        self::add('*', $sPath, $sQuery, $mOptional);
    }

    /**
     * @param array  $aMethod
     * @param string $sPath
     * @param string $sQuery
     * @param        $mOptional
     * @return void
     * @throws \ReflectionException
     */
    public static function MIX(array $aMethod = array(), string $sPath = '', string $sQuery = '', $mOptional = '')
    {
        foreach ($aMethod as $sMethod)
        {
            self::add(strtoupper($sMethod), $sPath, $sQuery, $mOptional);
        }
    }

    /**
     * @param string $sPath
     * @param string $sQuery
     * @param        $mOptional
     * @return void
     * @throws \ReflectionException
     */
    public static function GET(string $sPath = '', string $sQuery = '', $mOptional = '')
    {
        self::add('GET', $sPath, $sQuery, $mOptional);
    }

    /**
     * @param string $sPath
     * @param string $sQuery
     * @param        $mOptional
     * @return void
     * @throws \ReflectionException
     */
    public static function POST(string $sPath = '', string $sQuery = '', $mOptional = '')
    {
        self::add('POST', $sPath, $sQuery, $mOptional);
    }

    /**
     * @param string $sPath
     * @param string $sQuery
     * @param        $mOptional
     * @return void
     * @throws \ReflectionException
     */
    public static function PUT(string $sPath = '', string $sQuery = '', $mOptional = '')
    {
        self::add('PUT', $sPath, $sQuery, $mOptional);
    }

    /**
     * @param string $sPath
     * @param string $sQuery
     * @param        $mOptional
     * @return void
     * @throws \ReflectionException
     */
    public static function DELETE(string $sPath = '', string $sQuery = '', $mOptional = '')
    {
        self::add('DELETE', $sPath, $sQuery, $mOptional);
    }

    /**
     * @param string $sMethod
     * @param string $sPath
     * @param string $sQuery
     * @param mixed  $mOptional
     * @return void
     * @throws \ReflectionException
     */
    protected static function add(string $sMethod = 'GET', string $sPath = '', string $sQuery = '', $mOptional = '')
    {
        parse_str(get($sQuery), $aQuery);

        // allows schema '\Foo\Controller\Api::bar' next to 'module=Foo&c=Api&m=bar'
        if (null === get($aQuery['m']))
        {
            $aQuery = array();
            list($aQuery[Config::get_MVC_GET_PARAM_MODULE()], $sTmp, $aQuery[Config::get_MVC_GET_PARAM_C()]) = array_values(array_filter(explode('\\', strtok($sQuery, ':'))));
            $aQuery[Config::get_MVC_GET_PARAM_M()] = substr($sQuery, (strrpos($sQuery, ':') + 1));
            $sQuery = 'module=' . $aQuery[Config::get_MVC_GET_PARAM_MODULE()] .'&c=' . $aQuery[Config::get_MVC_GET_PARAM_C()] . '&m=' . $aQuery[Config::get_MVC_GET_PARAM_M()];
        }

        $sClass = ucfirst(get($aQuery[Config::get_MVC_GET_PARAM_MODULE()], '')) . '\\Controller\\' . ucfirst(get($aQuery[Config::get_MVC_GET_PARAM_C()], ''));
        $aMethodsAssigned = array(strtoupper($sMethod));

        if (isset(self::$aRoute[$sPath]))
        {
            $aMethodsAssigned = self::$aRoute[$sPath]->get_methodsAssigned();

            if (false === in_array($sMethod, $aMethodsAssigned, true))
            {
                array_push(
                    $aMethodsAssigned,
                    $sMethod
                );
            }

            // define default method
            if (in_array(Request::getCurrentRequest()->get_requestmethod(), $aMethodsAssigned, true))
            {
                $sMethod = Request::getCurrentRequest()->get_requestmethod();
            }
            else
            {
                $sMethod = current($aMethodsAssigned);
            }
        }

        self::$aRoute[$sPath] = DTRoute::create()
            ->set_path($sPath)
            ->set_method(strtoupper($sMethod))
            ->set_methodsAssigned($aMethodsAssigned)
            ->set_query($sQuery)
            ->set_class($sClass)
            ->set_classFile(Config::get_MVC_MODULES() . '/' . str_replace ('\\', '/', $sClass) . '.php')
            ->set_module(get($aQuery[Config::get_MVC_GET_PARAM_MODULE()]))
            ->set_c(get($aQuery[Config::get_MVC_GET_PARAM_C()]))
            ->set_m(get($aQuery[Config::get_MVC_GET_PARAM_M()]))
            ->set_additional($mOptional)
        ;

        foreach ($aMethodsAssigned as $sMethodsAssigned)
        {
            if (false === isset(self::$aMethod[strtolower($sMethodsAssigned)]))
            {
                self::$aMethod[strtolower($sMethodsAssigned)] = array();
            }

            if (false === in_array($sPath, self::$aMethod[strtolower($sMethodsAssigned)], true))
            {
                self::$aMethod[strtolower($sMethodsAssigned)][] = $sPath;
            }
        }
    }

    /**
     * @param bool $bWildcardsOnly
     * @return array|false
     */
    public static function getIndices(bool $bWildcardsOnly = false)
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
     * @param string $sKey
     * @param string $sValue
     * @return array
     */
    public static function getRouteIndexArrayOnKey(string $sKey = 'query', string $sValue = '')
    {
        $aRoute = Convert::objectToArray(self::$aRoute);
        $aIndex = array();

        foreach ($aRoute as $iIndex => $aValue)
        {
            (strtolower(get($aValue[$sKey], '')) === strtolower($sValue)) ? $aIndex[] = $iIndex : false;
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
     * @param string $sPath
     * @return string
     */
    public static function getIndexOnWildcard(string $sPath = '')
    {
        $aIndex = self::getIndices(true);

        foreach ($aIndex as $sIndex)
        {
            // cutt off "*"
            $sIndexCutOff = substr($sIndex, 0, -1);

            if (substr($sPath, 0, strlen($sIndexCutOff)) === $sIndexCutOff)
            {
                $aPathParam['_tail'] = substr($sPath, strlen($sIndexCutOff));
                Request::setPathParam($aPathParam);

                return (string) $sIndex;
            }
        }

        return '';
    }

    /**
     * @param string $sPath
     * @return string
     */
    public static function getPathOnPlaceholderIndex(string $sPath = '')
    {
        // Request
        $aPartPath = preg_split('@/@', $sPath, 0, PREG_SPLIT_NO_EMPTY);
        $iLengthPath = count($aPartPath);
        $aIndex = self::getIndices();

        foreach ($aIndex as $iKey => $sValue)
        {
            $aPartMatch = array_diff(preg_split('@/@', $sValue, 0, PREG_SPLIT_NO_EMPTY), array('*')); # delete "*"
            $sLastCharRight = substr($sValue, -1);
            $bIsWildcard = ('*' === $sLastCharRight) ? true : false;
            $iLengthFoo = count($aPartMatch);

            // string part before first placeholder has to match
            $sStrToKColon = strtok($sValue, ':');
            $sStrToKBrace = strtok($sValue, '{');
            $bPartBeforePlaceholderMatchColon = (substr($sPath, 0, strlen($sStrToKColon)) === $sStrToKColon) ? true : false;
            $bPartBeforePlaceholderMatchBrace = (substr($sPath, 0, strlen($sStrToKBrace)) === $sStrToKBrace) ? true : false;
            $sPart = '/';

            for ($i = 0; $i < $iLengthFoo; $i++)
            {
                $sPart.= get($aPartPath[$i]) . '/';
            }

            $sTail = substr($sPath, strlen($sPart));

            // detect placeholder route match
            if (
                (true === $bPartBeforePlaceholderMatchColon || true === $bPartBeforePlaceholderMatchBrace) &&
                (
                    // has exact same amount of / parts
                    $iLengthPath === $iLengthFoo
                    OR
                    // has minimum amount of / parts and is wildcard (has tail)
                    (true === $bIsWildcard && $iLengthPath >= $iLengthFoo)
                )
            )
            {
                (true === $bPartBeforePlaceholderMatchColon)
                    ? $aPlaceholder = preg_grep('/:/i', $aPartMatch)
                    : false
                ;
                (true === $bPartBeforePlaceholderMatchBrace)
                    ? $aPlaceholder = preg_grep('/\{*\}/i', $aPartMatch)
                    : false
                ;

                $aPathParam = array();

                foreach ($aPlaceholder as $iIndex => $sPlaceholder)
                {
                    (true === $bPartBeforePlaceholderMatchColon)
                        ? $sPlaceholder = substr($sPlaceholder, 1)
                        : false
                    ;
                    (true === $bPartBeforePlaceholderMatchBrace)
                        ? $sPlaceholder = substr($sPlaceholder, 1, -1)
                        : false
                    ;
                    $aPathParam[$sPlaceholder] = $aPartPath[$iIndex];
                }

                $aPathParam['_tail'] = $sTail;
                Request::setPathParam($aPathParam);

                return (string) get($aIndex[$iKey], '');
            }
        }

        return '';
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