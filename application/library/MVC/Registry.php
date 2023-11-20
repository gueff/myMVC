<?php
/**
 * Registry.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
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

	protected function __construct()
	{
		;
	}

	/**
	 * Singleton instance
	 * @return \MVC\Registry
	 */
	public static function getInstance() : Registry
	{
		if (null === self::$_oRegistry)
		{
			self::$_oRegistry = new self ();
		}

		return self::$_oRegistry;
	}

	/**
	 * prevent any cloning
     * @return void
     */
	private function __clone() : void
	{
		;
	}

	/**
	 * Unset the default registry instance.
	 * Primarily used in tearDown() in unit tests.
	 * @return void
	 */
	public static function _unsetInstance() : void
	{
		self::$_oRegistry = null;
	}

	/**
	 * gets a value by its key
     * @param string $sIndex
     * @return mixed
     * @throws \ReflectionException
     */
	public static function get(string $sIndex = '') : mixed
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

		return get(self::$_aStorage[$sIndex]);
	}

    /**
     * gets a value by its key and deletes the entry afterwards
     * @param string $sIndex
     * @return mixed
     * @throws \ReflectionException
     */
    public static function take(string $sIndex = '') : mixed
    {
        $mValue = self::get($sIndex);
        self::delete($sIndex);

        return $mValue;
    }

	/**
	 * saves a key/value pair to registry storage
     * @param string $sIndex index of storage
     * @param mixed  $mValue value to be set
     * @return void
     */
	public static function set(string $sIndex = '', mixed $mValue = null) : void
	{
		self::$_aStorage[$sIndex] = $mValue;
	}

    /**
     * @param string $sIndex
     * @return bool
     */
    public static function delete(string $sIndex = '') : bool
    {
        if (false === self::isRegistered($sIndex))
        {
            return false;
        }

        self::$_aStorage[$sIndex] = null;
        unset(self::$_aStorage[$sIndex]);

        return true;
    }

	/**
	 * gets the storage array
     * @return array
     */
	public static function getStorageArray() : array
	{
		return self::$_aStorage;
	}
	
	/**
	 * Returns true if the $index is a named value in the registry,
	 * or FALSE if $index was not found in the registry.
     * @param string $sIndex
     * @return bool
     */
	public static function isRegistered(string $sIndex = '') : bool
	{
		if (null === self::getInstance())
		{
			return false;
		}

		return array_key_exists($sIndex, self::$_aStorage);
	}
}