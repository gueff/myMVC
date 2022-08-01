<?php

/**
 * Idolon.php
 * PHP Image Server
 * 
 * @package Idolon
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See /doc/COPYING
 * @abstract serves image
 * @require imagemagick's convert
 * @example see examples folder
 * @see https://github.com/gueff/Idolon
 */       
class Idolon
{    
    /**
     * @access protected 
     * @var string
     */
    protected $_sParamKeyI = 'i';
    
    /**
     * @access protected 
     * @var string
     */
    protected $_sParamKeyX = 'x';
    
    /**
     * @access protected 
     * @var string
     */
    protected $_sParamKeyY = 'y';
    
    /**
     * @access protected 
     * @var string
     */
    protected $_sParamKeyR = 'r';
    
    /**
     * X-Dimension
     * @access protected 
     * @var integer
     */
    protected $_iDimensionX = 0;
    
    /**
     * Y-Dimension
     * @access protected 
     * @var integer
     */
    protected $_iDimensionY = 0;
    
    /**
     * Redirect
     * @access protected 
     * @var integer (1|0)
     */
    protected $_iRedirect = 1;    
    
    /**
     * callable
     * @access protected 
     * @var object $_oSantize
     */
    protected $_oSantize;
    
    /**
     * callable
     * @access protected 
     * @var object $_oFilter
     */
    protected $_oFilter;
    
    /**
     * absolute path to images folder
     * @access protected 
     * @var string
     */
    protected $_sImagePath = __DIR__;

    /**
     * absolute path to cache folder
     * @var string
     */
    protected $_sCachePath = __DIR__;

    /**
     * image by name
     * @access protected 
     * @var string
     */
    protected $_sImage = '';
    
    /**
     * prevent oversizing
     * @access protected 
     * @var boolean
     */
    protected $_bPreventOversizing = true;
    
    /**
     * path to imagemagick's convert
     * @access protected 
     * @var string
     */
    protected $_sConvertExecutable = '/usr/bin/convert';    
    
    /**
     * @access protected 
     * @var string
     */
    protected $_sLog = '';
    
    /**
     * Base64 image JPEG 404
     * @access protected 
     * @var string Base64 image
     */
    protected $_s404Base64Image = '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';
    
	/**
	 * set Config
	 * 
	 * @access public
     * @param array $aConfig Configuration
	 * @return void
	 */
	public function __construct (array $aConfig = array())
	{
        // Sanitize
        if (isset($aConfig['oSanitize']) && is_callable($aConfig['oSanitize']))
        {
            $this->_oSantize = $aConfig['oSanitize'];  
        }        
        else // default
        {
            $this->_oSantize = function(){
                (isset($this->_iDimensionX)) ? $this->_iDimensionX = (int) $this->_iDimensionX : false;
                (isset($this->_iDimensionY)) ? $this->_iDimensionY = (int) $this->_iDimensionY : false;
                (isset($this->_iRedirect)) ? $this->_iRedirect = (int) $this->_iRedirect : $this->_iRedirect = 1;            
            };
        }
        
        // Filter
        if (isset($aConfig['oFilter']) && is_callable($aConfig['oFilter']))
        {
            $this->_oFilter = $aConfig['oFilter'];  
        }
        else // default
        {
            $this->_oFilter = function(){
                (isset($_GET[$this->_sParamKeyI])) ? $_GET[$this->_sParamKeyI] = preg_replace('/[^a-zA-Z0-9\-\._, ]+/', '-', $_GET[$this->_sParamKeyI]) : false;
            };
        }
        
        (isset($aConfig['sParamKeyI'])) ? $this->_sParamKeyI = $aConfig['sParamKeyI'] : false;
        (isset($aConfig['sParamKeyX'])) ? $this->_sParamKeyX = $aConfig['sParamKeyX'] : false;
        (isset($aConfig['sParamKeyY'])) ? $this->_sParamKeyY = $aConfig['sParamKeyY'] : false;
        (isset($aConfig['sParamKeyR'])) ? $this->_sParamKeyR = $aConfig['sParamKeyR'] : false;
        (isset($aConfig['sConvertExecutable'])) ? $this->_sConvertExecutable = (string) $aConfig['sConvertExecutable'] : false;
        (isset($aConfig['s404Base64Image'])) ? $this->_s404Base64Image = (string) $aConfig['s404Base64Image'] : false;
        (isset($aConfig['sImagePath'])) ? $this->_sImagePath = (string) $aConfig['sImagePath'] : false;
        $this->_sCachePath = (string) (isset($aConfig['sCachePath'])) ? $aConfig['sCachePath'] : $this->_sImagePath;
        (isset($aConfig['bPreventOversizing'])) ? $this->_bPreventOversizing = (boolean) $aConfig['bPreventOversizing'] : true;
        
        if (isset($aConfig['sImage']))
        {
            $this->_sImage = (string) $aConfig['sImage'];
        }   
        else // default
        {
            (isset($_GET[$this->_sParamKeyI])) ? $this->_sImage  = $_GET[$this->_sParamKeyI] : false;
        }
        
        if (isset($aConfig['iX']))
        {
            $this->_iDimensionX = (int) $aConfig['iX'];
        }   
        else // default
        {
            (isset($_GET[$this->_sParamKeyX])) ? $this->_iDimensionX  = (int) $_GET[$this->_sParamKeyX] : false;
        }
        
        if (isset($aConfig['iY']))
        {
            $this->_iDimensionY = (int) $aConfig['iY'];
        }   
        else // default
        {
            (isset($_GET[$this->_sParamKeyY])) ? $this->_iDimensionY  = (int) $_GET[$this->_sParamKeyY] : false;
        }
        
        if (isset($aConfig['iRedirect']))
        {
            $this->_iRedirect = (int) $aConfig['iRedirect'];
        }   
        else // default
        {
            (isset($_GET[$this->_sParamKeyR])) ? $this->_iRedirect  = (int) $_GET[$this->_sParamKeyR] : false;
        }        
	}
    
