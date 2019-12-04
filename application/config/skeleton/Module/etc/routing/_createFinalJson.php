<?php

/**
 * creates final.json
 * run on CLI:
 *
 * $ php _createFinalJson.php
 */

$sFinalJson = 'final.json';
$aLanguageFolder = glob( realpath(__DIR__) . '/*', GLOB_ONLYDIR);
$aStandardRoutes = glob( realpath(__DIR__) . '/*json');
$aFinal = [];

foreach ($aLanguageFolder as $sValue)
{
    if (file_exists($sValue . '/routing.json'))
    {
        $aTmp = json_decode(file_get_contents($sValue . '/routing.json'), true);
        $aFinal = array_merge($aTmp, $aFinal);
    }
}

foreach ($aStandardRoutes as $sValue)
{
    if ('final.json' === basename($sValue))
    {
        continue;
    }

    if (file_exists($sValue))
    {
        $aTmp = json_decode(file_get_contents($sValue), true);
        $aFinal = array_merge($aTmp, $aFinal);
    }
}

if (file_exists($sFinalJson))
{
    unlink($sFinalJson);
}

file_put_contents(
    $sFinalJson,
    json_encode($aFinal, JSON_PRETTY_PRINT)
);
