<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\MVCTrait\TraitDataType;

class DTValue
{
	use TraitDataType;

	public const DTHASH = '648c051d5c804204884a548367a8b14c';

	/**
	 * @required true
	 * @var mixed
	 */
	protected $mValue;

	/**
	 * DTValue constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		$this->mValue = null;

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
     * @return DTValue
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oObject = new self($aData);
        
        return $oObject;
    }

	/**
	 * @param mixed $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_mValue(mixed $mValue)
	{
		$this->mValue = $mValue;

		return $this;
	}

	/**
	 * @return mixed
	 * @throws \ReflectionException
	 */
	public function get_mValue()
	{

		return $this->mValue;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_mValue()
	{
        return 'mValue';
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
