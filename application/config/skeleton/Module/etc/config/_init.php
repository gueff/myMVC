<?php

// Modulename
$sAppModuleName = basename(realpath(__DIR__ . '/../../'));

// Config Path
// depending on env MVC_ENV
$sConfigFileName =
    __DIR__
    . '/'
    . $sAppModuleName
    . '/config/'
    . getenv('MVC_ENV')
    . '.php';

// load config
if (file_exists($sConfigFileName))
{
    include $sConfigFileName;
}

// External composer Libraries
if (file_exists(__DIR__ . '/' . $sAppModuleName . '/vendor/autoload.php'))
{
    require_once __DIR__ . '/' . $sAppModuleName . '/vendor/autoload.php';
}
