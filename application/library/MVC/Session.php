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
	private static $_oSession = NULL;

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
	 * Constructor
	 * 
	 * @access protected
	 * @return void
	 */
	protected function __construct ()
	{
		$this->_sNamespace = Registry::get('MVC_SESSION_NAMESPACE');
		$this->_aOption = Registry::get ('MVC_SESSION_OPTIONS');
		
		foreach ($this->_aOption as $sKey => $mValue)
		{
			ini_set ('session.' . $sKey, $mValue);
			Log::WRITE ('ini_set("session.' . $sKey . '", ' . $mValue . ');');
		}

		session_start ();
		session_cache_limiter ('nocache');
		session_cache_expire (0);

		$this->setNamespace ();
	}

	/**
	 * Singleton instance
	 *
	 * @access public
	 * @static
	 * @return \MVC\Session
	 */
	public static function getInstance ()
	{
		if (null === self::$_oSession)
		{
			self::$_oSession = new self ();
		}

		return self::$_oSession;
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
	 * 
	 * @access private
	 * @param string $sNamespace | default=myMVC
	 * @return void
	 */
	private function setNamespace ($sNamespace = 'myMVC')
	{
		if ('' !== $sNamespace)
		{
			$this->_sNamespace = $sNamespace;
		}

		if (!array_key_exists($this->_sNamespace, $_SESSION))
		{
			$_SESSION[$this->_sNamespace] = NULL;
		}
	}

	/**
	 * gets the namescpace
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
	 * 
	 * @access public
	 * @param string $sKey
	 * @param mixed $mValue
	 * @return void
	 */
	public function set ($sKey, $mValue)
	{
		$_SESSION[$this->_sNamespace][$sKey] = $mValue;
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
		if (!array_key_exists ($sKey, $_SESSION[$this->_sNamespace]))
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
		return $_SESSION[$this->_sNamespace];
	}

	/**
	 * kills current session
	 * 
	 * @access public
	 * @return void
	 */
	public function kill ()
	{
		session_regenerate_id ();
		session_destroy ();
		$_SESSION = NULL;
		unset ($_SESSION);
	}
}
