<?php
/**
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
 */

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
 * @return void
 * @throws \ReflectionException
 */
function stop()
{
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