    /**
     * start serving requested image
     * @return bool
     */
    public function serve()
    {               
		// sanitize + filter
		$this->sanitize();
		$this->filter();
        $bSuccess = $this->proceed();

        return $bSuccess;
    }

    //----------------------------------------
    // Setter
    
    /**
     * sets path to images folder
     * @access public
     * @param string $sImagePath
     * @return $this
     */
    public function setImagePath(string $sImagePath = '')
    {
        if ('' !== $sImagePath)
        {
            $this->_sImagePath = $sImagePath;
        }
        
        return $this;
    }

    /**
     * sets path to cache folder
     * @param string $sCachePath
     * @return $this
     */
    public function setCachepath(string $sCachePath = '')
    {
        if ('' !== $sCachePath)
        {
            $this->_sCachePath = $sCachePath;
        }

        return $this;
    }

    /**
     * sets Sanitize Closure
     * @access public
     * @param callable $oSanitize
     * @return $this
     */
    public function setSanitize(callable $oSanitize)
    {
        if (is_callable($oSanitize))
        {
            $this->_oSantize = $oSanitize;
        }        
        
        return $this;
    }
    
    /**
     * sets Filter Closure
     * @access public
     * @param callable $oFilter
     * @return $this
     */
    public function setFilter(callable $oFilter)
    {
        if (is_callable($oFilter))
        {
            $this->_oFilter = $oFilter;
        }
        
        return $this;
    }

    /**
     * set path to imagemagick's convert binary
     * @access public
     * @param string $sConvertExecutable
     * @return $this
     */
    public function setConvert(string $sConvertExecutable)
    {
        $this->_sConvertExecutable = $sConvertExecutable;
        
        return $this;
    }

    /**
     * sets 404 base64 image
     * @access public
     * @param string $s404Base64Image
     * @return $this
     */
    public function set404Base64Image(string $s404Base64Image = '')
    {
        $this->_s404Base64Image = $s404Base64Image;
        
        return $this;
    }

    /**
     * sets setParamKeyI
     * @access public
     * @param string $sParamKeyI
     * @return $this
     */
    public function setParamKeyI(string $sParamKeyI = '')
    {
        $this->_sParamKeyI = $sParamKeyI;
        
        return $this;
    }

    /**
     * sets setParamKeyX
     * @access public
     * @param string $sParamKeyX
     * @return $this
     */
    public function setParamKeyX(string $sParamKeyX = '')
    {
        $this->_sParamKeyX = $sParamKeyX;
        
        return $this;
    }

    /**
     * sets $sParamKeyY
     * @access public
     * @param string $sParamKeyY
     * @return $this
     */
    public function setParamKeyY(string $sParamKeyY = '')
    {
        $this->_sParamKeyY = $sParamKeyY;
        
        return $this;
    }

    /**
     * sets $sParamKeyR
     * @access public
     * @param string $sParamKeyR
     * @return $this
     */
    public function setParamKeyR(string $sParamKeyR = '')
    {
        $this->_sParamKeyR = $sParamKeyR;
        
        return $this;
    }

