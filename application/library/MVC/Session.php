<?php
/**
 * Session.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

/**
 * Session
 */
class Session
{
    /**
     * Session object provides storage for shared objects.
     * @var \MVC\Session
     */
    protected static $_oInstance = NULL;

    /**
     * Options
     * @var array
     */
    protected $_aOption = array ();

    /**
     * namespace
     * @var string
     */
    protected $_sNamespace;

    /**
     * @var bool
     */
    protected $_bSessionEnable = false;

    /**
     * Session constructor.
     * @param string $sNamespace
     * @throws \ReflectionException
     */
    protected function __construct ($sNamespace = '')
    {
        $this->setNamespace($sNamespace);
        $this->_aOption = Config::get_MVC_SESSION_OPTIONS();

        foreach ($this->_aOption as $sKey => $mValue)
        {
            ini_set ('session.' . $sKey, $mValue);
            Log::write ('ini_set("session.' . $sKey . '", ' . $mValue . ');');
        }

        // Start a default Session, if no session was started before
        // AND
        // if MVC_SESSION_ENABLE is explicitely set to true
        if  (
            !session_id ()
            &&  (true === Config::get_MVC_SESSION_ENABLE())
        )
        {
            session_cache_limiter ('nocache');
            session_cache_expire (0);
            session_start ();
        }
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public static function getSessionEnable()
    {
        return Config::get_MVC_SESSION_ENABLE();
    }

    /**
     * @deprecated use: Config::set_MVC_SESSION_ENABLE();
     * @param $bEnable
     * @return void
     */
    public static function setSessionEnable($bEnable = true)
    {
        Config::set_MVC_SESSION_ENABLE($bEnable);
    }

    /**
     * @param bool $bEnable
     * @return Session
     */
    public function enable($bEnable = true)
    {
        $this->_bSessionEnable = $bEnable;
        Config::set_MVC_SESSION_ENABLE($bEnable);

        return self::$_oInstance;
    }

    /**
     * @deprecated use: Session:is()
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
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self ($sNamespace);
        }
        else
        {
            self::$_oInstance->setNamespace($sNamespace);
        }

        // copy Session Object to registry
        Config::set_MVC_SESSION(self::$_oInstance);

        return self::$_oInstance;
    }

    /**
     * @deprecated use: Config::set_MVC_SESSION();
     * @param \MVC\Session $oSession
     * @return void
     */
    public static function saveToRegistry(Session $oSession)
    {
        Config::set_MVC_SESSION($oSession);
    }

    /**
     * prevent any cloning
     * @return void
     */
    protected function __clone ()
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
            ? $sNamespace = Config::get_MVC_SESSION_NAMESPACE()
            : false;

        $this->_sNamespace = $sNamespace;

        return self::$_oInstance;
    }

    /**
     * gets the namespace
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

        return self::$_oInstance;
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
     * @return string
     */
    public function getSessionId()
    {
        $sSessionId = session_id();

        if (false === is_string($sSessionId) || true === empty($sSessionId))
        {
            return '';
        }

        return session_id();
    }

    /**
     * gets session key/values on the current namespace
     * @return array|mixed
     */
    public function getAll ()
    {
        $aData = (isset($_SESSION[$this->_sNamespace]))
            ? $_SESSION[$this->_sNamespace]
            : array()
        ;

        return $aData;
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
            self::$_oInstance = null;
            $_SESSION = NULL;
            unset ($_SESSION);
        }

        return self::$_oInstance;
    }

    /**
     * @deprecated use: Config::get_MVC_SESSION_PATH();
     * @return string
     * @throws \ReflectionException
     */
    public static function getSessionPath()
    {
        return Config::get_MVC_SESSION_PATH();
    }
}