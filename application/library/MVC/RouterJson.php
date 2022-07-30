<?php
/**
 * RouterJson.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;

/**
 * RouterJson
 * @implements \MVC\MVCInterface\RouterJson
 */
class RouterJson implements \MVC\MVCInterface\RouterJson
{
	/**
	 * object routing builder
	 * @var object
	 */
	protected $_oRoutingBuilder;

	/**
	 * routing JSON
	 * @var string
	 */
	protected $_sRoutingJson;

	/**
	 * routing array
	 * @var array
	 */
	public $aRouting = array ();

	/**
	 * $_SERVER['REQUEST_URI']
	 * @var string
	 */
	public $sRequestUri;

	/**
     * RouterJson constructor.
	 * reads the routing.json file and looks for matching routes
	 * The Get-Param `a` will be passed through in both cases
     * @throws \ReflectionException
     */
	public function __construct ()
	{
		// call the Routing Json building class to get the proper routing
		// @see config
        $sRoutingJsonBuilder = Config::get_MVC_ROUTING_JSON_BUILDER();

		if (true === empty($sRoutingJsonBuilder))
		{
			Error::addERROR (
                DTArrayObject::create()
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue('config MVC_ROUTING_JSON_BUILDER is not set.'))
            );
			return false;
		}

		$this->_oRoutingBuilder = new $sRoutingJsonBuilder;
		$this->_sRoutingJson = $this->_oRoutingBuilder->getRoutingJson();
        $this->aRouting = json_decode ($this->_sRoutingJson, true);

        if (0 !== json_last_error())
        {
            $this->aRouting = array();
        }

		$this->sRequestUri = Request::getServerRequestUri(); #  Request::getInstance()->getRequestUri();

        // add path
		(isset ($this->aRouting[$this->sRequestUri])) ? $this->aRouting[$this->sRequestUri]['path'] = $this->sRequestUri : false;

		// add class, method
		if (array_key_exists ($this->sRequestUri, $this->aRouting))
		{
			if (array_key_exists ('query', $this->aRouting[$this->sRequestUri]))
			{
				// add Target Class
				parse_str ($this->aRouting[$this->sRequestUri]['query'], $sQuery);
                $this->aRouting[$this->sRequestUri]['class'] = ucfirst ($sQuery[Config::get_MVC_GET_PARAM_MODULE()]) . '\\Controller\\' . ucfirst ($sQuery[Config::get_MVC_GET_PARAM_C()]);
                $this->aRouting[$this->sRequestUri]['method'] = Request::getMethodName();
			}
		}

        Log::write ('routing table built by: ' . $sRoutingJsonBuilder);
		Log::write ('routing handling done by: ' . Config::get_MVC_ROUTING_HANDLING());
		Log::write ('routes (cutout): ' . substr (preg_replace ('/\s+/', '', $this->_sRoutingJson), 0, 25) . ' [..]');

		if (false === filter_var (($this->_oRoutingBuilder instanceof \MVC\MVCInterface\RouterJsonBuilder), FILTER_VALIDATE_BOOLEAN))
		{
			$sMsg = 'ERROR: Make sure `' . $sRoutingJsonBuilder . '` implements \MVC\MVCInterface\RouterJsonBuilder';
			Error::addERROR (
                DTArrayObject::create()
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($sMsg))
            );
			Helper::stop ($sMsg);
		}
		
		return true;
	}

	/**
	 * saves routing to the registry
	 * @deprecated use => Router::setRoutingCurrent, Router::setRouting
	 * @access public
	 * @static
	 * @param array $aRouting
	 * @param string $sRequestUri
	 * @return void
	 */
	public static function saveRoutingToRegistry (array $aRouting, $sRequestUri)
	{
        Router::setRouting($aRouting);
        Router::setRoutingCurrent(((isset ($aRouting[$sRequestUri])) ? $aRouting[$sRequestUri] : array ()));
	}

	/**
	 * gets routing array
     * @deprecated use => Router::getRouting()
     * @return mixed
     * @throws \ReflectionException
     */
	public static function getRoutingArray ()
	{
		return Router::getRouting();
	}

	/**
	 * gets routing as json string
     * @deprecated use => Router::getRoutingJson();
     * @return false|string
     * @throws \ReflectionException
     */
	public static function getRoutingJson()
	{
        return Router::getRoutingJson();
	}
		
	/**
	 * Destructor
	 * @access public
	 * @return void
	 */
	public function __destruct ()
	{
		;
	}
}
