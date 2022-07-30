<?php
/**
 * RouterJsonfile.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

/**
 * RouterJsonfile
 * @extends \MVC\RouterJson
 */
class RouterJsonfile extends \MVC\RouterJson
{
    /**
     * RouterJsonfile constructor.
     * reads the routing.json file and looks for matching routes<br />
     * The Get-Param `a` will be passed through in both cases
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct();

        if (is_array($this->aRouting) && array_key_exists('QUERY_STRING', $_SERVER))
        {
            // right found (GET Params String)
            // means a request as e.g.
            //		http://dev.mvc.de/?module=custom&c=index&m=index
            foreach ($this->aRouting as $sKey => $aValue)
            {
                if (false === is_array($aValue))
                {
                    continue;
                }

                // if there is no route sepcified in the routing.json (empty), take the MVC fallback routing
                if (!array_key_exists('query', $aValue) || $aValue['query'] === '')
                {
                    $aValue['query'] = Router::getRoutingFallback();
                    // add Target Class
                    parse_str($aValue['query'], $sQuery);
                    $this->aRouting[$this->sRequestUri]['class'] = '\\' . ucfirst($sQuery[Config::get_MVC_GET_PARAM_MODULE()]) . '\\Controller\\' . ucfirst($sQuery[Config::get_MVC_GET_PARAM_C()]);
                }

                DETECT_APPENDINGS:
                {
                    $sAppend = '';
                    $sAppend = trim(substr($_SERVER['QUERY_STRING'], strlen($aValue['query'])));

                    // if query string contains the fallback string, cut it out
                    if (substr($sAppend, 0, strlen(Router::getRoutingFallback())) == Router::getRoutingFallback())
                    {
                        $sAppend = substr($sAppend, (strlen(Router::getRoutingFallback())));
                    }

                    $sAppend = '?' . trim(substr($sAppend, 1, strlen($sAppend)));
                    ($sAppend === '?') ? $sAppend = '' : FALSE;
                }

                // redirect to the SEO Url, which is $sKey here
                if ($aValue['query'] === substr($_SERVER['QUERY_STRING'], 0, strlen($aValue['query'])))
                {
                    Request::redirect($sKey . $sAppend);
                }
            }
        }

        // SEO Url 1:1 Match
        if (array_key_exists($this->sRequestUri, $this->aRouting))
        {
            $aQueryString = $this->aRouting[$this->sRequestUri];

            // use the MVC fallback routing if none is specified in routing.json. @see config
            if (empty ($aQueryString['query']))
            {
                $aQueryString['query'] = Router::getRoutingFallback();
                Log::write('MVC Fallback: ' . $aQueryString['query']);
            }

            // copy to QUERY_STRING
            $_SERVER['QUERY_STRING'] = $aQueryString['query'];

            $aParts = explode('&', $aQueryString['query']);

            // copy to GET
            foreach ($aParts as $aValue['query'])
            {
                $aPiece = explode('=', $aValue['query']);
                (array_key_exists(1, $aPiece)) ? $_GET[$aPiece[0]] = $aPiece[1] : FALSE;
                (array_key_exists(Config::get_MVC_GET_PARAM_MODULE(), $_GET)) ? $_GET[Config::get_MVC_GET_PARAM_MODULE()] = ucfirst($_GET[Config::get_MVC_GET_PARAM_MODULE()]) : FALSE;
                (array_key_exists(Config::get_MVC_GET_PARAM_C(), $_GET)) ? $_GET[Config::get_MVC_GET_PARAM_C()] = ucfirst($_GET[Config::get_MVC_GET_PARAM_C()]) : FALSE;
            }

            Request::init();
        }
        // SEO Url Wildcard (/*) Match
        else
        {
            foreach ($this->aRouting as $sIndex => $aValue)
            {
                if (substr($sIndex, -1) === '*')
                {
                    $sWildcard = substr($sIndex, 0, -1);

                    if (substr(Request::getServerRequestUri(), 0, strlen($sWildcard)) === $sWildcard)
                    {
                        // e.g.: module=default&c=index&m=action
                        $aQuery = explode('&', $this->aRouting[$sIndex]['query']);

                        foreach ($aQuery as $sValue)
                        {
                            $aEx = explode('=', $sValue);
                            $_GET[$aEx[0]] = $aEx[1];
                        }

                        $this->aRouting[$sIndex]['path'] = $sIndex;
                        $this->aRouting[$sIndex]['class'] = ucfirst($_GET['module']) . '\\Controller\\' . ucfirst($_GET['c']);
                        $this->aRouting[$sIndex]['index'] = $sIndex;
                        $this->sRequestUri = $sIndex;
                        $this->_addParam();

                        Request::init();

                        return true;
                    }
                }
            }
        }
    }

    /**
     * adds params from query to $_GET
     * @return void
     */
    private function _addParam()
    {
        $aParseUrl = parse_url(Request::getServerRequestUri());

        if (array_key_exists('query', $aParseUrl))
        {
            parse_str($aParseUrl['query'], $aParseStr);

            foreach ($aParseStr as $sKey => $sValue)
            {
                $_GET[$sKey] = $sValue;
            }
        }
    }

    /**
     * Destructor
     * @access public
     * @return void
     */
    public function __destruct()
    {
        ;
    }
}
