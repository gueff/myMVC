<?php
/**
 * Helper.php
 * @package   myMVC
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <info@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVC
 */

namespace MVC;

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;

/**
 * Helper
 */
class Helper
{

    /**
     * Mini OnScreen Debugger shows one bigger window bottom left on screen
     * @access public
     * @static
     * @param string|array $mData
     * @return void
     */
    public static function DEBUG($mData = '')
    {
        // source
        $aBacktrace = self::PREPAREBACKTRACEARRAY(debug_backtrace());

        ob_start();
        var_dump($mData);
        $mData = ob_get_contents();
        ob_end_clean();

        // output CLI
        if (isset ($GLOBALS['argc']))
        {
            echo "\n---DEBUG-------------------------";
            echo "\nFile:\t\t\t" . $aBacktrace['sFile'] . "";
            echo "\nLine:\t\t\t" . $aBacktrace['sLine'] . "";
            echo "\nClass::function:\t" . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . "\n";
            if (isset ($mData))
            {
                echo "\n" . '$data:' . "\n" . $mData . "\n\n";
            }
            echo "\n---/DEBUG------------------------\n\n";
        }
        // output Web
        else
        {
            echo '<div class="draggable" style="position: fixed !important; bottom:30px !important;left:5px !important;z-index:1 !important;float:left !important;text-align:left !important;background-color:white !important;border:1px solid gray !important;padding:5px !important;filter: Alpha (opacity=80) !important;opacity: 0.8 !important; moz-opacity: 0.8 !important;-moz-border-radius: 3px !important; border-radius: 3px !important;width: 600px !important;height: 550px !important;">
				<h1 style="color:red !important;margin:0 !important;padding:2px 0 0 0 !important;font-size:16px !important;">DEBUG</h1>
                <div style="overflow-wrap: break-word !important;word-wrap: break-word !important;hyphens: auto !important;">
                    <b>File:</b> ' . $aBacktrace['sFile'] . '<br>
                    <b>Line:</b> ' . $aBacktrace['sLine'] . '<br>
                    <b>Class/Method:</b> ' . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . '<br>
                </div>
				<textarea style="float:left !important;border:1px solid red !important;width:100% !important;min-height:400px !important;z-index:100 !important;font-size:12px !important;-moz-border-radius: 3px !important; border-radius: 3px !important;padding:10px !important;font-family: monospace !important;">' . $mData . '</textarea>
			</div>';
        }
    }

    /**
     * shows a smaller message on the screen right side.
     * if you call display more than once, all messages are showed among each other
     * use it to debug a string or array or whatever
     * @access public
     * @static
     * @param mixed $mData
     * @return void
     */
    public static function DISPLAY($mData = '')
    {
        static $sDisplay;
        static $iCount;

        $iCount++;

        // Source
        $aBacktrace = self::PREPAREBACKTRACEARRAY(debug_backtrace());

        ob_start();
        var_dump($mData);
        $mData = ob_get_contents();
        ob_end_clean();

        // Output for CLI
        if (isset ($GLOBALS['argc']))
        {
            echo "\n---DISPLAY-------------------------";
            echo "\nDisplay Count:\t\t" . $iCount . "";
            echo "\nFile:\t\t\t" . $aBacktrace['sFile'] . "";
            echo "\nLine:\t\t\t" . $aBacktrace['sLine'] . "";
            echo "\nClass::function:\t" . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . "\n";
            if (isset ($mData))
            {
                echo "\n" . '$data:' . "\n" . $mData . "\n\n";
            }
            echo "\n---/DISPLAY------------------------\n\n";
        }
        // Output Web
        else
        {
            // show source
            $sConsultation = '<div style="overflow-wrap: break-word !important;word-wrap: break-word !important;hyphens: auto !important;background-color:white !important;color:red !important;font-weight: normal !important;">';
            $sConsultation .= '<span style="color: white; background-color: blue; padding: 2px;">' . $iCount . '</span>';
            (isset ($aBacktrace['sFile']))
                ? $sConsultation .= '<b>File:</b> ' . $aBacktrace['sFile'] . '<br>'
                : '';
            (isset ($aBacktrace['sLine']))
                ? $sConsultation .= '<b>Line:</b> ' . $aBacktrace['sLine'] . '<br>'
                : '';
            (isset ($aBacktrace['sClass']) && isset ($aBacktrace['sFunction']))
                ? $sConsultation .= '<b>Class/Method:</b> ' . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . '<br>'
                : '';
            $sConsultation .= '</div>';

            if (is_array($mData))
            {
                $sDisplay .= $sConsultation . '<textarea style="font-size:10px;width:100% !important;height:200px !important;margin:0 !important;background-color:blue !important;color:white !important;border: none !important;padding: 5px !important;font-family: monospace !important;">' . $mData . '</textarea>';
            }
            else
            {
                $sDisplay .= $sConsultation . '<div style="font-size:10px;width:100%;padding:2px 0px 10px 0px;margin:0;background-color:blue;color:white;border:none;"><pre style="font-size:12px !important;overflow:auto !important;max-height:300px !important;background-color:transparent !important;color:#fff !important;border: none !important;padding: 5px !important;font-family: monospace !important;">' . $mData . '</pre></div>';
            }

            // Display
            echo '<div class="draggable" style="overflow: auto !important;max-height: 90%;z-index:10000 !important;position:fixed !important;bottom:10px !important;right:10px !important;background-color:blue !important;color:white !important;border:1px solid #333 !important;width:500px !important;-moz-border-radius:3px !important; border-radius: 3px !important;font-size:12px !important;font-family: monospace !important;"><b>';
            echo $sDisplay;
            echo '</b></div>';
        }
    }

