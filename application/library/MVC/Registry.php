<?php
/**
 * Registry.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
 */

namespace MVC;

/**
 * Registry
 */
class Registry
{
	/**
	 * Registry object provides storage for shared objects.
	 * @var \MVC\Registry
	 */
    protected static $_oRegistry = null;

	/**
	 * Storage
	 * @var array
	 */
    protected static $_aStorage = array();

	/**
	 * Constructor
	 * @return void
	 */
	protected function __construct ()
	{
		;
	}

	/**
	 * Singleton instance
	 * @return \MVC\Registry
	 */
	public static function getInstance ()
	{
		if (null === self::$_oRegistry)
		{
			self::$_oRegistry = new self ();
		}

		return self::$_oRegistry;
	}

	/**
	 *  prevent any cloning
	 * @return void
	 */
	private function __clone ()
	{
		;
	}

	/**
	 * Unset the default registry instance.
	 * Primarily used in tearDown() in unit tests.
	 * @return void
	 */
	public static function _unsetInstance ()
	{
		self::$_oRegistry = null;
	}

	/**
	 * gets a value by its key
     * @param $sIndex
     * @return mixed
     * @throws \ReflectionException
     */
	public static function get ($sIndex)
	{
		if (!array_key_exists ($sIndex, self::$_aStorage))
		{
            $aDebug = debug_backtrace();
            $sMsg = "Registry Key unknown. No entry is registered for key '$sIndex'."
                . ' ' . $aDebug[0]['file']
                . ', ' . $aDebug[0]['line']
            ;

            Error::exception(new \ErrorException ($sMsg, 0, E_USER_ERROR, __FILE__, __LINE__));
		}

		return self::$_aStorage[$sIndex];
	}

	/**
	 * saves a key/value pair to registry storage
	 * @param string $sIndex Index of the Storage
	 * @param mixed $mValue The Value ti be set
	 * @return void
	 */
	public static function set ($sIndex, $mValue)
	{
		self::$_aStorage[$sIndex] = $mValue;
	}

	/**
	 * gets the storage array
     * @return array
     */
	public static function getStorageArray ()
	{
		return self::$_aStorage;
	}
	
	/**
	 * Returns true if the $index is a named value in the registry,
	 * or FALSE if $index was not found in the registry.
     * @param $sIndex
     * @return bool
     */
	public static function isRegistered ($sIndex)
	{
		if (null === self::getInstance())
		{
			return false;
		}

		return array_key_exists ($sIndex, self::$_aStorage);
	}
}