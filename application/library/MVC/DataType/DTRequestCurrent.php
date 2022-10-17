<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\MVCTrait\TraitDataType;

class DTRequestCurrent
{
	use TraitDataType;

	const DTHASH = '7f3f9a46bb543c77b09da2575bc91d2f';

	/**
	 * @required false
	 * @var string
	 */
	protected $scheme;

	/**
	 * @required false
	 * @var string
	 */
	protected $host;

	/**
	 * @required false
	 * @var array
	 */
	protected $path;

	/**
	 * @required false
	 * @var string
	 */
	protected $query;

	/**
	 * @required false
	 * @var array
	 */
	protected $queryArray;

	/**
	 * @required false
	 * @var string
	 */
	protected $requesturi;

	/**
	 * @required false
	 * @var string
	 */
	protected $requestmethod;

	/**
	 * @required false
	 * @var string
	 */
	protected $protocol;

	/**
	 * @required false
	 * @var string
	 */
	protected $full;

	/**
	 * @required false
	 * @var string
	 */
	protected $input;

	/**
	 * @required false
	 * @var bool
	 */
	protected $isSecure;

	/**
	 * @required false
	 * @var array
	 */
	protected $headerArray;

	/**
	 * @required false
	 * @var array
	 */
	protected $pathParam;

	/**
	 * @required false
	 * @var string
	 */
	protected $ip;

	/**
	 * DTRequestCurrent constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		\MVC\Event::RUN ('DTRequestCurrent.__construct.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->scheme = '';
		$this->host = '';
		$this->path = array();
		$this->query = '';
		$this->queryArray = array();
		$this->requesturi = '';
		$this->requestmethod = '';
		$this->protocol = '';
		$this->full = '';
		$this->input = '';
		$this->isSecure = false;
		$this->headerArray = array();
		$this->pathParam = array();
		$this->ip = '';

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		\MVC\Event::RUN ('DTRequestCurrent.__construct.after', \MVC\DataType\DTArrayObject::create($aData));
	}

    /**
     * @param array $aData
     * @return DTRequestCurrent
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTRequestCurrent.create.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));
        
        $oObject = new self($aData);

        \MVC\Event::RUN ('DTRequestCurrent.create.after', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('DTRequestCurrent')->set_sValue($oObject)));
        
        return $oObject;
    }

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_scheme($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_scheme.before', \MVC\DataType\DTArrayObject::create(array('scheme' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->scheme = $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_host($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_host.before', \MVC\DataType\DTArrayObject::create(array('host' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->host = $aValue;

		return $this;
	}

	/**
	 * @param array $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_path($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_path.before', \MVC\DataType\DTArrayObject::create(array('path' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->path = $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_query($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_query.before', \MVC\DataType\DTArrayObject::create(array('query' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->query = $aValue;

		return $this;
	}

	/**
	 * @param array $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_queryArray($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_queryArray.before', \MVC\DataType\DTArrayObject::create(array('queryArray' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->queryArray = $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_requesturi($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_requesturi.before', \MVC\DataType\DTArrayObject::create(array('requesturi' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->requesturi = $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_requestmethod($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_requestmethod.before', \MVC\DataType\DTArrayObject::create(array('requestmethod' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->requestmethod = $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_protocol($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_protocol.before', \MVC\DataType\DTArrayObject::create(array('protocol' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->protocol = $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_full($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_full.before', \MVC\DataType\DTArrayObject::create(array('full' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->full = $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_input($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_input.before', \MVC\DataType\DTArrayObject::create(array('input' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->input = $aValue;

		return $this;
	}

	/**
	 * @param bool $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_isSecure($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_isSecure.before', \MVC\DataType\DTArrayObject::create(array('isSecure' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->isSecure = $aValue;

		return $this;
	}

	/**
	 * @param array $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_headerArray($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_headerArray.before', \MVC\DataType\DTArrayObject::create(array('headerArray' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->headerArray = $aValue;

		return $this;
	}

	/**
	 * @param array $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_pathParam($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_pathParam.before', \MVC\DataType\DTArrayObject::create(array('pathParam' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->pathParam = $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_ip($aValue)
	{
		\MVC\Event::RUN ('DTRequestCurrent.set_ip.before', \MVC\DataType\DTArrayObject::create(array('ip' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->ip = $aValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_scheme()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_scheme.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('scheme')->set_sValue($this->scheme))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->scheme;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_host()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_host.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('host')->set_sValue($this->host))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->host;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_path()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_path.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('path')->set_sValue($this->path))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->path;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_query()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_query.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('query')->set_sValue($this->query))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->query;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_queryArray()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_queryArray.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('queryArray')->set_sValue($this->queryArray))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->queryArray;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_requesturi()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_requesturi.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('requesturi')->set_sValue($this->requesturi))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->requesturi;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_requestmethod()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_requestmethod.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('requestmethod')->set_sValue($this->requestmethod))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->requestmethod;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_protocol()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_protocol.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('protocol')->set_sValue($this->protocol))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->protocol;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_full()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_full.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('full')->set_sValue($this->full))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->full;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_input()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_input.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('input')->set_sValue($this->input))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->input;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_isSecure()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_isSecure.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('isSecure')->set_sValue($this->isSecure))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->isSecure;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_headerArray()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_headerArray.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('headerArray')->set_sValue($this->headerArray))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->headerArray;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_pathParam()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_pathParam.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('pathParam')->set_sValue($this->pathParam))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->pathParam;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_ip()
	{
		\MVC\Event::RUN ('DTRequestCurrent.get_ip.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('ip')->set_sValue($this->ip))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->ip;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_scheme()
	{
        return 'scheme';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_host()
	{
        return 'host';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_path()
	{
        return 'path';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_query()
	{
        return 'query';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_queryArray()
	{
        return 'queryArray';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_requesturi()
	{
        return 'requesturi';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_requestmethod()
	{
        return 'requestmethod';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_protocol()
	{
        return 'protocol';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_full()
	{
        return 'full';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_input()
	{
        return 'input';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_isSecure()
	{
        return 'isSecure';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_headerArray()
	{
        return 'headerArray';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_pathParam()
	{
        return 'pathParam';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_ip()
	{
        return 'ip';
	}

	/**
	 * @return false|string JSON
	 */
	public function __toString()
	{
        return $this->getPropertyJson();
	}

	/**
	 * @return false|string
	 */
	public function getPropertyJson()
	{
        return json_encode($this->getPropertyArray());
	}

	/**
	 * @return array
	 */
	public function getPropertyArray()
	{
        return get_object_vars($this);
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function getConstantArray()
	{
		$oReflectionClass = new \ReflectionClass($this);
		$aConstant = $oReflectionClass->getConstants();

		return $aConstant;
	}

	/**
	 * @return $this
	 */
	public function flushProperties()
	{
		foreach ($this->getPropertyArray() as $sKey => $aValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod)) 
			{
				$this->$sMethod('');
			}
		}

		return $this;
	}

}