	/**
	 * set image
     * @access public
	 * @param string $sImage
     * @return $this
	 */
	public function setImage(string $sImage = '')
	{
		$this->_sImage = $sImage;
        
        return $this;
	}

	/**
	 * set x value
     * @access public
	 * @param int $iX
     * @return $this
	 */
	public function setDimensionX(int $iX = 0)
	{
		$this->_iDimensionX = $iX;
        
        return $this;
	}

	/**
	 * set y value
     * @access public
	 * @param int $iY
     * @return $this
	 */
	public function setDimensionY(int $iY = 0)
	{
		$this->_iDimensionY = $iY;
        
        return $this;
	}

	/**
	 * set redirect value
     * @access public
	 * @param int $iRedirect
     * @return $this
	 */
	public function setRedirect(int $iRedirect = 1)
	{
		$this->_iRedirect = $iRedirect;
        
        return $this;
	}		
	
    //----------------------------------------
    // Getter

    /**
     * gets Filter
     * @access public
     * @return callable
     */
    public function getSanitize() : callable
    {
        return $this->_oSantize;
    }

    /**
     * gets Filter
     * @access public
     * @return callable
     */
    public function getFilter() : callable
    {
        return $this->_oFilter;
    }
    
    /**
     * gets Log String
     * @access public
     * @return string
     */
    public function getLog() : string
    {
        return $this->_sLog;
    }

    //----------------------------------------
    
    /**
     * sanitizes input
     * @access protected 
     * @return void
     */
	protected function sanitize()
	{
        if (is_callable($this->_oSantize))
        {
            call_user_func($this->_oSantize);
        }       
	}

    /**
     * filters input
     * @access protected 
     * @return void
     */
	protected function filter()
	{
        if (is_callable($this->_oFilter))
        {
            call_user_func($this->_oFilter);
        } 
	}

    /**
     * start serving process 
     * @return bool
     */
	protected function proceed()
	{
		if (false == $this->essentialsGiven())
        {
            return false;
        }
        
        // delete all caches from original image which changed
		if (true === $this->imageRenewed())
		{
			$this->clearCachedFiles($this->_sImage);
		}

		$aDimension = $this->getDimensionArray();
        
		if (false === $this->dimensionsValid($aDimension))
        {
            return false;
        }

        $fRatio = $this->getRatio($aDimension);
		$this->aspectSafe($fRatio);
		$sFilenameDelivery = $this->buildFilename();

        if (!file_exists(realpath($this->_sCachePath . '/' . $sFilenameDelivery)))
        {
            $this->create($this->_sImage, $sFilenameDelivery);
        }

		return $this->deliver($sFilenameDelivery);
	}

    /**
     * returns false if requested image does not exist or x/y values not set
     * @access protected 
     * @return boolean success
     */
	protected function essentialsGiven() : bool
	{
	    // Dimension missing
	    if (true == ((0 === $this->_iDimensionX)))
        {
            $aDimension = $this->getDimensionArray();
            $this->_iDimensionX = $aDimension[0];
        }

        // Dimension missing
        if (true == ((0 === $this->_iDimensionY)))
        {
            $aDimension = $this->getDimensionArray();
            $this->_iDimensionY = $aDimension[1];
        }

		if  (
                    true === ((!isset($this->_sImage) || empty($this->_sImage))
                || !file_exists(realpath($this->_sImagePath . '/' . $this->_sImage))
                || !is_file(realpath($this->_sImagePath . '/' . $this->_sImage)))
                ||  true == ((0 === $this->_iDimensionX) && (0 === $this->_iDimensionY))
            )
		{
			$this->deliver();
			$this->clearCachedFiles($this->_sImage);
			return false;
		}
        
        return true;
	}

	/**
	 * check if original image was updated
     * @access protected 
	 * @return boolean renew
	 */
	protected function imageRenewed() : bool
	{
		$sDotfile = $this->_sCachePath . '/' . '.' . $this->_sImage . '.txt';
		
		if (!file_exists (realpath($this->_sImagePath . '/' . $this->_sImage)))
		{
			return false;
		}
		
		$iFilemtime = filemtime(realpath($this->_sImagePath . '/' . $this->_sImage));

		if (file_exists($sDotfile))
		{
			$iFilemtime2 = file_get_contents($sDotfile);
		}
		else
		{
			file_put_contents($sDotfile, $iFilemtime);
			$iFilemtime2 = $iFilemtime;
		}

		if ($iFilemtime2 > $iFilemtime)
		{
			return true;
		}

		return false;
	}

