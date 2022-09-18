<?php

/**
 * @name ${module}DataType
 */
namespace {module}\DataType;

class DTRoutingAdditional
{
	const DTHASH = '9dfe5fdcb08dd3d865998ef37792eda8';

	/**
	 * @var string
	 */
	protected $sTitle;

	/**
	 * @var string
	 */
	protected $sLayout;

	/**
	 * @var string
	 */
	protected $sMainmenu;

	/**
	 * @var string
	 */
	protected $sContent;

	/**
	 * @var string
	 */
	protected $sHeader;

	/**
	 * @var string
	 */
	protected $sNoscript;

	/**
	 * @var string
	 */
	protected $sCookieConsent;

	/**
	 * @var string
	 */
	protected $sFooter;

	/**
	 * @var array
	 */
	protected $aStyle;

	/**
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
		\MVC\Event::RUN ('DTRoutingAdditional.__construct.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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

		\MVC\Event::RUN ('DTRoutingAdditional.__construct.after', \MVC\DataType\DTArrayObject::create($aData));
	}

    /**
     * @param array $aData
     * @return DTRoutingAdditional
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTRoutingAdditional.create.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));
        
        $oObject = new self($aData);

        \MVC\Event::RUN ('DTRoutingAdditional.create.after', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('DTRoutingAdditional')->set_sValue($oObject)));
        
        return $oObject;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sTitle($mValue)
	{
		\MVC\Event::RUN ('DTRoutingAdditional.set_sTitle.before', \MVC\DataType\DTArrayObject::create(array('sTitle' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->sTitle = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sLayout($mValue)
	{
		\MVC\Event::RUN ('DTRoutingAdditional.set_sLayout.before', \MVC\DataType\DTArrayObject::create(array('sLayout' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->sLayout = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sMainmenu($mValue)
	{
		\MVC\Event::RUN ('DTRoutingAdditional.set_sMainmenu.before', \MVC\DataType\DTArrayObject::create(array('sMainmenu' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->sMainmenu = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sContent($mValue)
	{
		\MVC\Event::RUN ('DTRoutingAdditional.set_sContent.before', \MVC\DataType\DTArrayObject::create(array('sContent' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->sContent = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sHeader($mValue)
	{
		\MVC\Event::RUN ('DTRoutingAdditional.set_sHeader.before', \MVC\DataType\DTArrayObject::create(array('sHeader' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->sHeader = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sNoscript($mValue)
	{
		\MVC\Event::RUN ('DTRoutingAdditional.set_sNoscript.before', \MVC\DataType\DTArrayObject::create(array('sNoscript' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->sNoscript = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sCookieConsent($mValue)
	{
		\MVC\Event::RUN ('DTRoutingAdditional.set_sCookieConsent.before', \MVC\DataType\DTArrayObject::create(array('sCookieConsent' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->sCookieConsent = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sFooter($mValue)
	{
		\MVC\Event::RUN ('DTRoutingAdditional.set_sFooter.before', \MVC\DataType\DTArrayObject::create(array('sFooter' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->sFooter = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_aStyle($mValue)
	{
		\MVC\Event::RUN ('DTRoutingAdditional.set_aStyle.before', \MVC\DataType\DTArrayObject::create(array('aStyle' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->aStyle = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_aScript($mValue)
	{
		\MVC\Event::RUN ('DTRoutingAdditional.set_aScript.before', \MVC\DataType\DTArrayObject::create(array('aScript' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->aScript = $mValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sTitle()
	{
		\MVC\Event::RUN ('DTRoutingAdditional.get_sTitle.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('sTitle')->set_sValue($this->sTitle))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->sTitle;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sLayout()
	{
		\MVC\Event::RUN ('DTRoutingAdditional.get_sLayout.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('sLayout')->set_sValue($this->sLayout))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->sLayout;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sMainmenu()
	{
		\MVC\Event::RUN ('DTRoutingAdditional.get_sMainmenu.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('sMainmenu')->set_sValue($this->sMainmenu))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->sMainmenu;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sContent()
	{
		\MVC\Event::RUN ('DTRoutingAdditional.get_sContent.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('sContent')->set_sValue($this->sContent))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->sContent;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sHeader()
	{
		\MVC\Event::RUN ('DTRoutingAdditional.get_sHeader.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('sHeader')->set_sValue($this->sHeader))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->sHeader;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sNoscript()
	{
		\MVC\Event::RUN ('DTRoutingAdditional.get_sNoscript.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('sNoscript')->set_sValue($this->sNoscript))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->sNoscript;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sCookieConsent()
	{
		\MVC\Event::RUN ('DTRoutingAdditional.get_sCookieConsent.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('sCookieConsent')->set_sValue($this->sCookieConsent))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->sCookieConsent;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sFooter()
	{
		\MVC\Event::RUN ('DTRoutingAdditional.get_sFooter.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('sFooter')->set_sValue($this->sFooter))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->sFooter;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_aStyle()
	{
		\MVC\Event::RUN ('DTRoutingAdditional.get_aStyle.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aStyle')->set_sValue($this->aStyle))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->aStyle;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_aScript()
	{
		\MVC\Event::RUN ('DTRoutingAdditional.get_aScript.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aScript')->set_sValue($this->aScript))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->aScript;
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
}