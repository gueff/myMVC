<?php
/**
 * DTRequestCurrent.php
 * @package   myMVC
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\MVCTrait\TraitDataType;

class DTRequestCurrent
{
	use TraitDataType;

	const DTHASH = '7f3f9a46bb543c77b09da2575bc91d2f';

	/**
	 * @required false
	 * @var string
	 */
	protected $scheme;

	/**
	 * @required false
	 * @var string
	 */
	protected $host;

	/**
	 * @required false
	 * @var string
	 */
	protected $path;

	/**
	 * @required false
	 * @var string
	 */
	protected $query;

	/**
	 * @required false
	 * @var array
	 */
	protected $queryArray;

	/**
	 * @required false
	 * @var string
	 */
	protected $requesturi;

	/**
	 * @required false
	 * @var string
	 */
	protected $requestmethod;

	/**
	 * @required false
	 * @var string
	 */
	protected $protocol;

	/**
	 * @required false
	 * @var string
	 */
	protected $full;

	/**
	 * @required false
	 * @var string
	 */
	protected $input;

	/**
	 * @required false
	 * @var bool
	 */
	protected $isSecure;

	/**
	 * @required false
	 * @var array
	 */
	protected $headerArray;

	/**
	 * @required false
	 * @var array
	 */
	protected $pathParam;

	/**
	 * @required false
	 * @var string
	 */
	protected $ip;

	/**
	 * DTRequestCurrent constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTRequestCurrent.__construct.before', $aData);
        $aData = $oDTValue->get_mValue();

		$this->scheme = '';
		$this->host = '';
		$this->path = '';
		$this->query = '';
		$this->queryArray = array();
		$this->requesturi = '';
		$this->requestmethod = '';
		$this->protocol = '';
		$this->full = '';
		$this->input = '';
		$this->isSecure = false;
		$this->headerArray = array();
		$this->pathParam = array();
		$this->ip = '';

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTRequestCurrent.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return DTRequestCurrent
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTRequestCurrent.create.before', $oDTValue);
        $oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::RUN ('DTRequestCurrent.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_scheme($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRequestCurrent.set_scheme.before', $oDTValue);
		$this->scheme = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_host($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRequestCurrent.set_host.before', $oDTValue);
        $this->host = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $sValue
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_path($sValue)
	{
        $oDTValue = DTValue::create()->set_mValue($sValue); \MVC\Event::RUN ('DTRequestCurrent.set_path.before', $oDTValue);
        $this->path = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_query($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRequestCurrent.set_query.before', $oDTValue);
        $this->query = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param array $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_queryArray($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRequestCurrent.set_queryArray.before', $oDTValue);
        $this->queryArray = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_requesturi($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRequestCurrent.set_requesturi.before', $oDTValue);
        $this->requesturi = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_requestmethod($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRequestCurrent.set_requestmethod.before', $oDTValue);
        $this->requestmethod = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_protocol($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRequestCurrent.set_protocol.before', $oDTValue);
        $this->protocol = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_full($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRequestCurrent.set_full.before', $oDTValue);
        $this->full = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_input($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRequestCurrent.set_input.before', $oDTValue);
        $this->input = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param bool $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_isSecure($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRequestCurrent.set_isSecure.before', $oDTValue);
        $this->isSecure = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param array $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_headerArray($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRequestCurrent.set_headerArray.before', $oDTValue);
        $this->headerArray = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param array $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_pathParam($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRequestCurrent.set_pathParam.before', $oDTValue);
        $this->pathParam = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_ip($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRequestCurrent.set_ip.before', $oDTValue);
        $this->ip = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_scheme()
	{
        $oDTValue = DTValue::create()->set_mValue($this->scheme); \MVC\Event::RUN ('DTRequestCurrent.get_scheme.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_host()
	{
        $oDTValue = DTValue::create()->set_mValue($this->host); \MVC\Event::RUN ('DTRequestCurrent.get_host.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_path()
	{
        $oDTValue = DTValue::create()->set_mValue($this->path); \MVC\Event::RUN ('DTRequestCurrent.get_path.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_query()
	{
        $oDTValue = DTValue::create()->set_mValue($this->query); \MVC\Event::RUN ('DTRequestCurrent.get_query.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_queryArray()
	{
        $oDTValue = DTValue::create()->set_mValue($this->queryArray); \MVC\Event::RUN ('DTRequestCurrent.get_queryArray.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_requesturi()
	{
        $oDTValue = DTValue::create()->set_mValue($this->requesturi); \MVC\Event::RUN ('DTRequestCurrent.get_requesturi.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_requestmethod()
	{
        $oDTValue = DTValue::create()->set_mValue($this->requestmethod); \MVC\Event::RUN ('DTRequestCurrent.get_requestmethod.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_protocol()
	{
        $oDTValue = DTValue::create()->set_mValue($this->protocol); \MVC\Event::RUN ('DTRequestCurrent.get_protocol.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_full()
	{
        $oDTValue = DTValue::create()->set_mValue($this->full); \MVC\Event::RUN ('DTRequestCurrent.get_full.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_input()
	{
        $oDTValue = DTValue::create()->set_mValue($this->input); \MVC\Event::RUN ('DTRequestCurrent.get_input.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_isSecure()
	{
        $oDTValue = DTValue::create()->set_mValue($this->isSecure); \MVC\Event::RUN ('DTRequestCurrent.get_isSecure.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_headerArray()
	{
        $oDTValue = DTValue::create()->set_mValue($this->headerArray); \MVC\Event::RUN ('DTRequestCurrent.get_headerArray.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_pathParam()
	{
        $oDTValue = DTValue::create()->set_mValue($this->pathParam); \MVC\Event::RUN ('DTRequestCurrent.get_pathParam.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_ip()
	{
        $oDTValue = DTValue::create()->set_mValue($this->ip); \MVC\Event::RUN ('DTRequestCurrent.get_ip.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_scheme()
	{
        return 'scheme';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_host()
	{
        return 'host';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_path()
	{
        return 'path';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_query()
	{
        return 'query';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_queryArray()
	{
        return 'queryArray';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_requesturi()
	{
        return 'requesturi';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_requestmethod()
	{
        return 'requestmethod';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_protocol()
	{
        return 'protocol';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_full()
	{
        return 'full';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_input()
	{
        return 'input';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_isSecure()
	{
        return 'isSecure';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_headerArray()
	{
        return 'headerArray';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_pathParam()
	{
        return 'pathParam';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_ip()
	{
        return 'ip';
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
