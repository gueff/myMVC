<?php
/**
 * RouterJson.php
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
 * RouterJson
 * 
 * @implements \MVC\MVCInterface\RouterJson
 */
class RouterJson implements \MVC\MVCInterface\RouterJson
{
	/**
	 * object routing builder
	 * 
	 * @var object
	 * @access protected
	 */
	protected $_oRoutingBuilder;

	/**
	 * routing JSON
	 * 
	 * @var string
	 * @access protected
	 */
	protected $_sRoutingJson;

	/**
	 * routing array
	 * 
	 * @var array
	 * @access public
	 */
	public $_aRouting = array ();

	/**
	 * Request Uri
	 * 
	 * @var string
	 * @access public
	 */
	public $_sRequestUri;


	/**
	 * reads the routing.json file and looks for matching routes<br /> 
	 * The Get-Param `a` will be passed through in both cases
	 * 
	 * @access public
	 * @return boolean
	 */
	public function __construct ()
	{
		// call the Routing Json building class to get the proper routing
		// @see config
		(Registry::isRegistered ('MVC_ROUTING_JSON_BUILDER')) ? $sRoutingBuilder = Registry::get ('MVC_ROUTING_JSON_BUILDER') : false;

		if (!isset ($sRoutingBuilder))
		{
			Error::addERROR ('config MVC_ROUTING_JSON_BUILDER is not set.');
			return false;
		}

		$this->_oRoutingBuilder = new $sRoutingBuilder;
		$this->_sRoutingJson = $this->_oRoutingBuilder->getRoutingJson ();
		$this->_aRouting = json_decode ($this->_sRoutingJson, true);
		$this->_sRequestUri = Request::getInstance ()->getRequestUri ();
		
		// add path
		(isset ($this->_aRouting[$this->_sRequestUri])) ? $this->_aRouting[$this->_sRequestUri]['path'] = $this->_sRequestUri : false;

		// add class, method
		if (array_key_exists ($this->_sRequestUri, $this->_aRouting))
		{
			if (array_key_exists ('query', $this->_aRouting[$this->_sRequestUri]))
			{
				// add Target Class
				parse_str ($this->_aRouting[$this->_sRequestUri]['query'], $sQuery);
				$this->_aRouting[$this->_sRequestUri]['class'] = ucfirst ($sQuery[Registry::get ('MVC_GET_PARAM_MODULE')]) . '\\Controller\\' . ucfirst ($sQuery[Registry::get ('MVC_GET_PARAM_C')]);
				$this->_aRouting[$this->_sRequestUri]['method'] = Request::getInstance ()->getMethod ();
			}
		}
		
		Log::WRITE ('routing table built by: ' . $sRoutingBuilder);
		Log::WRITE ('routing handling done by: ' . Registry::get ('MVC_ROUTING_HANDLING'));
		Log::WRITE ('routes (cutout): ' . substr (preg_replace ('/\s+/', '', $this->_sRoutingJson), 0, 25) . ' [..]');

		if (false === filter_var (($this->_oRoutingBuilder instanceof \MVC\MVCInterface\RouterJsonBuilder), FILTER_VALIDATE_BOOLEAN))
		{
			/**
			 * @todo ERROR
			 */
			$sMsg = 'ERROR: <br />Make sure `' . $sRoutingBuilder . '` <b>implements</b> \MVC\MVCInterface\RouterJsonBuilder';
			Error::addERROR ($sMsg);
			Helper::STOP ($sMsg);
		}
		
		return true;
	}

	/**
	 * saves routing to the registry
	 * 
	 * @access public
	 * @static
	 * @param array $aRouting
	 * @param string $sRequestUri
	 * @return void
	 */
	public static function SAVEROUTINGTOREGISTRY (array $aRouting, $sRequestUri)
	{		
		// save routing array to registry
		Registry::set ('MVC_ROUTING', $aRouting);
		Registry::set ('MVC_ROUTING_CURRENT', ((isset ($aRouting[$sRequestUri])) ? $aRouting[$sRequestUri] : array ()));
	}

	/**
	 * gets routing array
	 * 
	 * @access public
	 * @static
	 * @return array
	 */
	public static function GETROUTINGARRAY ()
	{
		return Registry::get ('MVC_ROUTING');
	}

	/**
	 * gets routing as json string
	 * 
	 * @access public
	 * @static
	 * @return string JSON
	 */
	public static function GETROUTINGJSON ()
	{
		return json_encode (Registry::get ('MVC_ROUTING'));
	}
		
	/**
	 * Destrucor
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct ()
	{
		
	}
}
