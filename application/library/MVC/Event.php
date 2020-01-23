<?php
/**
 * Event.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVC
 */

namespace MVC;

/**
 * Description of Event (influenced by http://www.php.net/manual/en/functions.anonymous.php#96579)
 *
 * Usage Exmaples<br />
 *
 * \MVC\Event::BIND('test', function() {\MVC\Helper::DISPLAY('Hello from anonymous function');});<br />
 *
 * \MVC\Event::RUN ('test');<br />
 * \MVC\Event::RUN ('test', array('some' => 'value'));<br />
 * \MVC\Event::RUN ('test', $oObject);<br />
 * \MVC\Event::RUN ('test', function(){...});<br />
 *
 * \MVC\Event::UNBIND ('test');
 */
class Event
{

    /**
     * contains the events
     *
     * @access public
     * @static
     * @var array
     */
    public static $aEvent = array();

    /**
     * contains packages relating to the event, optionally given by the event
     *
     * @access public
     * @static
     * @var array
     */
    public static $aPackage = array();

    /**
     * binds a callback closure to a an event
     * @param $sEvent
     * @param \Closure $oClosure
     * @param null $oObject
     * @throws \ReflectionException
     */
    public static function BIND($sEvent, \Closure $oClosure, $oObject = NULL)
    {
        $aBacktrace = debug_backtrace();
        $sDebug = '';
        (isset ($aBacktrace[0]['file'])) ? $sDebug .= $aBacktrace[0]['file'] : FALSE;
        (isset ($aBacktrace[0]['line'])) ? $sDebug .= ', ' . $aBacktrace[0]['line'] : FALSE;
        $sDebug.= ' (' . uniqid() . ') ';
        (isset ($aBacktrace[0]['class'])) ? $sDebug .= ' > ' : FALSE;

        if (!isset (self::$aEvent[$sEvent]))
        {
            self::$aEvent[$sEvent] = array();
        }

        Log::WRITE('BIND (' . $sEvent . ', ' . Helper::CLOSUREDUMP($oClosure) . ')' . ' --> called in: ' . $sDebug);
        Event::addToRegistry('BIND', 'BIND (' . $sEvent . ', ' . Helper::CLOSUREDUMP($oClosure) . ')' . ' --> called in: ' . $sDebug);

        // add listener to the event
        self::$aEvent[$sEvent][serialize($sDebug)] = ($oObject === NULL) ? $oClosure : array($oObject, $oClosure);
    }

    /**
     * runs an event
     * @param $sEvent
     * @param null $mPackage
     * @return bool
     * @throws \ReflectionException
     */
    public static function RUN($sEvent, $mPackage = NULL)
    {
        $aBacktrace = debug_backtrace();
        $sDebug = '';
        (isset ($aBacktrace[0]['file'])) ? $sDebug .= $aBacktrace[0]['file'] : FALSE;
        (isset ($aBacktrace[0]['line'])) ? $sDebug .= ', ' . $aBacktrace[0]['line'] : FALSE;
        (isset ($aBacktrace[0]['class'])) ? $sDebug .= ' > ' : FALSE;

        $sPreLog = '(' . $sEvent . ') --> called in: ' . $sDebug;

        // nothing bonded
        if (!isset (self::$aEvent[$sEvent]))
        {
            Log::WRITE('RUN  ' . $sPreLog);
            return FALSE;
        }

        $sPreLog = 'RUN+ ' . $sPreLog;

        Event::addToRegistry('RUN', $sPreLog);

        // iterate bonded
        foreach (self::$aEvent[$sEvent] as $sKey => $sCallback)
        {
            // run bonded closure
            if (true === filter_var(Helper::ISCLOSURE($sCallback), FILTER_VALIDATE_BOOLEAN))
            {
                Log::WRITE($sPreLog . ' --> bonded by `' . unserialize($sKey) . ', try to run its Closure: ' . Helper::CLOSUREDUMP($sCallback));

                // error occured
                if (call_user_func($sCallback, $mPackage) === FALSE)
                {
                    Log::WRITE("ERROR\t" . $sPreLog . ' *** Closure could not be run: ' . serialize($sCallback), 'error.log');
                    #break; // leave the looop at 1st bound
                }
            }
        }

        return true;
    }

    /**
     * unbinds (delete) one or all events
     *
     * @access public
     * @static
     * @param string $sEvent eventname<br />
     * deletes the given event.<br />
     * if this parameter not is set, *all* events are going to be deleted
     *
     * @return boolean success
     */
    public static function UNBIND($sEvent = '')
    {
        $aBacktrace = debug_backtrace();
        $sDebug = '';
        (isset ($aBacktrace[0]['file'])) ? $sDebug .= $aBacktrace[0]['file'] : FALSE;
        (isset ($aBacktrace[0]['line'])) ? $sDebug .= ', ' . $aBacktrace[0]['line'] : FALSE;
        (isset ($aBacktrace[0]['class'])) ? $sDebug .= ' > ' : FALSE;

        if (!isset (self::$aEvent[$sEvent]))
        {
            Event::addToRegistry('UNBIND', 'UNBIND: All Events deleted --> called in: ' . $sDebug);

            self::$aEvent = array();
            Log::WRITE('UNBIND: All Events deleted --> called in: ' . $sDebug);

            return true;
        }

        Event::addToRegistry('UNBIND', 'UNBIND: Event `' . $sEvent . '` deleted --> called in: ' . $sDebug);

        self::$aEvent[$sEvent] = NULL;
        unset(self::$aEvent[$sEvent]);
        Log::WRITE('UNBIND: Event `' . $sEvent . '` deleted --> called in: ' . $sDebug);

        return true;
    }

    /**
     * adds a key/value pair to registry
     * @param $sKey
     * @param $sValue
     * @throws \ReflectionException
     */
    public static function addToRegistry($sKey, $sValue)
    {
        (!Registry::isRegistered('MVC_EVENT')) ? Registry::set('MVC_EVENT', array()) : FALSE;
        $aMvcEvent = Registry::get('MVC_EVENT');
        $aMvcEvent[$sKey][] = $sValue;
        Registry::set('MVC_EVENT', $aMvcEvent);
    }
}
