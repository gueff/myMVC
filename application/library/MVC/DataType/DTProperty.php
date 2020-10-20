<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

class DTProperty
{
	public const DTHASH = '098dbe6ceb5a5f19694af22f7101658d';

	/**
	 * @var string
	 */
	protected $key;

	/**
	 * @var string
	 */
	protected $var;

	/**
	 * @var mixed
	 */
	protected $value;

	/**
	 * @var string
	 */
	protected $visibility;

	/**
	 * @var bool
	 */
	protected $static;

	/**
	 * @var bool
	 */
	protected $setter;

	/**
	 * @var bool
	 */
	protected $getter;

	/**
	 * @var bool
	 */
	protected $explicitMethodForValue;

	/**
	 * @var bool
	 */
	protected $listProperty;

	/**
	 * @var bool
	 */
	protected $createStaticPropertyGetter;

	/**
	 * @var bool
	 */
	protected $setValueInConstructor;

	/**
	 * @var bool
	 */
	protected $forceCasting;

	/**
	 * @var bool
	 */
	protected $addMyMVCEvents;

	/**
	 * DTProperty constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		\MVC\Event::RUN ('DTProperty.__construct.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->key = '';
		$this->var = "string";
		$this->value = null;
		$this->visibility = "protected";
		$this->static = false;
		$this->setter = true;
		$this->getter = true;
		$this->explicitMethodForValue = false;
		$this->listProperty = true;
		$this->createStaticPropertyGetter = true;
		$this->setValueInConstructor = true;
		$this->forceCasting = false;
		$this->addMyMVCEvents = true;

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		\MVC\Event::RUN ('DTProperty.__construct.after', \MVC\DataType\DTArrayObject::create($aData));
	}

    /**
     * @param array $aData
     * @return DTProperty
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTProperty.create.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));
        
        $oObject = new self($aData);

        \MVC\Event::RUN ('DTProperty.create.after', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('DTProperty')->set_sValue($oObject)));
        
        return $oObject;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_key(string $mValue)
	{
		\MVC\Event::RUN ('DTProperty.set_key.before', \MVC\DataType\DTArrayObject::create(array('key' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->key = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_var(string $mValue)
	{
		\MVC\Event::RUN ('DTProperty.set_var.before', \MVC\DataType\DTArrayObject::create(array('var' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->var = $mValue;

		return $this;
	}

	/**
	 * @param mixed $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_value($mValue)
	{
		\MVC\Event::RUN ('DTProperty.set_value.before', \MVC\DataType\DTArrayObject::create(array('value' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->value = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_visibility(string $mValue)
	{
		\MVC\Event::RUN ('DTProperty.set_visibility.before', \MVC\DataType\DTArrayObject::create(array('visibility' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->visibility = $mValue;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_static(bool $mValue)
	{
		\MVC\Event::RUN ('DTProperty.set_static.before', \MVC\DataType\DTArrayObject::create(array('static' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->static = $mValue;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_setter(bool $mValue)
	{
		\MVC\Event::RUN ('DTProperty.set_setter.before', \MVC\DataType\DTArrayObject::create(array('setter' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->setter = $mValue;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_getter(bool $mValue)
	{
		\MVC\Event::RUN ('DTProperty.set_getter.before', \MVC\DataType\DTArrayObject::create(array('getter' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->getter = $mValue;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_explicitMethodForValue(bool $mValue)
	{
		\MVC\Event::RUN ('DTProperty.set_explicitMethodForValue.before', \MVC\DataType\DTArrayObject::create(array('explicitMethodForValue' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->explicitMethodForValue = $mValue;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_listProperty(bool $mValue)
	{
		\MVC\Event::RUN ('DTProperty.set_listProperty.before', \MVC\DataType\DTArrayObject::create(array('listProperty' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->listProperty = $mValue;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_createStaticPropertyGetter(bool $mValue)
	{
		\MVC\Event::RUN ('DTProperty.set_createStaticPropertyGetter.before', \MVC\DataType\DTArrayObject::create(array('createStaticPropertyGetter' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->createStaticPropertyGetter = $mValue;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_setValueInConstructor(bool $mValue)
	{
		\MVC\Event::RUN ('DTProperty.set_setValueInConstructor.before', \MVC\DataType\DTArrayObject::create(array('setValueInConstructor' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->setValueInConstructor = $mValue;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_forceCasting(bool $mValue)
	{
		\MVC\Event::RUN ('DTProperty.set_forceCasting.before', \MVC\DataType\DTArrayObject::create(array('forceCasting' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->forceCasting = $mValue;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_addMyMVCEvents(bool $mValue)
	{
		\MVC\Event::RUN ('DTProperty.set_addMyMVCEvents.before', \MVC\DataType\DTArrayObject::create(array('addMyMVCEvents' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->addMyMVCEvents = $mValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_key() : string
	{
		\MVC\Event::RUN ('DTProperty.get_key.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('key')->set_sValue($this->key))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->key;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_var() : string
	{
		\MVC\Event::RUN ('DTProperty.get_var.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('var')->set_sValue($this->var))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->var;
	}

	/**
	 * @return mixed
	 * @throws \ReflectionException
	 */
	public function get_value()
	{
		\MVC\Event::RUN ('DTProperty.get_value.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('value')->set_sValue($this->value))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->value;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_visibility() : string
	{
		\MVC\Event::RUN ('DTProperty.get_visibility.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('visibility')->set_sValue($this->visibility))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->visibility;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_static() : bool
	{
		\MVC\Event::RUN ('DTProperty.get_static.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('static')->set_sValue($this->static))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->static;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_setter() : bool
	{
		\MVC\Event::RUN ('DTProperty.get_setter.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('setter')->set_sValue($this->setter))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->setter;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_getter() : bool
	{
		\MVC\Event::RUN ('DTProperty.get_getter.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('getter')->set_sValue($this->getter))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->getter;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_explicitMethodForValue() : bool
	{
		\MVC\Event::RUN ('DTProperty.get_explicitMethodForValue.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('explicitMethodForValue')->set_sValue($this->explicitMethodForValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->explicitMethodForValue;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_listProperty() : bool
	{
		\MVC\Event::RUN ('DTProperty.get_listProperty.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('listProperty')->set_sValue($this->listProperty))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->listProperty;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_createStaticPropertyGetter() : bool
	{
		\MVC\Event::RUN ('DTProperty.get_createStaticPropertyGetter.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('createStaticPropertyGetter')->set_sValue($this->createStaticPropertyGetter))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->createStaticPropertyGetter;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_setValueInConstructor() : bool
	{
		\MVC\Event::RUN ('DTProperty.get_setValueInConstructor.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('setValueInConstructor')->set_sValue($this->setValueInConstructor))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->setValueInConstructor;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_forceCasting() : bool
	{
		\MVC\Event::RUN ('DTProperty.get_forceCasting.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('forceCasting')->set_sValue($this->forceCasting))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->forceCasting;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_addMyMVCEvents() : bool
	{
		\MVC\Event::RUN ('DTProperty.get_addMyMVCEvents.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('addMyMVCEvents')->set_sValue($this->addMyMVCEvents))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->addMyMVCEvents;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_key()
	{
        return 'key';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_var()
	{
        return 'var';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_value()
	{
        return 'value';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_visibility()
	{
        return 'visibility';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_static()
	{
        return 'static';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_setter()
	{
        return 'setter';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_getter()
	{
        return 'getter';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_explicitMethodForValue()
	{
        return 'explicitMethodForValue';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_listProperty()
	{
        return 'listProperty';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_createStaticPropertyGetter()
	{
        return 'createStaticPropertyGetter';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_setValueInConstructor()
	{
        return 'setValueInConstructor';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_forceCasting()
	{
        return 'forceCasting';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_addMyMVCEvents()
	{
        return 'addMyMVCEvents';
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
		return '{"name":"DTProperty","file":"DTProperty.php","extends":"","namespace":"MVC\\\\DataType","constant":[],"property":[{"key":"key","var":"string","value":"","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"var","var":"string","value":"string","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"value","var":"mixed","value":"null","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"visibility","var":"string","value":"protected","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"static","var":"bool","value":false,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"setter","var":"bool","value":true,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"getter","var":"bool","value":true,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"explicitMethodForValue","var":"bool","value":false,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"listProperty","var":"bool","value":true,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"createStaticPropertyGetter","var":"bool","value":true,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"setValueInConstructor","var":"bool","value":true,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"forceCasting","var":"bool","value":false,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false},{"key":"addMyMVCEvents","var":"bool","value":true,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true,"forceCasting":false}],"createHelperMethods":true}';
	}

}
