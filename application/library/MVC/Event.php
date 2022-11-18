<?php
/**
 * Event.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use MVC\DataType\DTArrayObject;

/**
 * @example
 * \MVC\Event::BIND('test', function() {\MVC\Debug::display('Hello from anonymous function');});
 * \MVC\Event::RUN ('test');
 * \MVC\Event::RUN ('test', array('some' => 'value'));
 * \MVC\Event::RUN ('test', $oObject);
 * \MVC\Event::RUN ('test', function(){...});
 * \MVC\Event::UNBIND ('test');
 */
class Event
{
    /**
     * contains the events
     * @var array
     */
    public static $aEvent = array();

    /**
     * contains packages relating to the event, optionally given by the event
     * @var array
     */
    public static $aPackage = array();

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function init()
    {
        \MVC\Event::RUN('mvc.event.init');

        //  require recursively all php files in module's routing dir
        /** @var \SplFileInfo $oSplFileInfo */
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(Config::get_MVC_MODULE_CURRENT_ETC_DIR() . '/event')) as $oSplFileInfo)
        {
            if ('php' === strtolower($oSplFileInfo->getExtension()))
            {
                require_once $oSplFileInfo->getPathname();
            }
        }
    }

    /**
     * bind multiple closures to multiple event at once via config array
     * @see /modules/{module}/etc/event/
     * @param array $aEvent
     * @return void
     * @throws \ReflectionException
     * @example  $aEvent = ['mvc.reflex.reflect.targetObject.before' => array(
     *              function(\MVC\DataType\DTArrayObject $oDTArrayObject) { // minify css/js files
     *                  \MVC\Minify::init();
     *              })];
     */
    public static function processBindConfigStack(array $aEvent = array())
    {
        foreach ($aEvent as $sEventName => $mData)
        {
            if (true === is_array($mData))
            {
                foreach ($mData as $oClosure)
                {
                    Event::bind($sEventName, $oClosure, null, debug_backtrace());
                }

                continue;
            }

            Event::bind($sEventName, $mData, null, debug_backtrace());
        }
    }

    /**
     * binds a callback closure to an event
     * @param string   $sEvent
     * @param \Closure $oClosure
     * @param          $oObject
     * @param array    $aDebug
     * @return void
     * @throws \ReflectionException
     */
    public static function bind(string $sEvent, \Closure $oClosure, $oObject = null, array $aDebug = array())
    {
        $sDebug = Log::prepareDebug(((true === empty($aDebug)) ? debug_backtrace() : $aDebug));

        if (!isset (self::$aEvent[$sEvent]))
        {
            self::$aEvent[$sEvent] = array();
        }

        Log::write('BIND (' . $sEvent . ', ' . Closure::dump($oClosure) . ')' . ' --> called in: ' . $sDebug);
        Event::addToRegistry('BIND', 'BIND (' . $sEvent . ', ' . Closure::dump($oClosure) . ')' . ' --> called in: ' . $sDebug);

        // add listener to event
        self::addListenerToEvent($sEvent, $oClosure, $oObject, $sDebug);
    }

    /**
     * @param string   $sEvent
     * @param \Closure $oClosure
     * @param          $oObject
     * @param string   $sDebug
     * @return void
     * @throws \ReflectionException
     */
    protected static function addListenerToEvent(string $sEvent, \Closure $oClosure, $oObject = null, string $sDebug = '')
    {
        // make $sSource a unique one
        $sDebug.= ' (' . uniqid() . ')';
        $sSource = serialize($sDebug);
        self::$aEvent[$sEvent][$sSource] = ($oObject === NULL)
            ? $oClosure
            : array($oObject, $oClosure)
        ;
    }

    /**
     * runs an event
     * @param $sEvent
     * @param null $mPackage
     * @return bool
     * @throws \ReflectionException
     */
    public static function run($sEvent, $mPackage = null)
    {
        if (null === $mPackage)
        {
            $mPackage = DTArrayObject::create();
        }

        $sDebug = Log::prepareDebug(debug_backtrace());
        $sPreLog = '(' . $sEvent . ') --> called in: ' . $sDebug;

        // nothing bonded
        if (!isset (self::$aEvent[$sEvent]))
        {
            // 'RUN  ' . $sPreLog
            return false;
        }

        $sPreLog = 'RUN+ ' . $sPreLog;

        Event::addToRegistry('RUN', $sPreLog);

        // iterate bonded
        foreach (self::$aEvent[$sEvent] as $sKey => $sCallback)
        {
            // run bonded closure
            if (true === filter_var(Closure::is($sCallback), FILTER_VALIDATE_BOOLEAN))
            {
                Log::write($sPreLog . ' --> bonded by `' . unserialize($sKey) . ', try to run its Closure: ' . Closure::toString($sCallback));

                // error occured
                if (call_user_func($sCallback, $mPackage) === false)
                {
                    Log::write("ERROR\t" . $sPreLog . ' *** Closure could not be run: ' . serialize($sCallback), 'error.log');
                }
            }
        }

        return true;
    }

    /**
     * unbinds (delete) one or all events
     * if this parameter not is set, *all* events are going to be deleted
     * @param $sEvent
     * @return bool
     * @throws \ReflectionException
     */
    public static function unbind($sEvent = '')
    {
        $sDebug = Log::prepareDebug(debug_backtrace());

        if (!isset (self::$aEvent[$sEvent]))
        {
            Event::addToRegistry('UNBIND', 'UNBIND: All Events deleted --> called in: ' . $sDebug);

            self::$aEvent = array();
            Log::write('UNBIND: All Events deleted --> called in: ' . $sDebug);

            return true;
        }

        Event::addToRegistry('UNBIND', 'UNBIND: Event `' . $sEvent . '` deleted --> called in: ' . $sDebug);
        self::$aEvent[$sEvent] = NULL;
        unset(self::$aEvent[$sEvent]);
        Log::write('UNBIND: Event `' . $sEvent . '` deleted --> called in: ' . $sDebug);

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
        $aMvcEvent = Config::get_MVC_EVENT();
        $aMvcEvent[$sKey][] = $sValue;
        Config::set_MVC_EVENT($aMvcEvent);
    }

    /**
     * @return array
     */
    public static function getEventArray()
    {
        return self::$aEvent;
    }

    /**
     * @deprecated use: Config::get_MVC_EVENT()
     * @return array
     * @throws \ReflectionException
     */
    public static function getEventReport()
    {
        $aEventReport = Config::get_MVC_EVENT();

        return $aEventReport;
    }
}