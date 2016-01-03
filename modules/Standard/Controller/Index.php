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
 * @name $StandardController
 */
namespace Standard\Controller;

/**
 * Index
 * 
 * @implements \MVC\MVCInterface\Controller
 */
class Index implements \MVC\MVCInterface\Controller
{

	/**
	 * session object
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
	protected $_aRoutingCurrent = array ();

	/**
	 * Event
	 * 
	 * @var \Standard\Event\Index
	 * @access protected
	 */
	protected $_oStandardEventIndex;

	/**
	 * View Object
	 * 
	 * @var \Standard\View\Index
	 * @access public
	 */
	public $oStandardViewIndex;

	/**
	 * Model Object
	 * 
	 * @var \Standard\Model\Index 
	 * @access protected
	 */
	protected $_oStandardModelIndex;


	/**
	 * this method is autom. called by MVC_Application->runTargetClassBeforeMethod() in very early stage
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function __preconstruct ()
	{
		// start event listener
		\Standard\Event\Index::getInstance ();
	}

	/**
	 * Constructor
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct ()
	{
		$this->_oMVCSession = \MVC\Registry::get ('MVC_SESSION');
		$this->_aRoutingCurrent = \MVC\Registry::get ('MVC_ROUTING_CURRENT');

		$this->_oStandardEventIndex = \Standard\Event\Index::getInstance ();
		$this->_oStandardModelIndex = new \Standard\Model\Index();
		$this->oStandardViewIndex = new \Standard\View\Index();

		// we want the Routing array assigned to the View for any request, so we assign it here
		$this->oStandardViewIndex->assign ('aRouting', \MVC\Registry::get ('MVC_ROUTING'));
	}

	/**
	 * home
	 * 
	 * @access public
	 * @return void
	 */
	public function home ()
	{
		$this->oStandardViewIndex->assign ('sTitle', $this->_aRoutingCurrent['title']);
		$this->oStandardViewIndex->assign ('sContent', $this->oStandardViewIndex->loadTemplateAsString ('index/index.tpl'));
	}

	/**
	 * about
	 * 
	 * @access public
	 * @return void
	 */
	public function about ()
	{
		$this->oStandardViewIndex->assign ('sTitle', $this->_aRoutingCurrent['title']);
		$this->oStandardViewIndex->assign ('sContent', $this->oStandardViewIndex->loadTemplateAsString ('index/about.tpl'));
	}
	
	/**
	 * handles routes which are not declared.<br />
	 * usually 404
	 * 
	 * @access public
	 * @return void
	 */
	public function fallback ()
	{
		$this->oStandardViewIndex->sendHeader404 ();
		$this->oStandardViewIndex->assign ('sTitle', '404');
		$this->oStandardViewIndex->assign ('sContent', $this->oStandardViewIndex->loadTemplateAsString ('index/404.tpl'));
	}

	/**
	 * Destructor
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct ()
	{
		// We want rendering in any case, so we put it here instead of putting in each method
		$this->oStandardViewIndex->render ();
	}

}
