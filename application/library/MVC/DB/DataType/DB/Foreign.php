<?php

/**
 * @name $MVCDBDataTypeDB
 */
namespace MVC\DB\DataType\DB;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class Foreign
{
	use TraitDataType;

	public const DTHASH = '1d3b072dbb5785d0a6750e4b872fab07';

	public const UPDATE_CASCADE = " ON UPDATE CASCADE ";

	public const UPDATE_SET_NULL = " ON UPDATE SET NULL ";

	public const UPDATE_NO_ACTION = " ON UPDATE NO ACTION ";

	public const UPDATE_RESTRICT = " ON UPDATE RESTRICT ";

	public const DELETE_CASCADE = " ON DELETE CASCADE ";

	public const DELETE_SET_NULL = " ON DELETE SET NULL ";

	public const DELETE_NO_ACTION = " ON DELETE NO ACTION ";

	public const DELETE_RESTRICT = " ON DELETE RESTRICT ";

	/**
	 * @required false
	 * @var string
	 */
	protected $sForeignKey;

	/**
	 * @required false
	 * @var string
	 */
	protected $sForeignKeySQL;

	/**
	 * @required false
	 * @var string
	 */
	protected $sReferenceTable;

	/**
	 * @required false
	 * @var string
	 */
	protected $sReferenceKey;

	/**
	 * @required false
	 * @var string
	 */
	protected $sOnDelete;

	/**
	 * @required false
	 * @var string
	 */
	protected $sOnUpdate;

	/**
	 * Foreign constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		$oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('Foreign.__construct.before', $oDTValue);
		$aData = $oDTValue->get_mValue();

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

		$oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::run('Foreign.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return Foreign
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('Foreign.create.before', $oDTValue);
		$oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::run('Foreign.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sForeignKey(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Foreign.set_sForeignKey.before', $oDTValue);
		$this->sForeignKey = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sForeignKeySQL(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Foreign.set_sForeignKeySQL.before', $oDTValue);
		$this->sForeignKeySQL = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sReferenceTable(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Foreign.set_sReferenceTable.before', $oDTValue);
		$this->sReferenceTable = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sReferenceKey(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Foreign.set_sReferenceKey.before', $oDTValue);
		$this->sReferenceKey = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sOnDelete(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Foreign.set_sOnDelete.before', $oDTValue);
		$this->sOnDelete = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sOnUpdate(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Foreign.set_sOnUpdate.before', $oDTValue);
		$this->sOnUpdate = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sForeignKey() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sForeignKey); 
		\MVC\Event::run('Foreign.get_sForeignKey.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sForeignKeySQL() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sForeignKeySQL); 
		\MVC\Event::run('Foreign.get_sForeignKeySQL.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sReferenceTable() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sReferenceTable); 
		\MVC\Event::run('Foreign.get_sReferenceTable.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sReferenceKey() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sReferenceKey); 
		\MVC\Event::run('Foreign.get_sReferenceKey.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sOnDelete() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sOnDelete); 
		\MVC\Event::run('Foreign.get_sOnDelete.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sOnUpdate() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sOnUpdate); 
		\MVC\Event::run('Foreign.get_sOnUpdate.before', $oDTValue);

		return $oDTValue->get_mValue();
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
		foreach ($this->getPropertyArray() as $sKey => $mValue)
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
