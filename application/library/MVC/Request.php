<?php
/**
 * Request.php
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
 * Request
 */
class Request
{

    /**
     * Request
     *
     * @var Request
     * @access private
     * @static
     */
    private static $_oInstance;

    /**
     * request uri
     *
     * @var string
     * @access private
     */
    private $_sRequestUri = '';

    /**
     * query array
     *
     * @var array
     * @access private
     */
    private $_aQueryVar = array();

    /**
     * whitelist array defines what chars are allowed
     *
     * @var array
     * @access private
     */
    private $_aWhitelistParams = array();


    /**
     * Constructor
     *
     * @access protected
     * @return \MVC\Request
     */
    protected function __construct()
    {
        $this->_aWhitelistParams = Registry::get('MVC_REQUEST_WHITELIST_PARAMS');

        // get the request
        $this->saveRequest();
        $this->prepareQueryVarsForUsage();
    }

    /**
     * reads the HTTP Request and saves request + query separated
     *
     * @access public
     * @return \MVC\Request
     */
    public function saveRequest()
    {
        // sanitize + save GET
        if (isset ($_GET)) {
            foreach ($_GET as $sKey => $sValue) {
                if (array_key_exists($sKey, $this->_aWhitelistParams['GET'])) {
                    $sSub = mb_substr(
                        $sValue, 0, $this->_aWhitelistParams['GET'][$sKey]['length'], 'UTF8'
                    );
                    $sTrim = trim($sSub);

                    $this->_aQueryVar['GET'][$sKey] = preg_replace(
                        $this->_aWhitelistParams['GET'][$sKey]['regex'], '', $sTrim
                    );
                }
            }
        }

        // etc
        (isset ($_POST)) ? $this->_aQueryVar['POST'] = $_POST : FALSE;
        (isset ($_COOKIE)) ? $this->_aQueryVar['COOKIE'] = $_COOKIE : FALSE;

        // if queries, split
        if (array_key_exists('QUERY_STRING', $_SERVER)) {
            $this->_sRequestUri = str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
        } else {
            // requested File
            $this->_sRequestUri = $_SERVER['REQUEST_URI'];
        }

        Event::RUN('mvc.request.saved', $this);

        return $this;
    }

    /**
     * prepares query vars for usage
     *
     * @access public
     * @return \MVC\Request
     */
    public function prepareQueryVarsForUsage()
    {
        /*
         * serve simple CLI Requests
         * Allows calling via CLI without any need of a /route/.
         * Write Parameter separated by spaces.
         * When adding JSON in a parameter, encapsulate with single quote `'`
         * Example:
         *		$ export MVC_ENV="develop"; php index.php module=standard c=index m=index a='{"foo":"bar","baz":[1,2,3]}'
         */
        if (php_sapi_name() === 'cli' && !empty($GLOBALS['argv'])) {
            for ($i = 1; $i <= 4; $i++) {
                if (array_key_exists($i, $GLOBALS['argv'])) {
                    $sToken = strtolower(strtok($GLOBALS['argv'][$i], '='));

                    if (
                    in_array(
                        $sToken,
                        array(
                            Registry::get('MVC_GET_PARAM_MODULE'),
                            Registry::get('MVC_GET_PARAM_C'),
                            Registry::get('MVC_GET_PARAM_M'),
                            Registry::get('MVC_GET_PARAM_A')
                        )
                    )
                    ) {
                        $this->_aQueryVar['GET'][$sToken] = substr($GLOBALS['argv'][$i], (strpos($GLOBALS['argv'][$i], '=') + 1), strlen($GLOBALS['argv'][$i]));
                    }
                }
            }
        }

        $aFallback = self::URLQUERYTOARRAY(Registry::get('MVC_ROUTING_FALLBACK'));

        if (array_key_exists('GET', $this->_aQueryVar)) {
            // add standard module if missing
            if (!array_key_exists(Registry::get('MVC_GET_PARAM_MODULE'), $this->_aQueryVar['GET']) || $this->_aQueryVar['GET'][Registry::get('MVC_GET_PARAM_MODULE')] == '') {
                $this->_aQueryVar['GET'][Registry::get('MVC_GET_PARAM_MODULE')] = $aFallback[Registry::get('MVC_GET_PARAM_MODULE')];
            }

            // add standard constroller if missing
            if (!array_key_exists(Registry::get('MVC_GET_PARAM_C'), $this->_aQueryVar['GET']) || $this->_aQueryVar['GET'][Registry::get('MVC_GET_PARAM_C')] == '') {
                $this->_aQueryVar['GET'][Registry::get('MVC_GET_PARAM_C')] = $aFallback[Registry::get('MVC_GET_PARAM_C')];
            }

            // add standard method if missing
            if (!array_key_exists(Registry::get('MVC_GET_PARAM_M'), $this->_aQueryVar['GET']) || $this->_aQueryVar['GET'][Registry::get('MVC_GET_PARAM_M')] == '') {
                $this->_aQueryVar['GET'][Registry::get('MVC_GET_PARAM_M')] = $aFallback[Registry::get('MVC_GET_PARAM_M')];
            }
        } else {
            $this->_aQueryVar['GET'][Registry::get('MVC_GET_PARAM_MODULE')] = $aFallback[Registry::get('MVC_GET_PARAM_MODULE')];
            $this->_aQueryVar['GET'][Registry::get('MVC_GET_PARAM_C')] = $aFallback[Registry::get('MVC_GET_PARAM_C')];
            $this->_aQueryVar['GET'][Registry::get('MVC_GET_PARAM_M')] = $aFallback[Registry::get('MVC_GET_PARAM_M')];
        }

        // capitals at beginning
        $this->_aQueryVar['GET'][Registry::get('MVC_GET_PARAM_MODULE')] = ucfirst($this->_aQueryVar['GET'][Registry::get('MVC_GET_PARAM_MODULE')]);
        $this->_aQueryVar['GET'][Registry::get('MVC_GET_PARAM_C')] = ucfirst($this->_aQueryVar['GET'][Registry::get('MVC_GET_PARAM_C')]);

        Event::RUN('mvc.request.prepared');

        return $this;
    }

