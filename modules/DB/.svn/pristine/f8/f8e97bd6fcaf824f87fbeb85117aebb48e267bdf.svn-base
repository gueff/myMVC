<?php

/**
 * @name $DBDataTypeDB
 */
namespace DB\DataType\DB;

class TableDataType
{
	const DTHASH = '01a56b3ee92feac444c3b50f40e01d4d';

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $stampChange;

	/**
	 * @var string
	 */
	protected $stampCreate;

	/**
	 * TableDataType constructor.
	 * @param array $aData
	 */
	public function __construct(array $aData = array())
	{
		$this->id = 0;
		$this->stampChange = '';
		$this->stampCreate = '';

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
     * @return TableDataType
     */
    public static function create(array $aData = array())
    {
        $oObject = new self($aData);

        return $oObject;
    }

	/**
	 * @param int $mValue 
	 * @return $this
	 */
	public function set_id($mValue)
	{
		$this->id = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_stampChange($mValue)
	{
		$this->stampChange = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_stampCreate($mValue)
	{
		$this->stampCreate = $mValue;

		return $this;
	}

	/**
	 * @return int
	 */
	public function get_id()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function get_stampChange()
	{
		return $this->stampChange;
	}

	/**
	 * @return string
	 */
	public function get_stampCreate()
	{
		return $this->stampCreate;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_id()
	{
        return 'id';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_stampChange()
	{
        return 'stampChange';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_stampCreate()
	{
        return 'stampCreate';
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
		return '{"name":"TableDataType","file":"TableDataType.php","extends":"","namespace":"DB\\\\DataType\\\\DB","constant":[],"property":[{"key":"id","var":"int","value":0,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"stampChange","var":"string","value":"","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"stampCreate","var":"string","value":"","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true}],"createHelperMethods":true}';
	}

}
