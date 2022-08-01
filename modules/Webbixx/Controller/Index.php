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
 * @name $WebbixxController
 */
namespace Webbixx\Controller;

use MVC\Helper;
use MVC\Request;
use MVC\Router;
use MVC\Session;
use MVC\View;

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
	 * @var \Webbixx\View\Index
	 * @access public
	 */
	public $oView;

	/**
	 * Model Object
	 * 
	 * @var \Webbixx\Model\Index 
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
		\Webbixx\Event\Index::getInstance();
	}
	
    /**
     * Index constructor.
     * @throws \ReflectionException
     * @throws \SmartyException
     */
    public function __construct ()
    {
        Request::handleFallback();
        $this->_oMVCSession = Session::is();
        $this->_aRoutingCurrent = Router::getRoutingCurrent();
        $this->_oModel = new \Webbixx\Model\Index();
        $this->oView = new \Webbixx\View\Index();
        $this->oView->autoAssign($this->_aRoutingCurrent);
    }

	public function index ()
	{
//        Helper::display(Session::is()->getSessionId());
//        Helper::debug(Request::getPathArray('/foo/bar/baz/'));
//        Helper::display(DTConfig::create()->get_MVC_ROUTING_FALLBACK());
//        Helper::display(Config::get_MVC_ROUTING_FALLBACK());
	}

    public function notFound()
    {
        http_response_code(404);
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
