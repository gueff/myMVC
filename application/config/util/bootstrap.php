<?php

/**
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

READ_ENV: {

    $sEnvFile = realpath(__DIR__ . '/../../../') . '/public/.env';

    // read .env file in the public folder
    if (file_exists($sEnvFile))
    {
        $aEnvContent = array_values(array_filter(file($sEnvFile), 'trim'));

        foreach ($aEnvContent as $sLine)
        {
            $sLine = trim($sLine);

            // skip comment lines
            if ('#' === substr($sLine, 0, 1))
            {
                continue;
            }

            // simply set
            putenv($sLine);
            $sLine = null;
            unset ($sLine);
        }

        $aEnvContent = null;
        unset($aEnvContent);
    }
    else
    {
        $sMessage = "missing file:\n/public/.env\n\n";
        die(('cli' != php_sapi_name()) ? nl2br($sMessage) : $sMessage);
    }

    $sEnvFile = null;
    unset($sEnvFile);
}

MVC_ENV: {

    // we need the variable MVC_ENV set.
    // So if MVC_ENV is not already set this fallback sets it to develop
    (false === getenv ('MVC_ENV')) ? putenv('MVC_ENV=develop') : false;
    $aConfig['MVC_ENV'] = getenv('MVC_ENV');
}

CONFIG: {

    // place of main myMVC config
    $aConfig['MVC_CONFIG_DIR'] = realpath(__DIR__ . '/../../../') . '/config';

    // load main config from /application/config/*.php
    foreach (glob ($aConfig['MVC_CONFIG_DIR'] . '/*.php') as $sFile)
    {
        require_once $sFile;
        $sFile = null;
        unset ($sFile);
    }

    #-----------------------------

    // get modules
    $aModule = glob($aConfig['MVC_MODULES'] . '/*', GLOB_ONLYDIR);

    // walk modules
    foreach ($aModule as $sModule)
    {
        if (file_exists($sModule . '/etc/config/'))
        {
            // load common config files
            foreach (glob ($sModule . '/etc/config/*.php') as $sFile)
            {
                require_once $sFile;
            }

            // load staging config
            $sConfigFileName =
                $sModule
                . '/etc/config/'
                . basename($sModule)
                . '/config/'
                . getenv('MVC_ENV')
                . '.php';

            if (file_exists($sConfigFileName))
            {
                include $sConfigFileName;
            }

            // External composer Libraries
            $sVendorAutoload = $sModule . '/etc/config/' . basename($sModule) . '/vendor/autoload.php';

            if (file_exists($sVendorAutoload))
            {
                require_once $sVendorAutoload;
            }
        }
    }

    #-----------------------------

    // load requirements from /application/config/util/_myMVC.php
    require_once __DIR__ . '/_myMVC.php';
}

FIRST_LOG_ENTRY_ON_NEW_REQUEST: {

    if ('cli' === php_sapi_name())
    {
        require_once realpath(__DIR__ . '/../../') . '/library/MVC/Request.php';
        \MVC\Request::setServerVarsForCli();
    }

    $sMessage = substr(__FILE__, strlen(realpath(__DIR__ . '/../../../'))) . ', ' . __LINE__ . ' > '
                . "\t" . str_repeat ('#', 10) . "\tnew Request"
                . "\t" . php_sapi_name ()
                . "\t" . (array_key_exists ('REQUEST_METHOD', $_SERVER) ? (string) $_SERVER['REQUEST_METHOD'] : '')
                . ' ' . (array_key_exists ('REQUEST_URI', $_SERVER) ? (string) $_SERVER['REQUEST_URI'] : '');
    $sMessage = ''
                . date("Y-m-d H:i:s")
                . "\t" . $_SERVER['HTTP_HOST']
                . "\t" . ((false !== getenv('MVC_ENV')) ? getenv('MVC_ENV') : '---?---')
                . "\t" . ((array_key_exists('REMOTE_ADDR', $_SERVER)) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1')
                . "\t" . ((array_key_exists('MVC_UNIQUE_ID', $GLOBALS['aConfig'])) ? $GLOBALS['aConfig']['MVC_UNIQUE_ID'] : '---')
                . "\t" . (('' !== session_id()) ? session_id() : str_pad('...........no session', 32, '.'))
                . "\t" . 0
                . "\t" . $sMessage
                . "\n";

    if (false === file_exists($GLOBALS['aConfig']['MVC_LOG_FILE_FOLDER']))
    {
        mkdir($GLOBALS['aConfig']['MVC_LOG_FILE_FOLDER']);
    }

    if (false === file_exists($GLOBALS['aConfig']['MVC_LOG_FILE_DEFAULT']))
    {
        touch($GLOBALS['aConfig']['MVC_LOG_FILE_DEFAULT']);
    }

    file_put_contents($GLOBALS['aConfig']['MVC_LOG_FILE_DEFAULT'], $sMessage,FILE_APPEND);
    $sMessage = null;
    unset($sMessage);
}

MVC_FUNCTIONS: {

    // load requirements from /application/config/util/functions.php
	require_once __DIR__ . '/functions.php';
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
		. PATH_SEPARATOR . $aConfig['MVC_MODULES']
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
	 * vanilla php autoloader
	 * http://www.sitepoint.com/autoloading-and-the-psr-0-standard/
	 * @param type $sClassName
	 */
	function mvcAutoload ($sClassName)
	{
		$sClassName = ltrim ($sClassName, '\\');
		$sFileName = '';
		$sNamespace = '';

		if ($iLastNsPos = strripos ($sClassName, '\\'))
		{
			$sNamespace = substr ($sClassName, 0, $iLastNsPos);
			$sClassName = substr ($sClassName, $iLastNsPos + 1);
			$sFileName = str_replace ('\\', DIRECTORY_SEPARATOR, $sNamespace) . DIRECTORY_SEPARATOR;
		}

		$sFileName .= str_replace ('_', DIRECTORY_SEPARATOR, $sClassName) . '.php';

		$sRegistry = $GLOBALS['aConfig']['MVC_LIBRARY'] . '/MVC/Registry.php';
		$sLog = $GLOBALS['aConfig']['MVC_LIBRARY'] . '/MVC/Log.php';

		if (file_exists ($sLog))
		{
			require_once $sRegistry;
			require_once $sLog;

			if (true === $GLOBALS['aConfig']['MVC_LOG_AUTOLOADER'])
			{
				file_put_contents (
					$GLOBALS['aConfig']['MVC_LOG_FILE_DEFAULT'], MVC\Log::prepareMessage (
						'AUTOLOADING' . "\t" . $sFileName,
                    substr(__FILE__, strlen(realpath(__DIR__ . '/../../../'))) . ', ' . __LINE__ . ' >'
					), FILE_APPEND
				);
			}
		}

		require $sFileName;
	}

	spl_autoload_register ("mvcAutoload");
}

LOAD_MVC_CLASSES: {

    foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($aConfig['MVC_LIBRARY'] . '/MVC/')) as $sMVCFileName)
    {
        if ('php' === strtolower(pathinfo($sMVCFileName)['extension']))
        {
            require_once $sMVCFileName;
            $sMVCFileName = null;
            unset ($sMVCFileName);
        }
    }
}