    /**
     * converts the string of an url into an associative array
     *
     * @access public
     * @static
     * @param string $sQuery
     * @return array
     */
    public static function URLQUERYTOARRAY($sQuery)
    {
        $aQueryParts = explode('&', $sQuery);

        $aParams = array();
        foreach ($aQueryParts as $sParam) {
            $aItem = explode('=', $sParam);
            $aParams[$aItem[0]] = $aItem[1];
        }

        return $aParams;
    }

    /**
     * Singleton instance
     *
     * @access public
     * @static
     * @return Request
     */
    public static function getInstance()
    {
        if (null === self::$_oInstance) {
            self::$_oInstance = new self ();
        }

        return self::$_oInstance;
    }

    /**
     * makes sure the requested page will be
     * delivered with the correct protocol (http|https)
     *
     * @access public
     * @static
     * @return void
     */
    public static function ENSURECORRECTPROTOCOL()
    {
        // auto redirect to ssl/non ssl
        // only for web frontend, not for cli usage
        if (FALSE === filter_var(Registry::get('MVC_CLI'), FILTER_VALIDATE_BOOLEAN)) {
            $aRequest = self::GETCURRENTREQUEST();
            $aRouting = Registry::get('MVC_ROUTING_CURRENT');

            if (!empty($aRouting)) {
                (isset ($aRouting['ssl'])) ? $sSsl = $aRouting['ssl'] : $sSsl = FALSE;

                if (Helper::DETECTSSL() !== (bool)$sSsl) {
                    (array_key_exists('ssl', $aRouting) && true === (bool)$aRouting['ssl']) ? $sProtocol = 'https://' : $sProtocol = 'http://';
                    Request::REDIRECT($sProtocol . $aRequest['host'] . $aRouting['path'] . ((!array_key_exists('query', $aRequest) ? $aRequest['query'] = '' : FALSE)));
                }
            }
        }
    }

