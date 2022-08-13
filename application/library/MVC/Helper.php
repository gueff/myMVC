<?php
/**
 * Helper.php
 * @package   myMVC
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <info@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;

/**
 * @deprecated
 * Helper
 */
class Helper
{
    /**
     * Mini OnScreen Debugger
     * @deprecated use Debug:info()
     * @param string|array $mData
     * @return void
     */
    public static function debug($mData = '')
    {
        Debug::info($mData);
    }

    /**
     * shows a smaller message on the screen right side.
     * if you call display more than once, all messages are showed among each other
     * use it to debug a string or array or whatever
     * @deprecated use Debug::display()
     * @access public
     * @static
     * @param mixed $mData
     * @return void
     */
    public static function display($mData = '')
    {
        Debug::display($mData);
    }

    /**
     * Stops any further execution: exits the script.
     * Shows a Message from where the STOP command was called (default).
     * @deprecated use Debug::stop()
     * @param mixed $mData          default=''
     * @param bool  $bShowWhereStop default=true
     * @param bool  $bDump          default=true
     * @throws \ReflectionException
     */
    public static function stop($mData = '', $bShowWhereStop = true, $bDump = true)
    {
        Debug::stop($mData, $bShowWhereStop, $bDump);

        /*
         * @todo doku: mvc.helper.stop.after => mvc.debug.stop.after
         */
//        Event::run('mvc.helper.stop.after', DTArrayObject::create()
//            ->add_aKeyValue(DTKeyValue::create()
//                ->set_sKey('aBacktrace')
//                ->set_sValue($aBacktrace))
//            ->add_aKeyValue(DTKeyValue::create()
//                ->set_sKey('mData')
//                ->set_sValue($sEcho))
//            ->add_aKeyValue(DTKeyValue::create()
//                ->set_sKey('bOccurrence')
//                ->set_sValue($bShowWhereStop)));

        exit ();
    }

    /**
     * checks whether the unknown parameter is a closure object
     * @deprecated use Closure::is()
     * @access public
     * @static
     * @param mixed $mUnknown
     * @return boolean
     */
    public static function isClosure($mUnknown)
    {
        return Closure::is($mUnknown);
    }

    /**
     * Dumps a Closure
     * @deprecated use Closure::dump()
     * @access public
     * @static
     * @param mixed $mClosure name of function or Closure
     * @return string
     * @throws \ReflectionException
     */
    public static function closureDump($mClosure)
    {
        return Closure::dump($mClosure);
    }

    /**
     * gets the http uri protocol
     * @deprecated use Request::getUriProtocol()
     * @param null $mSsl
     * @return string
     * @throws \ReflectionException
     */
    public static function getUriProtocol($mSsl = null)
    {
        return Request::getUriProtocol();
    }

    /**
     * check page is running in ssl mode
     * @deprecated use: Request::detectSsl()
     * @return bool|mixed
     * @throws \ReflectionException
     */
    public static function detectSsl()
    {
        return Request::detectSsl();
    }

    /**
     * makes sure the requested page will be delivered with the correct protocol (http|https)
     * @deprecated use: Request::ensureCorrectProtocol();
     * @return void
     * @throws \ReflectionException
     */
    public static function ensureCorrectProtocol()
    {
        Request::ensureCorrectProtocol();
    }

    /**
     * prepares backtrace array for output
     * @deprecated use Debug::prepareBacktraceArray()
     * @access public
     * @static
     * @param array $aBacktrace
     * @return array
     */
    public static function prepareBacktraceArray(array $aBacktrace = array())
    {
        return Debug::prepareBacktraceArray($aBacktrace);
    }

    /**
     * @deprecated use Debug::varExport($mData, $bReturn, $bShortArraySyntax);
     * @param mixed $mData
     * @param bool  $bReturn           default=false
     * @param bool  $bShortArraySyntax default=true
     * @return mixed
     */
    public static function varExport($mData, $bReturn = false, $bShortArraySyntax = true)
    {
        echo Debug::varExport($mData, $bReturn, $bShortArraySyntax);
    }

    /**
     * converts an object into array
     * @deprecated use Convert::objectToArray()
     * @param mixed $mObject
     * @return array
     */
    public static function convertObjectToArray($mObject)
    {
        return Convert::objectToArray($mObject);
    }

    /**
     * removes doubleDot+Slashes (../) from string
     * replaces multiple forwardSlashes (//) from string by a single forwardSlash
     * @deprecated use File::secureFilePath()
     * @param string $sAbsoluteFilePath
     * @param bool   $bIgnoreProtocols default=false; on true leaves :// as it is
     * @return string
     */
    public static function secureFilePath($sAbsoluteFilePath = '', $bIgnoreProtocols = false)
    {
        return File::secureFilePath($sAbsoluteFilePath, $bIgnoreProtocols);
    }

    /**
     * removes doubleDot+Slashes (../) from string
     * @deprecated use Strings::removeDoubleDotSlashesFromString()
     * @param string $sString
     * @return string
     */
    public static function removeDoubleDotSlashesFromString($sString = '')
    {
        return Strings::removeDoubleDotSlashesFromString($sString);
    }

    /**
     * replaces multiple forwardSlashes (//) from string by a single forwardSlash
     * @deprecated use Strings::replaceMultipleForwardSlashesByOneFromString()
     * @param string $sString
     * @param bool   $bIgnoreProtocols default=false; on true leaves :// as it is
     * @return string
     */
    public static function replaceMultipleForwardSlashesByOneFromString($sString = '', $bIgnoreProtocols = false)
    {
        return Strings::replaceMultipleForwardSlashesByOneFromString($sString, $bIgnoreProtocols);
    }
}
