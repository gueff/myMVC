<?php

/**
 * @name $DataTypeDataType
 */
namespace MVC\DataType;

class DTDataTypeGeneratorClass
{
	const DTHASH = 'ea31b4c41c0c96fe50b230a337855db0';

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var string
	 */
	protected $file = '';

	/**
	 * @var string
	 */
	protected $extends = '';

	/**
	 * @var string
	 */
	protected $namespace = '';

	/**
	 * @var \MVC\DataType\DTDataTypeGeneratorConstant[]
	 */
	protected $constant = array();

	/**
	 * @var \MVC\DataType\DTDataTypeGeneratorProperty[]
	 */
	protected $property = array();

    /**
     * DTClass constructor.
     * @param array $aData
     */
    public function __construct(array $aData = array())
    {
        foreach ($aData as $sKey => $mValue)
        {
            $sMethod = 'set_' . $sKey;

            if (method_exists($this, $sMethod))
            {
                $this->$sMethod($mValue);
            }
        }
    }

    /**
     * @param array $aData
     * @return DTDataTypeGeneratorClass
     */
    public static function create(array $aData = array())
    {
        $oObject = new self($aData);

        return $oObject;
    }

    /**
     * @param \MVC\DataType\DTDataTypeGeneratorProperty $oDTConstant
     * @return $this
     */
    public function add_DTConstant(\MVC\DataType\DTDataTypeGeneratorConstant $oDTConstant)
    {
        $this->constant[] = $oDTConstant;

        return $this;
    }

    /**
     * @param \MVC\DataType\DTDataTypeGeneratorProperty $oDTProperty
     * @return $this
     */
    public function add_DTProperty(\MVC\DataType\DTDataTypeGeneratorProperty $oDTProperty)
    {
        $this->property[] = $oDTProperty;

        return $this;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_name(string $mValue)
	{
		$this->name = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_file(string $mValue)
	{
		$this->file = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_extends(string $mValue)
	{
		$this->extends = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_namespace(string $mValue)
	{
		$this->namespace = $mValue;

		return $this;
	}

	/**
	 * @param \MVC\DataType\DTDataTypeGeneratorProperty[] $aDTDataTypeGeneratorProperty
	 * @return $this
	 */
	public function set_constant(array $aDTDataTypeGeneratorProperty)
	{
		$this->constant = $aDTDataTypeGeneratorProperty;

		return $this;
	}

	/**
	 * @param array \MVC\DataType\DTDataTypeGeneratorProperty[]
	 * @return $this
	 */
	public function set_property(array $aDTDataTypeGeneratorProperty)
	{
		$this->property = $aDTDataTypeGeneratorProperty;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_name() : string
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function get_file() : string
	{
		return $this->file;
	}

	/**
	 * @return string
	 */
	public function get_extends() : string
	{
		return $this->extends;
	}

	/**
	 * @return string
	 */
	public function get_namespace() : string
	{
		return $this->namespace;
	}

	/**
	 * @return \MVC\DataType\DTDataTypeGeneratorConstant[]
	 */
	public function get_constant() : array
	{
		return $this->constant;
	}

	/**
	 * @return \MVC\DataType\DTDataTypeGeneratorProperty[]
	 */
	public function get_property() : array
	{
		return $this->property;
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
