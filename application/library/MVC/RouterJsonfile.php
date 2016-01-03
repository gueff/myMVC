<?php
/**
 * RouterJsonfile.php
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
 * RouterJsonfile
 * 
 * @extends \MVC\RouterJson
 */
class RouterJsonfile extends \MVC\RouterJson
{

	/**
	 * reads the routing.json file and looks for matching routes<br /> 
	 * The Get-Param `a` will be passed through in both cases
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct ()
	{
		parent::__construct ();

		if (is_array ($this->_aRouting) && array_key_exists ('QUERY_STRING', $_SERVER))
		{
			// right found (GET Params String)
			// means a request as e.g.
			//		http://dev.mvc.de/?module=custom&c=index&m=index
			foreach ($this->_aRouting as $sKey => $aValue)
			{
				// if there is no route sepcified in the routing.json (empty), take the MVC fallback routing
				if (!array_key_exists ('query', $aValue) || $aValue['query'] === '')
				{
					$aValue['query'] = Registry::get ('MVC_ROUTING_FALLBACK');
					// add Target Class
					parse_str ($aValue['query'], $sQuery);
					$this->_aRouting[$this->_sRequestUri]['class'] = '\\' . ucfirst ($sQuery[Registry::get ('MVC_GET_PARAM_MODULE')]) . '\\Controller\\' . ucfirst ($sQuery[Registry::get ('MVC_GET_PARAM_C')]);
				}

				DETECT_APPENDINGS:
				{

					$sAppend = '';
					$sAppend = trim (substr ($_SERVER['QUERY_STRING'], strlen ($aValue['query'])));

					// if query string contains the fallback string, cut it out
					if (substr ($sAppend, 0, strlen (Registry::get ('MVC_ROUTING_FALLBACK'))) == Registry::get ('MVC_ROUTING_FALLBACK'))
					{
						$sAppend = substr ($sAppend, (strlen (Registry::get ('MVC_ROUTING_FALLBACK'))));
					}

					$sAppend = '?' . trim (substr ($sAppend, 1, strlen ($sAppend)));
					($sAppend === '?') ? $sAppend = '' : FALSE;
				}

				// redirect to the SEO Url, which is $sKey here
				if ($aValue['query'] === substr ($_SERVER['QUERY_STRING'], 0, strlen ($aValue['query'])))
				{
					Request::REDIRECT ($sKey . $sAppend);
				}
			}
		}

		// left found (SEO Url)
		if (array_key_exists ($this->_sRequestUri, $this->_aRouting))
		{
			$aQueryString = $this->_aRouting[$this->_sRequestUri];

			// use the MVC fallback routing if none is specified in routing.json. @see config
			if (empty ($aQueryString['query']))
			{
				$aQueryString['query'] = Registry::get ('MVC_ROUTING_FALLBACK');
				Log::WRITE ('MVC Fallback: ' . $aQueryString['query']);
			}

			// copy to QUERY_STRING
			$_SERVER['QUERY_STRING'] = $aQueryString['query'];

			$aParts = explode ('&', $aQueryString['query']);

			// copy to GET
			foreach ($aParts as $aValue['query'])
			{
				$aPiece = explode ('=', $aValue['query']);
				(array_key_exists (1, $aPiece)) ? $_GET[$aPiece[0]] = $aPiece[1] : FALSE;
				(array_key_exists (Registry::get ('MVC_GET_PARAM_MODULE'), $_GET)) ? $_GET[Registry::get ('MVC_GET_PARAM_MODULE')] = ucfirst ($_GET[Registry::get ('MVC_GET_PARAM_MODULE')]) : FALSE;
				(array_key_exists (Registry::get ('MVC_GET_PARAM_C'), $_GET)) ? $_GET[Registry::get ('MVC_GET_PARAM_C')] = ucfirst ($_GET[Registry::get ('MVC_GET_PARAM_C')]) : FALSE;
			}

			Request::getInstance ()->saveRequest ()->prepareQueryVarsForUsage ();
		}
	}

	/**
	 * Destrucor
	 * 
	 * @access public
	 * @return void
	 */	
	public function __destruct ()
	{
		;
	}
}
