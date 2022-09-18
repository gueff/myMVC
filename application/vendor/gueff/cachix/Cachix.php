<?php

/**
 * Cachix.php
 * 
 * @requiere Linux commands `rm`, `find` and `grep` to be executable via shell_exec
 * @example
 * 
 * // init Config
 * \Cachix::init(array(
 *		'bCaching' => true,
 *		'sCacheDir' => '/tmp/',
 *		'iDeleteAfterMinutes' => 10,
 *		'sBinRemove' => '/bin/rm',
 *		'sBinFind' => '/usr/bin/find',
 *		'sBinGrep' => '/bin/grep'
 * ));
 * 
 * // Data to be cached
 * $aData = ['foo' => 'bar'];
 * 
 * // build a Cache-Key
 * $sKey = 'myCacheKey.whatever';
 * 
 * // autodelete cachefiles
 * // which contain the string ".whatever" in key-name
 * \Cachix::autoDeleteCache('.whatever');
 * 
 * // first time saving data to cache...
 * if (empty(\Cachix::getCache($sKey)))
 * {
 *		\Cachix::saveCache(
 *			$sKey, 
 *			$aData
 *		);
 * }
 * // ...or read from existing Cache
 * else 
 * {
 *		$aData = \Cachix::getCache($sKey);
 * }  
 * 
 * @package Cachix
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */


/**
 * Cachix
 */
class Cachix
{    
	/**
	 * caching true/false; default=true
	 * @access public
	 * @static
	 * @var boolean
	 */
    public static $bCaching;
    
    /**
     * delete cache files when this vaue is reached
	 * @access public
	 * @static
     * @var integer
     */
    public static $iDeleteAfterMinutes; 

	/**
	 * absolute path to cache dir
	 * @access public
	 * @static
	 * @var string
	 */
    public static $sCacheDir;
	
	/**
	 * linux binary `rm'
	 * @access public
	 * @static
	 * @var string
	 */
	public static $sBinRemove;
	
	/**
	 * linux binary `find'
	 * @access public
	 * @static
	 * @var string
	 */
	public static $sBinFind;
	
	/**
	 * linux binary `grep'
	 * @access public
	 * @static
	 * @var string
	 */
	public static $sBinGrep;
	
	/**
	 * sets configuration; if none is given by param, defaults are set
	 * 
	 * @access public
	 * @static
	 * @param array $aConfig array(
	 *		'bCaching' => true, 
	 *		'sCacheDir' => '/tmp/', 
	 *		'iDeleteAfterMinutes' => 1440,
	 *		'sBinRemove' => '/bin/rm',
	 * 		'sBinFind' => '/usr/bin/find',
	 * 		'sBinGrep' => '/bin/grep',
	 * )
	 * @return void 
	 */
	public static function init(array $aConfig = array())
	{
		(is_null(self::$bCaching)) ? (self::$bCaching						= (isset($aConfig['bCaching']))				? $aConfig['bCaching']				: true)					: false;
		(is_null(self::$sCacheDir)) ? (self::$sCacheDir						= (isset($aConfig['sCacheDir']))			? $aConfig['sCacheDir']				: sys_get_temp_dir())	: false;
		(is_null(self::$iDeleteAfterMinutes)) ? (self::$iDeleteAfterMinutes	= (isset($aConfig['iDeleteAfterMinutes']))	? $aConfig['iDeleteAfterMinutes']	: 1440)					: false;	// 1440min === 1 day
		(is_null(self::$sBinRemove)) ? (self::$sBinRemove					= (isset($aConfig['sBinRemove']))			? $aConfig['sBinRemove']			: '/bin/rm')			: false;
		(is_null(self::$sBinFind)) ? (self::$sBinFind						= (isset($aConfig['sBinFind']))				? $aConfig['sBinFind']				: '/usr/bin/find')		: false;
		(is_null(self::$sBinGrep)) ? (self::$sBinGrep						= (isset($aConfig['sBinGrep']))				? $aConfig['sBinGrep']				: '/bin/grep')			: false;
	}

	/**
     * gets data from cache by key
     * 
	 * @access public
	 * @static
     * @param type $sKey
     * @return string $sContent content of requested | empty on fail
     */
    public static function getCache(string $sKey = '')
    {
		self::init();

        if (false === self::$bCaching || '' === $sKey)
        {
            return '';
        }

        $sFilename = self::$sCacheDir . '/' . $sKey;
        $sContent = '';

        if (file_exists($sFilename))
        {
            $sContent = unserialize(
				base64_decode(
					file_get_contents($sFilename)
				)
			);     
        }
        
        return $sContent;
    }

    /**
     * saves data into cache on key
     * 
	 * @access public
	 * @static
     * @param string $sKey
     * @param boolean success
	 * @return boolean success
     */
    public static function saveCache(string $sKey, $mData) : bool
    {
		self::init();
		
        if (false === self::$bCaching)
        {
            return false;
        }
        
        $sFilename = self::$sCacheDir . '/' . $sKey;
        $mData = base64_encode(
			serialize($mData)
		);
		
		if (!is_dir ($sFilename))
		{
			(is_file($sFilename) && file_exists($sFilename)) ? unlink($sFilename) : false;

			if (false === file_put_contents($sFilename, $mData, LOCK_EX))
			{
				return false;
			}
		}
        
        return true;
    }
    
    /**
     * deletes cachefiles after certain time
	 * 
     * @requiere Linux commands `rm`, `find` and `grep` executable via shell_exec
	 * @access public
	 * @static
     * @param string $sToken optional; default='' (all cachefiles)
     * @param string $sMinutes optional; default=self::$iDeleteAfterMinutes
     * @return boolean success
     */
    public static function autoDeleteCache(string $sToken = '', string $sMinutes = null) : bool
    {
		self::init();
		
        if (false === self::$bCaching)
        {
            return false;
        }
        
        if (null === $sMinutes)
        {
            $sMinutes = self::$iDeleteAfterMinutes;
        }
        
        $sCmd = self::$sBinFind . ' ' . self::$sCacheDir . ' -type f -mmin +' . $sMinutes; 
        ('' !== $sToken) ? $sCmd.= ' | ' . self::$sBinGrep . ' "' . $sToken . '"' : false;
        $mFind = trim(shell_exec($sCmd));

		if (!is_null($mFind) && !empty($mFind))
		{
		    $aLine = explode("\n", $mFind);

		    foreach ($aLine as $sLine)
            {
                $sCmd = self::$sBinRemove . ' "' . $sLine . '"';
                $mRemove = shell_exec($sCmd);
            }

			return (boolean) $mRemove;
		}
		
		return (boolean) $mFind;
    }
	
    
    /**
     * fushes cache (deletes all cachefiles immediatly)
     * 
     * @requiere Linux command `rm` executable via shell_exec
	 * @access public
	 * @static
     * @return boolean success
     */
    public static function flushCache() : bool
    {
		self::init();
		
        if (false === self::$bCaching)
        {
            return false;
        }
        
        $sCmd = self::$sBinRemove . ' -rf ' . self::$sCacheDir . '/*';        
        $mResult = shell_exec($sCmd);
		
		return (boolean) $mResult;
    }	
}
