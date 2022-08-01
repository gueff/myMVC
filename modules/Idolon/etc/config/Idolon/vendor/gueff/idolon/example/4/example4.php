<?php

// Idolon Class
require_once '../../Idolon.php';

/**
 * Overwrite redirect method
 * @extens \Idolon
 */
class MyIdolon extends \Idolon
{
    /**
     * performs a redirect
     * @access protected 
     * @return void
     */
	protected function redirect()
	{
        $aImage = explode('.', $this->_sImage);
        $sQuery = '?/' . $aImage[0] . '/' . $aImage[1] . '/' . $this->_iDimensionX . '/' . $this->_iDimensionY . '/' . $this->_iDimensionR . '/';
            
		$sRedirect = "Location: " . $_SERVER['PHP_SELF'] . $sQuery;
		$this->log($sRedirect);
		header($sRedirect);
		exit();
	}    
}

// get value array from query string
// e.g. split "/example/jpg/200/120/0/" into parts
$aPart = array_values(array_filter(explode('/', $_SERVER['QUERY_STRING']), 'trim'));

// set config
$aConfig['sImagePath'] = realpath(__DIR__ . '/../');            // image path
$aConfig['sImage'] = $aPart[0] . '.' . $aPart[1];               // image name
$aConfig['iX'] = (int) $aPart[2];                                     // x dimension
$aConfig['iY'] = (int) $aPart[3];                                     // y dimension
$aConfig['iRedirect'] = (isset($aPart[4])) ? (int) $aPart[4] : 0;     // redirect


$oIdolon = new MyIdolon($aConfig);
$oIdolon->serve();



