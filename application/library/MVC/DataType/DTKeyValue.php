<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

class DTKeyValue
{
	const DTHASH = 'dce2b4e83004d4b52cfd03cb97fccde3';

	/**
	 * @var string
	 */
	protected $sKey;

	/**
	 * @var mixed
	 */
	protected $sValue;

	/**
	 * DTKeyValue constructor.
	 * @param array $aData
	 */
	public function __construct(array $aData = array())
	{
		$this->sKey = '';
		$this->sValue = null;

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
     * @return DTKeyValue
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
	public function set_sKey($mValue)
	{
		$this->sKey = $mValue;

		return $this;
	}

	/**
	 * @param mixed $mValue 
	 * @return $this
	 */
	public function set_sValue($mValue)
	{
		$this->sValue = $mValue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_sKey()
	{
		return $this->sKey;
	}

	/**
	 * @return mixed
	 */
	public function get_sValue()
	{
		return $this->sValue;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sKey()
	{
        return 'sKey';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sValue()
	{
        return 'sValue';
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
		return '{"name":"KeyValue","file":"KeyValue.php","extends":"","namespace":"MVC\\\\DataType","constant":[],"property":[{"key":"sKey","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"sValue","var":"mixed","value":"null","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true}],"createHelperMethods":true}';
	}

}
