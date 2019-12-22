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
 * @name ${module}Controller
 */
namespace {module}\Controller;

/**
 * Index
 * 
 * @implements \MVC\MVCInterface\Controller
 */
class Index implements \MVC\MVCInterface\Controller
{
	/**
	 * Session Object
	 * 
	 * @var \MVC\Session
	 * @access protected
	 */
	protected $_oMVCSession;
	
	/**
	 * routing array for current page
	 * 
	 * @var array
	 * @access protected
	 */
	protected $_aRoutingCurrent = array();

	/**
	 * View Object
	 * 
	 * @var \{module}\View\Index
	 * @access public
	 */
	public $oView;

	/**
	 * Model Object
	 * 
	 * @var \{module}\Model\Index 
	 * @access protected
	 */
	protected $_oModel;

	/**
	 * this method is autom. called by MVC_Application->runTargetClassBeforeMethod()
	 * in very early stage
	 * 
	 * @access public
	 * @static
	 */
	public static function __preconstruct ()
	{
		// start event listener
		\{module}\Event\Index::getInstance();
	}
	
    /**
     * Index constructor.
     * @throws \ReflectionException
     * @throws \SmartyException
     */
	public function __construct ()
	{
		$this->_oMVCSession = \MVC\Registry::get('MVC_SESSION');
		$this->_aRoutingCurrent = \MVC\Registry::get('MVC_ROUTING_CURRENT');
		
		$this->_oModel = new \{module}\Model\Index();
		$this->oView = new \{module}\View\Index();
        $this->oView->autoAssign($this->_aRoutingCurrent);
	}

	public function index ()
	{
		;
	}

    /**
     * @throws \ReflectionException
     * @throws \SmartyException
     */
	public function __destruct ()
	{
		$this->oView->render ();
	}
}
