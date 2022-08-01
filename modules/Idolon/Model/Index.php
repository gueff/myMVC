<?php

/**
 * Index.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $IdolonModel
 */
namespace Idolon\Model;


use MVC\Helper;

/**
 * Index
 * @extends \Idolon
 */
class Index extends \Idolon
{
	/**
	 * @access private
	 * @var string
	 */
	private $_sIdolonToken = 'image';
	
	/**
	 * @access private
	 * @var array
	 */
	private $_aRequestValue = [];
	
	/**
	 * @access private
	 * @var integer
	 */
	private $_iMaxCacheFiles = 10;
	
	/**
     * Index constructor.
     * @param array $aConfig
     */
	public function __construct(array $aConfig = array())
	{
		parent::__construct($aConfig);
	}
	
    /**
     * @return bool
     * @throws \ReflectionException
     */
	public function run()
	{
	    $this->createCachePath();
		$this->getValuesFromRequest()->setIdolonConfig();
		$bSuccess = $this->serve();

		return $bSuccess;
	}

    /**
     * @return bool
     */
	protected function createCachePath()
    {
        if (false === file_exists($this->_sCachePath) || false === is_dir($this->_sCachePath))
        {
            return (boolean) mkdir($this->_sCachePath);
        }

        return true;
    }

	/**
	 * performs a redirect
	 * @access protected
	 * @return void
	 */
	protected function redirect()
	{
        $aInfo = pathinfo($this->_sImage);
		$sQuery = '/'
		    . $this->_sIdolonToken . '/'
		    . $aInfo['filename'] . '/'
		    . $aInfo['extension'] . '/'
		    . $this->_iDimensionX . '/'
		    . $this->_iDimensionY . '/'
		    . $this->_iRedirect . '/';
		$sRedirect = "Location: " . $sQuery;
		$this->log($sRedirect);

		// redirect nur auf anderen Path
		if ($_SERVER['REQUEST_URI'] !== $sQuery)
        {
            header($sRedirect);
            exit();
        }
	}
	
	/**
	 * @example split "http://blog.ueffing.net/image/screenshot1/png/200/100/1/" into 
	 * array(5) {
		[0]=>
		string(11) "screenshot1"
		[1]=>
		string(3) "png"
		[2]=>
		string(3) "200"
		[3]=>
		string(3) "100"
		[4]=>
		string(1) "1"
	  }
     * @return Index
     * @throws \ReflectionException
     */
	protected function getValuesFromRequest() : \Idolon\Model\Index
	{
		$aValue = array_values(
			array_filter(
				explode(
					'/',
                    \MVC\Request::getCurrentRequest()['path']
				), 
				function($mValue){
					return ($mValue !== null && $mValue !== false && $mValue !== '');
				}
			)
		);
		
		if ($aValue[0] === $this->_sIdolonToken)
		{
			// remove token from array
			unset($aValue[0]);
			$this->_aRequestValue = array_values($aValue);
		}		
		
		// fallbacks
		(!isset($this->_aRequestValue[0])) ? $this->_aRequestValue[0] = 0 : false;
		(!isset($this->_aRequestValue[1])) ? $this->_aRequestValue[1] = 0 : false;
		(!isset($this->_aRequestValue[2])) ? $this->_aRequestValue[2] = 0 : false;
		(!isset($this->_aRequestValue[3])) ? $this->_aRequestValue[3] = 0 : false;
		(!isset($this->_aRequestValue[4])) ? $this->_aRequestValue[4] = 1 : false;
		
		return $this;
	}
	
	/**
	 * set image values for Idolon
	 * @access protected 
	 * @return \Idolon\Model\Index
	 */
	protected function setIdolonConfig() : \Idolon\Model\Index
	{
		$this
			->setImage($this->_aRequestValue[0] . '.' . $this->_aRequestValue[1])
			->setDimensionX((int) $this->_aRequestValue[2])
			->setDimensionY((int) $this->_aRequestValue[3])
			->setRedirect((isset($this->_aRequestValue[4])) ? (int) $this->_aRequestValue[4] : 0)
			;
		
		return $this;
	}
	
	//--------------------------------------------------------------------------
	// Getter
	
	/**
	 * get token
	 * @access public
	 * @return string
	 */
	public function getIdolonToken() : string
	{
		return $this->_sIdolonToken;
	}

	//--------------------------------------------------------------------------
	// Setter

	/**
	 * setter for Token
     * @param string $sIdolonToken
     * @return $this
     */
	public function setIdolonToken(string $sIdolonToken = '')
	{
		$this->_sIdolonToken = $sIdolonToken;
		
		return $this;
	}
	
	/**
	 * set max amount of variations possible to cache for a image
     * @param int $iMaxCacheFiles
     * @return $this
     */
	public function setMaxCacheFilesForImage($iMaxCacheFiles = 10)
	{
		$this->_iMaxCacheFiles = $iMaxCacheFiles;
		
		return $this;
	}

    /**
     * clear cache files
     */
	public function __destruct()
    {
        $aFile = glob($this->_sCachePath . $this->_sImage . '_*');

        // oldest first
        array_multisort(
            array_map( 'filemtime', $aFile ),
            SORT_NUMERIC,
            SORT_ASC,
            $aFile
        );

        // how many cache files
        $iFilesExist = count($aFile);

        // how much to delete
        $iFilesToDelete = ($iFilesExist - $this->_iMaxCacheFiles);

        // delete
        for ($i = 0; $i < $iFilesToDelete; $i++)
        {
            unlink(Helper::secureFilePath($aFile[$i]));
        }
    }
}
