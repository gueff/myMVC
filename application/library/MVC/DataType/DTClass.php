<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

class DTClass
{
	public const DTHASH = 'b43c639a0697f12aa9512e6237aecd92';

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $file;

	/**
	 * @var string
	 */
	protected $extends;

	/**
	 * @var string
	 */
	protected $namespace;

	/**
	 * @var \MVC\DataType\DTConstant[]
	 */
	protected $constant;

	/**
	 * @var \MVC\DataType\DTProperty[]
	 */
	protected $property;

	/**
	 * @var bool
	 */
	protected $createHelperMethods;

	/**
	 * DTClass constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		\MVC\Event::RUN ('DTClass.__construct.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->name = '';
		$this->file = '';
		$this->extends = '';
		$this->namespace = '';
		$this->constant = array();
		$this->property = array();
		$this->createHelperMethods = true;

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		\MVC\Event::RUN ('DTClass.__construct.after', \MVC\DataType\DTArrayObject::create($aData));
	}

    /**
     * @param array $aData
     * @return DTClass
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTClass.create.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));
        
        $oObject = new self($aData);

        \MVC\Event::RUN ('DTClass.create.after', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('DTClass')->set_sValue($oObject)));
        
        return $oObject;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_name(string $mValue)
	{
		\MVC\Event::RUN ('DTClass.set_name.before', \MVC\DataType\DTArrayObject::create(array('name' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->name = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_file(string $mValue)
	{
		\MVC\Event::RUN ('DTClass.set_file.before', \MVC\DataType\DTArrayObject::create(array('file' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->file = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_extends(string $mValue)
	{
		\MVC\Event::RUN ('DTClass.set_extends.before', \MVC\DataType\DTArrayObject::create(array('extends' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->extends = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_namespace(string $mValue)
	{
		\MVC\Event::RUN ('DTClass.set_namespace.before', \MVC\DataType\DTArrayObject::create(array('namespace' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->namespace = $mValue;

		return $this;
	}

	/**
	 * @param array  $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_constant(array $aValue)
	{
		\MVC\Event::RUN ('DTClass.set_constant.before', \MVC\DataType\DTArrayObject::create(array('constant' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		foreach ($aValue as $mKey => $aData)
        {
            if (false === ($aData instanceof \MVC\DataType\DTConstant))
            {
                $aValue[$mKey] = new \MVC\DataType\DTConstant($aData);
            }
        }

		$this->constant = $aValue;

		return $this;
	}

	/**
	 * @param \MVC\DataType\DTConstant $mValue
	 * @return $this
	 */
	public function add_DTconstant(\MVC\DataType\DTConstant $mValue)
	{
		$this->constant[] = $mValue;

		return $this;
	}

	/**
	 * @param array  $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_property(array $aValue)
	{
		\MVC\Event::RUN ('DTClass.set_property.before', \MVC\DataType\DTArrayObject::create(array('property' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		foreach ($aValue as $mKey => $aData)
        {
            if (false === ($aData instanceof \MVC\DataType\DTProperty))
            {
                $aValue[$mKey] = new \MVC\DataType\DTProperty($aData);
            }
        }

		$this->property = $aValue;

		return $this;
	}

	/**
	 * @param \MVC\DataType\DTProperty $mValue
	 * @return $this
	 */
	public function add_DTproperty(\MVC\DataType\DTProperty $mValue)
	{
		$this->property[] = $mValue;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_createHelperMethods(bool $mValue)
	{
		\MVC\Event::RUN ('DTClass.set_createHelperMethods.before', \MVC\DataType\DTArrayObject::create(array('createHelperMethods' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->createHelperMethods = $mValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_name() : string
	{
		\MVC\Event::RUN ('DTClass.get_name.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('name')->set_sValue($this->name))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->name;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_file() : string
	{
		\MVC\Event::RUN ('DTClass.get_file.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('file')->set_sValue($this->file))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->file;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_extends() : string
	{
		\MVC\Event::RUN ('DTClass.get_extends.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('extends')->set_sValue($this->extends))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->extends;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_namespace() : string
	{
		\MVC\Event::RUN ('DTClass.get_namespace.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('namespace')->set_sValue($this->namespace))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->namespace;
	}

	/**
	 * @return \MVC\DataType\DTConstant[]
	 * @throws \ReflectionException
	 */
	public function get_constant()
	{
		\MVC\Event::RUN ('DTClass.get_constant.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('constant')->set_sValue($this->constant))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->constant;
	}

	/**
	 * @return \MVC\DataType\DTProperty[]
	 * @throws \ReflectionException
	 */
	public function get_property()
	{
		\MVC\Event::RUN ('DTClass.get_property.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('property')->set_sValue($this->property))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->property;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_createHelperMethods() : bool
	{
		\MVC\Event::RUN ('DTClass.get_createHelperMethods.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('createHelperMethods')->set_sValue($this->createHelperMethods))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->createHelperMethods;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_name()
	{
        return 'name';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_file()
	{
        return 'file';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_extends()
	{
        return 'extends';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_namespace()
	{
        return 'namespace';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_constant()
	{
        return 'constant';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_property()
	{
        return 'property';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_createHelperMethods()
	{
        return 'createHelperMethods';
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
		return '{"name":"DTClass","file":"DTClass.php","extends":"","namespace":"MVC\\\\DataType","constant":[{"key":"","value":null,"visibility":""},{"key":"","value":null,"visibility":""},{"key":"","value":null,"visibility":""},{"key":"","value":null,"visibility":""},{"key":"","value":null,"visibility":""},{"key":"","value":null,"visibility":""},{"key":"","value":null,"visibility":""}],"property":[{"key":"name","var":"string","value":"","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"file","var":"string","value":"","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"extends","var":"string","value":"","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"namespace","var":"string","value":"","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"constant","var":"\\\\MVC\\\\DataType\\\\DTConstant[]","value":"array()","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"property","var":"\\\\MVC\\\\DataType\\\\DTProperty[]","value":"array()","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"createHelperMethods","var":"bool","value":true,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false}],"createHelperMethods":true}';
	}

}
