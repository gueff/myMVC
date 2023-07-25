<?php

/**
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

MVC_FUNCTIONS: {

    require_once __DIR__ . '/functions.php';
}

READ_ENV: {

    mvcStoreEnv(realpath(__DIR__ . '/../../../') . '/.env');
}

MVC_ENV: {

    // we need the variable MVC_ENV set.
    // So this fallback sets it to "develop" if MVC_ENV is not already set before
    (false === getenv ('MVC_ENV'))
        ? putenv('MVC_ENV=develop')
        : false
    ;
    $aConfig['MVC_ENV'] = getenv('MVC_ENV');
}

CONFIG: {

    $aConfig = mvcConfigLoader($aConfig);
}

LOAD_FIRST_ESSENTIALS:{

    require_once $aConfig['MVC_LIBRARY'] . '/MVC/Config.php';
    require_once $aConfig['MVC_LIBRARY'] . '/MVC/Debug.php';
    require_once $aConfig['MVC_LIBRARY'] . '/MVC/Log.php';
    require_once $aConfig['MVC_LIBRARY'] . '/MVC/Registry.php';
}

MVC_INSTALL: {

    // check install status.
    // if necessary, auto create folders, run composer, install required libraries
    require_once __DIR__ . '/checkInstall.php';
}

MVC_AUTOLOADING: {

    // set Include paths
    set_include_path (
        get_include_path ()

        // MVC Application
        . PATH_SEPARATOR . $aConfig['MVC_LIBRARY']
        . PATH_SEPARATOR . $aConfig['MVC_MODULES_DIR']
        . PATH_SEPARATOR . implode (PATH_SEPARATOR, $aConfig['MVC_SMARTY_PLUGINS_DIR'])
    );

    // Enable Autoload for main Composer Libs
    require_once $aConfig['MVC_APPLICATION_PATH'] . '/vendor/autoload.php';

    /**
     * custom composer libraries
     * which may defined via your custom config
     * by $aConfig['MVC_COMPOSER_DIR']
     *
     * For example:
     * 		$aConfig['MVC_COMPOSER_DIR'] = $aConfig['MVC_CONFIG_DIR'];
     * 		or, even better, using a subdirectory - here, it is called "myMVC":
     * 		$aConfig['MVC_COMPOSER_DIR'] = $aConfig['MVC_CONFIG_DIR'] . '/myMvc/';
     */
    if (isset ($aConfig['MVC_COMPOSER_DIR']) && file_exists ($aConfig['MVC_COMPOSER_DIR'] . '/vendor/autoload.php'))
    {
        require_once $aConfig['MVC_COMPOSER_DIR'] . '/vendor/autoload.php';
    }

    /**
     * PSR4 autoloader
     */
    spl_autoload_register(function ($sClassName) {

        global $aConfig;

        $sFileName = str_replace('\\', DIRECTORY_SEPARATOR, $sClassName) . '.php';

        if (true === $aConfig['MVC_LOG_AUTOLOADER'])
        {
            \MVC\Log::write('AUTOLOADING' . "\t" . $sFileName);
        }

        require_once $sFileName;
    });
}

FIRST_LOG_ENTRY_ON_NEW_REQUEST: {

    if ('cli' === php_sapi_name())
    {
        \MVC\Request::setServerVarsForCli();
    }

    $sMessage = str_repeat ('#', 10) . "\tnew Request"
        . "\t" . php_sapi_name ()
        . "\t" . (array_key_exists ('REQUEST_METHOD', $_SERVER) ? (string) $_SERVER['REQUEST_METHOD'] : '')
        . ' ' . (array_key_exists ('REQUEST_URI', $_SERVER) ? (string) $_SERVER['REQUEST_URI'] : '');

    \MVC\Log::write($sMessage);
}