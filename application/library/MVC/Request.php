<?php
/**
 * Request.php
 * @package   myMVC
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <info@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;

/**
 * Request
 */
class Request
{
    /**
     * Request
     * @deprecated
     * @var Request
     */
    protected static $_oInstance;

    /**
     * @deprecated use: Request::init()
     * Request constructor.
     * @throws \ReflectionException
     */
    protected function __construct()
    {
        $this->saveRequest();
        $this->prepareQueryVarsForUsage();
    }

    /**
     * @deprecated
     * prevent any cloning
     * @access protected
     * @return void
     */
    protected function __clone()
    {
        ;
    }

    /**
     * @deprecated use: Request::init()
     * Singleton instance
     * @return \MVC\Request
     */
    public static function getInstance()
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self ();
        }

        return self::$_oInstance;
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function init()
    {
        self::save();
        self::prepare();
    }

    /**
     * @deprecated use: Request::save()
     * @return $this
     * @throws \ReflectionException
     */
    public function saveRequest()
    {
        self::save();

        return $this;
    }

    /**
     * reads the HTTP Request and saves request + query separated
     * @return void
     * @throws \ReflectionException
     */
    public static function save()
    {
        $aQueryvar = self::getQueryVarArray();

        // sanitize + save GET
        if (isset ($_GET))
        {
            foreach ($_GET as $sKey => $sValue)
            {
                if (array_key_exists($sKey, Config::get_MVC_REQUEST_WHITELIST_PARAMS()['GET']))
                {
                    $sSub = mb_substr($sValue, 0, Config::get_MVC_REQUEST_WHITELIST_PARAMS()['GET'][$sKey]['length'], 'UTF8');
                    $sTrim = trim($sSub);

                    $aQueryvar['GET'][$sKey] = preg_replace(Config::get_MVC_REQUEST_WHITELIST_PARAMS()['GET'][$sKey]['regex'], '', $sTrim);
                }
            }
        }

        // etc
        (isset ($_POST))
            ? $aQueryvar['POST'] = $_POST
            : false;
        (isset ($_COOKIE))
            ? $aQueryvar['COOKIE'] = $_COOKIE
            : false;

        // save
        self::setQueryVarArray($aQueryvar);

        Event::run('mvc.request.saveRequest.after', DTArrayObject::create()
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('MVC_REQUEST_QUERYVAR')
                ->set_sValue(self::getQueryVarArray()))
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('REQUEST_URI')
                ->set_sValue(self::getServerRequestUri())));
    }

    /**
     * @return array|mixed
     * @throws \ReflectionException
     */
    public static function getQueryVarArray()
    {
        return Config::get_MVC_REQUEST_QUERYVAR();
    }

    /**
     * @param array $aQueryVar
     * @return void
     */
    public static function setQueryVarArray(array $aQueryVar = array())
    {
        Config::set_MVC_REQUEST_QUERYVAR($aQueryVar);
    }

    /**
     * @deprecated use: Request::prepare()
     * @return $this
     * @throws \ReflectionException
     */
    public function prepareQueryVarsForUsage()
    {
        self::prepare();

        return $this;
    }

    /**
     * prepares query vars for usage
     * @return void
     * @throws \ReflectionException
     */
    public static function prepare()
    {
        $aQueryvar = self::getQueryVarArray();

        /*
         * serve simple CLI Requests
         * Allows calling via CLI without any need of a /route/.
         * Write Parameter separated by spaces.
         * When adding JSON in a parameter, encapsulate with single quote `'`
         * Example:
         *		$ export MVC_ENV="develop"; php index.php module=standard c=index m=index a='{"foo":"bar","baz":[1,2,3]}'
         */
        if (true === self::isCli() && !empty($GLOBALS['argv']))
        {
            for ($i = 1; $i <= 4; $i++)
            {
                if (array_key_exists($i, $GLOBALS['argv']))
                {
                    $sToken = strtolower(strtok($GLOBALS['argv'][$i], '='));

                    if (in_array($sToken, array(
                            Config::get_MVC_GET_PARAM_MODULE(),
                            Config::get_MVC_GET_PARAM_C(),
                            Config::get_MVC_GET_PARAM_M(),
                            Config::get_MVC_GET_PARAM_A(),
                        )))
                    {
                        $aQueryvar['GET'][$sToken] = substr($GLOBALS['argv'][$i], (strpos($GLOBALS['argv'][$i], '=') + 1), strlen($GLOBALS['argv'][$i]));
                    }
                }
            }
        }

        $aFallback = self::urlQueryToArray(Router::getRoutingFallback());

        if (array_key_exists('GET', $aQueryvar))
        {
            // add standard module if missing
            if (!array_key_exists(Config::get_MVC_GET_PARAM_MODULE(), $aQueryvar['GET']) || $aQueryvar['GET'][Config::get_MVC_GET_PARAM_MODULE()] == '')
            {
                $aQueryvar['GET'][Config::get_MVC_GET_PARAM_MODULE()] = $aFallback[Config::get_MVC_GET_PARAM_MODULE()];
            }

            // add standard controller if missing
            if (!array_key_exists(Config::get_MVC_GET_PARAM_C(), $aQueryvar['GET']) || $aQueryvar['GET'][Config::get_MVC_GET_PARAM_C()] == '')
            {
                $aQueryvar['GET'][Config::get_MVC_GET_PARAM_C()] = $aFallback[Config::get_MVC_GET_PARAM_C()];
            }

            // add standard method if missing
            if (!array_key_exists(Config::get_MVC_GET_PARAM_M(), $aQueryvar['GET']) || $aQueryvar['GET'][Config::get_MVC_GET_PARAM_M()] == '')
            {
                $aQueryvar['GET'][Config::get_MVC_GET_PARAM_M()] = $aFallback[Config::get_MVC_GET_PARAM_M()];
            }
        }
        else
        {
            $aQueryvar['GET'][Config::get_MVC_GET_PARAM_MODULE()] = $aFallback[Config::get_MVC_GET_PARAM_MODULE()];
            $aQueryvar['GET'][Config::get_MVC_GET_PARAM_C()] = $aFallback[Config::get_MVC_GET_PARAM_C()];
            $aQueryvar['GET'][Config::get_MVC_GET_PARAM_M()] = $aFallback[Config::get_MVC_GET_PARAM_M()];
        }

        // capitals at beginning
        $aQueryvar['GET'][Config::get_MVC_GET_PARAM_MODULE()] = ucfirst($aQueryvar['GET'][Config::get_MVC_GET_PARAM_MODULE()]);
        $aQueryvar['GET'][Config::get_MVC_GET_PARAM_C()] = ucfirst($aQueryvar['GET'][Config::get_MVC_GET_PARAM_C()]);

        // save
        self::setQueryVarArray($aQueryvar);

        Event::run('mvc.request.prepareQueryVarsForUsage.after', DTArrayObject::create()
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('_aQueryVar')
                ->set_sValue(self::getQueryVarArray())));
    }

    /**
     * converts the string of an url into an associative array
     * @access public
     * @static
     * @param string $sQuery
     * @return array
     */
    public static function urlQueryToArray($sQuery = '')
    {
        $aQueryPart = array_filter(explode('&', $sQuery));
        $aParam = array();

        foreach ($aQueryPart as $sParam)
        {
            $aItem = explode('=', $sParam);
            $aParam[$aItem[0]] = $aItem[1];
        }

        return $aParam;
    }

    /**
     * makes sure the requested page will be
     * delivered with the correct protocol (http|https)
     * @return void
     * @throws \ReflectionException
     */
    public static function ensureCorrectProtocol()
    {
        // auto redirect to ssl/non ssl
        // only for web frontend, not for cli usage
        if (true === self::isHttp())
        {
            $aRequest = self::getCurrentRequest();
            $aRouting = Router::getRoutingCurrent();

            if (!empty($aRouting))
            {
                (isset ($aRouting['ssl']))
                    ? $sSsl = $aRouting['ssl']
                    : $sSsl = false;

                if (Helper::detectSsl() !== (bool)$sSsl)
                {
                    (array_key_exists('ssl', $aRouting) && true === (bool)$aRouting['ssl'])
                        ? $sProtocol = 'https://'
                        : $sProtocol = 'http://';
                    self::redirect($sProtocol . $aRequest['host'] . $aRouting['path'] . ((!array_key_exists('query', $aRequest)
                            ? $aRequest['query'] = ''
                            : false)));
                }
            }
        }
    }

    /**
     * gets current request
     * @return array
     * @throws \ReflectionException
     */
    public static function getCurrentRequest()
    {
        $aUriInfo = parse_url(self::getUriProtocol() . $_SERVER['HTTP_HOST'] . self::getServerRequestUri());
        (false === is_array($aUriInfo)) ? $aUriInfo = array() : false;
        $aUriInfo['requesturi'] = self::getServerRequestUri();
        $aUriInfo['protocol'] = self::getUriProtocol();
        $aUriInfo['full'] = self::getUriProtocol() . $_SERVER['HTTP_HOST'] . self::getServerRequestUri();

        return $aUriInfo;
    }

    /**
     * gets the http uri protocol
     * @param null $mSsl
     * @return string
     * @throws \ReflectionException
     */
    public static function getUriProtocol($mSsl = null)
    {
        // detect on ssl or not
        if (isset ($mSsl))
        {
            // http
            if ((int)$mSsl === 0 || $mSsl == false)
            {
                return 'http://';
            }
            // https
            elseif ((int)$mSsl === 1 || $mSsl == true)
            {
                return 'https://';
            }
        }
        // autodetect
        else
        {
            // http
            if (self::detectSsl() === false)
            {
                return 'http://';
            }
            // http
            elseif (self::detectSsl() === true)
            {
                return 'https://';
            }
        }

        \MVC\Event::run('mvc.error', DTArrayObject::create()
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('sMessage')
                ->set_sValue('could not detect protocol of requested page.')));

        return '';
    }

    /**
     * check page is running in ssl mode
     * @return bool|mixed
     * @throws \ReflectionException
     */
    public static function detectSsl()
    {
        if (!empty(Config::get_MVC_SECURE_REQUEST()))
        {
            return Config::get_MVC_SECURE_REQUEST();
        }

        return (
            (array_key_exists('HTTPS', $_SERVER) && strtolower($_SERVER['HTTPS']) !== 'off')
            || $_SERVER['SERVER_PORT'] == Config::get_MVC_SSL_PORT()
        );
    }

    /**
     * redirects to given URI
     * @param $sLocation
     * @throws \ReflectionException
     */
    public static function redirect($sLocation)
    {
        // source
        $aBacktrace = debug_backtrace();

        (array_key_exists('file', $aBacktrace[0]))
            ? $sFile = $aBacktrace[0]['file']
            : $sFile = '';
        (array_key_exists('line', $aBacktrace[0]))
            ? $sLine = $aBacktrace[0]['line']
            : $sLine = '';
        (array_key_exists('line', $aBacktrace))
            ? $sLine = $aBacktrace['line']
            : false;

        // standard
        Log::write('Redirect to: ' . $sLocation . ' --> called in: ' . $sFile . ', ' . $sLine);

        // CLI
        if (true === self::isCli())
        {
            echo shell_exec('php index.php "' . $sLocation . '"');

            // Event
            \MVC\Event::run('mvc.request.redirect', DTArrayObject::create()
                ->add_aKeyValue(DTKeyValue::create()
                    ->set_sKey('sLocation')
                    ->set_sValue('[CLI] php index.php "' . $sLocation . '"'))
                ->add_aKeyValue(DTKeyValue::create()
                    ->set_sKey('aDebug')
                    ->set_sValue(Helper::prepareBacktraceArray((debug_backtrace()[0] ?? array())))));

            exit ();
        }

        // Event
        \MVC\Event::run('mvc.request.redirect', DTArrayObject::create()
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('sLocation')
                ->set_sValue($sLocation))
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('aDebug')
                ->set_sValue(Helper::prepareBacktraceArray((debug_backtrace()[0] ?? array())))));

        header('Location: ' . $sLocation);
        exit ();
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public static function isCli()
    {
        /*
         * @info detection of cli takes place in /config/_myMVC.php
         */
        if (true === Config::get_MVC_CLI())
        {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public static function isHttp()
    {
        /*
         * @info detection of cli takes place in /config/_myMVC.php
         */
        if (false === self::isCli())
        {
            return true;
        }

        return false;
    }

    /**
     * gets whitelist array
     * @deprecated use: Config::get_MVC_REQUEST_WHITELIST_PARAMS()
     * @return array|mixed
     * @throws \ReflectionException
     */
    public function getWhitelistParams()
    {
        return Config::get_MVC_REQUEST_WHITELIST_PARAMS();
    }

    /**
     * gets the request uri
     * @deprecated use: Request::getServerRequestUri()
     * @access public
     * @return string request uri
     */
    public function getRequestUri()
    {
        return self::getServerRequestUri();
    }

    /**
     * @return string
     */
    public static function getServerRequestUri()
    {
        $sRequestUri = (array_key_exists ('REQUEST_URI', $_SERVER) ? (string) $_SERVER['REQUEST_URI'] : '');

        return $sRequestUri;
    }

    /**
     * @return string
     */
    public static function getServerRequestMethod()
    {
        $sRequestMethod = (array_key_exists ('REQUEST_METHOD', $_SERVER) ? (string) $_SERVER['REQUEST_METHOD'] : '');

        return $sRequestMethod;
    }

    /**
     * identify target class
     * @return string
     * @throws \ReflectionException
     */
    public static function getTargetClass()
    {
        $aQueryArray = self::getQueryVarArray();

        // identify target class
        $sClass = '\\' . $aQueryArray['GET'][Config::get_MVC_GET_PARAM_MODULE()] . '\\Controller\\' . $aQueryArray['GET'][Config::get_MVC_GET_PARAM_C()];

        return $sClass;
    }

    /**
     * identify target class as file
     * @return string
     * @throws \ReflectionException
     */
    public static function getTargetClassFile()
    {
        $sClass = self::getTargetClass();
        $sFile = Config::get_MVC_MODULES() . str_replace ('\\', '/', $sClass) . '.php';

        return $sFile;
    }

    /**
     * @example '/foo/bar/baz/'
     *          array(3) {[0]=> string(3) "foo" [1]=> string(3) "bar" [2]=> string(3) "baz"}
     * @param $sUrl
     * @param $bReverse
     * @return array
     * @throws \ReflectionException
     */
    public static function getPathArray($sUrl = '', $bReverse = false)
    {
        if ('' === $sUrl)
        {
            $sUrl = self::getCurrentRequest()['full'];
        }

        $aUrl = parse_url($sUrl);
        $mPath = preg_split('~/~', $aUrl['path'], NULL, PREG_SPLIT_NO_EMPTY);
        $aPath = (false === is_array($mPath)) ? array() : $mPath;

        if (true === $bReverse)
        {
            $aPath = array_reverse($aPath);
        }

        return $aPath;
    }

    /**
     * gets the requested modulename
     * @deprecated use: Request::getModuleName()
     * @return mixed|string
     * @throws \ReflectionException
     */
    public function getModule()
    {
        return self::getModuleName();
    }

    /**
     * @return mixed|string
     * @throws \ReflectionException
     */
    public static function getModuleName()
    {
        $aQuery = self::getQueryVarArray();

        if (array_key_exists('GET', $aQuery))
        {
            if (array_key_exists(Config::get_MVC_GET_PARAM_MODULE(), $aQuery['GET']))
            {
                return $aQuery['GET'][Config::get_MVC_GET_PARAM_MODULE()];
            }
        }

        return '';
    }

    /**
     * gets query array
     * @deprecated use: Request::getQueryVarArray();
     * @return void
     * @throws \ReflectionException
     */
    public function getQueryArray()
    {
        return self::getQueryVarArray();
    }

    /**
     * gets the requested controller name
     * @deprecated use: Request::getControllerName()
     * @return string
     * @throws \ReflectionException
     */
    public function getController()
    {
        return self::getControllerName();
    }

    /**
     * gets the requested controller name
     * @return string
     * @throws \ReflectionException
     */
    public static function getControllerName()
    {
        $aQuery = self::getQueryVarArray();

        if (array_key_exists('GET', $aQuery))
        {
            if (array_key_exists(Config::get_MVC_GET_PARAM_C(), $aQuery['GET']))
            {
                return (string) $aQuery['GET'][Config::get_MVC_GET_PARAM_C()];
            }
        }

        return '';
    }

    /**
     * gets the requested method name
     * @deprecated use Request::getMethodName()
     * @return mixed|string
     * @throws \ReflectionException
     */
    public function getMethod()
    {
        return self::getMethodName();
    }

    /**
     * gets the requested method name
     * @return string
     * @throws \ReflectionException
     */
    public static function getMethodName()
    {
        $aQuery = self::getQueryVarArray();

        if (array_key_exists('GET', $aQuery))
        {
            if (array_key_exists(Config::get_MVC_GET_PARAM_M(), $aQuery['GET']))
            {
                return (string) $aQuery['GET'][Config::get_MVC_GET_PARAM_M()];
            }
        }

        return '';
    }

    /**
     * @deprecated use: Request::setModuleName()
     * @param string $sModuleName
     * @return $this
     * @throws \ReflectionException
     */
    public function setModule($sModuleName = '')
    {
        self::setModuleName($sModuleName);

        return $this;
    }

    /**
     * @param $sModuleName
     * @return void
     * @throws \ReflectionException
     */
    public static function setModuleName($sModuleName = '')
    {
        if ('' !== $sModuleName)
        {
            $_GET[Config::get_MVC_GET_PARAM_MODULE()] = $sModuleName;
            self::save();
        }
    }

    /**
     * @deprecated use: Request::setControllerName()
     * @param string $sControllerName
     * @return $this
     * @throws \ReflectionException
     */
    public function setController($sControllerName = '')
    {
        self::setControllerName($sControllerName);

        return $this;
    }

    /**
     * @param $sControllerName
     * @return void
     * @throws \ReflectionException
     */
    public static function setControllerName($sControllerName = '')
    {
        if ('' !== $sControllerName)
        {
            $_GET[Config::get_MVC_GET_PARAM_C()] = $sControllerName;
            self::save();
        }
    }

    /**
     * @deprecated use: Request::setMethodName()
     * @param string $sMethodName
     * @return $this
     * @throws \ReflectionException
     */
    public function setMethod($sMethodName = '')
    {
        self::setMethodName($sMethodName);

        return $this;
    }

    /**
     * @param $sMethodName
     * @return void
     * @throws \ReflectionException
     */
    public static function setMethodName($sMethodName = '')
    {
        if ('' !== $sMethodName)
        {
            $_GET[Config::get_MVC_GET_PARAM_M()] = $sMethodName;
            self::save();
        }
    }

    /**
     * @deprecated use: Request::setArgumentValue()
     * @param string $sArgument
     * @return $this
     * @throws \ReflectionException
     */
    public function setArgument($sArgument = '')
    {
        self::setArgumentValue($sArgument);

        return $this;
    }

    /**
     * @param $sArgument
     * @return void
     * @throws \ReflectionException
     */
    public static function setArgumentValue($sArgument = '')
    {
        if ('' !== $sArgument)
        {
            $_GET[Config::get_MVC_GET_PARAM_A()] = $sArgument;
            self::save();
        }
    }

    /**
     * sets whitelist params
     * @param array $aWhitelistParam
     * @return void
     */
    public static function setWhitelistParamArray(array $aWhitelistParam = array())
    {
        Config::set_MVC_REQUEST_WHITELIST_PARAMS($aWhitelistParam);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function handleFallback()
    {
        // set routing current from fallback if empty
        if (true === empty(Router::getRoutingCurrent()))
        {
            $sIndex = Router::getRouteIndexOnKey('query', Router::getRoutingFallback());
            #$oRoute = Router::getRouteObjectByIndex($sIndex);

            $oDTArrayObject = DTArrayObject::create();
            $oDTArrayObject->add_aKeyValue(DTKeyValue::create()->set_sKey('sRequest')->set_sValue(self::getServerRequestUri()));
            $oDTArrayObject->add_aKeyValue(DTKeyValue::create()->set_sKey('sForward')->set_sValue(null));

            if (false === empty($sIndex))
            {
                Router::setRoutingCurrent(Router::getRouting()[$sIndex]);
                $oDTArrayObject->setDTKeyValueByKey(DTKeyValue::create()->set_sKey('sForward')->set_sValue($sIndex));
            }

            Event::run (
                'mvc.request.handleFallback.after',
                $oDTArrayObject
            );
        }
    }

    /**
     * enables using myMvc via commandline
     * example usage
     * 		$ php index.php "/"
     */
    public static function cliWrapper ()
    {
        // check user/file permission
        $sIndex = realpath (__DIR__ . '/../../../public') . '/index.php';

        if (posix_getuid () != File::getFileInfo($sIndex, 'uid'))
        {
            $aUser = posix_getpwuid (posix_getuid ());
            $aFileInfo = File::getFileInfo($sIndex);

            die (
                "\n\tERROR\tCLI - access granted for User `" . $aFileInfo['name'] . "` only "
                . "(User `" . $aUser['name'] . "`, uid:" . $aUser['uid'] . ", not granted).\t"
                . __FILE__ . ', ' . __LINE__ . "\n\n"
            );
        }

        (!array_key_exists (1, $GLOBALS['argv'])) ? $GLOBALS['argv'][1] = '' : false;
        $aParseUrl = parse_url ($GLOBALS['argv'][1]);

        $_SERVER = array ();
        $_SERVER['REQUEST_URI'] = $GLOBALS['argv'][1];
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        $_SERVER['HTTP_HOST'] = 'localhost';

        if (array_key_exists ('query', $aParseUrl))
        {
            $_SERVER['QUERY_STRING'] = $aParseUrl['query'];
            parse_str ($aParseUrl['query'], $_GET);
        }
    }
}