    /**
     * Stops any further execution: exits the script.
     * Shows a Message from where the STOP command was called (default).
     * @param mixed $mData          default=''
     * @param bool  $bShowWhereStop default=true
     * @param bool  $bDump          default=true
     * @throws \ReflectionException
     */
    public static function STOP($mData = '', $bShowWhereStop = true, $bDump = true)
    {
        static $iCount;
        $iCount++;

        // source
        $aBacktrace = self::PREPAREBACKTRACEARRAY(debug_backtrace());

        if (true === $bDump)
        {
            ob_start();
            var_dump($mData);
            $sEcho = ob_get_contents();
            ob_end_clean();
        }
        else
        {
            $sEcho = $mData;
        }

        // output CLI
        if (isset ($GLOBALS['argc']))
        {
            $sConsultation = "\n---STOP-------------------------";
            $sConsultation .= "\nStopped at:";
            $sConsultation .= "\nFile:\t\t\t" . $aBacktrace['sFile'] . "";
            $sConsultation .= "\nLine:\t\t\t" . $aBacktrace['sLine'] . "";
            $sConsultation .= "\nClass::function:\t" . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . "\n";

            echo ($bShowWhereStop === true)
                ? $sConsultation
                : '';

            if (isset ($mData) && !empty ($mData))
            {
                echo ($bShowWhereStop === true)
                    ? "\nData:\n"
                    : '';
                echo $sEcho . "\n";
            }
            echo "\n---/STOP------------------------\n\n";
        }
        // output Web
        else
        {
            // show source
            $sConsultation = '<div style="overflow-wrap: break-word !important;word-wrap: break-word !important;hyphens: auto !important;background-color:white !important;color:red !important;font-weight: normal !important;">';
            (isset ($aBacktrace['sFile']))
                ? $sConsultation .= '<b>File:</b> ' . $aBacktrace['sFile'] . '<br>'
                : '';
            (isset ($aBacktrace['sLine']))
                ? $sConsultation .= '<b>Line:</b> ' . $aBacktrace['sLine'] . '<br>'
                : '';
            (isset ($aBacktrace['sClass']) && isset ($aBacktrace['sFunction']))
                ? $sConsultation .= '<b>Class/Method:</b> ' . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . '<br>'
                : '';
            $sConsultation .= '</div>';

            // display
            echo '<div class="draggable" style="padding:10px !important;z-index:10000 !important;position:fixed !important;top:10px !important;left:10px !important;background-color:red !important;color:white !important;border:1px solid #333 !important;width:400px !important;height:auto !important;overflow:auto !important;-moz-border-radius: 3px !important; border-radius: 3px !important;"><b>';
            echo ($bShowWhereStop === true)
                ? '<h1 style="font-size:20px !important;">STOP</h1><p>Stopped at:</p>' . $sConsultation
                : '';

            if (isset ($mData) && !empty ($mData))
            {
                echo ($bShowWhereStop === true)
                    ? '<h2>Data</h2><p>'
                    : '';
                echo '<pre style="font-size:10px;overflow:auto !important;max-height:300px !important;background-color:transparent !important;color:#fff !important;border: none !important;">' . $sEcho . '</pre></p>';
            }
            echo '</b></div>';
        }

        Event::RUN('mvc.helper.stop.after', DTArrayObject::create()
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('aBacktrace')
                ->set_sValue($aBacktrace))
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('mData')
                ->set_sValue($sEcho))
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('bOccurrence')
                ->set_sValue($bShowWhereStop)));

        exit ();
    }

    /**
     * checks wether the unknown parameter is a closure object
     * @access public
     * @static
     * @param mixed $mUnknown
     * @return boolean
     */
    public static function ISCLOSURE($mUnknown)
    {
        return is_object($mUnknown) && ($mUnknown instanceof \Closure);
    }

    /**
     * Dumps a Closure
     * taken from http://www.metashock.de/2013/05/dump-source-code-of-closure-in-php/
     * @access public
     * @static
     * @param mixed $mClosure name of function or Closure
     * @return string
     * @throws \ReflectionException
     */
    public static function CLOSUREDUMP($mClosure)
    {
        $oReflectionFunction = new \ReflectionFunction ($mClosure);
        $aParam = array();

        foreach ($oReflectionFunction->getParameters() as $mValue)
        {
            $sTemp = '';

            if ($mValue->isArray())
            {
                $sTemp .= 'array ';
            }
            else
            {
                if ($mValue->getClass())
                {
                    $sTemp .= $mValue->getClass()->name . ' ';
                }
            }

            if ($mValue->isPassedByReference())
            {
                $sTemp .= '&';
            }

            $sTemp .= '$' . $mValue->name;

            if ($mValue->isOptional())
            {
                $sTemp .= ' = ' . var_export($mValue->getDefaultValue(), true);
            }

            $aParam [] = $sTemp;
        }

        $sString = 'function (' . implode(', ', $aParam) . '){' . PHP_EOL;
        $aLine = file($oReflectionFunction->getFileName());

        for ($iCount = $oReflectionFunction->getStartLine(); $iCount < $oReflectionFunction->getEndLine(); $iCount++)
        {
            $sString .= $aLine[$iCount];
        }

        return $sString;
    }

    /**
     * gets the http uri protocol
     * @param null $mSsl
     * @return string|null
     * @throws \ReflectionException
     */
    public static function GETURIPROTOCOL($mSsl = null)
    {
        // detect on ssl or not
        if (isset ($mSsl))
        {
            // http
            if ((int)$mSsl === 0 || $mSsl == false)
            {
                return 'http://';
            }
            // https
            elseif ((int)$mSsl === 1 || $mSsl == true)
            {
                return 'https://';
            }
        }
        // autodetect
        else
        {
            // http
            if (self::DETECTSSL() === false)
            {
                return 'http://';
            }
            // http
            elseif (self::DETECTSSL() === true)
            {
                return 'https://';
            }
        }

        \MVC\Event::RUN('mvc.error', DTArrayObject::create()
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('sMessage')
                ->set_sValue('could not detect protocol of requested page.')));

        return null;
    }

    /**
     * check page is running in ssl mode
     * @return bool|mixed
     * @throws \ReflectionException
     */
    public static function DETECTSSL()
    {
        if (Registry::isRegistered('MVC_SECURE_REQUEST'))
        {
            return Registry::get('MVC_SECURE_REQUEST');
        }

        return ((array_key_exists('HTTPS', $_SERVER) && strtolower($_SERVER['HTTPS']) !== 'off') || Registry::isRegistered('MVC_SSL_PORT') && $_SERVER['SERVER_PORT'] == Registry::get('MVC_SSL_PORT'));
    }

    /**
     * get infos about a file via stat
     * @access public
     * @static
     * @param string $sFile file
     * @param string $sKey  (optional) if $sKey is given, only this info wil be returned
     * @return array
     */
    public static function GETFILEINFO($sFile = null, $sKey = null)
    {
        if (!isset($sFile) || !isset($sKey))
        {
            return array();
        }

        $aStat = stat($sFile);
        $aInfo = posix_getpwuid($aStat['uid']);

        if (!empty ($sKey))
        {
            if (array_key_exists($sKey, $aInfo))
            {
                return $aInfo[$sKey];
            }
        }

        return $aInfo;
    }

    /**
     * makes sure the requested page will be delivered with the correct protocol (http|https)
     * @throws \ReflectionException
     */
    public static function ENSURECORRECTPROTOCOL()
    {
        $aDebug = self::PREPAREBACKTRACEARRAY(debug_backtrace());
        Log::WRITE("DEPRECATED: " . __METHOD__ . "\tReplaced by:\t" . '\MVC\Request::ENSURECORRECTPROTOCOL(); --> called in: ' . $aDebug['sFile'] . ', ' . $aDebug['sLine'], 'notice.log');

        // Replaced by:
        Request::ENSURECORRECTPROTOCOL();
    }

    /**
     * prepares backtrace array for output
     * @access public
     * @static
     * @param array $aBacktrace
     * @return array
     */
    public static function PREPAREBACKTRACEARRAY(array $aBacktrace = array())
    {
        $aData = array();
        $aData['sFile'] = (isset($aBacktrace[0]['file']))
            ? $aBacktrace[0]['file']
            : '';
        $aData['sLine'] = (isset($aBacktrace[0]['line']))
            ? $aBacktrace[0]['line']
            : '';
        $aData['sClass'] = (isset($aBacktrace[1]['class']))
            ? $aBacktrace[1]['class']
            : '';
        $aData['sFunction'] = (isset($aBacktrace[1]['function']))
            ? $aBacktrace[1]['function']
            : '';

        return $aData;
    }

    /**
     * @param mixed $mData
     * @param bool  $bReturn           default=false
     * @param bool  $bShortArraySyntax default=true
     * @return mixed
     */
    public static function VAREXPORT($mData, $bReturn = false, $bShortArraySyntax = true)
    {
        $sExport = var_export($mData, true);
        $sExport = preg_replace("/^([ ]*)(.*)/m", '$1$1$2', $sExport);
        $aData = preg_split("/\r\n|\n|\r/", $sExport);

        $sTokenLeft = (true === $bShortArraySyntax)
            ? '['
            : 'array(';
        $sTokenRight = (true === $bShortArraySyntax)
            ? ']'
            : ')';

        $aData = preg_replace(["/\s*array\s\($/", "/\)(,)?$/", "/\s=>\s$/"], [
                null,
                $sTokenRight . '$1',
                ' => ' . $sTokenLeft,
            ], $aData);
        $sExport = join(PHP_EOL, array_filter([$sTokenLeft] + $aData));

        if (true === $bReturn)
        {
            return $sExport;
        }

        echo $sExport;
    }

    /**
     * converts an object into array
     * @param mixed $mObject
     * @return array
     */
    public static function convertObjectToArray($mObject)
    {
        (is_object($mObject))
            ? $mObject = (array)$mObject
            : false;

        if (is_array($mObject))
        {
            $aNew = array();

            foreach ($mObject as $sKey => $mValue)
            {
                $sFirstChar = trim(substr(trim($sKey), 0, 1));
                (('*' === $sFirstChar))
                    ? $sKey = trim(substr(trim($sKey), 1))
                    : false;
                $aNew[$sKey] = self::convertObjectToArray($mValue);
            }
        }
        else
        {
            $aNew = $mObject;
        }

        return $aNew;
    }

    /**
     * removes doubleDot+Slashes (../) from string
     * replaces multiple forwardSlashes (//) from string by a single forwardSlash
     * @param string $sAbsoluteFilePath
     * @param bool   $bIgnoreProtocols default=false; on true leaves :// as it is
     * @return string
     */
    public static function secureFilePath($sAbsoluteFilePath = '', $bIgnoreProtocols = false)
    {
        $sAbsoluteFilePath = self::removeDoubleDotSlashesFromString($sAbsoluteFilePath);
        $sAbsoluteFilePath = self::replaceMultipleForwardSlashesByOneFromString($sAbsoluteFilePath, $bIgnoreProtocols);

        /**@var string */
        return $sAbsoluteFilePath;
    }

    /**
     * removes doubleDot+Slashes (../) from string
     * @param string $sString
     * @return string
     */
    public static function removeDoubleDotSlashesFromString($sString = '')
    {
        // removes any "../"
        $sString = (string)preg_replace('#(\.\.\/)+#', '', trim($sString));

        /**@var string */
        return $sString;
    }

    /**
     * replaces multiple forwardSlashes (//) from string by a single forwardSlash
     * @param string $sString
     * @param bool   $bIgnoreProtocols default=false; on true leaves :// as it is
     * @return string
     */
    public static function replaceMultipleForwardSlashesByOneFromString($sString = '', $bIgnoreProtocols = false)
    {
        // removes multiple "/" [e.g.: //, ///, ////, etc.]
        if (true === $bIgnoreProtocols)
        {
            $sString = (string) preg_replace('#([^:])(\/{2,})#', '$1/', trim($sString));
        }
        else
        {
            $sString = (string) preg_replace('#/+#', '/', trim($sString));
        }

        /**@var string */
        return $sString;
    }
}