    /**
     * delete already recalced and so cached files
     * @param string $sFile
     */
	public function clearCachedFiles ($sFile = '')
	{
        $aCached = glob($this->_sCachePath . $sFile . '_*');
        $sDotfile = $this->_sCachePath . '.' . $sFile . '.txt';
        $sDotfile = (string) preg_replace('#(\.\.\/)+#', '', trim($sDotfile));
        $sDotfile = (string) preg_replace('#/+#', '/', trim($sDotfile));

        foreach ($aCached as $sImage)
        {
            $sImage = (string) preg_replace('#(\.\.\/)+#', '', trim($sImage));
            $sImage = (string) preg_replace('#/+#', '/', trim($sImage));

            if (file_exists($sImage))
            {
                unlink($sImage);
            }
        }

        if (file_exists($sDotfile))
        {
            unlink($sDotfile);
        }
	}

    /**
     * gets dimensions of image
     * @access protected 
     * @return array
     */
	protected function getDimensionArray() : array
	{
		// get dimensions
		$aDimension = (!empty($this->_sImage) && file_exists(realpath($this->_sImagePath . '/' . $this->_sImage)) && is_file(realpath($this->_sImagePath . '/' . $this->_sImage))) ? getimagesize(realpath($this->_sImagePath . '/' . $this->_sImage)) : array('mime' => 'image/png');

		return $aDimension;
	}

    /**
     * gets ratio of requested image
     * @access protected 
     * @param array $aDimension
     * @return float
     */
	protected function getRatio(array $aDimension = array()) : float
	{
		// calc ratio
		$fRatio = round(($aDimension[0] / $aDimension[1]), 1);

		return $fRatio;
	}

    /**
     * returns false if requested dimensions are faulty; auto redirect with corrected values if wanted
     * @access protected 
     * @param array $aDimension
     * @return boolean success
     */
	protected function dimensionsValid(array $aDimension = array()) : bool
	{
        // x not set, y is set
		if ((!isset($this->_iDimensionX) || 0 === $this->_iDimensionX) && isset($this->_iDimensionY))
		{            
            $this->autoSetX();
            
            if (1 === $this->_iRedirect)
            {
                $this->redirect();
            }
		}
        
        // y not set, x is set
		if ((!isset($this->_iDimensionY) || 0 === $this->_iDimensionY) && isset($this->_iDimensionX))
		{            
            $this->autoSetY();
            
            if (1 === $this->_iRedirect)
            {
                $this->redirect();
            }
		}

		// x/y faulty
		($this->_iDimensionX <= 0) ? $this->_iDimensionX = $aDimension[0] : false;
		($this->_iDimensionY <= 0) ? $this->_iDimensionY = $aDimension[1] : false;
        
        // prevent resizing to higher x or y values than original has
        if (true === $this->_bPreventOversizing)
        {
            if  ($this->_iDimensionX > $aDimension[0])
            {
                $this->log('_iDimensionX:' . $this->_iDimensionX . ' > $aDimension[0]:' . $aDimension[0]);
                $this->deliver();
                return false;
            }
            if ($this->_iDimensionY > $aDimension[1])
            {
                $this->log('_iDimensionY:' . $this->_iDimensionY . ' > $aDimension[1]:' . $aDimension[1]);
                $this->deliver();
                return false;
            }
        }
        
        return true;
	}

    /**
     * builds filename of image
     * @access protected 
     * @return string
     */
	protected function buildFilename() : string
	{
		$sFilenameDelivery = $this->_sImage . '_' . $this->_iDimensionX . 'x' . $this->_iDimensionY . '.' . pathinfo($this->_sImage, PATHINFO_EXTENSION);

		return $sFilenameDelivery;
	}

    /**
     * sets y to proper ascpect ratio if necessary; redirect to url with proper values if wanted
     * @access protected 
     * @param float $fRatio Ratio value
     * @return void
     */
	protected function aspectSafe(float $fRatio)
	{
        // quantify
        $iSub = strlen((string) $this->_iDimensionX);
        ($iSub > 4) ? $iSub = 4 : false;
        $sOriginalRatio = substr((string) $fRatio, 0, $iSub);
        $sRequestedRatio = round($this->_iDimensionX / $this->_iDimensionY, 1);

		// aspect
        if  (
                    1 === $this->_iRedirect 
                &&  (
                            $sRequestedRatio
                        != $sOriginalRatio
                    )
            )
        {
            $this->autoSetY();
            $this->log('$sOriginalRatio: ' . $sOriginalRatio);
            $this->log('$sRequestedRatio: ' . $sRequestedRatio);
            $this->redirect();
        }
	}
    
