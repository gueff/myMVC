<?php
/**
 * Request.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;
use MVC\DataType\DTRequestCurrent;

/**
 * Request
 */
class Request
{
    /**
     * gets current request
     * @return \MVC\DataType\DTRequestCurrent
     * @throws \ReflectionException
     */
    public static function getCurrentRequest()
    {
        // run only once
        if (true === Registry::isRegistered('oDTRequestCurrent'))
        {
            $oDTRequestCurrent = Registry::get('oDTRequestCurrent');

            return $oDTRequestCurrent;
        }

        $aUriInfo = parse_url(self::getUriProtocol() . $_SERVER['HTTP_HOST'] . self::getServerRequestUri());
        (false === is_array($aUriInfo)) ? $aUriInfo = array() : false;

        $oDTRequestCurrent = DTRequestCurrent::create($aUriInfo);
        $oDTRequestCurrent->set_requesturi(self::getServerRequestUri());
        $oDTRequestCurrent->set_protocol(self::getUriProtocol());
        $oDTRequestCurrent->set_full(self::getUriProtocol() . $_SERVER['HTTP_HOST'] . self::getServerRequestUri());
        $oDTRequestCurrent->set_requestmethod(Request::getServerRequestMethod());
        $oDTRequestCurrent->set_input(file_get_contents("php://input"));
        $oDTRequestCurrent->set_isSecure(Config::get_MVC_SECURE_REQUEST());
        parse_str($oDTRequestCurrent->get_query(), $aQueryArray);
        $oDTRequestCurrent->set_queryArray($aQueryArray);
        $oDTRequestCurrent->set_headerArray(self::getHeaderArray());
        $oDTRequestCurrent->set_pathParam(self::getPathParam());
        $oDTRequestCurrent->set_ip(self::getIpAddress());

        // if event ...
        Event::bind('mvc.controller.init.before', function(){
            // ... run this event
            Event::run(
                'mvc.request.getCurrentRequest.after',
                DTArrayObject::create()->add_aKeyValue(
                    DTKeyValue::create()
                        ->set_sKey('oDTRequestCurrent')
                        ->set_sValue(Registry::get('oDTRequestCurrent'))
                )
            );
        });

        // save to registry
        Registry::set('oDTRequestCurrent', $oDTRequestCurrent);

        return $oDTRequestCurrent;
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
        Log::write(
            'Redirect to: ' . $sLocation . ' --> called in: ' . $sFile . ', ' . $sLine,
            Config::get_MVC_LOG_FILE_DEFAULT(),
            false
        );

        // CLI
        if (true === self::isCli())
        {
            echo trim((string) shell_exec(Config::get_MVC_BIN_PHP_BINARY() . ' index.php "' . $sLocation . '"'));

            // Event
            \MVC\Event::run('mvc.request.redirect', DTArrayObject::create()
                ->add_aKeyValue(DTKeyValue::create()
                    ->set_sKey('sLocation')
                    ->set_sValue('[CLI] php index.php "' . $sLocation . '"'))
                ->add_aKeyValue(DTKeyValue::create()
                    ->set_sKey('aDebug')
                    ->set_sValue(Debug::prepareBacktraceArray((debug_backtrace()[0] ?? array())))));

            exit ();
        }

        // Event
        \MVC\Event::run('mvc.request.redirect', DTArrayObject::create()
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('sLocation')
                ->set_sValue($sLocation))
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('aDebug')
                ->set_sValue(Debug::prepareBacktraceArray((debug_backtrace()[0] ?? array())))));

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
         * @info detection of cli takes place in /config/_mvc.php
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
         * @info detection of cli takes place in /config/_mvc.php
         */
        if (false === self::isCli())
        {
            return true;
        }

        return false;
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
            $sUrl = self::getCurrentRequest()->get_full();
        }

        $aUrl = parse_url($sUrl);
        $mPath = preg_split('~/~', $aUrl['path'], 0, PREG_SPLIT_NO_EMPTY);
        $aPath = (false === is_array($mPath)) ? array() : $mPath;

        if (true === $bReverse)
        {
            $aPath = array_reverse($aPath);
        }

        return $aPath;
    }

    /**
     * @param $sKey
     * @return array|string
     * @throws \ReflectionException
     */
    public static function getPathParam($sKey = '')
    {
        if (Registry::isRegistered('aPathParam'))
        {
            $aParam = (array) Registry::get('aPathParam');

            if ('' === $sKey)
            {
                return $aParam;
            }

            return (string) get($aParam[$sKey], '');
        }

        $mReturn = (empty($sKey)) ? array() : '';

        return $mReturn;
    }

    /**
     * @param array $aPathParam
     * @return void
     */
    public static function setPathParam(array $aPathParam = array())
    {
        Registry::set('aPathParam', $aPathParam);
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

        if (posix_getuid () != File::info($sIndex)->get_uid())
        {
            $aUser = posix_getpwuid (posix_getuid ());

            die (
                "\n\tERROR\tCLI - access granted for User `" . File::info($sIndex)->get_name() . "` only "
                . "(User `" . $aUser['name'] . "`, uid:" . $aUser['uid'] . ", not granted).\t"
                . __FILE__ . ', ' . __LINE__ . "\n\n"
            );
        }

        self::setServerVarsForCli();
    }

    /**
     * @return void
     */
    public static function setServerVarsForCli()
    {
        (!array_key_exists (1, $GLOBALS['argv'])) ? $GLOBALS['argv'][1] = '' : false;
        $aParseUrl = parse_url ($GLOBALS['argv'][1]);

        $_SERVER = array ();
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = $GLOBALS['argv'][1];
        $_SERVER['REMOTE_ADDR'] = '0.0.0.0';
        $_SERVER['HTTP_HOST'] = 'localhost';
        $_SERVER['SERVER_PORT'] = 80;

        if (array_key_exists ('query', $aParseUrl))
        {
            $_SERVER['QUERY_STRING'] = $aParseUrl['query'];
            parse_str ($aParseUrl['query'], $_GET);
        }
    }

    /**
     * @return array
     */
    public static function getHeaderArray()
    {
        $aHeader = getallheaders();

        if (false === $aHeader)
        {
            return array();
        }

        return $aHeader;
    }

    /**
     * @param $sKey
     * @return string
     */
    public static function getHeader($sKey = '')
    {
        $aHeader = self::getHeaderArray();

        return (string) get($aHeader[$sKey], '');
    }

    /**
     * @return string
     */
    public static function getIpAddress()
    {
        $sIpAddress = isset($_SERVER['HTTP_CLIENT_IP'])
            ? $_SERVER['HTTP_CLIENT_IP']
            : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR']: $_SERVER['REMOTE_ADDR'])
        ;

        return (string) $sIpAddress;
    }

}