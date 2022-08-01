<?php

/**
 * @name $DBDataTypeDB
 */
namespace DB\DataType\DB;

class Constraint
{
	const DTHASH = '84b6711bf4dc1741098ab3e66aaed569';

	/**
	 * @var string
	 */
	protected $COLUMN_NAME;

	/**
	 * @var string
	 */
	protected $CONSTRAINT_NAME;

	/**
	 * @var string
	 */
	protected $REFERENCED_COLUMN_NAME;

	/**
	 * @var string
	 */
	protected $REFERENCED_TABLE_NAME;

	/**
	 * Constraint constructor.
	 * @param array $aData
	 */
	public function __construct(array $aData = array())
	{
		$this->COLUMN_NAME = '';
		$this->CONSTRAINT_NAME = '';
		$this->REFERENCED_COLUMN_NAME = '';
		$this->REFERENCED_TABLE_NAME = '';

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
     * @return Constraint
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
	public function set_COLUMN_NAME($mValue)
	{
		$this->COLUMN_NAME = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_CONSTRAINT_NAME($mValue)
	{
		$this->CONSTRAINT_NAME = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_REFERENCED_COLUMN_NAME($mValue)
	{
		$this->REFERENCED_COLUMN_NAME = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_REFERENCED_TABLE_NAME($mValue)
	{
		$this->REFERENCED_TABLE_NAME = $mValue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_COLUMN_NAME()
	{
		return $this->COLUMN_NAME;
	}

	/**
	 * @return string
	 */
	public function get_CONSTRAINT_NAME()
	{
		return $this->CONSTRAINT_NAME;
	}

	/**
	 * @return string
	 */
	public function get_REFERENCED_COLUMN_NAME()
	{
		return $this->REFERENCED_COLUMN_NAME;
	}

	/**
	 * @return string
	 */
	public function get_REFERENCED_TABLE_NAME()
	{
		return $this->REFERENCED_TABLE_NAME;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_COLUMN_NAME()
	{
        return 'COLUMN_NAME';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_CONSTRAINT_NAME()
	{
        return 'CONSTRAINT_NAME';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_REFERENCED_COLUMN_NAME()
	{
        return 'REFERENCED_COLUMN_NAME';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_REFERENCED_TABLE_NAME()
	{
        return 'REFERENCED_TABLE_NAME';
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
		return '{"name":"Constraint","file":"Constraint.php","extends":"","namespace":"DB\\\\DataType\\\\DB","constant":[],"property":[{"key":"COLUMN_NAME","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"CONSTRAINT_NAME","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"REFERENCED_COLUMN_NAME","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"REFERENCED_TABLE_NAME","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true}],"createHelperMethods":true}';
	}

}
