<?php

/**
 * @name $MVCDBDataTypeDB
 */
namespace MVC\DB\DataType\DB;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class Table
{
	use TraitDataType;

	public const DTHASH = '9e1f7fcd0e8b973687e62159f26b68a8';

	/**
	 * @required false
	 * @var string
	 */
	protected $sName;

	/**
	 * @required false
	 * @var Field[]
	 */
	protected $aField;

	/**
	 * Table constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		$oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('Table.__construct.before', $oDTValue);
		$aData = $oDTValue->get_mValue();

		$this->sName = '';
		$this->aField = array();

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		$oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::run('Table.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return Table
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('Table.create.before', $oDTValue);
		$oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::run('Table.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sName(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Table.set_sName.before', $oDTValue);
		$this->sName = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param Field[]  $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_aField(array $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Table.set_aField.before', $oDTValue);

		$mValue = (array) $oDTValue->get_mValue();
                
        foreach ($mValue as $mKey => $aData)
        {            
            if (false === ($aData instanceof Field))
            {
                $mValue[$mKey] = new Field($aData);
            }
        }

		$this->aField = $mValue;

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
	 * @throws \ReflectionException
	 */
	public function get_sName() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sName); 
		\MVC\Event::run('Table.get_sName.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return Field[]
	 * @throws \ReflectionException
	 */
	public function get_aField()
	{
		$oDTValue = DTValue::create()->set_mValue($this->aField); 
		\MVC\Event::run('Table.get_aField.before', $oDTValue);

		return $oDTValue->get_mValue();
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
