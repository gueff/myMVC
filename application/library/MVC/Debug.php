<?php
/**
 * Debug.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
 */

namespace MVC;

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;
use Webbixx\Controller\Api;

class Debug
{
    /**
     * @param $sData
     * @return false|string
     */
    protected static function dump($mData = '')
    {
        ob_start();
        echo (Closure::is($mData)) ? '// type: Closure' : '// type: ' . gettype($mData);
        echo ('resource' === gettype($mData)) ? ', ' . get_resource_type($mData) : '';
        echo ('array' === gettype($mData)) ? ', items: ' . count($mData) : '';
        echo "\n";
        self::varExport($mData);
        $sData = trim(ob_get_contents());
        $sData = str_replace("=>\n", '=>', $sData);
        $sData = str_replace("=> \n", '=>', $sData);
        ob_end_clean();

        return $sData;
    }

    /**
     * Mini OnScreen Debugger
     * @param string|array $mData
     * @return void
     */
    public static function info($mData = '')
    {
        // source
        $aBacktrace = self::prepareBacktraceArray(debug_backtrace());
        $mData = self::dump($mData);

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
    public static function display($mData = '')
    {
        static $sDisplay;
        static $iCount;

        $iCount++;

        // Source
        $aBacktrace = self::prepareBacktraceArray(debug_backtrace());
        $mData = self::dump($mData);

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

            $sDisplay .= $sConsultation . '<textarea style="font-size:10px;width:100% !important;min-height: 60px !important;margin:0 !important;background-color:blue !important;color:white !important;border: none !important;padding: 5px !important;font-family: monospace !important;">' . $mData . '</textarea>';

            // Display
            echo '<div class="draggable" style="overflow: auto !important;max-height: 90%;z-index:10000 !important;position:fixed !important;bottom:10px !important;right:10px !important;background-color:blue !important;color:white !important;border:1px solid #333 !important;width:500px !important;-moz-border-radius:3px !important; border-radius: 3px !important;font-size:12px !important;font-family: monospace !important;"><b>';
            echo $sDisplay;
            echo '</b></div>';
        }
    }

    /**
     * Stops any further execution: exits the script.
     * Shows a Message from where the STOP command was called (default).
     * @param       $mData
     * @param       $bShowWhereStop
     * @param       $bDump
     * @param array $aBacktrace
     * @return void
     * @throws \ReflectionException
     */
    public static function stop($mData = '', $bShowWhereStop = true, $bDump = true, array $aBacktrace = array())
    {
        static $iCount;
        $iCount++;

        // source
        (true === empty($aBacktrace)) ? $aBacktrace = self::prepareBacktraceArray(debug_backtrace()) : false;

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

        Event::run('mvc.debug.stop.after', DTArrayObject::create()
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('aBacktrace')
                ->set_sValue($aBacktrace))
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('mData')
                ->set_sValue($sEcho))
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('bOccurrence')
                ->set_sValue($bShowWhereStop)));

        (true === \MVC\Request::isCli()) ? \MVC\Config::get_MVC_MODULE_CURRENT_VIEW()::$bRender = false : false;
        exit ();
    }

    /**
     * prepares backtrace array for output
     * @access public
     * @static
     * @param array $aBacktrace
     * @return array
     */
    public static function prepareBacktraceArray(array $aBacktrace = array())
    {
        $aData = array();
        $aData['sFile'] = get($aBacktrace[0]['file'], '');
        $aData['sLine'] = get($aBacktrace[0]['line'], '');
        $aData['sClass'] = get($aBacktrace[1]['class'], '');
        $aData['sFunction'] = get($aBacktrace[1]['function'], '');

        return $aData;
    }

    /**
     * @param      $mData
     * @param bool $bReturn             default=false
     * @param bool $bShortArraySyntax   default=true
     * @return string|void
     */
    public static function varExport($mData, bool $bReturn = false, bool $bShortArraySyntax = true)
    {
        $sExport = var_export($mData, true);
        $sExport = preg_replace("/^([ ]*)(.*)/m", '$1$1$2', $sExport);
        $aData = preg_split("/\r\n|\n|\r/", $sExport);

        if ('array' === gettype($mData))
        {
            $sTokenLeft = (true === $bShortArraySyntax) ? '[' : 'array(';
            $sTokenRight = (true === $bShortArraySyntax) ? ']' : ')';
            $aData = preg_replace(["/\s*array\s\($/", "/\)(,)?$/", "/\s=>\s$/"], [
                null,
                $sTokenRight . '$1',
                ' => ' . $sTokenLeft,
            ], $aData);
            $sExport = join(PHP_EOL, array_filter([$sTokenLeft] + $aData));
        }

        if (true === $bReturn)
        {
            return (string) $sExport;
        }

        echo (string) $sExport;
    }
}