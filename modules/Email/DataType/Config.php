<?php

/**
 * @name $EmailDataType
 */
namespace Email\DataType;

class Config
{
	const DTHASH = '946b93efc4a4378ae285c3f79bfd8543';

	/**
	 * @var string
	 */
	protected $sAbsolutePathToFolderSpooler;

	/**
	 * @var string
	 */
	protected $sAbsolutePathToFolderAttachment;

	/**
	 * @var array
	 */
	protected $aIgnoreFile;

	/**
	 * @var string
	 */
	protected $sFolderNew;

	/**
	 * @var string
	 */
	protected $sFolderDone;

	/**
	 * @var string
	 */
	protected $sFolderRetry;

	/**
	 * @var string
	 */
	protected $sFolderFail;

	/**
	 * @var int
	 */
	protected $iAmountToSpool;

	/**
	 * @var int
	 */
	protected $iMaxSecondsOfRetry;

	/**
	 * @var string
	 */
	protected $oCallback;

	/**
	 * Config constructor.
	 * @param array $aData
	 */
	public function __construct(array $aData = array())
	{
		$this->sAbsolutePathToFolderSpooler = '';
		$this->sAbsolutePathToFolderAttachment = '';
		$this->aIgnoreFile = array(0=>'..',1=>'.',2=>'.ignoreMe',);
		$this->sFolderNew = "new";
		$this->sFolderDone = "done";
		$this->sFolderRetry = "retry";
		$this->sFolderFail = "fail";
		$this->iAmountToSpool = 10;
		$this->iMaxSecondsOfRetry = 7200;
		$this->oCallback = '';

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
     * @return Config
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
	public function set_sAbsolutePathToFolderSpooler($mValue)
	{
		$this->sAbsolutePathToFolderSpooler = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_sAbsolutePathToFolderAttachment($mValue)
	{
		$this->sAbsolutePathToFolderAttachment = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 */
	public function set_aIgnoreFile($mValue)
	{
		$this->aIgnoreFile = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_sFolderNew($mValue)
	{
		$this->sFolderNew = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_sFolderDone($mValue)
	{
		$this->sFolderDone = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_sFolderRetry($mValue)
	{
		$this->sFolderRetry = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_sFolderFail($mValue)
	{
		$this->sFolderFail = $mValue;

		return $this;
	}

	/**
	 * @param int $mValue 
	 * @return $this
	 */
	public function set_iAmountToSpool($mValue)
	{
		$this->iAmountToSpool = $mValue;

		return $this;
	}

	/**
	 * @param int $mValue 
	 * @return $this
	 */
	public function set_iMaxSecondsOfRetry($mValue)
	{
		$this->iMaxSecondsOfRetry = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_oCallback($mValue)
	{
		$this->oCallback = $mValue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_sAbsolutePathToFolderSpooler()
	{
		return $this->sAbsolutePathToFolderSpooler;
	}

	/**
	 * @return string
	 */
	public function get_sAbsolutePathToFolderAttachment()
	{
		return $this->sAbsolutePathToFolderAttachment;
	}

	/**
	 * @return array
	 */
	public function get_aIgnoreFile()
	{
		return $this->aIgnoreFile;
	}

	/**
	 * @return string
	 */
	public function get_sFolderNew()
	{
		return $this->sFolderNew;
	}

	/**
	 * @return string
	 */
	public function get_sFolderDone()
	{
		return $this->sFolderDone;
	}

	/**
	 * @return string
	 */
	public function get_sFolderRetry()
	{
		return $this->sFolderRetry;
	}

	/**
	 * @return string
	 */
	public function get_sFolderFail()
	{
		return $this->sFolderFail;
	}

	/**
	 * @return int
	 */
	public function get_iAmountToSpool()
	{
		return $this->iAmountToSpool;
	}

	/**
	 * @return int
	 */
	public function get_iMaxSecondsOfRetry()
	{
		return $this->iMaxSecondsOfRetry;
	}

	/**
	 * @return string
	 */
	public function get_oCallback()
	{
		return $this->oCallback;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sAbsolutePathToFolderSpooler()
	{
        return 'sAbsolutePathToFolderSpooler';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sAbsolutePathToFolderAttachment()
	{
        return 'sAbsolutePathToFolderAttachment';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_aIgnoreFile()
	{
        return 'aIgnoreFile';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sFolderNew()
	{
        return 'sFolderNew';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sFolderDone()
	{
        return 'sFolderDone';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sFolderRetry()
	{
        return 'sFolderRetry';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sFolderFail()
	{
        return 'sFolderFail';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_iAmountToSpool()
	{
        return 'iAmountToSpool';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_iMaxSecondsOfRetry()
	{
        return 'iMaxSecondsOfRetry';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_oCallback()
	{
        return 'oCallback';
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
		return '{"name":"Config","file":"Config.php","extends":"","namespace":"Email\\\\DataType","constant":[],"property":[{"key":"sAbsolutePathToFolderSpooler","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"sAbsolutePathToFolderAttachment","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"aIgnoreFile","var":"array","value":["..",".",".ignoreMe"],"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"sFolderNew","var":"string","value":"new","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"sFolderDone","var":"string","value":"done","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"sFolderRetry","var":"string","value":"retry","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"sFolderFail","var":"string","value":"fail","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"iAmountToSpool","var":"int","value":10,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"iMaxSecondsOfRetry","var":"int","value":7200,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"oCallback","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true}],"createHelperMethods":true}';
	}

}
