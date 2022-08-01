<?php

/**
 * @name $WebbixxDataType
 */
namespace Webbixx\DataType;

class DTConfig
{
	const DTHASH = '0daa8456a41aa5f7e0855fe0037a05ba';

	/**
	 * @var string
	 */
	protected $MVC_ENV;

	/**
	 * @var string
	 */
	protected $MVC_CONFIG_DIR;

	/**
	 * @var integer
	 */
	protected $MVC_DEBUG;

	/**
	 * @var integer
	 */
	protected $MVC_LOG_AUTOLOADER;

	/**
	 * @var string
	 */
	protected $MVC_GET_PARAM_MODULE;

	/**
	 * @var string
	 */
	protected $MVC_GET_PARAM_C;

	/**
	 * @var string
	 */
	protected $MVC_GET_PARAM_M;

	/**
	 * @var string
	 */
	protected $MVC_GET_PARAM_A;

	/**
	 * @var string
	 */
	protected $MVC_ROUTING_HANDLING;

	/**
	 * @var string
	 */
	protected $MVC_ROUTING_JSON_BUILDER;

	/**
	 * @var string
	 */
	protected $MVC_ROUTER_JSON;

	/**
	 * @var string
	 */
	protected $MVC_INTERFACE_ROUTER_JSON;

	/**
	 * @var string
	 */
	protected $MVC_ROUTING_FALLBACK;

	/**
	 * @var string
	 */
	protected $MVC_METHODNAME_PRECONSTRUCT;

	/**
	 * @var string
	 */
	protected $MVC_WEB_ROOT;

	/**
	 * @var string
	 */
	protected $MVC_BASE_PATH;

	/**
	 * @var string
	 */
	protected $MVC_APPLICATION_PATH;

	/**
	 * @var string
	 */
	protected $MVC_PUBLIC_PATH;

	/**
	 * @var string
	 */
	protected $MVC_LOG_FILE_FOLDER;

	/**
	 * @var string
	 */
	protected $MVC_LOG_FILE_DEFAULT;

	/**
	 * @var string
	 */
	protected $MVC_LOG_FILE_ERROR;

	/**
	 * @var string
	 */
	protected $MVC_LOG_FILE_WARNING;

	/**
	 * @var string
	 */
	protected $MVC_LOG_FILE_NOTICE;

	/**
	 * @var string
	 */
	protected $MVC_APPLICATION_CONFIG_DIR;

	/**
	 * @var string
	 */
	protected $MVC_VIEW_TEMPLATES;

	/**
	 * @var string
	 */
	protected $MVC_LIBRARY;

	/**
	 * @var string
	 */
	protected $MVC_MODULES;

	/**
	 * @var string
	 */
	protected $MVC_CACHE_DIR;

	/**
	 * @var integer
	 */
	protected $MVC_SSL_PORT;

	/**
	 * @var integer
	 */
	protected $MVC_SECURE_REQUEST;

	/**
	 * @var string
	 */
	protected $MVC_SESSION_NAMESPACE;

	/**
	 * @var string
	 */
	protected $MVC_SESSION_PATH;

	/**
	 * @var array
	 */
	protected $MVC_SESSION_OPTIONS;

	/**
	 * @var integer
	 */
	protected $MVC_SESSION_ENABLE;

	/**
	 * @var array
	 */
	protected $MVC_REQUEST_WHITELIST_PARAMS;

	/**
	 * @var string
	 */
	protected $MVC_ROUTING_JSON;

	/**
	 * @var integer
	 */
	protected $MVC_CLI;

	/**
	 * @var integer
	 */
	protected $MVC_SMARTY_CACHE_STATUS;

	/**
	 * @var string
	 */
	protected $MVC_SMARTY_CACHE_DIR;

	/**
	 * @var string
	 */
	protected $MVC_SMARTY_TEMPLATE_DIR;

	/**
	 * @var string
	 */
	protected $MVC_SMARTY_TEMPLATE_DEFAULT;

	/**
	 * @var string
	 */
	protected $MVC_SMARTY_TEMPLATE_CACHE_DIR;

	/**
	 * @var array
	 */
	protected $MVC_SMARTY_PLUGINS_DIR;

	/**
	 * @var array
	 */
	protected $MVC_POLICY;

	/**
	 * @var string
	 */
	protected $MVC_UNIQUE_ID;

	/**
	 * @var string
	 */
	protected $MVC_DATATYPE_CONFIG;

	/**
	 * @var string
	 */
	protected $MVC_COMPOSER_DIR;

