<?php
/**
 * Config.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
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
    public static function get_MVC_ROUTE_QUERY_PARAM_MODULE()
    {
        if (Registry::isRegistered('MVC_ROUTE_QUERY_PARAM_MODULE'))
        {
            return (string) Registry::get('MVC_ROUTE_QUERY_PARAM_MODULE');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_ROUTE_QUERY_PARAM_C()
    {
        if (Registry::isRegistered('MVC_ROUTE_QUERY_PARAM_C'))
        {
            return (string) Registry::get('MVC_ROUTE_QUERY_PARAM_C');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_ROUTE_QUERY_PARAM_M()
    {
        if (Registry::isRegistered('MVC_ROUTE_QUERY_PARAM_M'))
        {
            return (string) Registry::get('MVC_ROUTE_QUERY_PARAM_M');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_CURRENT_DIR()
    {
        if (Registry::isRegistered('MVC_MODULE_CURRENT_DIR'))
        {
            return (string) Registry::get('MVC_MODULE_CURRENT_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_CURRENT_CONTROLLER_DIR()
    {
        if (Registry::isRegistered('MVC_MODULE_CURRENT_CONTROLLER_DIR'))
        {
            return (string) Registry::get('MVC_MODULE_CURRENT_CONTROLLER_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_CURRENT_DATATYPE_DIR()
    {
        if (Registry::isRegistered('MVC_MODULE_CURRENT_DATATYPE_DIR'))
        {
            return (string) Registry::get('MVC_MODULE_CURRENT_DATATYPE_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_CURRENT_ETC_DIR()
    {
        if (Registry::isRegistered('MVC_MODULE_CURRENT_ETC_DIR'))
        {
            return (string) Registry::get('MVC_MODULE_CURRENT_ETC_DIR');
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
    public static function get_MVC_MODULES_DIR()
    {
        if (Registry::isRegistered('MVC_MODULES_DIR'))
        {
            return (string) Registry::get('MVC_MODULES_DIR');
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
     * @param $iPort
     * @return void
     */
    public static function set_MVC_SSL_PORT($iPort = 443)
    {
        Registry::set('MVC_SSL_PORT', $iPort);
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
     * @return bool
     * @throws \ReflectionException
     */
    public static function get_MVC_CLI()
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
    public static function get_MVC_POLICY()
    {
        if (Registry::isRegistered('MVC_POLICY'))
        {
            return (array) Registry::get('MVC_POLICY');
        }

        return array();
    }

    /**
     * sets policy rules to registry
     * @param array $aPolicy
     * @return void
     */
    public static function set_MVC_POLICY(array $aPolicy = array())
    {
        Registry::set('MVC_POLICY', $aPolicy);
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function get_MVC_EVENT()
    {
        if (false === Registry::isRegistered('MVC_EVENT'))
        {
            self::set_MVC_EVENT();
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
    public static function get_MVC_UNIQUE_ID()
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

    /**
     * returns config settings array of current module | or config of given module
     * @return array
     * @throws \ReflectionException
     */
    public static function MODULE($sModule = '')
    {
        if ('' === $sModule)
        {
            $sModule = self::get_MVC_MODULE_CURRENT_NAME();
        }

        if (Registry::isRegistered('MODULE'))
        {
            return (array) get(Registry::get('MODULE')[$sModule], array());
        }

        return array();
    }

    /**
     * returns config settings array of current module | or config of given module
     * @return array
     * @throws \ReflectionException
     */
    public static function get_MVC_CORE($sModule = '')
    {
        if (Registry::isRegistered('MVC_CORE'))
        {
            return (array) Registry::get('MVC_CORE');
        }

        return array();
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_ENV()
    {
        if (Registry::isRegistered('MVC_ENV'))
        {
            return (string) Registry::get('MVC_ENV');
        }

        return '?';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_VERSION()
    {
        return (Registry::isRegistered('MVC_CORE') && isset(Registry::get('MVC_CORE')['version']))
            ? Registry::get('MVC_CORE')['version']
            : '?';
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function get_MVC_CACHE_CONFIG()
    {
        if (Registry::isRegistered('MVC_CACHE_CONFIG'))
        {
            return (array) Registry::get('MVC_CACHE_CONFIG');
        }

        return array();
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_CURRENT_COMPOSER_DIR()
    {
        if (Registry::isRegistered('MVC_MODULE_CURRENT_COMPOSER_DIR'))
        {
            return (string) Registry::get('MVC_MODULE_CURRENT_COMPOSER_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_CURRENT_CONFIG_DIR()
    {
        if (Registry::isRegistered('MVC_MODULE_CURRENT_CONFIG_DIR'))
        {
            return (string) Registry::get('MVC_MODULE_CURRENT_CONFIG_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_CURRENT_EVENT_DIR()
    {
        if (Registry::isRegistered('MVC_MODULE_CURRENT_EVENT_DIR'))
        {
            return (string) Registry::get('MVC_MODULE_CURRENT_EVENT_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_CURRENT_MODEL_DIR()
    {
        if (Registry::isRegistered('MVC_MODULE_CURRENT_MODEL_DIR'))
        {
            return (string) Registry::get('MVC_MODULE_CURRENT_MODEL_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_CURRENT_POLICY_DIR()
    {
        if (Registry::isRegistered('MVC_MODULE_CURRENT_POLICY_DIR'))
        {
            return (string) Registry::get('MVC_MODULE_CURRENT_POLICY_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_CURRENT_VIEW_DIR()
    {
        if (Registry::isRegistered('MVC_MODULE_CURRENT_VIEW_DIR'))
        {
            return (string) Registry::get('MVC_MODULE_CURRENT_VIEW_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_CURRENT_STAGING_CONFIG_DIR()
    {
        if (Registry::isRegistered('MVC_MODULE_CURRENT_STAGING_CONFIG_DIR'))
        {
            return (string) Registry::get('MVC_MODULE_CURRENT_STAGING_CONFIG_DIR');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_CURRENT_NAME()
    {
        if (Registry::isRegistered('MVC_MODULE_CURRENT_NAME'))
        {
            return (string) Registry::get('MVC_MODULE_CURRENT_NAME');
        }

        return '';
    }

    /**
     * @param \MVC\View $oView
     * @return void
     */
    public static function set_MVC_MODULE_CURRENT_VIEW(\MVC\View $oView)
    {
        Registry::set('MVC_MODULE_CURRENT_VIEW', $oView);
    }

    /**
     * @return \MVC\View|null
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_CURRENT_VIEW()
    {
        $oView = null;

        if (Registry::isRegistered('MVC_MODULE_CURRENT_VIEW'))
        {
            /** @var \MVC\View $oView */
            $oView = Registry::get('MVC_MODULE_CURRENT_VIEW');
        }

        return $oView;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_BIN_REMOVE()
    {
        if (Registry::isRegistered('MVC_BIN_REMOVE'))
        {
            return (string) Registry::get('MVC_BIN_REMOVE');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_BIN_FIND()
    {
        if (Registry::isRegistered('MVC_BIN_FIND'))
        {
            return (string) Registry::get('MVC_BIN_FIND');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_BIN_GREP()
    {
        if (Registry::isRegistered('MVC_BIN_GREP'))
        {
            return (string) Registry::get('MVC_BIN_GREP');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_BIN_MOVE()
    {
        if (Registry::isRegistered('MVC_BIN_MOVE'))
        {
            return (string) Registry::get('MVC_BIN_MOVE');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_BIN_RENAME()
    {
        if (Registry::isRegistered('MVC_BIN_RENAME'))
        {
            return (string) Registry::get('MVC_BIN_RENAME');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_BIN_XARGS()
    {
        if (Registry::isRegistered('MVC_BIN_XARGS'))
        {
            return (string) Registry::get('MVC_BIN_XARGS');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_BIN_SED()
    {
        if (Registry::isRegistered('MVC_BIN_SED'))
        {
            return (string) Registry::get('MVC_BIN_SED');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_BIN_PHP_BINARY()
    {
        if (Registry::isRegistered('MVC_BIN_PHP_BINARY'))
        {
            return (string) Registry::get('MVC_BIN_PHP_BINARY');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_BIN_PS()
    {
        if (Registry::isRegistered('MVC_BIN_PS'))
        {
            return (string) Registry::get('MVC_BIN_PS');
        }

        return '';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_REGISTER_SHUTDOWN_FUNCTION()
    {
        if (Registry::isRegistered('MVC_REGISTER_SHUTDOWN_FUNCTION'))
        {
            return (string) Registry::get('MVC_REGISTER_SHUTDOWN_FUNCTION');
        }

        return '';
    }

    /**
     * @param $sString
     * @return void
     */
    public static function set_MVC_REGISTER_SHUTDOWN_FUNCTION($sString = '')
    {
        Registry::set('MVC_REGISTER_SHUTDOWN_FUNCTION', $sString);
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_SET_ERROR_HANDLER()
    {
        if (Registry::isRegistered('MVC_SET_ERROR_HANDLER'))
        {
            return (string) Registry::get('MVC_SET_ERROR_HANDLER');
        }

        return '';
    }

    /**
     * @param $sString
     * @return void
     */
    public static function set_MVC_SET_ERROR_HANDLER($sString = '')
    {
        Registry::set('MVC_SET_ERROR_HANDLER', $sString);
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function get_MVC_SET_EXCEPTION_HANDLER()
    {
        if (Registry::isRegistered('MVC_SET_EXCEPTION_HANDLER'))
        {
            return (string) Registry::get('MVC_SET_EXCEPTION_HANDLER');
        }

        return '';
    }

    /**
     * @param $sString
     * @return void
     */
    public static function set_MVC_SET_EXCEPTION_HANDLER($sString = '')
    {
        Registry::set('MVC_SET_EXCEPTION_HANDLER', $sString);
    }
}