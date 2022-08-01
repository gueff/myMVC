<?php

/**
 * @name $EmailDataType
 */
namespace Email\DataType;

class Email
{
	const DTHASH = 'becfb5736c5373b632484fbb3f091108';

	/**
	 * @var string
	 */
	protected $subject;

	/**
	 * @var array
	 */
	protected $recipientMailAdresses;

	/**
	 * @var string
	 */
	protected $text;

	/**
	 * @var string
	 */
	protected $html;

	/**
	 * @var string
	 */
	protected $senderMail;

	/**
	 * @var string
	 */
	protected $senderName;

	/**
	 * @var \MVC\DataType\DTArrayObject
	 */
	protected $oAttachment;

	/**
	 * Email constructor.
	 * @param array $aData
	 */
	public function __construct(array $aData = array())
	{
		$this->subject = '';
		$this->recipientMailAdresses = array();
		$this->text = '';
		$this->html = '';
		$this->senderMail = '';
		$this->senderName = '';
		$this->oAttachment = \MVC\DataType\DTArrayObject::create();

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
     * @return Email
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
	public function set_subject($mValue)
	{
		$this->subject = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 */
	public function set_recipientMailAdresses($mValue)
	{
		$this->recipientMailAdresses = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_text($mValue)
	{
		$this->text = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_html($mValue)
	{
		$this->html = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_senderMail($mValue)
	{
		$this->senderMail = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_senderName($mValue)
	{
		$this->senderName = $mValue;

		return $this;
	}

	/**
	 * @param \MVC\DataType\DTArrayObject $mValue 
	 * @return $this
	 */
	public function set_oAttachment($mValue)
	{
		$this->oAttachment = $mValue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_subject()
	{
		return $this->subject;
	}

	/**
	 * @return array
	 */
	public function get_recipientMailAdresses()
	{
		return $this->recipientMailAdresses;
	}

	/**
	 * @return string
	 */
	public function get_text()
	{
		return $this->text;
	}

	/**
	 * @return string
	 */
	public function get_html()
	{
		return $this->html;
	}

	/**
	 * @return string
	 */
	public function get_senderMail()
	{
		return $this->senderMail;
	}

	/**
	 * @return string
	 */
	public function get_senderName()
	{
		return $this->senderName;
	}

	/**
	 * @return \MVC\DataType\DTArrayObject
	 */
	public function get_oAttachment()
	{
		return $this->oAttachment;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_subject()
	{
        return 'subject';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_recipientMailAdresses()
	{
        return 'recipientMailAdresses';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_text()
	{
        return 'text';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_html()
	{
        return 'html';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_senderMail()
	{
        return 'senderMail';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_senderName()
	{
        return 'senderName';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_oAttachment()
	{
        return 'oAttachment';
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
		return '{"name":"Email","file":"Email.php","extends":"","namespace":"Email\\\\DataType","constant":[],"property":[{"key":"subject","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"recipientMailAdresses","var":"array","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"text","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"html","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"senderMail","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"senderName","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"oAttachment","var":"\\\\MVC\\\\DataType\\\\DTArrayObject","value":"\\\\MVC\\\\DataType\\\\DTArrayObject::create()","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true}],"createHelperMethods":true}';
	}

}
