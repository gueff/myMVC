<?php
/**
 * requireModuleConfigs.php
 *
 * searches for php files in
 *      /modules/{name}/etc/config/*.php
 * and requires them
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

// get modules
$aModule = glob($aConfig['MVC_MODULES'] . '/*', GLOB_ONLYDIR);

// walk modules
foreach ($aModule as $sModule)
{
    if (file_exists($sModule . '/etc/config/'))
    {
        // load config file
        foreach (glob ($sModule . '/etc/config/*.php') as $sFile)
        {
            require_once $sFile;
        }
    }
}
