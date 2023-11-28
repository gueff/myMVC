<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class DTEventContext
{
	use TraitDataType;

	public const DTHASH = '28c36155c08f602cf4029f8211b80afe';

	/**
	 * @required true
	 * @var string
	 */
	protected $sEvent;

	/**
	 * @required true
	 * @var string
	 */
	protected $sEventOrigin;

	/**
	 * @required false
	 * @var mixed
	 */
	protected $mRunPackage;

	/**
	 * @required true
	 * @var array
	 */
	protected $aBonded;

	/**
	 * @required true
	 * @var string
	 */
	protected $sBondedBy;

	/**
	 * @required true
	 * @var string
	 */
	protected $sCalledIn;

	/**
	 * @required true
	 * @var \Closure
	 */
	protected $oCallback;

	/**
	 * @required true
	 * @var string
	 */
	protected $sCallbackDumped;

	/**
	 * @required true
	 * @var string
	 */
	protected $sMessage;

	/**
	 * DTEventContext constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		$oDTValue = DTValue::create()->set_mValue($aData);
		$aData = $oDTValue->get_mValue();

		$this->sEvent = '';
		$this->sEventOrigin = '';
		$this->mRunPackage = '';
		$this->aBonded = array();
		$this->sBondedBy = '';
		$this->sCalledIn = '';
		$this->oCallback = null;
		$this->sCallbackDumped = '';
		$this->sMessage = '';

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		$oDTValue = DTValue::create()->set_mValue($aData); 
	}

    /**
     * @param array $aData
     * @return DTEventContext
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData);
		$oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); 

        return $oDTValue->get_mValue();
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sEvent(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->sEvent = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sEventOrigin(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->sEventOrigin = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param mixed $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_mRunPackage(mixed $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->mRunPackage = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_aBonded(array $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->aBonded = (array) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sBondedBy(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->sBondedBy = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sCalledIn(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->sCalledIn = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param \Closure $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_oCallback(\Closure $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->oCallback = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sCallbackDumped(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->sCallbackDumped = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sMessage(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->sMessage = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sEvent() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sEvent); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sEventOrigin() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sEventOrigin); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return mixed
	 * @throws \ReflectionException
	 */
	public function get_mRunPackage()
	{
		$oDTValue = DTValue::create()->set_mValue($this->mRunPackage); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_aBonded() : array
	{
		$oDTValue = DTValue::create()->set_mValue($this->aBonded); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sBondedBy() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sBondedBy); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sCalledIn() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sCalledIn); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return \Closure
	 * @throws \ReflectionException
	 */
	public function get_oCallback() : \Closure
	{
		$oDTValue = DTValue::create()->set_mValue($this->oCallback); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sCallbackDumped() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sCallbackDumped); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sMessage() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sMessage); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sEvent()
	{
        return 'sEvent';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sEventOrigin()
	{
        return 'sEventOrigin';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_mRunPackage()
	{
        return 'mRunPackage';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_aBonded()
	{
        return 'aBonded';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sBondedBy()
	{
        return 'sBondedBy';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sCalledIn()
	{
        return 'sCalledIn';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_oCallback()
	{
        return 'oCallback';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sCallbackDumped()
	{
        return 'sCallbackDumped';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sMessage()
	{
        return 'sMessage';
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
