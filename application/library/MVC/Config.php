<?php
/**
 * Config.php
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
 * Application
 */
class Config
{
    /**
     * save config array to registry in key value manner
     * @param array $aConfig
     * @return void
     */
    public static function init (array $aConfig = array ())
    {
        // save config array to registry in key value manner
        foreach ($aConfig as $sKey => $sValue)
        {
            Registry::set($sKey, $sValue);
        }
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public static function get_MVC_DEBUG ()
    {
        if (Registry::isRegistered('MVC_DEBUG'))
        {
            return (boolean) filter_var(Registry::get('MVC_DEBUG'), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public static function get_MVC_LOG_AUTOLOADER()
    {
        if (Registry::isRegistered('MVC_LOG_AUTOLOADER'))
        {
            return (boolean) filter_var(Registry::get('MVC_LOG_AUTOLOADER'), FILTER_VALIDATE_BOOLEAN);
        }

        return true;
    }

    /**
     * @return string
     * @throws \ReflectionException#
     */
    public static function get_MVC_GET_PARAM_MODULE()
    {
        if (Registry::isRegistered('MVC_GET_PARAM_MODULE'))
        {
            return (string) Registry::get('MVC_GET_PARAM_MODULE');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_GET_PARAM_C()
    {
        if (Registry::isRegistered('MVC_GET_PARAM_C'))
        {
            return (string) Registry::get('MVC_GET_PARAM_C');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_GET_PARAM_M()
    {
        if (Registry::isRegistered('MVC_GET_PARAM_M'))
        {
            return (string) Registry::get('MVC_GET_PARAM_M');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_GET_PARAM_A()
    {
        if (Registry::isRegistered('MVC_GET_PARAM_A'))
        {
            return (string) Registry::get('MVC_GET_PARAM_A');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_ROUTING_HANDLING()
    {
        if (Registry::isRegistered('MVC_ROUTING_HANDLING'))
        {
            return (string) Registry::get('MVC_ROUTING_HANDLING');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_ROUTING_JSON()
    {
        if (Registry::isRegistered('MVC_ROUTING_JSON'))
        {
            return (string) Registry::get('MVC_ROUTING_JSON');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_ROUTING_JSON_BUILDER()
    {
        if (Registry::isRegistered('MVC_ROUTING_JSON_BUILDER'))
        {
            return (string) Registry::get('MVC_ROUTING_JSON_BUILDER');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_ROUTER_JSON()
    {
        if (Registry::isRegistered('MVC_ROUTER_JSON'))
        {
            return (string) Registry::get('MVC_ROUTER_JSON');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_INTERFACE_ROUTER_JSON()
    {
        if (Registry::isRegistered('MVC_INTERFACE_ROUTER_JSON'))
        {
            return (string) Registry::get('MVC_INTERFACE_ROUTER_JSON');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_ROUTING_FALLBACK()
    {
        if (Registry::isRegistered('MVC_ROUTING_FALLBACK'))
        {
            return (string) Registry::get('MVC_ROUTING_FALLBACK');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_METHODNAME_PRECONSTRUCT()
    {
        if (Registry::isRegistered('MVC_METHODNAME_PRECONSTRUCT'))
        {
            return (string) Registry::get('MVC_METHODNAME_PRECONSTRUCT');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_WEB_ROOT()
    {
        if (Registry::isRegistered('MVC_WEB_ROOT'))
        {
            return (string) Registry::get('MVC_WEB_ROOT');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_BASE_PATH()
    {
        if (Registry::isRegistered('MVC_BASE_PATH'))
        {
            return (string) Registry::get('MVC_BASE_PATH');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_APPLICATION_PATH()
    {
        if (Registry::isRegistered('MVC_APPLICATION_PATH'))
        {
            return (string) Registry::get('MVC_APPLICATION_PATH');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_PUBLIC_PATH()
    {
        if (Registry::isRegistered('MVC_PUBLIC_PATH'))
        {
            return (string) Registry::get('MVC_PUBLIC_PATH');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_LOG_FILE_FOLDER()
    {
        if (Registry::isRegistered('MVC_LOG_FILE_FOLDER'))
        {
            return (string) Registry::get('MVC_LOG_FILE_FOLDER');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_LOG_FILE_DEFAULT()
    {
        if (Registry::isRegistered('MVC_LOG_FILE_DEFAULT'))
        {
            return (string) Registry::get('MVC_LOG_FILE_DEFAULT');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_LOG_FILE_ERROR()
    {
        if (Registry::isRegistered('MVC_LOG_FILE_ERROR'))
        {
            return (string) Registry::get('MVC_LOG_FILE_ERROR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_LOG_FILE_WARNING()
    {
        if (Registry::isRegistered('MVC_LOG_FILE_WARNING'))
        {
            return (string) Registry::get('MVC_LOG_FILE_WARNING');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_LOG_FILE_NOTICE()
    {
        if (Registry::isRegistered('MVC_LOG_FILE_NOTICE'))
        {
            return (string) Registry::get('MVC_LOG_FILE_NOTICE');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_APPLICATION_CONFIG_DIR()
    {
        if (Registry::isRegistered('MVC_APPLICATION_CONFIG_DIR'))
        {
            return (string) Registry::get('MVC_APPLICATION_CONFIG_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_VIEW_TEMPLATES()
    {
        if (Registry::isRegistered('MVC_VIEW_TEMPLATES'))
        {
            return (string) Registry::get('MVC_VIEW_TEMPLATES');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_LIBRARY()
    {
        if (Registry::isRegistered('MVC_LIBRARY'))
        {
            return (string) Registry::get('MVC_LIBRARY');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULES()
    {
        if (Registry::isRegistered('MVC_MODULES'))
        {
            return (string) Registry::get('MVC_MODULES');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_CONFIG_DIR()
    {
        if (Registry::isRegistered('MVC_CONFIG_DIR'))
        {
            return (string) Registry::get('MVC_CONFIG_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_CACHE_DIR()
    {
        if (Registry::isRegistered('MVC_CACHE_DIR'))
        {
            return (string) Registry::get('MVC_CACHE_DIR');
        }

        return '';
    }

    /**
     * @param $sCacheDir
     * @return void
     */
    public static function set_MVC_CACHE_DIR($sCacheDir = '')
    {
        Registry::set('MVC_CACHE_DIR', $sCacheDir);
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_SSL_PORT()
    {
        if (Registry::isRegistered('MVC_SSL_PORT'))
        {
            return (string) Registry::get('MVC_SSL_PORT');
        }

        return '';
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public static function get_MVC_SECURE_REQUEST()
    {
        if (Registry::isRegistered('MVC_SECURE_REQUEST'))
        {
            return (boolean) filter_var(Registry::get('MVC_SECURE_REQUEST'), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_SESSION_NAMESPACE()
    {
        if (Registry::isRegistered('MVC_SESSION_NAMESPACE'))
        {
            return (string) Registry::get('MVC_SESSION_NAMESPACE');
        }

        return 'myMVC';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_SESSION_PATH()
    {
        if (Registry::isRegistered('MVC_SESSION_PATH'))
        {
            return (string) Registry::get('MVC_SESSION_PATH');
        }

        return '';
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function get_MVC_SESSION_OPTIONS()
    {
        if (Registry::isRegistered('MVC_SESSION_OPTIONS'))
        {
            return (array) Registry::get('MVC_SESSION_OPTIONS');
        }

        return array();
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public static function get_MVC_SESSION_ENABLE()
    {
        if (Registry::isRegistered('MVC_SESSION_ENABLE'))
        {
            return (boolean) filter_var(Registry::get('MVC_SESSION_ENABLE'), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }

    /**
     * @param $bEnable
     * @return void
     */
    public static function set_MVC_SESSION_ENABLE($bEnable = true)
    {
        Registry::set('MVC_SESSION_ENABLE', $bEnable);
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function get_MVC_REQUEST_WHITELIST_PARAMS()
    {
        if (Registry::isRegistered('MVC_REQUEST_WHITELIST_PARAMS'))
        {
            return (array) Registry::get('MVC_REQUEST_WHITELIST_PARAMS');
        }

        return array();
    }

    /**
     * @param array $aWhitelistParam
     * @return void
     */
    public static function set_MVC_REQUEST_WHITELIST_PARAMS(array $aWhitelistParam = array())
    {
        Registry::set('MVC_REQUEST_WHITELIST_PARAMS', $aWhitelistParam);
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public static function get_MVC_CLI ()
    {
        if (Registry::isRegistered('MVC_CLI'))
        {
            return (boolean) filter_var(Registry::get('MVC_CLI'), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public static function get_MVC_SMARTY_CACHE_STATUS()
    {
        if (Registry::isRegistered('MVC_SMARTY_CACHE_STATUS'))
        {
            return (boolean) filter_var(Registry::get('MVC_SMARTY_CACHE_STATUS'), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_SMARTY_CACHE_DIR()
    {
        if (Registry::isRegistered('MVC_SMARTY_CACHE_DIR'))
        {
            return (string) Registry::get('MVC_SMARTY_CACHE_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_SMARTY_TEMPLATE_DIR()
    {
        if (Registry::isRegistered('MVC_SMARTY_TEMPLATE_DIR'))
        {
            return (string) Registry::get('MVC_SMARTY_TEMPLATE_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_SMARTY_TEMPLATE_DEFAULT()
    {
        if (Registry::isRegistered('MVC_SMARTY_TEMPLATE_DEFAULT'))
        {
            return (string) Registry::get('MVC_SMARTY_TEMPLATE_DEFAULT');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_SMARTY_TEMPLATE_CACHE_DIR()
    {
        if (Registry::isRegistered('MVC_SMARTY_TEMPLATE_CACHE_DIR'))
        {
            return (string) Registry::get('MVC_SMARTY_TEMPLATE_CACHE_DIR');
        }

        return '';
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function get_MVC_SMARTY_PLUGINS_DIR()
    {
        if (Registry::isRegistered('MVC_SMARTY_PLUGINS_DIR'))
        {
            return (array) Registry::get('MVC_SMARTY_PLUGINS_DIR');
        }

        return array();
    }

    /**
     * gets the policy rules from registry
     * @return array
     * @throws \ReflectionException
     */
    public static function get_MVC_POLICY ()
    {
        if (Registry::isRegistered('MVC_POLICY'))
        {
            return (array) Registry::get('MVC_POLICY');
        }

        return array();
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function get_MVC_EVENT()
    {
        if (false === Registry::isRegistered('MVC_EVENT'))
        {
            Registry::set('MVC_EVENT', array());
        }

        if (Registry::isRegistered('MVC_EVENT'))
        {
            return Registry::get('MVC_EVENT');
        }

        return array();
    }

    /**
     * @param array $aMvcEvent
     * @return void
     */
    public static function set_MVC_EVENT(array $aMvcEvent = array())
    {
        Registry::set('MVC_EVENT', $aMvcEvent);
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_UNIQUE_ID ()
    {
        if (Registry::isRegistered('MVC_UNIQUE_ID'))
        {
            return (string) Registry::get('MVC_UNIQUE_ID');
        }

        return '---';
    }

    /**
     * @return \MVC\Session|null
     * @throws \ReflectionException
     */
    public static function get_MVC_SESSION()
    {
        if (Registry::isRegistered('MVC_SESSION'))
        {
            /** @var \MVC\Session $oSession */
            $oSession = Registry::get('MVC_SESSION');

            return $oSession;
        }

        return null;
    }

    /**
     * @param \MVC\Session $oSession
     * @return void
     */
    public static function set_MVC_SESSION(Session $oSession)
    {
        Registry::set ('MVC_SESSION', $oSession);
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function get_MVC_REQUEST_QUERYVAR ()
    {
        if (Registry::isRegistered('MVC_REQUEST_QUERYVAR'))
        {
            return (array) Registry::get('MVC_REQUEST_QUERYVAR');
        }

        return array();
    }

    /**
     * @param array $aQueryVar
     * @return void
     */
    public static function set_MVC_REQUEST_QUERYVAR(array $aQueryVar = array())
    {
        Registry::set('MVC_REQUEST_QUERYVAR', $aQueryVar);
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function get_MVC_ROUTING()
    {
        if (Registry::isRegistered('MVC_ROUTING'))
        {
            return (array) Registry::get('MVC_ROUTING');
        }

        return array();
    }

    /**
     * @param array $aRouting
     * @return void
     */
    public static function set_MVC_ROUTING(array $aRouting = array())
    {
        Registry::set (
            'MVC_ROUTING',
            $aRouting
        );
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function get_MVC_ROUTING_CURRENT()
    {
        if (Registry::isRegistered('MVC_ROUTING_CURRENT'))
        {
            return (array) Registry::get('MVC_ROUTING_CURRENT');
        }

        return array();
    }

    /**
     * @param array $aRouting
     * @return void
     */
    public static function set_MVC_ROUTING_CURRENT(array $aRouting = array())
    {
        Registry::set (
            'MVC_ROUTING_CURRENT',
            $aRouting
        );
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_INFOTOOL_ENABLE()
    {
        if (Registry::isRegistered('MVC_INFOTOOL_ENABLE'))
        {
            return (boolean) filter_var(Registry::get('MVC_INFOTOOL_ENABLE'), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }
}