	/**
	 * @var array
	 */
	protected $MVC_CORE;

	/**
	 * DTConfig constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		\MVC\Event::RUN ('DTConfig.__construct.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_ENV = "develop";
		$this->MVC_CONFIG_DIR = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/config";
		$this->MVC_DEBUG = 1;
		$this->MVC_LOG_AUTOLOADER = 1;
		$this->MVC_GET_PARAM_MODULE = "module";
		$this->MVC_GET_PARAM_C = "c";
		$this->MVC_GET_PARAM_M = "m";
		$this->MVC_GET_PARAM_A = "a";
		$this->MVC_ROUTING_HANDLING = "\MVC\RouterJsonfile";
		$this->MVC_ROUTING_JSON_BUILDER = "\MVC\RouterJsonBuilder";
		$this->MVC_ROUTER_JSON = "\MVC\RouterJson";
		$this->MVC_INTERFACE_ROUTER_JSON = "\MVC\MVCInterface\RouterJson";
		$this->MVC_ROUTING_FALLBACK = "module=Webbixx&c=index&m=notFound";
		$this->MVC_METHODNAME_PRECONSTRUCT = "__preconstruct";
		$this->MVC_WEB_ROOT = ".";
		$this->MVC_BASE_PATH = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git";
		$this->MVC_APPLICATION_PATH = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application";
		$this->MVC_PUBLIC_PATH = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/public";
		$this->MVC_LOG_FILE_FOLDER = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/log/";
		$this->MVC_LOG_FILE_DEFAULT = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/log/default.log";
		$this->MVC_LOG_FILE_ERROR = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/log/error.log";
		$this->MVC_LOG_FILE_WARNING = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/log/warning.log";
		$this->MVC_LOG_FILE_NOTICE = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/log/notice.log";
		$this->MVC_APPLICATION_CONFIG_DIR = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/config";
		$this->MVC_VIEW_TEMPLATES = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/modules/Webbixx/templates";
		$this->MVC_LIBRARY = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/library";
		$this->MVC_MODULES = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/modules";
		$this->MVC_CACHE_DIR = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/cache";
		$this->MVC_SSL_PORT = 443;
		$this->MVC_SECURE_REQUEST = 0;
		$this->MVC_SESSION_NAMESPACE = "myMVC";
		$this->MVC_SESSION_PATH = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/session";
		$this->MVC_SESSION_OPTIONS = array('cookie_httponly'=>true,'auto_start'=>0,'save_path'=>'/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/session','cookie_secure'=>false,'name'=>'myMVC','save_handler'=>'files','cookie_lifetime'=>0,'gc_maxlifetime'=>65535,'gc_probability'=>1,'use_strict_mode'=>1,'use_cookies'=>1,'use_only_cookies'=>1,'upload_progress.enabled'=>1,);
		$this->MVC_SESSION_ENABLE = 0;
		$this->MVC_REQUEST_WHITELIST_PARAMS = array('GET'=>array('module'=>array('regex'=>'/[^[:alnum:]]+/u','length'=>50,),'c'=>array('regex'=>'/[^[:alnum:]]+/u','length'=>50,),'m'=>array('regex'=>'/[^[:alnum:_]]+/u','length'=>50,),'a'=>array('regex'=>'/[^\\p{L}\\p{M}\\p{Z}\\p{S}\\p{N}\\p{Pd}\\p{Pc}\\p{Ps}\\p{Pe}\\p{Pi}\\p{Pf}\\|\']+/u','length'=>256,),),);
		$this->MVC_ROUTING_JSON = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/modules/Webbixx/etc/routing/.myMVC.json";
		$this->MVC_CLI = 1;
		$this->MVC_SMARTY_CACHE_STATUS = 0;
		$this->MVC_SMARTY_CACHE_DIR = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/cache";
		$this->MVC_SMARTY_TEMPLATE_DIR = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/modules/Default/templates";
		$this->MVC_SMARTY_TEMPLATE_DEFAULT = "Frontend/layout/index.tpl";
		$this->MVC_SMARTY_TEMPLATE_CACHE_DIR = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/templates_c";
		$this->MVC_SMARTY_PLUGINS_DIR = array(0=>'/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/smartyPlugins',1=>'/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/modules/Webbixx/etc/smarty',);
		$this->MVC_POLICY = array('\\Webbixx\\Controller\\Index'=>array('index'=>array(0=>'\\Webbixx\\Policy\\Index::policy1',),),);
		$this->MVC_UNIQUE_ID = "62e57627e8e6b";
		$this->MVC_DATATYPE_CONFIG = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/application/config/datatype.php";
		$this->MVC_COMPOSER_DIR = "/media/admin1/811b9852-6f28-4544-aac6-de1b7658b070/home/admin1/htdocs/myMVC.github/_git/myMVC.git/modules/Webbixx/etc/config/Webbixx";
		$this->MVC_CORE = array('version'=>'dev-master','phpExtensionsRequired'=>array(0=>'Core',1=>'ctype',2=>'curl',3=>'date',4=>'dom',5=>'fileinfo',6=>'filter',7=>'iconv',8=>'json',9=>'mbstring',10=>'Phar',11=>'posix',12=>'Reflection',13=>'session',14=>'SimpleXML',15=>'standard',16=>'SPL',),'phpFunctionsRequired'=>array(0=>'mb_strlen',1=>'iconv',2=>'utf8_decode',),);

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		\MVC\Event::RUN ('DTConfig.__construct.after', \MVC\DataType\DTArrayObject::create($aData));
	}

    /**
     * @param array $aData
     * @return DTConfig
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTConfig.create.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));
        
        $oObject = new self($aData);

        \MVC\Event::RUN ('DTConfig.create.after', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('DTConfig')->set_sValue($oObject)));
        
        return $oObject;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_ENV($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_ENV.before', \MVC\DataType\DTArrayObject::create(array('MVC_ENV' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_ENV = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_CONFIG_DIR($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_CONFIG_DIR.before', \MVC\DataType\DTArrayObject::create(array('MVC_CONFIG_DIR' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_CONFIG_DIR = $mValue;

		return $this;
	}

	/**
	 * @param integer $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_DEBUG($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_DEBUG.before', \MVC\DataType\DTArrayObject::create(array('MVC_DEBUG' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_DEBUG = $mValue;

		return $this;
	}

	/**
	 * @param integer $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_LOG_AUTOLOADER($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_LOG_AUTOLOADER.before', \MVC\DataType\DTArrayObject::create(array('MVC_LOG_AUTOLOADER' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_LOG_AUTOLOADER = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_GET_PARAM_MODULE($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_GET_PARAM_MODULE.before', \MVC\DataType\DTArrayObject::create(array('MVC_GET_PARAM_MODULE' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_GET_PARAM_MODULE = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_GET_PARAM_C($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_GET_PARAM_C.before', \MVC\DataType\DTArrayObject::create(array('MVC_GET_PARAM_C' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_GET_PARAM_C = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_GET_PARAM_M($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_GET_PARAM_M.before', \MVC\DataType\DTArrayObject::create(array('MVC_GET_PARAM_M' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_GET_PARAM_M = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_GET_PARAM_A($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_GET_PARAM_A.before', \MVC\DataType\DTArrayObject::create(array('MVC_GET_PARAM_A' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_GET_PARAM_A = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_ROUTING_HANDLING($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_ROUTING_HANDLING.before', \MVC\DataType\DTArrayObject::create(array('MVC_ROUTING_HANDLING' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_ROUTING_HANDLING = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_ROUTING_JSON_BUILDER($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_ROUTING_JSON_BUILDER.before', \MVC\DataType\DTArrayObject::create(array('MVC_ROUTING_JSON_BUILDER' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_ROUTING_JSON_BUILDER = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_ROUTER_JSON($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_ROUTER_JSON.before', \MVC\DataType\DTArrayObject::create(array('MVC_ROUTER_JSON' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_ROUTER_JSON = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_INTERFACE_ROUTER_JSON($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_INTERFACE_ROUTER_JSON.before', \MVC\DataType\DTArrayObject::create(array('MVC_INTERFACE_ROUTER_JSON' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_INTERFACE_ROUTER_JSON = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_ROUTING_FALLBACK($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_ROUTING_FALLBACK.before', \MVC\DataType\DTArrayObject::create(array('MVC_ROUTING_FALLBACK' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_ROUTING_FALLBACK = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_METHODNAME_PRECONSTRUCT($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_METHODNAME_PRECONSTRUCT.before', \MVC\DataType\DTArrayObject::create(array('MVC_METHODNAME_PRECONSTRUCT' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_METHODNAME_PRECONSTRUCT = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_WEB_ROOT($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_WEB_ROOT.before', \MVC\DataType\DTArrayObject::create(array('MVC_WEB_ROOT' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_WEB_ROOT = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_BASE_PATH($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_BASE_PATH.before', \MVC\DataType\DTArrayObject::create(array('MVC_BASE_PATH' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_BASE_PATH = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_APPLICATION_PATH($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_APPLICATION_PATH.before', \MVC\DataType\DTArrayObject::create(array('MVC_APPLICATION_PATH' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_APPLICATION_PATH = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_PUBLIC_PATH($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_PUBLIC_PATH.before', \MVC\DataType\DTArrayObject::create(array('MVC_PUBLIC_PATH' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_PUBLIC_PATH = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_LOG_FILE_FOLDER($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_LOG_FILE_FOLDER.before', \MVC\DataType\DTArrayObject::create(array('MVC_LOG_FILE_FOLDER' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_LOG_FILE_FOLDER = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_LOG_FILE_DEFAULT($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_LOG_FILE_DEFAULT.before', \MVC\DataType\DTArrayObject::create(array('MVC_LOG_FILE_DEFAULT' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_LOG_FILE_DEFAULT = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_LOG_FILE_ERROR($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_LOG_FILE_ERROR.before', \MVC\DataType\DTArrayObject::create(array('MVC_LOG_FILE_ERROR' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_LOG_FILE_ERROR = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_LOG_FILE_WARNING($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_LOG_FILE_WARNING.before', \MVC\DataType\DTArrayObject::create(array('MVC_LOG_FILE_WARNING' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_LOG_FILE_WARNING = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_LOG_FILE_NOTICE($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_LOG_FILE_NOTICE.before', \MVC\DataType\DTArrayObject::create(array('MVC_LOG_FILE_NOTICE' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_LOG_FILE_NOTICE = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_APPLICATION_CONFIG_DIR($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_APPLICATION_CONFIG_DIR.before', \MVC\DataType\DTArrayObject::create(array('MVC_APPLICATION_CONFIG_DIR' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_APPLICATION_CONFIG_DIR = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_VIEW_TEMPLATES($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_VIEW_TEMPLATES.before', \MVC\DataType\DTArrayObject::create(array('MVC_VIEW_TEMPLATES' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_VIEW_TEMPLATES = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_LIBRARY($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_LIBRARY.before', \MVC\DataType\DTArrayObject::create(array('MVC_LIBRARY' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_LIBRARY = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_MODULES($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_MODULES.before', \MVC\DataType\DTArrayObject::create(array('MVC_MODULES' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_MODULES = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_CACHE_DIR($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_CACHE_DIR.before', \MVC\DataType\DTArrayObject::create(array('MVC_CACHE_DIR' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_CACHE_DIR = $mValue;

		return $this;
	}

	/**
	 * @param integer $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_SSL_PORT($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_SSL_PORT.before', \MVC\DataType\DTArrayObject::create(array('MVC_SSL_PORT' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_SSL_PORT = $mValue;

		return $this;
	}

	/**
	 * @param integer $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_SECURE_REQUEST($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_SECURE_REQUEST.before', \MVC\DataType\DTArrayObject::create(array('MVC_SECURE_REQUEST' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_SECURE_REQUEST = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_SESSION_NAMESPACE($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_SESSION_NAMESPACE.before', \MVC\DataType\DTArrayObject::create(array('MVC_SESSION_NAMESPACE' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_SESSION_NAMESPACE = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_SESSION_PATH($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_SESSION_PATH.before', \MVC\DataType\DTArrayObject::create(array('MVC_SESSION_PATH' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_SESSION_PATH = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_SESSION_OPTIONS($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_SESSION_OPTIONS.before', \MVC\DataType\DTArrayObject::create(array('MVC_SESSION_OPTIONS' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_SESSION_OPTIONS = $mValue;

		return $this;
	}

	/**
	 * @param integer $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_SESSION_ENABLE($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_SESSION_ENABLE.before', \MVC\DataType\DTArrayObject::create(array('MVC_SESSION_ENABLE' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_SESSION_ENABLE = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_REQUEST_WHITELIST_PARAMS($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_REQUEST_WHITELIST_PARAMS.before', \MVC\DataType\DTArrayObject::create(array('MVC_REQUEST_WHITELIST_PARAMS' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_REQUEST_WHITELIST_PARAMS = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_ROUTING_JSON($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_ROUTING_JSON.before', \MVC\DataType\DTArrayObject::create(array('MVC_ROUTING_JSON' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_ROUTING_JSON = $mValue;

		return $this;
	}

	/**
	 * @param integer $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_CLI($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_CLI.before', \MVC\DataType\DTArrayObject::create(array('MVC_CLI' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_CLI = $mValue;

		return $this;
	}

	/**
	 * @param integer $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_SMARTY_CACHE_STATUS($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_SMARTY_CACHE_STATUS.before', \MVC\DataType\DTArrayObject::create(array('MVC_SMARTY_CACHE_STATUS' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_SMARTY_CACHE_STATUS = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_SMARTY_CACHE_DIR($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_SMARTY_CACHE_DIR.before', \MVC\DataType\DTArrayObject::create(array('MVC_SMARTY_CACHE_DIR' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_SMARTY_CACHE_DIR = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_SMARTY_TEMPLATE_DIR($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_SMARTY_TEMPLATE_DIR.before', \MVC\DataType\DTArrayObject::create(array('MVC_SMARTY_TEMPLATE_DIR' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_SMARTY_TEMPLATE_DIR = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_SMARTY_TEMPLATE_DEFAULT($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_SMARTY_TEMPLATE_DEFAULT.before', \MVC\DataType\DTArrayObject::create(array('MVC_SMARTY_TEMPLATE_DEFAULT' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_SMARTY_TEMPLATE_DEFAULT = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_SMARTY_TEMPLATE_CACHE_DIR($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_SMARTY_TEMPLATE_CACHE_DIR.before', \MVC\DataType\DTArrayObject::create(array('MVC_SMARTY_TEMPLATE_CACHE_DIR' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_SMARTY_TEMPLATE_CACHE_DIR = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_SMARTY_PLUGINS_DIR($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_SMARTY_PLUGINS_DIR.before', \MVC\DataType\DTArrayObject::create(array('MVC_SMARTY_PLUGINS_DIR' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_SMARTY_PLUGINS_DIR = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_POLICY($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_POLICY.before', \MVC\DataType\DTArrayObject::create(array('MVC_POLICY' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_POLICY = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_UNIQUE_ID($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_UNIQUE_ID.before', \MVC\DataType\DTArrayObject::create(array('MVC_UNIQUE_ID' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_UNIQUE_ID = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_DATATYPE_CONFIG($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_DATATYPE_CONFIG.before', \MVC\DataType\DTArrayObject::create(array('MVC_DATATYPE_CONFIG' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_DATATYPE_CONFIG = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_COMPOSER_DIR($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_COMPOSER_DIR.before', \MVC\DataType\DTArrayObject::create(array('MVC_COMPOSER_DIR' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_COMPOSER_DIR = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_MVC_CORE($mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_MVC_CORE.before', \MVC\DataType\DTArrayObject::create(array('MVC_CORE' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->MVC_CORE = $mValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_ENV()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_ENV.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_ENV')->set_sValue($this->MVC_ENV))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_ENV;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_CONFIG_DIR()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_CONFIG_DIR.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_CONFIG_DIR')->set_sValue($this->MVC_CONFIG_DIR))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_CONFIG_DIR;
	}

	/**
	 * @return integer
	 * @throws \ReflectionException
	 */
	public function get_MVC_DEBUG()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_DEBUG.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_DEBUG')->set_sValue($this->MVC_DEBUG))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_DEBUG;
	}

	/**
	 * @return integer
	 * @throws \ReflectionException
	 */
	public function get_MVC_LOG_AUTOLOADER()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_LOG_AUTOLOADER.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_LOG_AUTOLOADER')->set_sValue($this->MVC_LOG_AUTOLOADER))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_LOG_AUTOLOADER;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_GET_PARAM_MODULE()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_GET_PARAM_MODULE.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_GET_PARAM_MODULE')->set_sValue($this->MVC_GET_PARAM_MODULE))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_GET_PARAM_MODULE;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_GET_PARAM_C()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_GET_PARAM_C.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_GET_PARAM_C')->set_sValue($this->MVC_GET_PARAM_C))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_GET_PARAM_C;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_GET_PARAM_M()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_GET_PARAM_M.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_GET_PARAM_M')->set_sValue($this->MVC_GET_PARAM_M))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_GET_PARAM_M;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_GET_PARAM_A()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_GET_PARAM_A.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_GET_PARAM_A')->set_sValue($this->MVC_GET_PARAM_A))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_GET_PARAM_A;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_ROUTING_HANDLING()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_ROUTING_HANDLING.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_ROUTING_HANDLING')->set_sValue($this->MVC_ROUTING_HANDLING))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_ROUTING_HANDLING;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_ROUTING_JSON_BUILDER()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_ROUTING_JSON_BUILDER.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_ROUTING_JSON_BUILDER')->set_sValue($this->MVC_ROUTING_JSON_BUILDER))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_ROUTING_JSON_BUILDER;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_ROUTER_JSON()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_ROUTER_JSON.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_ROUTER_JSON')->set_sValue($this->MVC_ROUTER_JSON))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_ROUTER_JSON;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_INTERFACE_ROUTER_JSON()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_INTERFACE_ROUTER_JSON.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_INTERFACE_ROUTER_JSON')->set_sValue($this->MVC_INTERFACE_ROUTER_JSON))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_INTERFACE_ROUTER_JSON;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_ROUTING_FALLBACK()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_ROUTING_FALLBACK.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_ROUTING_FALLBACK')->set_sValue($this->MVC_ROUTING_FALLBACK))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_ROUTING_FALLBACK;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_METHODNAME_PRECONSTRUCT()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_METHODNAME_PRECONSTRUCT.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_METHODNAME_PRECONSTRUCT')->set_sValue($this->MVC_METHODNAME_PRECONSTRUCT))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_METHODNAME_PRECONSTRUCT;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_WEB_ROOT()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_WEB_ROOT.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_WEB_ROOT')->set_sValue($this->MVC_WEB_ROOT))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_WEB_ROOT;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_BASE_PATH()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_BASE_PATH.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_BASE_PATH')->set_sValue($this->MVC_BASE_PATH))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_BASE_PATH;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_APPLICATION_PATH()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_APPLICATION_PATH.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_APPLICATION_PATH')->set_sValue($this->MVC_APPLICATION_PATH))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_APPLICATION_PATH;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_PUBLIC_PATH()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_PUBLIC_PATH.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_PUBLIC_PATH')->set_sValue($this->MVC_PUBLIC_PATH))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_PUBLIC_PATH;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_LOG_FILE_FOLDER()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_LOG_FILE_FOLDER.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_LOG_FILE_FOLDER')->set_sValue($this->MVC_LOG_FILE_FOLDER))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_LOG_FILE_FOLDER;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_LOG_FILE_DEFAULT()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_LOG_FILE_DEFAULT.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_LOG_FILE_DEFAULT')->set_sValue($this->MVC_LOG_FILE_DEFAULT))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_LOG_FILE_DEFAULT;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_LOG_FILE_ERROR()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_LOG_FILE_ERROR.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_LOG_FILE_ERROR')->set_sValue($this->MVC_LOG_FILE_ERROR))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_LOG_FILE_ERROR;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_LOG_FILE_WARNING()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_LOG_FILE_WARNING.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_LOG_FILE_WARNING')->set_sValue($this->MVC_LOG_FILE_WARNING))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_LOG_FILE_WARNING;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_LOG_FILE_NOTICE()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_LOG_FILE_NOTICE.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_LOG_FILE_NOTICE')->set_sValue($this->MVC_LOG_FILE_NOTICE))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_LOG_FILE_NOTICE;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_APPLICATION_CONFIG_DIR()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_APPLICATION_CONFIG_DIR.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_APPLICATION_CONFIG_DIR')->set_sValue($this->MVC_APPLICATION_CONFIG_DIR))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_APPLICATION_CONFIG_DIR;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_VIEW_TEMPLATES()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_VIEW_TEMPLATES.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_VIEW_TEMPLATES')->set_sValue($this->MVC_VIEW_TEMPLATES))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_VIEW_TEMPLATES;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_LIBRARY()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_LIBRARY.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_LIBRARY')->set_sValue($this->MVC_LIBRARY))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_LIBRARY;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_MODULES()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_MODULES.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_MODULES')->set_sValue($this->MVC_MODULES))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_MODULES;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_CACHE_DIR()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_CACHE_DIR.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_CACHE_DIR')->set_sValue($this->MVC_CACHE_DIR))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_CACHE_DIR;
	}

	/**
	 * @return integer
	 * @throws \ReflectionException
	 */
	public function get_MVC_SSL_PORT()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_SSL_PORT.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_SSL_PORT')->set_sValue($this->MVC_SSL_PORT))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_SSL_PORT;
	}

	/**
	 * @return integer
	 * @throws \ReflectionException
	 */
	public function get_MVC_SECURE_REQUEST()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_SECURE_REQUEST.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_SECURE_REQUEST')->set_sValue($this->MVC_SECURE_REQUEST))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_SECURE_REQUEST;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_SESSION_NAMESPACE()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_SESSION_NAMESPACE.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_SESSION_NAMESPACE')->set_sValue($this->MVC_SESSION_NAMESPACE))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_SESSION_NAMESPACE;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_SESSION_PATH()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_SESSION_PATH.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_SESSION_PATH')->set_sValue($this->MVC_SESSION_PATH))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_SESSION_PATH;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_MVC_SESSION_OPTIONS()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_SESSION_OPTIONS.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_SESSION_OPTIONS')->set_sValue($this->MVC_SESSION_OPTIONS))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_SESSION_OPTIONS;
	}

	/**
	 * @return integer
	 * @throws \ReflectionException
	 */
	public function get_MVC_SESSION_ENABLE()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_SESSION_ENABLE.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_SESSION_ENABLE')->set_sValue($this->MVC_SESSION_ENABLE))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_SESSION_ENABLE;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_MVC_REQUEST_WHITELIST_PARAMS()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_REQUEST_WHITELIST_PARAMS.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_REQUEST_WHITELIST_PARAMS')->set_sValue($this->MVC_REQUEST_WHITELIST_PARAMS))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_REQUEST_WHITELIST_PARAMS;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_ROUTING_JSON()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_ROUTING_JSON.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_ROUTING_JSON')->set_sValue($this->MVC_ROUTING_JSON))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_ROUTING_JSON;
	}

	/**
	 * @return integer
	 * @throws \ReflectionException
	 */
	public function get_MVC_CLI()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_CLI.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_CLI')->set_sValue($this->MVC_CLI))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_CLI;
	}

	/**
	 * @return integer
	 * @throws \ReflectionException
	 */
	public function get_MVC_SMARTY_CACHE_STATUS()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_SMARTY_CACHE_STATUS.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_SMARTY_CACHE_STATUS')->set_sValue($this->MVC_SMARTY_CACHE_STATUS))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_SMARTY_CACHE_STATUS;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_SMARTY_CACHE_DIR()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_SMARTY_CACHE_DIR.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_SMARTY_CACHE_DIR')->set_sValue($this->MVC_SMARTY_CACHE_DIR))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_SMARTY_CACHE_DIR;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_SMARTY_TEMPLATE_DIR()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_SMARTY_TEMPLATE_DIR.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_SMARTY_TEMPLATE_DIR')->set_sValue($this->MVC_SMARTY_TEMPLATE_DIR))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_SMARTY_TEMPLATE_DIR;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_SMARTY_TEMPLATE_DEFAULT()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_SMARTY_TEMPLATE_DEFAULT.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_SMARTY_TEMPLATE_DEFAULT')->set_sValue($this->MVC_SMARTY_TEMPLATE_DEFAULT))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_SMARTY_TEMPLATE_DEFAULT;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_SMARTY_TEMPLATE_CACHE_DIR()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_SMARTY_TEMPLATE_CACHE_DIR.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_SMARTY_TEMPLATE_CACHE_DIR')->set_sValue($this->MVC_SMARTY_TEMPLATE_CACHE_DIR))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_SMARTY_TEMPLATE_CACHE_DIR;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_MVC_SMARTY_PLUGINS_DIR()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_SMARTY_PLUGINS_DIR.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_SMARTY_PLUGINS_DIR')->set_sValue($this->MVC_SMARTY_PLUGINS_DIR))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_SMARTY_PLUGINS_DIR;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_MVC_POLICY()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_POLICY.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_POLICY')->set_sValue($this->MVC_POLICY))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_POLICY;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_UNIQUE_ID()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_UNIQUE_ID.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_UNIQUE_ID')->set_sValue($this->MVC_UNIQUE_ID))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_UNIQUE_ID;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_DATATYPE_CONFIG()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_DATATYPE_CONFIG.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_DATATYPE_CONFIG')->set_sValue($this->MVC_DATATYPE_CONFIG))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_DATATYPE_CONFIG;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_MVC_COMPOSER_DIR()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_COMPOSER_DIR.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_COMPOSER_DIR')->set_sValue($this->MVC_COMPOSER_DIR))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_COMPOSER_DIR;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_MVC_CORE()
	{
		\MVC\Event::RUN ('DTConfig.get_MVC_CORE.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('MVC_CORE')->set_sValue($this->MVC_CORE))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->MVC_CORE;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_ENV()
	{
        return 'MVC_ENV';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_CONFIG_DIR()
	{
        return 'MVC_CONFIG_DIR';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_DEBUG()
	{
        return 'MVC_DEBUG';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_LOG_AUTOLOADER()
	{
        return 'MVC_LOG_AUTOLOADER';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_GET_PARAM_MODULE()
	{
        return 'MVC_GET_PARAM_MODULE';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_GET_PARAM_C()
	{
        return 'MVC_GET_PARAM_C';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_GET_PARAM_M()
	{
        return 'MVC_GET_PARAM_M';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_GET_PARAM_A()
	{
        return 'MVC_GET_PARAM_A';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_ROUTING_HANDLING()
	{
        return 'MVC_ROUTING_HANDLING';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_ROUTING_JSON_BUILDER()
	{
        return 'MVC_ROUTING_JSON_BUILDER';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_ROUTER_JSON()
	{
        return 'MVC_ROUTER_JSON';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_INTERFACE_ROUTER_JSON()
	{
        return 'MVC_INTERFACE_ROUTER_JSON';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_ROUTING_FALLBACK()
	{
        return 'MVC_ROUTING_FALLBACK';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_METHODNAME_PRECONSTRUCT()
	{
        return 'MVC_METHODNAME_PRECONSTRUCT';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_WEB_ROOT()
	{
        return 'MVC_WEB_ROOT';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_BASE_PATH()
	{
        return 'MVC_BASE_PATH';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_APPLICATION_PATH()
	{
        return 'MVC_APPLICATION_PATH';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_PUBLIC_PATH()
	{
        return 'MVC_PUBLIC_PATH';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_LOG_FILE_FOLDER()
	{
        return 'MVC_LOG_FILE_FOLDER';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_LOG_FILE_DEFAULT()
	{
        return 'MVC_LOG_FILE_DEFAULT';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_LOG_FILE_ERROR()
	{
        return 'MVC_LOG_FILE_ERROR';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_LOG_FILE_WARNING()
	{
        return 'MVC_LOG_FILE_WARNING';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_LOG_FILE_NOTICE()
	{
        return 'MVC_LOG_FILE_NOTICE';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_APPLICATION_CONFIG_DIR()
	{
        return 'MVC_APPLICATION_CONFIG_DIR';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_VIEW_TEMPLATES()
	{
        return 'MVC_VIEW_TEMPLATES';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_LIBRARY()
	{
        return 'MVC_LIBRARY';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_MODULES()
	{
        return 'MVC_MODULES';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_CACHE_DIR()
	{
        return 'MVC_CACHE_DIR';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_SSL_PORT()
	{
        return 'MVC_SSL_PORT';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_SECURE_REQUEST()
	{
        return 'MVC_SECURE_REQUEST';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_SESSION_NAMESPACE()
	{
        return 'MVC_SESSION_NAMESPACE';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_SESSION_PATH()
	{
        return 'MVC_SESSION_PATH';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_SESSION_OPTIONS()
	{
        return 'MVC_SESSION_OPTIONS';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_SESSION_ENABLE()
	{
        return 'MVC_SESSION_ENABLE';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_REQUEST_WHITELIST_PARAMS()
	{
        return 'MVC_REQUEST_WHITELIST_PARAMS';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_ROUTING_JSON()
	{
        return 'MVC_ROUTING_JSON';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_CLI()
	{
        return 'MVC_CLI';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_SMARTY_CACHE_STATUS()
	{
        return 'MVC_SMARTY_CACHE_STATUS';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_SMARTY_CACHE_DIR()
	{
        return 'MVC_SMARTY_CACHE_DIR';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_SMARTY_TEMPLATE_DIR()
	{
        return 'MVC_SMARTY_TEMPLATE_DIR';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_SMARTY_TEMPLATE_DEFAULT()
	{
        return 'MVC_SMARTY_TEMPLATE_DEFAULT';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_SMARTY_TEMPLATE_CACHE_DIR()
	{
        return 'MVC_SMARTY_TEMPLATE_CACHE_DIR';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_SMARTY_PLUGINS_DIR()
	{
        return 'MVC_SMARTY_PLUGINS_DIR';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_POLICY()
	{
        return 'MVC_POLICY';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_UNIQUE_ID()
	{
        return 'MVC_UNIQUE_ID';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_DATATYPE_CONFIG()
	{
        return 'MVC_DATATYPE_CONFIG';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_COMPOSER_DIR()
	{
        return 'MVC_COMPOSER_DIR';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_MVC_CORE()
	{
        return 'MVC_CORE';
	}

}
