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
 * shorthand for `Debug::display()` on userland
 * @param mixed $mData
 * @return void
 */
function display(mixed $mData = '')
{
    if (true === class_exists('\MVC\Debug', true))
    {
        \MVC\Debug::display($mData, debug_backtrace());
    }
}

/**
 * shorthand for `Debug::info()` on userland
 * @param mixed $mData
 * @return void
 */
function info(mixed $mData = '')
{
    if (true === class_exists('\MVC\Debug', true))
    {
        \MVC\Debug::info($mData, debug_backtrace());
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
        die("\nstop at: \n- File: " . debug_backtrace()[0]['file']. "\n- Line: " . debug_backtrace()[0]['line'] . "\n");
    }

    $aDebug = \MVC\Debug::prepareBacktraceArray(debug_backtrace());
    $sMessage = "\n<pre>stop at:\n- File: " . $aDebug['sFile'] . "\n- Line: " . $aDebug['sLine'] . "\n";
    (!empty(get($aDebug['sClass']))) ? $sMessage.="- Method: " . $aDebug['sClass'] . "::" . $aDebug['sFunction'] . "</pre>" : false;
    ('cli' === strtolower(php_sapi_name())) ? $sMessage = strip_tags($sMessage): false;
    die($sMessage);
}

/**
 * dumps data using print_r
 * @example pr(get_include_path(), ':');
 * @param mixed  $mData
 * @param string $sSeparator optional works on strings
 * @return void
 */
function pr($mData, string $sSeparator = "\n")
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
    #-----------------------------
    # main config

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
    # module config

    if (count($aConfig['MVC_MODULE_PRIMARY']) > 1)
    {
        $sMessage = '<div class="alert alert-danger" role="alert"><center>'
                    . "<h1>⚠️</h1><p><b>There is more than one primary module, <br>but you can only have one. <br><br>Detected primary modules: <br><pre>'" . implode("','", $aConfig['MVC_MODULE_PRIMARY']) . "'</pre>\n\n"
                    . '- EOM -</b></p></center></div>';
        echo (true === $aConfig['MVC_CLI']) ? strip_tags($sMessage) : $sMessage;
        exit(1);
    }

    $aConfig['MVC_MODULE_SECONDARY'] = array_diff(array_filter(array_map(function ($sValue) use ($aConfig){
        return str_replace($aConfig['MVC_MODULES_DIR'] . '/', '', $sValue);
    }, glob($aConfig['MVC_MODULES_DIR'] . '/*', GLOB_ONLYDIR)), 'trim'), $aConfig['MVC_MODULE_PRIMARY']);

    $aConfig['MVC_MODULE_SET'] = array(
        'SECONDARY' => $aConfig['MVC_MODULE_SECONDARY'],    # handle 'SECONDARY' first
        'PRIMARY' => $aConfig['MVC_MODULE_PRIMARY'],        # handle 'PRIMARY' second
    );

    foreach ($aConfig['MVC_MODULE_SET'] as $sType => $aModule)
    {
        // walk modules
        foreach ($aModule as $sModule)
        {
            if (file_exists($aConfig['MVC_MODULES_DIR'] . '/' . $sModule . '/etc/config/'))
            {
                // load common config files
                foreach (glob ($aConfig['MVC_MODULES_DIR'] . '/' . $sModule . '/etc/config/*.php') as $sFile)
                {
                    require_once $sFile;
                }

                // load staging config
                $sConfigFileName =
                    $aConfig['MVC_MODULES_DIR'] . '/' . $sModule
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
                $sVendorAutoload = $aConfig['MVC_MODULES_DIR'] . '/' . $sModule . '/etc/config/' . basename($sModule) . '/vendor/autoload.php';

                if (file_exists($sVendorAutoload))
                {
                    require_once $sVendorAutoload;
                }
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
 * @return string
 * @throws \ReflectionException
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
        \MVC\Error::warning('function `' . __FUNCTION__ . '()` > requested program `' . $sWhereIsItem . '` not found.');
    }

    return $sResult;
}