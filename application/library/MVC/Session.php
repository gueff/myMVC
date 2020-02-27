<?php
/**
 * Session.php
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
 * Session
 */
class Session
{

    /**
     * Session object provides storage for shared objects.
     *
     * @var \MVC\Session
     * @access private
     * @static
     */
    private static $oInstance = NULL;

    /**
     * Options
     *
     * @var array
     * @access private
     */
    private $_aOption = array ();

    /**
     * namespace
     *
     * @var string
     * @access private
     */
    private $_sNamespace;

    /**
     * @var bool
     */
    private $bSessionEnable = false;

    /**
     * Session constructor.
     * @param string $sNamespace
     * @throws \ReflectionException
     */
    protected function __construct ($sNamespace = '')
    {
        $this->setNamespace($sNamespace);
        $this->_aOption = Registry::get ('MVC_SESSION_OPTIONS');

        foreach ($this->_aOption as $sKey => $mValue)
        {
            ini_set ('session.' . $sKey, $mValue);
            Log::WRITE ('ini_set("session.' . $sKey . '", ' . $mValue . ');');
        }

        // Start a default Session, if no session was started before
        // AND
        // if MVC_SESSION_ENABLE is explicitely set to true
        if  (
            !session_id ()
            &&  (
                true === Registry::isRegistered('MVC_SESSION_ENABLE')
                &&  true === Registry::get('MVC_SESSION_ENABLE')
            )
        )
        {
            session_cache_limiter ('nocache');
            session_cache_expire (0);
            session_start ();
        }
    }

    /**
     * @param bool $bEnable
     * @return Session
     */
    public function enable($bEnable = true)
    {
        $this->bSessionEnable = $bEnable;

        return self::$oInstance;
    }

    /**
     * @deprecated gets killed next version; use create() instead
     * @param string $sNamespace
     * @return Session
     * @throws \ReflectionException
     */
    public static function getInstance ($sNamespace = '')
    {
        return self::is($sNamespace);
    }

    /**
     * @param string $sNamespace
     * @return Session
     * @throws \ReflectionException
     */
    public static function is ($sNamespace = '')
    {
        if (null === self::$oInstance)
        {
            self::$oInstance = new self ($sNamespace);
            return self::$oInstance;
        }

        self::$oInstance->setNamespace($sNamespace);

        return self::$oInstance;
    }

    /**
     * prevent any cloning
     *
     * @access private
     * @return void
     */
    private function __clone ()
    {
        ;
    }

    /**
     * sets namespace
     * @param string $sNamespace
     * @return Session
     * @throws \ReflectionException
     */
    public function setNamespace ($sNamespace = '')
    {
        ('' === $sNamespace)
            // fallback
            ? $sNamespace = ((true === Registry::isRegistered('MVC_SESSION_NAMESPACE')) ? Registry::get('MVC_SESSION_NAMESPACE') : 'myMVC')
            : false;

        $this->_sNamespace = $sNamespace;

        return self::$oInstance;
    }

    /**
     * gets the namespace
     *
     * @access public
     * @return string namespace
     */
    public function getNamespace ()
    {
        return $this->_sNamespace;
    }

    /**
     * sets a value by its key
     * @param $sKey
     * @param $mValue
     * @return Session
     */
    public function set ($sKey, $mValue)
    {
        $_SESSION[$this->_sNamespace][$sKey] = $mValue;

        return self::$oInstance;
    }

    /**
     * @param $sKey
     * @return bool
     */
    public function has ($sKey)
    {
        if (isset($_SESSION[$this->_sNamespace][$sKey]))
        {
            return true;
        }

        return false;
    }

    /**
     * gets a value by its key
     *
     * @access public
     * @param string $sKey
     * @return string value
     */
    public function get ($sKey)
    {
        if (!isset($_SESSION[$this->_sNamespace][$sKey]))
        {
            return '';
        }

        return $_SESSION[$this->_sNamespace][$sKey];
    }

    /**
     * gets session key/values on the current namespace
     *
     * @access public
     * @return array
     */
    public function getAll ()
    {
        return (isset($_SESSION[$this->_sNamespace])) ? $_SESSION[$this->_sNamespace] : array();
    }

    /**
     * kills current session
     * @return Session
     */
    public function kill ($bDeleteOldSession = true)
    {
        if (false === empty(session_id()))
        {
            session_regenerate_id ($bDeleteOldSession);
            session_destroy ();
            $_SESSION = NULL;
            unset ($_SESSION);
        }

        return self::$oInstance;
    }
}
