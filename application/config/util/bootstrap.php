<?php

/**
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

// read .env file in the public folder
if (file_exists('.env'))
{
    $aEnvContent = array_values(array_filter(file('.env'), 'trim'));

    foreach ($aEnvContent as $sLine)
    {
        // skip comment lines
        if ('#' === substr(trim($sLine), 0, 1))
        {
            continue;
        }

        // simply set
        putenv(trim($sLine));
    }
}


// we need MVC_ENV set.
// So if MVC_ENV is not already set (e.g. via Webserver, which is the recommended way - see documentation), 
// this fallback sets a value
(false === getenv ('MVC_ENV')) ? putenv('MVC_ENV=develop') : false;

MVC_INSTALL: {

	/**
	 * check install status
	 * if necessary,
	 * auto create folders, run composer, install required libraries
	 */
	require_once __DIR__ . '/checkInstall.php';
}

MVC_CONFIG: {

	// load main config
	require_once __DIR__ . '/stagingLoader.php';

	/**
	 * customize/extend the config:
	 * scan the webroot/config folder and require all *.php files. 
	 * You may customize previous settings there and/or declare new ones 
	 */
	foreach (glob ($aConfig['MVC_APPLICATION_CONFIG_EXTEND_DIR'] . '/*.php') as $sFile)
	{
		require_once $sFile;
	}
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
	 * 		$aConfig['MVC_COMPOSER_DIR'] = $aConfig['MVC_APPLICATION_CONFIG_EXTEND_DIR'];
	 * 		or, even better, using a subdirectory - here, it is called "myMVC":
	 * 		$aConfig['MVC_COMPOSER_DIR'] = $aConfig['MVC_APPLICATION_CONFIG_EXTEND_DIR'] . '/myMvc/';
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
					$GLOBALS['aConfig']['MVC_LOG_FILE_DEFAULT'], MVC\Log::PREPARE_MESSAGE (
						'AUTOLOADING' . "\t" . $sFileName, __FILE__ . ', ' . __LINE__ . ' >', 100
					), FILE_APPEND
				);
			}
		}

		require $sFileName;
	}

	spl_autoload_register ("mvcAutoload");
}

// load MVC classes
foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($aConfig['MVC_LIBRARY'] . '/MVC/')) as $sMVCFileName)
{
    $aPathinfo = pathinfo($sMVCFileName);

    if ('php' === $aPathinfo['extension'])
    {
        require_once $sMVCFileName;
    }
}

// set to Registry
foreach ($aConfig as $sKey => $sValue){\MVC\Registry::set ($sKey, $sValue);}
