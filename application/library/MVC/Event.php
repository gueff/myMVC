<?php
/**
 * Event.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use MVC\DataType\DTArrayObject;

/**
 * @example
 * \MVC\Event::bind('test', function() {\MVC\Debug::display('Hello from anonymous function');});
 * \MVC\Event::run('test');
 * \MVC\Event::run('test', array('some' => 'value'));
 * \MVC\Event::run('test', $oObject);
 * \MVC\Event::run('test', function(){...});
 * \MVC\Event::delete('test');
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
        $sEventDir = Config::get_MVC_MODULE_CURRENT_ETC_DIR() . '/event';

        if (false === file_exists($sEventDir))
        {
            return false;
        }

        //  require recursively all php files in module's routing dir
        /** @var \SplFileInfo $oSplFileInfo */
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($sEventDir)) as $oSplFileInfo)
        {
            if ('php' === strtolower($oSplFileInfo->getExtension()))
            {
                require_once $oSplFileInfo->getPathname();
            }
        }

        \MVC\Event::RUN('mvc.event.init.after');

        return true;
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

        Log::write(
            'BIND (' . $sEvent . ', ' . Closure::dump($oClosure) . ')' . ' --> called in: ' . $sDebug,
            Config::get_MVC_LOG_FILE_EVENT(),
            false
        );
        Event::addToRegistry('BIND', 'BIND (' . $sEvent . ', ' . Closure::dump($oClosure) . ')' . ' --> called in: ' . $sDebug);

        // add listener to event
        self::addListenerToEvent($sEvent, $oClosure, $oObject, $sDebug);
    }

    /**
     * binds a callback closure to an event
     * @notice alternative writing to Event::bind()
     * @param string   $sEvent
     * @param \Closure $oClosure
     * @param          $oObject
     * @param array    $aDebug
     * @return void
     * @throws \ReflectionException
     */
    public static function listen(string $sEvent, \Closure $oClosure, $oObject = null, array $aDebug = array())
    {
        self::bind($sEvent, $oClosure, $oObject, $aDebug);
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
                Log::write(
                    $sPreLog . ' --> bonded by `' . unserialize($sKey) . ', try to run its Closure: ' . Closure::toString($sCallback),
                    Config::get_MVC_LOG_FILE_EVENT(),
                    false
                );

                // error occured
                if (call_user_func($sCallback, $mPackage) === false)
                {
                    Log::write(
                        "ERROR\t" . $sPreLog . ' *** Closure could not be run: ' . serialize($sCallback),
                        Config::get_MVC_LOG_FILE_ERROR(),
                        false
                    );
                }
            }
        }

        return true;
    }

    /**
     * unbinds (delete) one or all events
     * if this parameter not is set, *all* events are going to be deleted
     * @param $sEvent
     * @return true
     * @throws \ReflectionException
     */
    public static function delete($sEvent = '')
    {
        $sDebug = Log::prepareDebug(debug_backtrace());

        // delete all
        if (true === empty($sEvent))
        {
            Event::addToRegistry('UNBIND', 'UNBIND: All Events deleted --> called in: ' . $sDebug);

            self::$aEvent = array();
            Log::write(
                'UNBIND: All Events deleted --> called in: ' . $sDebug,
                Config::get_MVC_LOG_FILE_EVENT(),
                false
            );

            return true;
        }

        // key unknown
        if (false === isset(self::$aEvent[$sEvent]))
        {
            Error::error('UNBIND: Failed due to unknown event `' . $sEvent . '` --> called in: ' . $sDebug);

            return false;
        }

        Event::addToRegistry('UNBIND', 'UNBIND: Event `' . $sEvent . '` deleted --> called in: ' . $sDebug);
        self::$aEvent[$sEvent] = NULL;
        unset(self::$aEvent[$sEvent]);

        Log::write(
            'UNBIND: Event `' . $sEvent . '` deleted --> called in: ' . $sDebug,
            Config::get_MVC_LOG_FILE_EVENT(),
            false
        );

        return true;
    }

    /**
     * adds a key/value pair to registry
     * @param $sKey
     * @param $sValue
     * @return void
     * @throws \ReflectionException
     */
    public static function addToRegistry($sKey, $sValue)
    {
        $aMvcEvent = Config::get_MVC_EVENT();
        $aMvcEvent[$sKey][] = $sValue;
        Config::set_MVC_EVENT($aMvcEvent);
    }

    /**
     * @deprecated use instead: \MVC\Event::get
     * @return array
     */
    public static function getEventArray()
    {
        return self::$aEvent;
    }

    /**
     * returns array with Listeners of all Events (default), or of the certain event $sEvent
     * @param string $sEvent
     * @return array
     */
    public static function get(string $sEvent = '')
    {
        if (true === empty($sEvent))
        {
            return self::$aEvent;
        }

        return (array) get(self::$aEvent[$sEvent], array());
    }
}