<?php

/**
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

MVC_RUNTIME_SETTINGS: {

    // show error messages
    error_reporting(E_ALL);

    /*
     * @see http://www.php.net/manual/en/timezones.php
     * @see http://stackoverflow.com/a/5559239/2487859
     * to get array of availabe timezones see result of timezone_identifiers_list()
     * 
     * try to get timezone (ubuntu), or set to UTC
     */
    date_default_timezone_set(((file_exists('/etc/timezone')) ? trim(file_get_contents('/etc/timezone')) : 'UTC'));
    setlocale(LC_ALL, 'C');

    // show InfoTool bar
    $aConfig['MVC_INFOTOOL_ENABLE'] = true;

    // Log autoloader actions
    $aConfig['MVC_LOG_AUTOLOADER'] = true;
}

MVC_BIN: {

    // remove
    $aConfig['MVC_BIN_REMOVE'] = '/bin/rm';
    // find
    $aConfig['MVC_BIN_FIND'] = '/usr/bin/find';
    // grep
    $aConfig['MVC_BIN_GREP'] = '/bin/grep';
}

MVC_APPLICATION_SETTINGS: {

    /**
     * reserverd $_GET Params
     */
    $aConfig['MVC_GET_PARAM_MODULE'] = 'module';
    $aConfig['MVC_GET_PARAM_C'] = 'c';
    $aConfig['MVC_GET_PARAM_M'] = 'm';

    /**
     * MVC fallback routing
     * this routing will be used if none is specified for routing
     * Note: Possibility of a direct call (http|cli) of this route is disabled
     */
    $aConfig['MVC_ROUTING_FALLBACK'] =
          $aConfig['MVC_GET_PARAM_MODULE'] . '=standard&'
        . $aConfig['MVC_GET_PARAM_C'] . '=index&'
        . $aConfig['MVC_GET_PARAM_M'] . '=fallback';

    /**
     * Name of method to be executed in the Target Controller Class
     * before session and other main functionalities.
     * It will be called in /application/library/MVC/Application.php:
     *        self::runTargetClassPreconstruct (Request::getInstance ()->getQueryArray ());
     *
     * This method is also declared via interface MVC_Interface_Controller.
     * Due to this, you should not edit this name. Otherwise you have to
     * rename the method in that interface class, too.
     *
     * default:
     * $aConfig['MVC_METHODNAME_PRECONSTRUCT'] = '__preconstruct';
     */
    $aConfig['MVC_METHODNAME_PRECONSTRUCT'] = '__preconstruct';

    /**
     * Paths etc.
     */
    $aConfig['MVC_WEB_ROOT'] = dirname($_SERVER['PHP_SELF']);
    $aConfig['MVC_BASE_PATH'] = realpath(__DIR__ . '/../');
    $aConfig['MVC_APPLICATION_PATH'] = $aConfig['MVC_BASE_PATH'] . '/application';
    $aConfig['MVC_PUBLIC_PATH'] = $aConfig['MVC_BASE_PATH'] . '/public';
    $aConfig['MVC_LOG_FILE_FOLDER'] = $aConfig['MVC_APPLICATION_PATH'] . '/log/';
    $aConfig['MVC_LOG_FILE_DEFAULT'] = $aConfig['MVC_LOG_FILE_FOLDER'] . 'default.log';
    $aConfig['MVC_LOG_FILE_ERROR'] = $aConfig['MVC_LOG_FILE_FOLDER'] . 'error.log';
    $aConfig['MVC_LOG_FILE_WARNING'] = $aConfig['MVC_LOG_FILE_FOLDER'] . 'warning.log';
    $aConfig['MVC_LOG_FILE_NOTICE'] = $aConfig['MVC_LOG_FILE_FOLDER'] . 'notice.log';
    $aConfig['MVC_APPLICATION_CONFIG_DIR'] = $aConfig['MVC_APPLICATION_PATH'] . '/config';
    $aConfig['MVC_VIEW_TEMPLATES'] = $aConfig['MVC_BASE_PATH'] . '/modules/Default/templates';
    $aConfig['MVC_LIBRARY'] = $aConfig['MVC_APPLICATION_PATH'] . '/library';
    $aConfig['MVC_MODULES'] = $aConfig['MVC_BASE_PATH'] . '/modules';/** @deprecated - use instead: `MVC_MODULES_DIR` */
    $aConfig['MVC_MODULES_DIR'] = $aConfig['MVC_BASE_PATH'] . '/modules';

    // Main myMVC config folder
    $aConfig['MVC_CONFIG_DIR'] = $aConfig['MVC_BASE_PATH'] . '/config';

    /**
     * Caching
     */
    // cache folder
    $aConfig['MVC_CACHE_DIR'] = $aConfig['MVC_APPLICATION_PATH'] . '/cache';
    $aConfig['MVC_CACHE_CONFIG'] = array(
        'bCaching' => true,
        'sCacheDir' => $aConfig['MVC_CACHE_DIR'],
        'iDeleteAfterMinutes' => 1440,
        'sBinRemove' => $aConfig['MVC_BIN_REMOVE'],
        'sBinFind' => $aConfig['MVC_BIN_FIND'],
        'sBinGrep' => $aConfig['MVC_BIN_GREP']
    );

    /**
     * misc
     */
    // Secure Port, SSL
    $aConfig['MVC_SSL_PORT'] = 443;

    // boolean Request is secure ? (SSL)
    $aConfig['MVC_SECURE_REQUEST'] = (array_key_exists('HTTPS', $_SERVER) && strtolower($_SERVER['HTTPS']) !== 'off') || (array_key_exists('SERVER_PORT', $_SERVER) && ($_SERVER['SERVER_PORT'] == $aConfig['MVC_SSL_PORT']));

    /**
     * Session
     */
    // session folder and
    // Session options @see http://php.net/manual/de/session.configuration.php
    $aConfig['MVC_SESSION_NAMESPACE'] = 'myMVC';
    $aConfig['MVC_SESSION_PATH'] = $aConfig['MVC_APPLICATION_PATH'] . '/session';
    $aConfig['MVC_SESSION_OPTIONS'] = array(
        'cookie_httponly' => true,
        'auto_start' => 0,
        'save_path' => $aConfig['MVC_SESSION_PATH'],
        'cookie_secure' => $aConfig['MVC_SECURE_REQUEST'],
        'name' => 'myMVC' . (($aConfig['MVC_SECURE_REQUEST']) ? '_secure' : ''),
        'save_handler' => 'files',
        'cookie_lifetime' => 0,

        // max value for "session.gc_maxlifetime" is 65535. values bigger than this may cause  php session stops working.
        'gc_maxlifetime' => 65535,
        'gc_probability' => 1,
        'use_strict_mode' => 1,
        'use_cookies' => 1,
        'use_only_cookies' => 1,
        'upload_progress.enabled' => 1,
    );

    // default behaviour
    // false:   session won't start. This means NO cookie is written to client
    // true:    session will start
    $aConfig['MVC_SESSION_ENABLE'] = false;

    // Routing Class
    $aConfig['MVC_ROUTING_CLASS'] = '\\MVC\\Routing';

    // routing.json file
    $aConfig['MVC_ROUTING_JSON'] = '';

    // detect if request is done via cli. set boole true|false
    $aConfig['MVC_CLI'] = (('cli' === php_sapi_name()) ? true : false);
}

