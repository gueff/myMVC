<?php

/**
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 *
 * these configs here can be extended and overwritten by:
 *  `/modules/{module}/etc/config/_mvc.php`
 *  `/modules/{module}/etc/config/{module}/config/{stage}.php`
 */

//-------------------------------------------------------------------------------------
// MVC

MVC_RUNTIME_SETTINGS: {

    // show error messages
    error_reporting(E_ALL);

    // enable exit on "kill" command and CLI break (CTRL-C)
    // This command needs the pcntl extension to run.
    // do not provide if php's builtin webserver is running (using e.g. php myMVC.phar)
    if (true === isset($_SERVER['HTTP_HOST']) && '127.0.0.1:1969' !== $_SERVER['HTTP_HOST'])
    {
        (function_exists('pcntl_async_signals')) ? pcntl_async_signals(true) : false;
        (function_exists('pcntl_signal')) ? pcntl_signal(SIGTERM, function(){exit();}) : false;
        (function_exists('pcntl_signal')) ? pcntl_signal(SIGINT, function(){exit();}) : false;
    }

    /*
     * @see http://www.php.net/manual/en/timezones.php
     * @see http://stackoverflow.com/a/5559239/2487859
     * to get array of available timezones see result of timezone_identifiers_list()
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

    $aConfig['MVC_BIN_PHP_BINARY'] = PHP_BINARY;
    $aConfig['MVC_BIN_PS'] = whereis('ps');         # ps - report a snapshot of the current processes.
    $aConfig['MVC_BIN_SED'] = whereis('sed');       # sed - stream editor for filtering and transforming text
    $aConfig['MVC_BIN_MOVE'] = whereis('mv');       # mv - move (rename) files
    $aConfig['MVC_BIN_GREP'] = whereis('grep');     # grep, egrep, fgrep, rgrep - print lines that match patterns
    $aConfig['MVC_BIN_FIND'] = whereis('find');     # find - search for files in a directory hierarchy
    $aConfig['MVC_BIN_REMOVE'] = whereis('rm');     # rm - remove files or directories
    $aConfig['MVC_BIN_XARGS'] = whereis('xargs');   # xargs - build and execute command lines from standard input
}

MVC_APPLICATION_SETTINGS_I: {

    /**
     * keys for "query" notation in \MVC\Route routings
     * e.g.: 'module=Foo&c=index&m=index'
     */
    $aConfig['MVC_ROUTE_QUERY_PARAM_MODULE'] = 'module';
    $aConfig['MVC_ROUTE_QUERY_PARAM_C'] = 'c';
    $aConfig['MVC_ROUTE_QUERY_PARAM_M'] = 'm';

    /**
     * Name of method to be executed in the Target Controller Class
     * before session and other main functionalities.
     * It will be called in /application/library/MVC/Application.php:
     *        Controller::runTargetClassPreconstruct();
     *
     * This method is also declared via interface MVC_Interface_Controller.
     * Due to this, you should not edit this name, otherwise you have to
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

    $aConfig['MVC_APPLICATION_INIT_DIR'] = $aConfig['MVC_APPLICATION_PATH'] . '/init';

    $aConfig['MVC_LIBRARY'] = $aConfig['MVC_APPLICATION_PATH'] . '/library';
    $aConfig['MVC_MODULES_DIR'] = $aConfig['MVC_BASE_PATH'] . '/modules';

    // Main myMVC config directory
    $aConfig['MVC_CONFIG_DIR'] = $aConfig['MVC_BASE_PATH'] . '/config';

    /**
     * Event
     */
    // allow declaring listeners with wildcard, e.g.:   Event::bind('foo.bar.*', ... );
    // matches to event 'foo.bar.baz':                  Event::run('foo.bar.baz');
    // mandatory: asterisk `*` at the end
    // notice: wildcard listeners are processed before the regular event listeners
    $aConfig['MVC_EVENT_ENABLE_WILDCARD'] = true;

    // logging of each simple "RUN" event into MVC_LOG_FILE_EVENT
    // remember:
    // - events marked as "RUN": fired events without any listener (nothing happens)
    // - events marked as "RUN+": fired events with bonded listeners / closures to be executed
    // be aware that setting this to "true" would produce much data in the logfile (consider using logrotate!)
    // anyway this might be useful for a develop environment, as it helps debugging and understanding
    $aConfig['MVC_EVENT_LOG_RUN'] = false;

    // logging request into request.log
    $aConfig['MVC_LOG_REQUEST'] = false;

    // logging of SQL Statements
    $aConfig['MVC_LOG_SQL'] = false;

    /**
     * Log
     * consider a logrotate mechanism for these logfiles as they may grow quickly
     */
    $aConfig['MVC_LOG_FILE_DIR'] = $aConfig['MVC_APPLICATION_PATH'] . '/log/';          # trailing slash required
    $aConfig['MVC_LOG_FILE_DEFAULT'] = $aConfig['MVC_LOG_FILE_DIR'] . 'default.log';
    $aConfig['MVC_LOG_FILE_ERROR'] = $aConfig['MVC_LOG_FILE_DIR'] . 'error.log';
    $aConfig['MVC_LOG_FILE_WARNING'] = $aConfig['MVC_LOG_FILE_DIR'] . 'warning.log';
    $aConfig['MVC_LOG_FILE_NOTICE'] = $aConfig['MVC_LOG_FILE_DIR'] . 'notice.log';
    $aConfig['MVC_LOG_FILE_POLICY'] = $aConfig['MVC_LOG_FILE_DIR'] . 'policy.log';
    $aConfig['MVC_LOG_FILE_EVENT'] = $aConfig['MVC_LOG_FILE_DIR'] . 'event.log';
    $aConfig['MVC_LOG_FILE_REQUEST'] = $aConfig['MVC_LOG_FILE_DIR'] . 'request.log';
    $aConfig['MVC_LOG_FILE_SQL'] = $aConfig['MVC_LOG_FILE_DIR'] . 'sql.log';

    // 1) make sure write access is given to the folder
    // as long as the db user is going to write and not the webserver user
    // 2) consider a logrotate mechanism for this logfile as it may grow quickly
    $aConfig['MVC_LOG_FILE_DB_DIR'] = '/tmp/';

    // control log details
    $aConfig['MVC_LOG_DETAIL'] = [
        'date' => true,
        'host' => true,
        'env' => true,
        'ip' => true,
        'uniqueid' => true,
        'sessionid' => true,
        'count' => true,
        'debug' => true,
        'message' => true,
    ];

    // force linebreaks in logfiles no matter what
    $aConfig['MVC_LOG_FORCE_LINEBREAK'] = false;

    /**
     * Caching
     */
    // cache directory
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
    // session directory and
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

MODULES: {

    // if a module has that file it is the primary one
    $aConfig['MVC_MODULE_PRIMARY_ESSENTIAL'] = '/.primary';

    // identify primary module
    $aConfig['MVC_MODULE_PRIMARY'] = array_filter(
        array_map(
            function ($sValue) use ($aConfig){
                return str_replace($aConfig['MVC_MODULE_PRIMARY_ESSENTIAL'], '', str_replace($aConfig['MVC_MODULES_DIR'] . '/', '', $sValue));
            }, glob($aConfig['MVC_MODULES_DIR'] . '/*' . $aConfig['MVC_MODULE_PRIMARY_ESSENTIAL'])),
        'trim'
    );
    $aConfig['MVC_MODULE_PRIMARY_NAME'] = current($aConfig['MVC_MODULE_PRIMARY']);
    $aConfig['MVC_MODULE_PRIMARY_DIR'] = $aConfig['MVC_MODULES_DIR'] . '/' . $aConfig['MVC_MODULE_PRIMARY_NAME'];
    $aConfig['MVC_MODULE_PRIMARY_CONFIG_DIR'] = $aConfig['MVC_MODULE_PRIMARY_DIR'] . '/etc/config';
    $aConfig['MVC_MODULE_PRIMARY_CONTROLLER_DIR'] = $aConfig['MVC_MODULE_PRIMARY_DIR'] . '/Controller';
    $aConfig['MVC_MODULE_PRIMARY_DATATYPE_DIR'] = $aConfig['MVC_MODULE_PRIMARY_DIR'] . '/DataType';
    $aConfig['MVC_MODULE_PRIMARY_ETC_DIR'] = $aConfig['MVC_MODULE_PRIMARY_DIR'] . '/etc';
    $aConfig['MVC_MODULE_PRIMARY_STAGING_CONFIG_DIR'] = $aConfig['MVC_MODULE_PRIMARY_CONFIG_DIR'] . '/' . $aConfig['MVC_MODULE_PRIMARY_NAME'] . '/config';
    $aConfig['MVC_MODULE_PRIMARY_EVENT_DIR'] = $aConfig['MVC_MODULES_DIR'] . '/Event';
    $aConfig['MVC_MODULE_PRIMARY_MODEL_DIR'] = $aConfig['MVC_MODULES_DIR'] . '/Model';
    $aConfig['MVC_MODULE_PRIMARY_POLICY_DIR'] = $aConfig['MVC_MODULES_DIR'] . '/Policy';
    $aConfig['MVC_MODULE_PRIMARY_VIEW_DIR'] = $aConfig['MVC_MODULES_DIR'] . '/View';
    $aConfig['MVC_MODULE_PRIMARY_COMPOSER_DIR'] = $aConfig['MVC_MODULE_PRIMARY_CONFIG_DIR'] . '/' . $aConfig['MVC_MODULE_PRIMARY_NAME'];

    // array for module configs
    $aConfig['MODULE'] = array();
}

MVC_APPLICATION_SETTINGS_II:
{
    /**
     * MVC fallback routing
     * this routing will be used if none is specified for routing
     * Note: Possibility of a direct call (http|cli) of this route is disabled
     */
    $aConfig['MVC_ROUTING_FALLBACK'] = $aConfig['MVC_ROUTE_QUERY_PARAM_MODULE'] . '=' . $aConfig['MVC_MODULE_PRIMARY_NAME'] . '&'
                                       . $aConfig['MVC_ROUTE_QUERY_PARAM_C'] . '=index&'
                                       . $aConfig['MVC_ROUTE_QUERY_PARAM_M'] . '=notFound';
}

MVC_TEMPLATE_ENGINE_SMARTY: {

    $aConfig['MVC_VIEW_TEMPLATE_DIR'] = $aConfig['MVC_MODULE_PRIMARY_DIR'] . '/templates';

    $aConfig['MVC_SMARTY_CACHE_STATUS'] = false;
    $aConfig['MVC_SMARTY_CACHE_DIR'] = $aConfig['MVC_APPLICATION_PATH'] . '/cache';

    $aConfig['MVC_SMARTY_TEMPLATE_DIR'] = $aConfig['MVC_VIEW_TEMPLATE_DIR'];
    $aConfig['MVC_SMARTY_TEMPLATE_DEFAULT'] = 'Frontend/layout/index.tpl';

    // templates_c directory and
    // templates_c directory access rights, octal mode
    $aConfig['MVC_SMARTY_TEMPLATE_CACHE_DIR'] = $aConfig['MVC_APPLICATION_PATH'] . '/templates_c';

    // array Location of Smarty PlugIns
    $aConfig['MVC_SMARTY_PLUGINS_DIR'][] = $aConfig['MVC_APPLICATION_PATH'] . '/smartyPlugins';
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

    $aConfig['MVC_UNIQUE_ID'] = date('YmdHis') . '' . uniqid();
}