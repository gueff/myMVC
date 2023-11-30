<?php

/**
 * @name $MVCDBDataTypeDB
 */
namespace MVC\DB\DataType\DB;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class Field
{
	use TraitDataType;

	public const DTHASH = 'abcdcbcb84c803e41b5f4c4b7f94b909';

	 const CHARACTER_UTF8 = "utf8";

	 const COLLATE_UTF8_BIN = "utf8_bin";

	/**
	 * @required false
	 * @var string
	 */
	protected $sName;

	/**
	 * @required false
	 * @var int
	 */
	protected $iLength;

	/**
	 * @required false
	 * @var bool
	 */
	protected $bIsChangeable;

	/**
	 * @required false
	 * @var \DB\DataType\SQL\FieldTypeConcrete
	 */
	protected $oType;

	/**
	 * @required false
	 * @var string
	 */
	protected $sCharacter;

	/**
	 * @required false
	 * @var string
	 */
	protected $sCollate;

	/**
	 * @required false
	 * @var bool
	 */
	protected $bNull;

	/**
	 * @required false
	 * @var string
	 */
	protected $sComment;

	/**
	 * Field constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		$oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('Field.__construct.before', $oDTValue);
		$aData = $oDTValue->get_mValue();

		$this->sName = '';
		$this->iLength = 0;
		$this->bIsChangeable = true;
		$this->oType = null;
		$this->sCharacter = '';
		$this->sCollate = '';
		$this->bNull = true;
		$this->sComment = '';

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		$oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::run('Field.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return Field
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('Field.create.before', $oDTValue);
		$oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::run('Field.create.after', $oDTValue);

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
		\MVC\Event::run('Field.set_sName.before', $oDTValue);
		$this->sName = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param int $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_iLength(int $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Field.set_iLength.before', $oDTValue);
		$this->iLength = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_bIsChangeable(bool $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Field.set_bIsChangeable.before', $oDTValue);
		$this->bIsChangeable = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param \DB\DataType\SQL\FieldTypeConcrete $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_oType(\DB\DataType\SQL\FieldTypeConcrete $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Field.set_oType.before', $oDTValue);
		$this->oType = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sCharacter(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Field.set_sCharacter.before', $oDTValue);
		$this->sCharacter = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sCollate(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Field.set_sCollate.before', $oDTValue);
		$this->sCollate = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_bNull(bool $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Field.set_bNull.before', $oDTValue);
		$this->bNull = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sComment(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('Field.set_sComment.before', $oDTValue);
		$this->sComment = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sName() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sName); 
		\MVC\Event::run('Field.get_sName.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_iLength() : int
	{
		$oDTValue = DTValue::create()->set_mValue($this->iLength); 
		\MVC\Event::run('Field.get_iLength.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_bIsChangeable() : bool
	{
		$oDTValue = DTValue::create()->set_mValue($this->bIsChangeable); 
		\MVC\Event::run('Field.get_bIsChangeable.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return \DB\DataType\SQL\FieldTypeConcrete
	 * @throws \ReflectionException
	 */
	public function get_oType() : \DB\DataType\SQL\FieldTypeConcrete
	{
		$oDTValue = DTValue::create()->set_mValue($this->oType); 
		\MVC\Event::run('Field.get_oType.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sCharacter() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sCharacter); 
		\MVC\Event::run('Field.get_sCharacter.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sCollate() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sCollate); 
		\MVC\Event::run('Field.get_sCollate.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_bNull() : bool
	{
		$oDTValue = DTValue::create()->set_mValue($this->bNull); 
		\MVC\Event::run('Field.get_bNull.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sComment() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sComment); 
		\MVC\Event::run('Field.get_sComment.before', $oDTValue);

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
	public static function getPropertyName_iLength()
	{
        return 'iLength';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_bIsChangeable()
	{
        return 'bIsChangeable';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_oType()
	{
        return 'oType';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sCharacter()
	{
        return 'sCharacter';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sCollate()
	{
        return 'sCollate';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_bNull()
	{
        return 'bNull';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sComment()
	{
        return 'sComment';
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
