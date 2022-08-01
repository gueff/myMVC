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
 * @name $IdolonController
 */
namespace Idolon\Controller;


/**
 * Index
 * @implements \MVC\MVCInterface\Controller
 */
class Index implements \MVC\MVCInterface\Controller
{
    /**
     * @var array
     */
    protected $aConfig = array();

	/**
	 * Model Object
	 * 
	 * @var \Idolon\Model\Index 
	 * @access protected
	 */
	protected $_oIdolonModelIndex;

	/**
	 * this method is autom. called by MVC_Application->runTargetClassBeforeMethod()
	 * in very early stage
	 * 
	 * @access public
	 * @static
	 */
	public static function __preconstruct ()
	{
	    ;
	}

    /**
     * Index constructor.
     * @param array $aConfig
     */
	public function __construct (array $aConfig = array())
	{
	    $this->aConfig = $aConfig;
		$this->_oIdolonModelIndex = new \Idolon\Model\Index(array(
			'bPreventOversizing' => $this->aConfig['IDOLON_PREVENT_OVERSIZING']
		));
	}

	/**
	 * index
	 * @access public
	 */
	public function index ()
	{
        $bSuccess = $this->_oIdolonModelIndex
			->setImagePath($this->aConfig['IDOLON_IMAGE_PATH'])
            ->setCachepath($this->aConfig['IDOLON_CACHE_PATH'])
			->setIdolonToken($this->aConfig['IDOLON_TOKEN'])
			->setMaxCacheFilesForImage($this->aConfig['IDOLON_MAX_CACHE_FILES_FOR_IMAGE'])
			->run()
			;

        exit();
	}

	/**
	 * Destructor
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct ()
	{
		;
	}	
}
