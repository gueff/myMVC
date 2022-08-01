<?php

/**
 * @name $DBDataTypeDB
 */
namespace DB\DataType\DB;

class Table
{
	const DTHASH = '8521acd6b3e46a4d7f4e21241ce77806';

	/**
	 * @var string
	 */
	protected $sName;

	/**
	 * @var Field[]
	 */
	protected $aField;

	/**
	 * Table constructor.
	 * @param array $aData
	 */
	public function __construct(array $aData = array())
	{
		$this->sName = '';
		$this->aField = null;

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
     * @return Table
     */
    public static function create(array $aData = array())
    {
        $oObject = new self($aData);

        return $oObject;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_sName($mValue)
	{
		$this->sName = $mValue;

		return $this;
	}

	/**
	 * @param array $aValue 
	 * @return $this
	 */
	public function set_aField($aValue)
	{
		foreach ($aValue as $mKey => $aData)
        {
            if (false === ($aData instanceof Field))
            {
                $aValue[$mKey] = new Field($aData);
            }
        }

		$this->aField = $aValue;

		return $this;
	}

	/**
	 * @param Field $mValue
	 * @return $this
	 */
	public function add_aField(Field $mValue)
	{
		$this->aField[] = $mValue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_sName()
	{
		return $this->sName;
	}

	/**
	 * @return Field[]
	 */
	public function get_aField()
	{
		return $this->aField;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sName()
	{
        return 'sName';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_aField()
	{
        return 'aField';
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
		return '{"name":"Table","file":"Table.php","extends":"","namespace":"DB\\\\DataType\\\\DB","constant":[],"property":[{"key":"sName","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"aField","var":"Field[]","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true}],"createHelperMethods":true}';
	}

}