    /**
     * sets x in ratio to y
     * @access protected 
     * @return void
     */
    protected function autoSetX()
    {
        $aDimension = $this->getDimensionArray();
        $this->_iDimensionX = round(
            $aDimension[0] / ($aDimension[1] / $this->_iDimensionY)
        );
        $this->log($this->_iDimensionX);
    }
    
    /**
     * sets y in ratio to x
     * @access protected 
     * @return void
     */
    protected function autoSetY()
    {
        $aDimension = $this->getDimensionArray();
        $this->_iDimensionY = round(
            $aDimension[1] / ($aDimension[0] / $this->_iDimensionX)
        );        
        $this->log($this->_iDimensionY);
    }

    /**
     * performs a redirect with new Params (i/x/y/r)
     * @access protected 
     * @return void
     */
	protected function redirect()
	{
        $sQuery = '?' 
            . $this->_sParamKeyI . '=' . $this->_sImage 
            . '&' . $this->_sParamKeyX . '=' . $this->_iDimensionX 
            . '&' . $this->_sParamKeyY . '=' . $this->_iDimensionY
            ;        
		$sRedirect = "Location: " . $_SERVER['PHP_SELF'] . $sQuery;
		$this->log($sRedirect);
		header($sRedirect);
		exit();
	}

    /**
     * creates a new image (copy of original) with the requested dimensions
     * @access protected 
     * @param string $sSource
     * @param string $sTarget
     * @return void
     */
	protected function create(string $sSource, string $sTarget)
	{
		$sTmp = md5(uniqid() . microtime(true));

        $sCmd = $this->_sConvertExecutable . ' ' . $this->_sImagePath . '/' . $sSource . ' -resize '
            . $this->_iDimensionX . 'x' . $this->_iDimensionY . ((0 === $this->_iRedirect) ? '!' : false) . ' '
            . $this->_sCachePath . '/' . $sTmp;

		$this->log($sCmd);
		shell_exec($sCmd);

		rename($this->_sCachePath . '/' . $sTmp, $this->_sCachePath . '/' . $sTarget);
	}

    /**
     * delivers image
     * @param string $sFilename
     * @return bool
     */
	protected function deliver(string $sFilename = '')
	{
		$aDimension = $this->getDimensionArray();
        
        header("Content-type: " . $aDimension['mime']);
        header("Expires: Mon, 1 Jan " . (date('Y') + 10) . " 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        if (true === file_exists(realpath($this->_sCachePath . '/' . $sFilename)) && is_file(realpath($this->_sCachePath . '/' . $sFilename)))
        {
            $this->log($this->_sCachePath . '/' . $sFilename);
            header("Content-Length: " . filesize($this->_sCachePath . '/' . $sFilename) . " bytes");

    		$mReadfile = readfile($this->_sCachePath . '/' . $sFilename);

            if (false !== $mReadfile)
            {
                return true;
            }
        }
        else
        {
            $mDecode = base64_decode($this->_s404Base64Image);
            echo $mDecode;

            if (false !== $mDecode)
            {
                return true;
            }
        }

        return false;
	}

	/**
	 * Logs a Message
     * @access protected 
	 * @param string $sType
	 * @param string $aRoute
     * @return void
	 */
	protected function log($sMessage = '')
	{
        if (is_array($sMessage))
        {
            $sMessage = print_r($sMessage, true);
        }
        
        $aDebug = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
		$sLog = date('Y-m-d H:i:s');
		$sLog.= "\t" . microtime(true);
		$sLog.= "\t" . uniqid();
        $sLog.= "\t" . basename($aDebug[0]['file']) . ', ' . $aDebug[0]['line'];
		$sLog.= "\t" . $_SERVER['REQUEST_METHOD'];
		$sLog.= "\t" . $_SERVER['REQUEST_URI'];

		ob_start();
		print_r($_GET);
		$sPrintr = '$_GET ' . str_replace("\n", ' ', preg_replace('!\s+!', ' ', ob_get_contents()));
		ob_end_clean();
		(!empty($_GET)) ? $sLog.= "\t" . $sPrintr : false;

        $sLog.= "\t" . $sMessage;
        
		$this->_sLog.= $sLog . "\n";
	}
}