    /**
     * gets current request
     *
     * @access public
     * @static
     * @return array
     */
    public static function GETCURRENTREQUEST()
    {
        $aUriInfo = parse_url(Helper::GETURIPROTOCOL() . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        $aUriInfo['requesturi'] = $_SERVER['REQUEST_URI'];
        $aUriInfo['protocol'] = Helper::GETURIPROTOCOL();
        $aUriInfo['full'] = Helper::GETURIPROTOCOL() . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        return $aUriInfo;
    }

    /**
     * redirects to given URI
     *
     * @access public
     * @static
     * @param string $sLocation
     * @param string $sHeader
     * @return void
     */
    public static function REDIRECT($sLocation, $sHeader = '')
    {
        // source
        $aBacktrace = debug_backtrace();

        (array_key_exists('file', $aBacktrace[0])) ? $sFile = $aBacktrace[0]['file'] : $sFile = '';
        (array_key_exists('line', $aBacktrace[0])) ? $sLine = $aBacktrace[0]['line'] : $sLine = '';
        (array_key_exists('line', $aBacktrace)) ? $sLine = $aBacktrace['line'] : FALSE;

        // standard
        Log::WRITE('Redirect to: ' . $sLocation . ' --> called in: ' . $sFile . ', ' . $sLine);

        // CLI
        if (true === filter_var(Registry::get('MVC_CLI'), FILTER_VALIDATE_BOOLEAN)) {
            echo shell_exec('php index.php "' . $sLocation . '"');
            exit ();
        }

        header('Location: ' . $sLocation);
        exit ();
    }

    /**
     * gets whitelist array
     *
     * @access public
     * @return array
     */
    public function getWhitelistParams()
    {
        return $this->_aWhitelistParams;
    }

    /**
     * gets the request uri
     *
     * @access public
     * @return string request uri
     */
    public function getRequestUri()
    {
        return $this->_sRequestUri;
    }

    /**
     * gets the requested modulename
     *
     * @access public
     * @return string module
     */
    public function getModule()
    {
        $aQuery = $this->getQueryArray();

        if (array_key_exists('GET', $aQuery)) {
            if (array_key_exists(Registry::get('MVC_GET_PARAM_MODULE'), $aQuery['GET'])) {
                return $aQuery['GET'][Registry::get('MVC_GET_PARAM_MODULE')];
            }
        }

        return '';
    }

    /**
     * gets query array
     *
     * @access public
     * @return array
     */
    public function getQueryArray()
    {
        return $this->_aQueryVar;
    }

    /**
     * gets the requested controller name
     *
     * @access public
     * @return string controllername
     */
    public function getController()
    {
        $aQuery = $this->getQueryArray();

        if (array_key_exists('GET', $aQuery)) {
            if (array_key_exists(Registry::get('MVC_GET_PARAM_C'), $aQuery['GET'])) {
                return $aQuery['GET'][Registry::get('MVC_GET_PARAM_C')];
            }
        }

        return '';
    }

    /**
     * gets the requested method name
     *
     * @access public
     * @return string methodname
     */
    public function getMethod()
    {
        $aQuery = $this->getQueryArray();

        if (array_key_exists('GET', $aQuery)) {
            if (array_key_exists(Registry::get('MVC_GET_PARAM_M'), $aQuery['GET'])) {
                return $aQuery['GET'][Registry::get('MVC_GET_PARAM_M')];
            }
        }

        return '';
    }

    /**
     * @param string $sModuleName
     * @return \MVC\Request
     */
    public function setModule($sModuleName = '')
    {
        if ('' !== $sModuleName) {
            $_GET[Registry::get('MVC_GET_PARAM_MODULE')] = $sModuleName;
            $this->saveRequest();
        }

        return $this;
    }

    /**
     * @param string $sControllerName
     * @return \MVC\Request
     */
    public function setController($sControllerName = '')
    {
        if ('' !== $sControllerName) {
            $_GET[Registry::get('MVC_GET_PARAM_C')] = $sControllerName;
            $this->saveRequest();
        }

        return $this;
    }

    /**
     * @param string $sMethodName
     * @return \MVC\Request
     */
    public function setMethod($sMethodName = '')
    {
        if ('' !== $sMethodName) {
            $_GET[Registry::get('MVC_GET_PARAM_M')] = $sMethodName;
            $this->saveRequest();
        }

        return $this;
    }

    /**
     * @param string $sArgument
     * @return \MVC\Request
     */
    public function setArgument($sArgument = '')
    {
        if ('' !== $sArgument) {
            $_GET[Registry::get('MVC_GET_PARAM_A')] = $sArgument;
            $this->saveRequest();
        }

        return $this;
    }

    /**
     * sets whitelist params
     *
     * @access public
     * @param array $aWhitelistParams
     * @return \MVC\Request
     */
    public function setWhitelistParams(array $aWhitelistParams = array())
    {
        $this->_aWhitelistParams = $aWhitelistParams;
        return $this;
    }

    /**
     * prevent any cloning
     *
     * @access private
     * @return void
     */
    private function __clone()
    {
        ;
    }
}
