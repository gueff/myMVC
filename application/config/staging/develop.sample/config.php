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

    // enable debug output
    $aConfig['MVC_DEBUG'] = true;

    // Log autoloader actions
    $aConfig['MVC_LOG_AUTOLOADER'] = true;
}

MVC_APPLICATION_SETTINGS: {

    /**
     * reserverd $_GET Params
     * if you change one of these, take care to change the "query" settings
     * of each route inside
     *        /application/config/routing.json
     * too.
     */
    $aConfig['MVC_GET_PARAM_MODULE'] = 'module';
    $aConfig['MVC_GET_PARAM_C'] = 'c';
    $aConfig['MVC_GET_PARAM_M'] = 'm';
    $aConfig['MVC_GET_PARAM_A'] = 'a';

    /**
     * define from where myMVC should read routing
     * default is "MVC_RouterJsonfile" and does not require a database.
     * If default "MVC_RouterJsonfile" is chosen, there must be definded
     * which class is responsible for building up the json string, storing the routings.
     * Which is, as default: "MVC_RouterJsonBuilder"
     */
    $aConfig['MVC_ROUTING_HANDLING'] = '\MVC\RouterJsonfile';
    $aConfig['MVC_ROUTING_JSON_BUILDER'] = '\MVC\RouterJsonBuilder';

    // *** this you should not change ***
    $aConfig['MVC_ROUTER_JSON'] = '\MVC\RouterJson';
    // *** this you should not change ***
    $aConfig['MVC_INTERFACE_ROUTER_JSON'] = '\MVC\MVCInterface\RouterJson';

    /**
     * MVC fallback routing
     * this routing will be used if none is specified for routing
     * (see e.g. /application/config/routing.json)
     *
     * Note: Possibility of a direct call (http|cli) of this route is disabled
     */
    $aConfig['MVC_ROUTING_FALLBACK'] = $aConfig['MVC_GET_PARAM_MODULE'] . '=standard&'
        . $aConfig['MVC_GET_PARAM_C'] . '=index&'
        . $aConfig['MVC_GET_PARAM_M'] . '=fallback';

    /**
     * Name of method to be executed in the Target Controller Class
     * before session, IDS and other main functionalities.
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
    $aConfig['MVC_BASE_PATH'] = realpath(__DIR__ . '/../../../../');
    $aConfig['MVC_APPLICATION_PATH'] = $aConfig['MVC_BASE_PATH'] . '/application';
    $aConfig['MVC_LOG_FILE_FOLDER'] = $aConfig['MVC_APPLICATION_PATH'] . '/log/';
    $aConfig['MVC_LOG_FILE_DEFAULT'] = $aConfig['MVC_LOG_FILE_FOLDER'] . 'default.log';
    $aConfig['MVC_APPLICATION_CONFIG_DIR'] = $aConfig['MVC_APPLICATION_PATH'] . '/config';
    $aConfig['MVC_VIEW_TEMPLATES'] = $aConfig['MVC_BASE_PATH'] . '/modules/Default/templates';
    $aConfig['MVC_LIBRARY'] = $aConfig['MVC_APPLICATION_PATH'] . '/library';
    $aConfig['MVC_MODULES'] = $aConfig['MVC_BASE_PATH'] . '/modules';

    // custom config folder
    $aConfig['MVC_APPLICATION_CONFIG_EXTEND_DIR'] = $aConfig['MVC_BASE_PATH'] . '/config';

    // cache folder and
    // cache folder access rights, octal mode
    $aConfig['MVC_CACHE_DIR'] = $aConfig['MVC_APPLICATION_PATH'] . '/cache';

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
    // session folder access rights, octal mode
    // Session options @see http://php.net/manual/de/session.configuration.php
    $aConfig['MVC_SESSION_NAMESPACE'] = 'myMVC';
    $aConfig['MVC_SESSION_PATH'] = $aConfig['MVC_APPLICATION_PATH'] . '/session';
    $aConfig['MVC_SESSION_OPTIONS'] = array(
        'cookie_httponly' => true
    , 'auto_start' => 0
    , 'save_path' => $aConfig['MVC_SESSION_PATH']
    , 'cookie_secure' => $aConfig['MVC_SECURE_REQUEST']
    , 'name' => 'myMVC' . (($aConfig['MVC_SECURE_REQUEST']) ? '_secure' : '')
    , 'save_handler' => 'files'
    , 'cookie_lifetime' => 0

        // max value for "session.gc_maxlifetime" is 65535. values bigger than this may cause  php session stops working.
    , 'gc_maxlifetime' => 65535
    , 'gc_probability' => 1
    , 'use_strict_mode' => 1
    , 'use_cookies' => 1
    , 'use_only_cookies' => 1
    , 'upload_progress.enabled' => 1
    );

    // default behaviour; session does NOT start
    // means NO cookie is written to users browser
    $aConfig['MVC_SESSION_ENABLE'] = false;

    /**
     * Request
     */
    $aConfig['MVC_REQUEST_WHITELIST_PARAMS'] = array(
        'GET' => array(
            // module
            $aConfig['MVC_GET_PARAM_MODULE'] => array(
                'regex' => '/[^a-zA-Z0-9]+/'
            , 'length' => 50
            )
            // class
        , $aConfig['MVC_GET_PARAM_C'] => array(
                'regex' => '/[^a-zA-Z0-9]+/'
            , 'length' => 50
            )
            // method
        , $aConfig['MVC_GET_PARAM_M'] => array(
                'regex' => '/[^a-zA-Z0-9]+/'
            , 'length' => 50
            )
            // args
        , $aConfig['MVC_GET_PARAM_A'] => array(
                'regex' => '/[^a-zA-Z0-9üöäÜÖÄß\|\:\[\]\{\},"\']+/'
            , 'length' => 256
            )
        )
    );

    /**
     * routing.json file
     */
    $aConfig['MVC_ROUTING_JSON'] = $aConfig['MVC_APPLICATION_CONFIG_DIR'] . '/staging/' . getenv('MVC_ENV') . '/routing.json';

    // detect if request is done via cli. set boole true|FALSE
    $aConfig['MVC_CLI'] = (('cli' === php_sapi_name()) ? true : FALSE);
}

MVC_TEMPLATE_ENGINE_SMARTY: {

    $aConfig['MVC_SMARTY_CACHE_STATUS'] = FALSE;
    $aConfig['MVC_SMARTY_CACHE_DIR'] = $aConfig['MVC_APPLICATION_PATH'] . '/cache';

    $aConfig['MVC_SMARTY_TEMPLATE_DIR'] = $aConfig['MVC_VIEW_TEMPLATES'];
    $aConfig['MVC_SMARTY_TEMPLATE_DEFAULT'] = 'layout/admin.tpl';

    // templates_c folder and
    // templates_c folder access rights, octal mode
    $aConfig['MVC_SMARTY_TEMPLATE_CACHE_DIR'] = $aConfig['MVC_APPLICATION_PATH'] . '/templates_c';

    // array Location of Smarty PlugIns 
    $aConfig['MVC_SMARTY_PLUGINS_DIR'][] = $aConfig['MVC_APPLICATION_PATH'] . '/smartyPlugins';
}

MVC_IDS: {

    $aConfig['MVC_IDS_CONFIG'] = $aConfig['MVC_APPLICATION_CONFIG_DIR'] . '/staging/' . getenv('MVC_ENV') . '/ids.ini';
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
