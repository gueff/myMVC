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

// External composer Libraries
$sVendorAutoload = __DIR__ . '/' . $sAppModuleName . '/vendor/autoload.php';

if (file_exists($sConfigFileName))
{
    include $sConfigFileName;
}

if (file_exists($sVendorAutoload))
{
    require_once $sVendorAutoload;
}
