<?php
/**
 * DTRoute.php
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

class DTRoute
{
	use TraitDataType;

	const DTHASH = '68791994b30f4c19747ff6db589d6b0d';

	/**
	 * @required true
	 * @var string
	 */
	protected $path;

	/**
	 * @required false
	 * @var string
	 */
	protected $method;

	/**
	 * @required false
	 * @var array
	 */
	protected $methodsAssigned;

	/**
	 * @required false
	 * @var string
	 */
	protected $query;

	/**
	 * @required false
	 * @var string
	 */
	protected $class;

	/**
	 * @required false
	 * @var string
	 */
	protected $classFile;

	/**
	 * @required false
	 * @var string
	 */
	protected $module;

	/**
	 * @required false
	 * @var string
	 */
	protected $c;

	/**
	 * @required false
	 * @var string
	 */
	protected $m;

	/**
	 * @required false
	 * @var mixed
	 */
	protected $additional;

	/**
	 * DTRoute constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTRoute.__construct.before', $oDTValue);
        $aData = $oDTValue->get_mValue();

		$this->path = '';
		$this->method = '';
		$this->methodsAssigned = array();
		$this->query = '';
		$this->class = '';
		$this->classFile = '';
		$this->module = '';
		$this->c = '';
		$this->m = '';
		$this->additional = null;

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTRoute.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return DTRoute
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTRoute.create.before', $oDTValue);
        $oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::RUN ('DTRoute.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_path($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRoute.set_path.before', $oDTValue);
		$this->path = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_method($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRoute.set_method.before', $oDTValue);
        $this->method = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param array $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_methodsAssigned($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRoute.set_methodsAssigned.before', $oDTValue);
        $this->methodsAssigned = (array) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_query($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRoute.set_query.before', $oDTValue);
        $this->query = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_class($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRoute.set_class.before', $oDTValue);
        $this->class = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_classFile($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRoute.set_classFile.before', $oDTValue);
        $this->classFile = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_module($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRoute.set_module.before', $oDTValue);
        $this->module = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_c($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRoute.set_c.before', $oDTValue);
        $this->c = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_m($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRoute.set_m.before', $oDTValue);
        $this->m = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param mixed $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_additional($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTRoute.set_additional.before', $oDTValue);
        $this->additional = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_path()
	{
        $oDTValue = DTValue::create()->set_mValue($this->path); \MVC\Event::RUN ('DTRoute.get_path.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_method()
	{
        $oDTValue = DTValue::create()->set_mValue($this->method); \MVC\Event::RUN ('DTRoute.get_method.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_methodsAssigned()
	{
        $oDTValue = DTValue::create()->set_mValue($this->methodsAssigned); \MVC\Event::RUN ('DTRoute.get_methodsAssigned.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_query()
	{
        $oDTValue = DTValue::create()->set_mValue($this->query); \MVC\Event::RUN ('DTRoute.get_query.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_class()
	{
        $oDTValue = DTValue::create()->set_mValue($this->class); \MVC\Event::RUN ('DTRoute.get_class.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_classFile()
	{
        $oDTValue = DTValue::create()->set_mValue($this->classFile); \MVC\Event::RUN ('DTRoute.get_classFile.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_module()
	{
        $oDTValue = DTValue::create()->set_mValue($this->module); \MVC\Event::RUN ('DTRoute.get_module.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_c()
	{
        $oDTValue = DTValue::create()->set_mValue($this->c); \MVC\Event::RUN ('DTRoute.get_c.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_m()
	{
        $oDTValue = DTValue::create()->set_mValue($this->m); \MVC\Event::RUN ('DTRoute.get_m.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return mixed
	 * @throws \ReflectionException
	 */
	public function get_additional()
	{
        $oDTValue = DTValue::create()->set_mValue($this->additional); \MVC\Event::RUN ('DTRoute.get_additional.before', $oDTValue);

        return $oDTValue->get_mValue();
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
	public static function getPropertyName_method()
	{
        return 'method';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_methodsAssigned()
	{
        return 'methodsAssigned';
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
	public static function getPropertyName_class()
	{
        return 'class';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_classFile()
	{
        return 'classFile';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_module()
	{
        return 'module';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_c()
	{
        return 'c';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_m()
	{
        return 'm';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_additional()
	{
        return 'additional';
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
