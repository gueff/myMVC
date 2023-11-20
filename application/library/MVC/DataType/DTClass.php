<?php
/**
 * DTClass.php
 * @package   myMVC
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

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
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTClass.__construct.before', $oDTValue);
        $aData = $oDTValue->get_mValue();

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

        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTClass.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return DTClass
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTClass.create.before', $oDTValue);
        $oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::RUN ('DTClass.create.after', $oDTValue);
        
        return $oDTValue->get_mValue();
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_name(string $mValue)
	{
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::RUN ('DTClass.set_name.before', $oDTValue);
		$this->name = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_file(string $mValue)
	{
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::RUN ('DTClass.set_file.before', $oDTValue);
		$this->file = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_extends(string $mValue)
	{
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::RUN ('DTClass.set_extends.before', $oDTValue);
		$this->extends = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_namespace(string $mValue)
	{
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::RUN ('DTClass.set_namespace.before', $oDTValue);
		$this->namespace = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param array  $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_constant(array $aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTClass.set_constant.before', $oDTValue);
        $aValue = $oDTValue->get_mValue();

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
     * @throws \ReflectionException
     */
	public function add_DTconstant(\MVC\DataType\DTConstant $mValue)
	{
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::RUN ('DTClass.add_DTconstant.before', $oDTValue);
		$this->constant[] = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param array  $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_property(array $aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTClass.set_property.before', $oDTValue);
        $aValue = $oDTValue->get_mValue();

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
     * @throws \ReflectionException
     */
	public function add_DTproperty(\MVC\DataType\DTProperty $mValue)
	{
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::RUN ('DTClass.add_DTproperty.before', $oDTValue);
		$this->property[] = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_createHelperMethods(bool $mValue)
	{
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::RUN ('DTClass.set_createHelperMethods.before', $oDTValue);
		$this->createHelperMethods = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_name() : string
	{
        $oDTValue = DTValue::create()->set_mValue($this->name); \MVC\Event::RUN ('DTClass.get_name.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_file() : string
	{
        $oDTValue = DTValue::create()->set_mValue($this->file); \MVC\Event::RUN ('DTClass.get_file.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_extends() : string
	{
        $oDTValue = DTValue::create()->set_mValue($this->extends); \MVC\Event::RUN ('DTClass.get_extends.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_namespace() : string
	{
        $oDTValue = DTValue::create()->set_mValue($this->namespace); \MVC\Event::RUN ('DTClass.get_namespace.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return \MVC\DataType\DTConstant[]
	 * @throws \ReflectionException
	 */
	public function get_constant()
	{
        $oDTValue = DTValue::create()->set_mValue($this->constant); \MVC\Event::RUN ('DTClass.get_constant.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return \MVC\DataType\DTProperty[]
	 * @throws \ReflectionException
	 */
	public function get_property()
	{
        $oDTValue = DTValue::create()->set_mValue($this->property); \MVC\Event::RUN ('DTClass.get_property.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_createHelperMethods() : bool
	{
        $oDTValue = DTValue::create()->set_mValue($this->createHelperMethods); \MVC\Event::RUN ('DTClass.get_createHelperMethods.before', $oDTValue);

		return $oDTValue->get_mValue();
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
}