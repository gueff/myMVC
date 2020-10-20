<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

class DTConfig
{
	public const DTHASH = 'd6d0e2004444ffd7b227bbf08eeb19ff';

	/**
	 * @var string
	 */
	protected $dir;

	/**
	 * @var bool
	 */
	protected $unlinkDir;

	/**
	 * @var \MVC\DataType\DTClass[]
	 */
	protected $class;

	/**
	 * DTConfig constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		\MVC\Event::RUN ('DTConfig.__construct.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->dir = '';
		$this->unlinkDir = false;
		$this->class = array();

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
     * @param \MVC\DataType\DTClass $oDTClass
     * @return $this
     */
    public function add_DTClass(\MVC\DataType\DTClass $oDTClass)
    {
        $this->class[] = $oDTClass;

        return $this;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dir(string $mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_dir.before', \MVC\DataType\DTArrayObject::create(array('dir' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->dir = $mValue;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_unlinkDir(bool $mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_unlinkDir.before', \MVC\DataType\DTArrayObject::create(array('unlinkDir' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->unlinkDir = $mValue;

		return $this;
	}

	/**
	 * @param array  $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_class(array $aValue)
	{
		\MVC\Event::RUN ('DTConfig.set_class.before', \MVC\DataType\DTArrayObject::create(array('class' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		foreach ($aValue as $mKey => $aData)
        {
            if (false === ($aData instanceof \MVC\DataType\DTClass))
            {
                $aValue[$mKey] = new \MVC\DataType\DTClass($aData);
            }
        }

		$this->class = $aValue;

		return $this;
	}

	/**
	 * @param \MVC\DataType\DTClass $mValue
	 * @return $this
	 */
	public function add_class(\MVC\DataType\DTClass $mValue)
	{
		$this->class[] = $mValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dir() : string
	{
		\MVC\Event::RUN ('DTConfig.get_dir.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('dir')->set_sValue($this->dir))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->dir;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_unlinkDir() : bool
	{
		\MVC\Event::RUN ('DTConfig.get_unlinkDir.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('unlinkDir')->set_sValue($this->unlinkDir))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->unlinkDir;
	}

	/**
	 * @return \MVC\DataType\DTClass[]
	 * @throws \ReflectionException
	 */
	public function get_class()
	{
		\MVC\Event::RUN ('DTConfig.get_class.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('class')->set_sValue($this->class))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->class;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_dir()
	{
        return 'dir';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_unlinkDir()
	{
        return 'unlinkDir';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_class()
	{
        return 'class';
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

	/**
	 * @return string JSON
	 */
	public function getDataTypeConfigJSON()
	{
		return '{"name":"DTConfig","file":"DTConfig.php","extends":"","namespace":"MVC\\\\DataType","constant":[],"property":[{"key":"dir","var":"string","value":"","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"unlinkDir","var":"bool","value":false,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"class","var":"\\\\MVC\\\\DataType\\\\DTClass[]","value":"array()","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false}],"createHelperMethods":true}';
	}

}
