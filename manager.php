<?php

/**
 * Usage
 *		$ php manager.php
 * 
 * 
 */

putenv("MVC_ENV=develop");

$sUsage = "
--------------------------------
myMVC Manager
--------------------------------

Dependencies
	-	need to run on a linux machine
	-	needs execution of php's shell_exec
	-	need to run Linux commands (sed, grep, rm) via shell_exec
	

Basic Usage
	$ php manager.php {COMMAND}={VALUE}\n
	
	commands
		module_create
			creates a new module

			$ php manager.php module_create=test
			-> creates the module 'test'
		
		module_delete
			deletes an existing module

			$ php manager.php module_delete=test
			-> deletes the module 'test'
		

*** PLEASE NOTICE *********************
* be careful with delete command      *
* no security question will be asked  *
* the module will be erased instantly *
***************************************
";

//------------------------------------------------------------------------------


// Settings
require_once './application/config/util/stagingLoader.php';

// convert cli params into GET array - @see http://php.net/manual/de/features.commandline.php#108883
(isset($argv)) ? parse_str(implode('&', array_slice($argv, 1)), $_GET) : die ("\n\nfor usage on CLI only\n\n");



// create module
if (isset($_GET['module_create']))
{
	$_GET['module_create'] = ucfirst(trim($_GET['module_create']));

	// check if not exist yet
	if (is_dir($aConfig['MVC_MODULES'] . '/' . $_GET['module_create'] ))
	{
		echo "\nERROR\tmodule '" . $_GET['module_create'] . "' already exists. Exit.\n\n";
		exit();
	}
	
	echo "\ncreating module/" . $_GET['module_create'] . "/* with subdirectories and -files\n";

	// copy new module skeleton
	recursiveCopy($aConfig['MVC_APPLICATION_CONFIG_DIR'] . '/skeleton/Module', $aConfig['MVC_MODULES'] . '/' . $_GET['module_create']);

	// replace placeholder
	shell_exec('grep -rl "{module}" ' . $aConfig['MVC_MODULES'] . '/' . $_GET['module_create'] . ' | xargs sed -i "s/{module}/' . $_GET['module_create'] . '/g"');

	// rename folder
    shell_exec('mv "' . $aConfig['MVC_MODULES'] . '/' . $_GET['module_create'] . '/etc/config/{module}" "' . $aConfig['MVC_MODULES'] . '/' . $_GET['module_create'] . '/etc/config/' . $_GET['module_create'] . '"')  ;

	// add route to routing.json
	$sJson = file_get_contents($aConfig['MVC_APPLICATION_CONFIG_DIR'] . '/staging/' . getenv ('MVC_ENV') . '/routing.json');
	$aJson = json_decode($sJson, TRUE);	
	$aJson['/' . $_GET['module_create'] . '/'] = array(
		'query' => 'module=' . strtolower($_GET['module_create']) . '&c=index&m=index',
		'title' => ucfirst($_GET['module_create']),
		'ssl' => 0
	);
	
	// JSON_PRETTY_PRINT not available < PHP5.4; so do it old way
	$oJson = json_encode($aJson);
	$oJson = str_replace(',', "	\n\t,\n\t", $oJson);
	$oJson = str_replace('{', "{\n\t\t", $oJson);
	$oJson = str_replace('}', "\n}", $oJson);
	$oJson = str_replace(':', ":\n\t\t\t", $oJson);
	
	copy ($aConfig['MVC_APPLICATION_CONFIG_DIR'] . '/staging/' . getenv ('MVC_ENV') . '/routing.json', $aConfig['MVC_APPLICATION_CONFIG_DIR'] . '/staging/' . getenv ('MVC_ENV') . '/routing.json.' . date('Y-m-d_H-i-s'));
	file_put_contents($aConfig['MVC_APPLICATION_CONFIG_DIR'] . '/staging/' . getenv ('MVC_ENV') . '/routing.json', $oJson);
	
	echo "module '" . $_GET['module_create'] . "' created.\n\n";
}
// delete module
elseif (isset($_GET['module_delete']))
{
	$_GET['module_delete'] = ucfirst(trim($_GET['module_delete']));

	// check if not exists
	if (!is_dir($aConfig['MVC_MODULES'] . '/' . $_GET['module_delete'] ))
	{
		echo "\nERROR\tmodule '" . $_GET['module_delete'] . "' does not exists. Exit.\n\n";
		exit();
	}
	
	$sCommand = 'rm -rf ' . $aConfig['MVC_MODULES'] . '/' . $_GET['module_delete'];
	shell_exec ($sCommand);
	
	// remove route from routing.json
	$sJson = file_get_contents($aConfig['MVC_APPLICATION_CONFIG_DIR'] . '/staging/' . getenv ('MVC_ENV') . '/routing.json');
	$aJson = json_decode($sJson, TRUE);	
	$aJson['/' . $_GET['module_delete'] . '/'] = NULL;
	unset($aJson['/' . $_GET['module_delete'] . '/']);
	
	// JSON_PRETTY_PRINT not available < PHP5.4; so do it old way
	$oJson = json_encode($aJson);
	$oJson = str_replace(',', "	\n\t,\n\t", $oJson);
	$oJson = str_replace('{', "{\n\t", $oJson);
	$oJson = str_replace('}', "\n}", $oJson);
	$oJson = str_replace(':', ":\n\t\t", $oJson);

	copy ($aConfig['MVC_APPLICATION_CONFIG_DIR'] . '/staging/' . getenv ('MVC_ENV') . '/routing.json', $aConfig['MVC_APPLICATION_CONFIG_DIR'] . '/staging/' . getenv ('MVC_ENV') . '/routing.json.' . date('Y-m-d_H-i-s'));
	file_put_contents($aConfig['MVC_APPLICATION_CONFIG_DIR'] . '/staging/' . getenv ('MVC_ENV') . '/routing.json', $oJson);
	
	echo "module '" . $_GET['module_delete'] . "' deleted.\n\n";		
}
else
{
	echo $sUsage;
}

/**
 * copies recursively
 * @param type $src
 * @param type $dst
 */
function recursiveCopy($src, $dst)
{
	$dir = opendir($src);
	@mkdir($dst);
	
	while (false !== ( $file = readdir($dir)))
	{
		if (( $file != '.' ) && ( $file != '..' ))
		{
			if (is_dir($src . '/' . $file))
			{
				recursiveCopy($src . '/' . $file, $dst . '/' . $file);
			}
			else
			{
				copy($src . '/' . $file, $dst . '/' . $file);
			}
		}
	}
	
	closedir($dir);
}


