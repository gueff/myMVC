<?php
/**
 * Router.php
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
 * Router
 */
class Router
{
    /**
     * Router constructor.
     * @throws \ReflectionException
     */
	public static function init()
	{
		$oRouterJsonFile = new RouterJsonfile();
        $sClassRoutingHandling = Config::get_MVC_ROUTING_HANDLING();
		$sClassRouterJson = Config::get_MVC_ROUTER_JSON();
		$sInterfaceToCheck = Config::get_MVC_INTERFACE_ROUTER_JSON();

		if (false === is_subclass_of ($oRouterJsonFile, $sClassRouterJson))
		{
			$sMsg = 'ERROR: Make sure `' . $sClassRoutingHandling . '` extends ' . $sClassRouterJson;
			Error::addERROR (
                DTArrayObject::create()
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($sMsg))
            );
			Log::write (strip_tags ($sMsg));
			Helper::stop ($sMsg);
		}

		if (false === filter_var (($oRouterJsonFile instanceof $sInterfaceToCheck), FILTER_VALIDATE_BOOLEAN))
		{
			$sMsg = 'ERROR: Make sure `' . $sClassRoutingHandling . '` implements ' . $sInterfaceToCheck;
			Error::addERROR (
                DTArrayObject::create()
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($sMsg))
            );
			Log::write (strip_tags($sMsg));
			Helper::stop($sMsg);
		}

		// save to registry
        Router::setRouting($oRouterJsonFile->aRouting);
        Router::setRoutingCurrent(
            (isset ($oRouterJsonFile->aRouting[$oRouterJsonFile->sRequestUri]))
                ? $oRouterJsonFile->aRouting[$oRouterJsonFile->sRequestUri]
                : array ()
        );
	}

    /**
     * @return array
     * @throws \ReflectionException
     */
	public static function getRouting()
    {
        return Config::get_MVC_ROUTING();
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function getRoutingJson()
    {
        $sJson = json_encode (self::getRouting());

        if (false === is_string($sJson))
        {
            Error::addERROR(
                DTArrayObject::create()->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('json_error')->set_sValue(json_last_error_msg())
                )
            );

            return '';
        }

        return (string) $sJson;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getRoutingCurrent()
    {
        return Config::get_MVC_ROUTING_CURRENT();
    }

    /**
     * @param array $aRouting
     * @return void
     */
    public static function setRoutingCurrent(array $aRouting = array())
    {
        Config::set_MVC_ROUTING_CURRENT($aRouting);
    }

    /**
     * @param array $aRouting
     * @return void
     */
    public static function setRouting(array $aRouting = array())
    {
        Config::set_MVC_ROUTING($aRouting);
    }

    /**
     * @return array|mixed
     * @throws \ReflectionException
     */
    public static function getRoutingFallback()
    {
        return Config::get_MVC_ROUTING_FALLBACK();
    }

    /**
     * @param $sIndex
     * @return \MVC\DataType\DTRoute
     * @throws \ReflectionException
     */
    public static function getRouteObjectByIndex($sIndex = '')
    {
        $aRoute = self::getRouting()[$sIndex];
        $aInfo = self::getInfoArrayFromRouteQuery($aRoute['query']);
        $oDTRoute = DTRoute::create()
            ->set_path(get($sIndex))
            ->set_query(get($aRoute['query'], ''))
            ->set_title(get($aRoute['title'], ''))
            ->set_class(get($aInfo['sClass'], ''))
            ->set_method(get($aInfo['sMethod'], ''))
            ->set_layout(get($aRoute['template']['layout'], ''))
            ->set_style(get($aRoute['template']['style'], array()))
            ->set_load(get($aRoute['template']['load'], array()))
            ->set_script(get($aRoute['template']['script'], array()))
        ;

        return $oDTRoute;
    }

    /**
     * @param $sKey default=query
     * @param $sValue default=''
     * @return string
     * @throws \ReflectionException
     */
    public static function getRouteIndexOnKey($sKey = 'query', $sValue = '')
    {
        $iIndex = array_search(
            $sValue,
            array_column(self::getRouting(), $sKey)
        );

        $aMVC_ROUTING = array_keys(self::getRouting());
        $sIndex = get($aMVC_ROUTING[$iIndex],'');

        return $sIndex;
    }

    /**
     * @param $sQuery
     * @return array
     * @throws \ReflectionException
     */
    public static function getInfoArrayFromRouteQuery($sQuery = '')
    {
        parse_str ($sQuery, $aParse);
        $sClass = '\\' . ucfirst ($aParse[Config::get_MVC_GET_PARAM_MODULE()]) . '\\' . ucfirst ($aParse[Config::get_MVC_GET_PARAM_C()]);
        $sMethod = $aParse[Config::get_MVC_GET_PARAM_M()];
        $sFile = Config::get_MVC_MODULES() . '/' . str_replace ('\\', '/', $sClass) . '.php';

        $aResult = array(
            'sClass' => $sClass,
            'sMethod' => $sMethod,
            'sFile' => $sFile
        );

        return $aResult;
    }

    /**
     * @return bool|void
     * @throws \ReflectionException
     */
    public static function createFinalJson()
    {
        // take config from registry or take fallback config
        $aCachixConfig = (true === Registry::isRegistered('CACHIX_CONFIG'))
            ? Registry::get('CACHIX_CONFIG')
            : array(
                'bCaching' => true,
                'sCacheDir' => Config::get_MVC_CACHE_DIR(),
                'iDeleteAfterMinutes' => 1440,
                'sBinRemove' => '/bin/rm',
                'sBinFind' => '/usr/bin/find',
                'sBinGrep' => '/bin/grep'
            );
        \Cachix::init($aCachixConfig);

        $sFinalJsonAbs = Config::get_MVC_ROUTING_JSON();
        $sFinalJsonDir = dirname($sFinalJsonAbs);
        $aStandardRoutes = glob( $sFinalJsonDir . '/*json');
        $aFinal = [];

        foreach ($aStandardRoutes as $sValue)
        {
            // skip .myMVC.json
            if (basename($sFinalJsonAbs) === basename($sValue))
            {
                continue;
            }

            if (file_exists($sValue))
            {
                $aTmp = json_decode(file_get_contents($sValue), true);
                $aFinal = array_merge($aTmp, $aFinal);
            }
        }

        $sCacheKey = str_replace('\\', '', __METHOD__) . '.' . md5(json_encode($aFinal, JSON_PRETTY_PRINT));
        $sCacheContent = md5(json_encode($aFinal, JSON_PRETTY_PRINT));

        // nothing to do because of no changes
        if ($sCacheContent === \Cachix::getCache($sCacheKey))
        {
            return true;
        }

        if (file_exists($sFinalJsonAbs))
        {
            unlink($sFinalJsonAbs);
        }

        file_put_contents(
            $sFinalJsonAbs,
            json_encode($aFinal, JSON_PRETTY_PRINT)
        );

        // update cache
        \Cachix::autoDeleteCache(str_replace('\\', '', __METHOD__), 0);
        \Cachix::saveCache($sCacheKey, $sCacheContent);
    }
}
