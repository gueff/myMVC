<?php

/**
 * @name $EmailDataType
 */
namespace Email\DataType;

class EmailAttachment
{
	const DTHASH = '41ecad95b34a10ad2600c64acdef3780';

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $content;

	/**
	 * @var string
	 */
	protected $file;

	/**
	 * EmailAttachment constructor.
	 * @param array $aData
	 */
	public function __construct(array $aData = array())
	{
		$this->name = '';
		$this->content = '';
		$this->file = '';

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
     * @return EmailAttachment
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
	public function set_name($mValue)
	{
		$this->name = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_content($mValue)
	{
		$this->content = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_file($mValue)
	{
		$this->file = $mValue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_name()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function get_content()
	{
		return $this->content;
	}

	/**
	 * @return string
	 */
	public function get_file()
	{
		return $this->file;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_name()
	{
        return 'name';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_content()
	{
        return 'content';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_file()
	{
        return 'file';
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
		return '{"name":"EmailAttachment","file":"EmailAttachment.php","extends":"","namespace":"Email\\\\DataType","constant":[],"property":[{"key":"name","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"content","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"file","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true}],"createHelperMethods":true}';
	}

}
