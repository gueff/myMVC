<?php

/**
 * @name $MVCDBDataTypeDB
 */
namespace MVC\DB\DataType\DB;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class Constraint
{
	use TraitDataType;

	public const DTHASH = '36e3065034b0245fb2276a8731926c80';

	/**
	 * @required false
	 * @var string
	 */
	protected $COLUMN_NAME;

	/**
	 * @required false
	 * @var string
	 */
	protected $CONSTRAINT_NAME;

	/**
	 * @required false
	 * @var string
	 */
	protected $REFERENCED_COLUMN_NAME;

	/**
	 * @required false
	 * @var string
	 */
	protected $REFERENCED_TABLE_NAME;

	/**
	 * Constraint constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		$oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('Constraint.__construct.before', $oDTValue);
		$aData = $oDTValue->get_mValue();

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

		$oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::run('Constraint.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return Constraint
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('Constraint.create.before', $oDTValue);
		$oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::run('Constraint.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_COLUMN_NAME(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Constraint.set_COLUMN_NAME.before', $oDTValue);
		$this->COLUMN_NAME = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_CONSTRAINT_NAME(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Constraint.set_CONSTRAINT_NAME.before', $oDTValue);
		$this->CONSTRAINT_NAME = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_REFERENCED_COLUMN_NAME(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Constraint.set_REFERENCED_COLUMN_NAME.before', $oDTValue);
		$this->REFERENCED_COLUMN_NAME = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_REFERENCED_TABLE_NAME(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Constraint.set_REFERENCED_TABLE_NAME.before', $oDTValue);
		$this->REFERENCED_TABLE_NAME = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_COLUMN_NAME() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->COLUMN_NAME); 
		\MVC\Event::run('Constraint.get_COLUMN_NAME.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_CONSTRAINT_NAME() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->CONSTRAINT_NAME); 
		\MVC\Event::run('Constraint.get_CONSTRAINT_NAME.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_REFERENCED_COLUMN_NAME() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->REFERENCED_COLUMN_NAME); 
		\MVC\Event::run('Constraint.get_REFERENCED_COLUMN_NAME.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_REFERENCED_TABLE_NAME() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->REFERENCED_TABLE_NAME); 
		\MVC\Event::run('Constraint.get_REFERENCED_TABLE_NAME.before', $oDTValue);

		return $oDTValue->get_mValue();
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
