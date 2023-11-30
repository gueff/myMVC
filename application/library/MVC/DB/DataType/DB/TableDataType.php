<?php

/**
 * @name $MVCDBDataTypeDB
 */
namespace MVC\DB\DataType\DB;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class TableDataType
{
	use TraitDataType;

	public const DTHASH = '02fdeba2e82b361819efe6fe0851daaa';

	/**
	 * @required false
	 * @var int
	 */
	protected $id;

	/**
	 * @required false
	 * @var string
	 */
	protected $stampChange;

	/**
	 * @required false
	 * @var string
	 */
	protected $stampCreate;

	/**
	 * TableDataType constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		$oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('TableDataType.__construct.before', $oDTValue);
		$aData = $oDTValue->get_mValue();

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

		$oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::run('TableDataType.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return TableDataType
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('TableDataType.create.before', $oDTValue);
		$oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::run('TableDataType.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

	/**
	 * @param int $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_id(int $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('TableDataType.set_id.before', $oDTValue);
		$this->id = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_stampChange(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('TableDataType.set_stampChange.before', $oDTValue);
		$this->stampChange = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_stampCreate(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('TableDataType.set_stampCreate.before', $oDTValue);
		$this->stampCreate = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_id() : int
	{
		$oDTValue = DTValue::create()->set_mValue($this->id); 
		\MVC\Event::run('TableDataType.get_id.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_stampChange() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->stampChange); 
		\MVC\Event::run('TableDataType.get_stampChange.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_stampCreate() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->stampCreate); 
		\MVC\Event::run('TableDataType.get_stampCreate.before', $oDTValue);

		return $oDTValue->get_mValue();
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
