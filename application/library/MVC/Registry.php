<?php
/**
 * Registry.php
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
 * Registry
 */
class Registry
{

	/**
	 * Class name of the singleton registry object.
	 * 
	 * @var string default='MVC_Registry'
	 * @access private
	 * @static
	 */
	private static $_sRegistryClassName = 'MVC_Registry';

	/**
	 * Registry object provides storage for shared objects.
	 * 
	 * @var \MVC\Registry
	 * @access private
	 * @static
	 */
	private static $_oRegistry = NULL;

	/**
	 * Storage
	 * 
	 * @var array
	 * @access private
	 * @static
	 */
	private static $_aStorage = array();


	/**
	 * Constructor
	 * 
	 * @access protected
	 * @return void
	 */
	protected function __construct ()
	{
		;
	}

	/**
	 * Singleton instance
	 *
	 * @access public
	 * @static
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
	 * 
	 * @access private
	 * @return void
	 */
	private function __clone ()
	{
		
	}

	/**
	 * Unset the default registry instance.
	 * Primarily used in tearDown() in unit tests.
	 * 
	 * @access public
	 * @return void
	 */
	public static function _unsetInstance ()
	{
		self::$_oRegistry = null;
	}

	/**
	 * gets a value by its key
	 *
	 * @access public
	 * @static
	 * @param string $sIndex - get the value associated with $index
	 * @return mixed
	 */
	public static function get ($sIndex)
	{
		if (!array_key_exists ($sIndex, self::$_aStorage))
		{
			$sMsg = "No entry is registered for key '$sIndex'";
			Helper::STOP ($sMsg);
		}

		return self::$_aStorage[$sIndex];
	}

	/**
	 * saves a key/value pair to registry storage
	 *
	 * @access public
	 * @static
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
	 *
	 * @access public
	 * @static
	 * @return array $_aStorage
	 */
	public static function getStorageArray ()
	{
		return self::$_aStorage;
	}
	
	/**
	 * Returns true if the $index is a named value in the registry,
	 * or FALSE if $index was not found in the registry.
	 *
	 * @access public
	 * @static
	 * @param  string $sIndex
	 * @return boolean success
	 */
	public static function isRegistered ($sIndex)
	{
		if (NULL === self::getInstance ())
		{
			return FALSE;
		}

		return array_key_exists ($sIndex, self::$_aStorage);
	}
}
