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
		\MVC\Event::RUN ('DTClass.__construct.before', $aData);

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

		\MVC\Event::RUN ('DTClass.__construct.after', $aData);
	}

    /**
     * @param array $aData
     * @return DTClass
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTClass.create.before', $aData);
        
        $oObject = new self($aData);

        \MVC\Event::RUN ('DTClass.create.after', $oObject);
        
        return $oObject;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_name(string $mValue)
	{
		\MVC\Event::RUN ('DTClass.set_name.before', $mValue);

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
		\MVC\Event::RUN ('DTClass.set_file.before', $mValue);

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
		\MVC\Event::RUN ('DTClass.set_extends.before', $mValue);

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
		\MVC\Event::RUN ('DTClass.set_namespace.before', $mValue);

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
		\MVC\Event::RUN ('DTClass.set_constant.before', $aValue);

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
        \MVC\Event::RUN ('DTClass.add_DTconstant.before', $mValue);

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
		\MVC\Event::RUN ('DTClass.set_property.before', $aValue);

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
        \MVC\Event::RUN ('DTClass.add_DTproperty.before', $mValue);

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
		\MVC\Event::RUN ('DTClass.set_createHelperMethods.before', $mValue);

		$this->createHelperMethods = $mValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_name() : string
	{
		\MVC\Event::RUN ('DTClass.get_name.before', $this->name);

		return $this->name;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_file() : string
	{
		\MVC\Event::RUN ('DTClass.get_file.before', $this->file);

		return $this->file;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_extends() : string
	{
		\MVC\Event::RUN ('DTClass.get_extends.before', $this->extends);

		return $this->extends;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_namespace() : string
	{
		\MVC\Event::RUN ('DTClass.get_namespace.before', $this->namespace);

		return $this->namespace;
	}

	/**
	 * @return \MVC\DataType\DTConstant[]
	 * @throws \ReflectionException
	 */
	public function get_constant()
	{
		\MVC\Event::RUN ('DTClass.get_constant.before', $this->constant);

		return $this->constant;
	}

	/**
	 * @return \MVC\DataType\DTProperty[]
	 * @throws \ReflectionException
	 */
	public function get_property()
	{
		\MVC\Event::RUN ('DTClass.get_property.before', $this->property);

		return $this->property;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_createHelperMethods() : bool
	{
		\MVC\Event::RUN ('DTClass.get_createHelperMethods.before', $this->createHelperMethods);

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
}