<?php

/**
 * @name $WebbixxDataType
 */
namespace Webbixx\DataType;

class DTRoute
{
	const DTHASH = '30689418e2c163effa37d370d0dc2b7e';

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @var string
	 */
	protected $query;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $layout;

	/**
	 * @var array
	 */
	protected $style;

	/**
	 * @var array
	 */
	protected $load;

	/**
	 * @var array
	 */
	protected $script;

	/**
	 * @var string
	 */
	protected $class;

	/**
	 * @var string
	 */
	protected $method;

	/**
	 * DTRoute constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		\MVC\Event::RUN ('DTRoute.__construct.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->path = '';
		$this->query = '';
		$this->title = '';
		$this->layout = '';
		$this->style = array();
		$this->load = array();
		$this->script = array();
		$this->class = '';
		$this->method = '';

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		\MVC\Event::RUN ('DTRoute.__construct.after', \MVC\DataType\DTArrayObject::create($aData));
	}

    /**
     * @param array $aData
     * @return DTRoute
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTRoute.create.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));
        
        $oObject = new self($aData);

        \MVC\Event::RUN ('DTRoute.create.after', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('DTRoute')->set_sValue($oObject)));
        
        return $oObject;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_path($mValue)
	{
		\MVC\Event::RUN ('DTRoute.set_path.before', \MVC\DataType\DTArrayObject::create(array('path' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->path = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_query($mValue)
	{
		\MVC\Event::RUN ('DTRoute.set_query.before', \MVC\DataType\DTArrayObject::create(array('query' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->query = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_title($mValue)
	{
		\MVC\Event::RUN ('DTRoute.set_title.before', \MVC\DataType\DTArrayObject::create(array('title' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->title = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_layout($mValue)
	{
		\MVC\Event::RUN ('DTRoute.set_layout.before', \MVC\DataType\DTArrayObject::create(array('layout' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->layout = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_style($mValue)
	{
		\MVC\Event::RUN ('DTRoute.set_style.before', \MVC\DataType\DTArrayObject::create(array('style' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->style = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_load($mValue)
	{
		\MVC\Event::RUN ('DTRoute.set_load.before', \MVC\DataType\DTArrayObject::create(array('load' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->load = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_script($mValue)
	{
		\MVC\Event::RUN ('DTRoute.set_script.before', \MVC\DataType\DTArrayObject::create(array('script' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->script = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_class($mValue)
	{
		\MVC\Event::RUN ('DTRoute.set_class.before', \MVC\DataType\DTArrayObject::create(array('class' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->class = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_method($mValue)
	{
		\MVC\Event::RUN ('DTRoute.set_method.before', \MVC\DataType\DTArrayObject::create(array('method' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->method = $mValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_path()
	{
		\MVC\Event::RUN ('DTRoute.get_path.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('path')->set_sValue($this->path))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->path;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_query()
	{
		\MVC\Event::RUN ('DTRoute.get_query.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('query')->set_sValue($this->query))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->query;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_title()
	{
		\MVC\Event::RUN ('DTRoute.get_title.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('title')->set_sValue($this->title))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->title;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_layout()
	{
		\MVC\Event::RUN ('DTRoute.get_layout.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('layout')->set_sValue($this->layout))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->layout;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_style()
	{
		\MVC\Event::RUN ('DTRoute.get_style.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('style')->set_sValue($this->style))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->style;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_load()
	{
		\MVC\Event::RUN ('DTRoute.get_load.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('load')->set_sValue($this->load))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->load;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_script()
	{
		\MVC\Event::RUN ('DTRoute.get_script.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('script')->set_sValue($this->script))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->script;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_class()
	{
		\MVC\Event::RUN ('DTRoute.get_class.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('class')->set_sValue($this->class))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->class;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_method()
	{
		\MVC\Event::RUN ('DTRoute.get_method.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('method')->set_sValue($this->method))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->method;
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
	public static function getPropertyName_title()
	{
        return 'title';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_layout()
	{
        return 'layout';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_style()
	{
        return 'style';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_load()
	{
        return 'load';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_script()
	{
        return 'script';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_class()
	{
        return 'class';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_method()
	{
        return 'method';
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