MVC_TEMPLATE_ENGINE_SMARTY: {

    $aConfig['MVC_SMARTY_CACHE_STATUS'] = false;
    $aConfig['MVC_SMARTY_CACHE_DIR'] = $aConfig['MVC_APPLICATION_PATH'] . '/cache';

    $aConfig['MVC_SMARTY_TEMPLATE_DIR'] = $aConfig['MVC_VIEW_TEMPLATES'];
    $aConfig['MVC_SMARTY_TEMPLATE_DEFAULT'] = 'Frontend/layout/index.tpl';

    // templates_c folder and
    // templates_c folder access rights, octal mode
    $aConfig['MVC_SMARTY_TEMPLATE_CACHE_DIR'] = $aConfig['MVC_APPLICATION_PATH'] . '/templates_c';

    // array Location of Smarty PlugIns 
    $aConfig['MVC_SMARTY_PLUGINS_DIR'][] = $aConfig['MVC_APPLICATION_PATH'] . '/smartyPlugins';
}

MODULES: {
    $aConfig['MODULE'] = array();
}

/**
 * @see /application/doc/README "Policy"
 * Policy Rules are bonded to a specific "Controller::Method"
 * Define your policies
 */
MVC_POLICY: {

    $aConfig['MVC_POLICY'] = array();
}

MVC_MISC: {

    $aConfig['MVC_UNIQUE_ID'] = uniqid();
}