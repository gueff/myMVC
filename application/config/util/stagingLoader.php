<?php

/**
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

$aConfig = array();

GET_STAGES: {
	
	// get possible stages
	$aStage = array_map('basename', array_filter(glob(realpath (__DIR__ . '/../') . '/staging/*'), 'is_dir'));

	if (!in_array(getenv('MVC_ENV'), $aStage))
	{
		$sMsg = "\nERROR\n\t- the environment variable MVC_ENV is not set to one of the values " . implode ('|', $aStage) . ". \nInstead, it is set to `" . getenv('MVC_ENV') . "`\nSee doc/README for how to set the MVC_ENV environment variable.\nAbort.\n\n";
		('cli' !== php_sapi_name()) ? $sMsg = nl2br($sMsg) : false;
		die($sMsg);
	}
}

LOAD_CONFIG_FILES: {
	
	// get possible config/php files
	$aConfigFile = glob(realpath (__DIR__ . '/../') . '/staging/' . getenv('MVC_ENV') . '/*.php');

	if (empty($aConfigFile))
	{
		$sMsg = "\nERROR\t- cannot load any config file in `" . realpath (__DIR__ . '/../') . '/staging/' . getenv('MVC_ENV') . "` - no config.php file.\n\nAbort.\n\n";
		('cli' !== php_sapi_name()) ? $sMsg = nl2br($sMsg) : false;
		die($sMsg);
	}

	// load php files
	foreach ($aConfigFile as $sConfigFile)
	{
		require $sConfigFile;
	}
}

// add Env to config
$aConfig['MVC_ENV'] = getenv('MVC_ENV');
