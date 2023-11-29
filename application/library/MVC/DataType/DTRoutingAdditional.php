<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class DTRoutingAdditional
{
	use TraitDataType;

	public const DTHASH = 'd1146596bdc5be9f318fabe93f3bf5fb';

	/**
	 * @required true
	 * @var string
	 */
	protected $sTitle;

	/**
	 * @required true
	 * @var string
	 */
	protected $sLayout;

	/**
	 * @required true
	 * @var string
	 */
	protected $sMainmenu;

	/**
	 * @required true
	 * @var string
	 */
	protected $sContent;

	/**
	 * @required true
	 * @var string
	 */
	protected $sHeader;

	/**
	 * @required true
	 * @var string
	 */
	protected $sNoscript;

	/**
	 * @required true
	 * @var string
	 */
	protected $sCookieConsent;

	/**
	 * @required true
	 * @var string
	 */
	protected $sFooter;

	/**
	 * @required true
	 * @var array
	 */
	protected $aStyle;

	/**
	 * @required true
	 * @var array
	 */
	protected $aScript;

	/**
	 * DTRoutingAdditional constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		$oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('DTRoutingAdditional.__construct.before', $oDTValue);
		$aData = $oDTValue->get_mValue();

		$this->sTitle = '';
		$this->sLayout = '';
		$this->sMainmenu = '';
		$this->sContent = '';
		$this->sHeader = '';
		$this->sNoscript = '';
		$this->sCookieConsent = '';
		$this->sFooter = '';
		$this->aStyle = array();
		$this->aScript = array();

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		$oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::run('DTRoutingAdditional.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return DTRoutingAdditional
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('DTRoutingAdditional.create.before', $oDTValue);
		$oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::run('DTRoutingAdditional.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sTitle(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoutingAdditional.set_sTitle.before', $oDTValue);
		$this->sTitle = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sLayout(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoutingAdditional.set_sLayout.before', $oDTValue);
		$this->sLayout = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sMainmenu(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoutingAdditional.set_sMainmenu.before', $oDTValue);
		$this->sMainmenu = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sContent(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoutingAdditional.set_sContent.before', $oDTValue);
		$this->sContent = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sHeader(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoutingAdditional.set_sHeader.before', $oDTValue);
		$this->sHeader = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sNoscript(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoutingAdditional.set_sNoscript.before', $oDTValue);
		$this->sNoscript = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sCookieConsent(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoutingAdditional.set_sCookieConsent.before', $oDTValue);
		$this->sCookieConsent = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sFooter(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoutingAdditional.set_sFooter.before', $oDTValue);
		$this->sFooter = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_aStyle(array $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoutingAdditional.set_aStyle.before', $oDTValue);
		$this->aStyle = (array) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_aScript(array $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoutingAdditional.set_aScript.before', $oDTValue);
		$this->aScript = (array) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sTitle() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sTitle); 
		\MVC\Event::run('DTRoutingAdditional.get_sTitle.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sLayout() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sLayout); 
		\MVC\Event::run('DTRoutingAdditional.get_sLayout.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sMainmenu() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sMainmenu); 
		\MVC\Event::run('DTRoutingAdditional.get_sMainmenu.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sContent() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sContent); 
		\MVC\Event::run('DTRoutingAdditional.get_sContent.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sHeader() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sHeader); 
		\MVC\Event::run('DTRoutingAdditional.get_sHeader.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sNoscript() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sNoscript); 
		\MVC\Event::run('DTRoutingAdditional.get_sNoscript.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sCookieConsent() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sCookieConsent); 
		\MVC\Event::run('DTRoutingAdditional.get_sCookieConsent.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sFooter() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sFooter); 
		\MVC\Event::run('DTRoutingAdditional.get_sFooter.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_aStyle() : array
	{
		$oDTValue = DTValue::create()->set_mValue($this->aStyle); 
		\MVC\Event::run('DTRoutingAdditional.get_aStyle.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_aScript() : array
	{
		$oDTValue = DTValue::create()->set_mValue($this->aScript); 
		\MVC\Event::run('DTRoutingAdditional.get_aScript.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sTitle()
	{
        return 'sTitle';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sLayout()
	{
        return 'sLayout';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sMainmenu()
	{
        return 'sMainmenu';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sContent()
	{
        return 'sContent';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sHeader()
	{
        return 'sHeader';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sNoscript()
	{
        return 'sNoscript';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sCookieConsent()
	{
        return 'sCookieConsent';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sFooter()
	{
        return 'sFooter';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_aStyle()
	{
        return 'aStyle';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_aScript()
	{
        return 'aScript';
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
