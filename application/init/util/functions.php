<?php

#--------------------------------------------------------------------------------
#

/**
 * simplifies the use of variables.
 * If a variable does not exist, null or a defined value is returned
 *
 * // usually
 * $mValue = (isset($aData['foo']['bar'])) ? $aData['foo']['bar'] : null;
 * // way easier with get()
 * $mValue = get($aData['foo']['bar']);
 *
 * @param      $sVar
 * @param null $mFallback
 * @return mixed|null
 * @example     if (get($_GET['foo']) === 123) {..}         // value of $_GET['foo'] or null
 *              if (get($_GET['foo'], 123) === 123) {..}    // value of $_GET['foo'] or 123
 *              $mValue = get($aData['foo']['bar']);        // value of $aData['foo']['bar'] or null
 */
function get(&$sVar, $mFallback = null)
{
    if (isset($sVar))
    {
        return $sVar;
    }

    return $mFallback;
}

/**
 * dumps data using print_r
 * @example pr(get_include_path(), ':');
 * @param $mData
 * @param $sSeparator optional works on strings
 * @return void
 */
function pr($mData, $sSeparator = "\n")
{
    if (true === is_string($mData))
    {
        echo ('cli' === php_sapi_name())
            ? print_r(array_filter(explode($sSeparator, $mData)), true) . "\n"
            : '<pre>' . print_r(array_filter(explode($sSeparator, $mData)), true) . '</pre><hr>';
    }
    elseif (true === is_array($mData))
    {
        echo ('cli' === php_sapi_name())
            ? print_r(array_filter($mData), true) . "\n"
            : '<pre>' . print_r(array_filter($mData), true) . '</pre><hr>';
    }
    else
    {
        echo ('cli' === php_sapi_name())
            ? print_r($mData) . "\n"
            : '<pre>' . print_r($mData) . '</pre><hr>';
    }
}

/**
 * @return void
 * @throws \ReflectionException
 */
function stop()
{
    if (
        (false === class_exists('\MVC\Debug', true)) ||
        (false === class_exists('\MVC\Request', true))
    )
    {
        die("\ndie at: " . __FILE__ . ', ' . __LINE__ . "\n");
    }

    $aDebug = \MVC\Debug::prepareBacktraceArray(debug_backtrace());
    $sMessage = "<pre>
stop at:
- File: " . $aDebug['sFile'] . "
- Line: " . $aDebug['sLine']. "
- Method: " . $aDebug['sClass'] . "::" . $aDebug['sFunction'] . "
</pre>
";

    (true === \MVC\Request::isCli()) ? $sMessage = strip_tags($sMessage): false;
    die($sMessage);
}

if (!function_exists('getallheaders'))
{
    /**
     * @return array
     */
    function getallheaders()
    {
        $aHeader = [];

        foreach ($_SERVER as $name => $value)
        {
            if (substr($name, 0, 5) == 'HTTP_')
            {
                $aHeader[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }

        return $aHeader;
    }
}

/**
 * reads environment key/values from a given file
 * and stores them via putenv so that they will be accessible via getenv() *
 * @param string $sEnvFile
 * @return void
 */
function mvcStoreEnv(string $sEnvFile = '')
{
    (true === empty($sEnvFile))
        ? $sEnvFile = realpath(__DIR__ . '/../../../') . '/.env'
        : false
    ;

    if (false === file_exists($sEnvFile))
    {
        file_put_contents(
            $sEnvFile,
            "# auto-created " . date('Y-m-d H:i:s') . "\nMVC_ENV=develop\n"
        );
    }

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
        $sMessage = "missing file:\n" . $sEnvFile . "\n\n";
        echo (('cli' != php_sapi_name()) ? nl2br($sMessage) : $sMessage . "\n");
        (false === getenv('emvicy')) ? exit() : false;
    }

    $sEnvFile = null;
    unset($sEnvFile);
}

/**
 * @param array $aConfig
 * @return array
 */
function mvcConfigLoader(array $aConfig = array())
{
    // place of main myMVC config
    $aConfig['MVC_CONFIG_DIR'] = realpath(__DIR__ . '/../../../') . '/config';

    // load main config from /config/*.php
    foreach (glob ($aConfig['MVC_CONFIG_DIR'] . '/*.php') as $sFile)
    {
        require_once $sFile;
        $sFile = null;
        unset ($sFile);
    }

    #-----------------------------

    // get modules
    $aModule = glob($aConfig['MVC_MODULES_DIR'] . '/*', GLOB_ONLYDIR);

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

    // load requirements from /application/init/util/_mvc.php
    require_once __DIR__ . '/_mvc.php';

    return $aConfig;
}

/**
 * @param string $sWhereIsItem
 * @return string|void
 */
function whereis(string $sWhereIsItem = '')
{
    ob_start();
    system('/bin/bash -c "type -p ' . escapeshellarg(trim($sWhereIsItem)) . '"', $iCode);
    $mResult = ob_get_contents();
    $sResult = trim(((false === $mResult) ? '' : $mResult));
    ob_end_clean();

    if (true === empty($sResult))
    {
        echo 'program `' . $sWhereIsItem . '` not found. Abort.' . "\n\n";
        exit();
    }

    return $sResult;
}