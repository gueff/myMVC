<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

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

	}

    /**
     * @param array $aData
     * @return DTEventContext
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oObject = new self($aData);
        
        return $oObject;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sEvent(string $mValue)
	{
		$this->sEvent = (string) $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sEventOrigin(string $mValue)
	{
		$this->sEventOrigin = (string) $mValue;

		return $this;
	}

	/**
	 * @param mixed $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_mRunPackage(mixed $mValue)
	{
		$this->mRunPackage = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_aBonded(array $mValue)
	{
		$this->aBonded = (array) $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sBondedBy(string $mValue)
	{
		$this->sBondedBy = (string) $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sCalledIn(string $mValue)
	{
		$this->sCalledIn = (string) $mValue;

		return $this;
	}

	/**
	 * @param \Closure $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_oCallback(\Closure $mValue)
	{
		$this->oCallback = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sCallbackDumped(string $mValue)
	{
		$this->sCallbackDumped = (string) $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sMessage(string $mValue)
	{
		$this->sMessage = (string) $mValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sEvent() : string
	{

		return $this->sEvent;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sEventOrigin() : string
	{

		return $this->sEventOrigin;
	}

	/**
	 * @return mixed
	 * @throws \ReflectionException
	 */
	public function get_mRunPackage()
	{

		return $this->mRunPackage;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_aBonded() : array
	{

		return $this->aBonded;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sBondedBy() : string
	{

		return $this->sBondedBy;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sCalledIn() : string
	{

		return $this->sCalledIn;
	}

	/**
	 * @return \Closure
	 * @throws \ReflectionException
	 */
	public function get_oCallback() : \Closure
	{

		return $this->oCallback;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sCallbackDumped() : string
	{

		return $this->sCallbackDumped;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sMessage() : string
	{

		return $this->sMessage;
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
