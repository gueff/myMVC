<?php

/**
 * @name $DBDataTypeDB
 */
namespace DB\DataType\DB;

class Foreign
{
	const DTHASH = '8688525f657b0b9b5e56cc606133a699';

	const UPDATE_CASCADE = " ON UPDATE CASCADE ";

	const UPDATE_SET_NULL = " ON UPDATE SET NULL ";

	const UPDATE_NO_ACTION = " ON UPDATE NO ACTION ";

	const UPDATE_RESTRICT = " ON UPDATE RESTRICT ";

	const DELETE_CASCADE = " ON DELETE CASCADE ";

	const DELETE_SET_NULL = " ON DELETE SET NULL ";

	const DELETE_NO_ACTION = " ON DELETE NO ACTION ";

	const DELETE_RESTRICT = " ON DELETE RESTRICT ";

	/**
	 * @var string
	 */
	protected $sForeignKey;

	/**
	 * @var string
	 */
	protected $sForeignKeySQL;

	/**
	 * @var string
	 */
	protected $sReferenceTable;

	/**
	 * @var string
	 */
	protected $sReferenceKey;

	/**
	 * @var string
	 */
	protected $sOnDelete;

	/**
	 * @var string
	 */
	protected $sOnUpdate;

	/**
	 * Foreign constructor.
	 * @param array $aData
	 */
	public function __construct(array $aData = array())
	{
		$this->sForeignKey = '';
		$this->sForeignKeySQL = "INT(11) NULL AFTER `id`";
		$this->sReferenceTable = '';
		$this->sReferenceKey = "id";
		$this->sOnDelete = " ON DELETE NO ACTION ";
		$this->sOnUpdate = " ON UPDATE NO ACTION ";

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
     * @return Foreign
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
	public function set_sForeignKey($mValue)
	{
		$this->sForeignKey = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_sForeignKeySQL($mValue)
	{
		$this->sForeignKeySQL = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_sReferenceTable($mValue)
	{
		$this->sReferenceTable = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_sReferenceKey($mValue)
	{
		$this->sReferenceKey = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_sOnDelete($mValue)
	{
		$this->sOnDelete = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_sOnUpdate($mValue)
	{
		$this->sOnUpdate = $mValue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_sForeignKey()
	{
		return $this->sForeignKey;
	}

	/**
	 * @return string
	 */
	public function get_sForeignKeySQL()
	{
		return $this->sForeignKeySQL;
	}

	/**
	 * @return string
	 */
	public function get_sReferenceTable()
	{
		return $this->sReferenceTable;
	}

	/**
	 * @return string
	 */
	public function get_sReferenceKey()
	{
		return $this->sReferenceKey;
	}

	/**
	 * @return string
	 */
	public function get_sOnDelete()
	{
		return $this->sOnDelete;
	}

	/**
	 * @return string
	 */
	public function get_sOnUpdate()
	{
		return $this->sOnUpdate;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sForeignKey()
	{
        return 'sForeignKey';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sForeignKeySQL()
	{
        return 'sForeignKeySQL';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sReferenceTable()
	{
        return 'sReferenceTable';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sReferenceKey()
	{
        return 'sReferenceKey';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sOnDelete()
	{
        return 'sOnDelete';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sOnUpdate()
	{
        return 'sOnUpdate';
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
		return '{"name":"Foreign","file":"Foreign.php","extends":"","namespace":"DB\\\\DataType\\\\DB","constant":[{"key":"UPDATE_CASCADE","value":"\\" ON UPDATE CASCADE \\"","visibility":"public"},{"key":"UPDATE_SET_NULL","value":"\\" ON UPDATE SET NULL \\"","visibility":"public"},{"key":"UPDATE_NO_ACTION","value":"\\" ON UPDATE NO ACTION \\"","visibility":"public"},{"key":"UPDATE_RESTRICT","value":"\\" ON UPDATE RESTRICT \\"","visibility":"public"},{"key":"DELETE_CASCADE","value":"\\" ON DELETE CASCADE \\"","visibility":"public"},{"key":"DELETE_SET_NULL","value":"\\" ON DELETE SET NULL \\"","visibility":"public"},{"key":"DELETE_NO_ACTION","value":"\\" ON DELETE NO ACTION \\"","visibility":"public"},{"key":"DELETE_RESTRICT","value":"\\" ON DELETE RESTRICT \\"","visibility":"public"}],"property":[{"key":"sForeignKey","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"sForeignKeySQL","var":"string","value":"INT(11) NULL AFTER `id`","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"sReferenceTable","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"sReferenceKey","var":"string","value":"id","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"sOnDelete","var":"string","value":" ON DELETE NO ACTION ","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"sOnUpdate","var":"string","value":" ON UPDATE NO ACTION ","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true}],"createHelperMethods":true}';
	}

}
