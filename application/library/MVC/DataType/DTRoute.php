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
		\MVC\Event::RUN ('DTRoute.__construct.before', $aData);

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

		\MVC\Event::RUN ('DTRoute.__construct.after', $aData);
	}

    /**
     * @param array $aData
     * @return DTRoute
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTRoute.create.before', $aData);

        $oObject = new self($aData);

        \MVC\Event::RUN ('DTRoute.create.after', $oObject);

        return $oObject;
    }

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_path($aValue)
	{
		\MVC\Event::RUN ('DTRoute.set_path.before', $aValue);

		$this->path = (string) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_method($aValue)
	{
		\MVC\Event::RUN ('DTRoute.set_method.before', $aValue);

        $this->method = (string) $aValue;

		return $this;
	}

	/**
	 * @param array $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_methodsAssigned($aValue)
	{
		\MVC\Event::RUN ('DTRoute.set_methodsAssigned.before', $aValue);

        $this->methodsAssigned = (array) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_query($aValue)
	{
		\MVC\Event::RUN ('DTRoute.set_query.before', $aValue);

        $this->query = (string) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_class($aValue)
	{
		\MVC\Event::RUN ('DTRoute.set_class.before', $aValue);

        $this->class = (string) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_classFile($aValue)
	{
		\MVC\Event::RUN ('DTRoute.set_classFile.before', $aValue);

        $this->classFile = (string) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_module($aValue)
	{
		\MVC\Event::RUN ('DTRoute.set_module.before', $aValue);

        $this->module = (string) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_c($aValue)
	{
		\MVC\Event::RUN ('DTRoute.set_c.before', $aValue);

        $this->c = (string) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_m($aValue)
	{
		\MVC\Event::RUN ('DTRoute.set_m.before', $aValue);

        $this->m = (string) $aValue;

		return $this;
	}

	/**
	 * @param mixed $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_additional($aValue)
	{
		\MVC\Event::RUN ('DTRoute.set_additional.before', $aValue);

        $this->additional = $aValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_path()
	{
		\MVC\Event::RUN ('DTRoute.get_path.before', $this->path);

		return $this->path;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_method()
	{
		\MVC\Event::RUN ('DTRoute.get_method.before', $this->method);

        return $this->method;
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_methodsAssigned()
	{
		\MVC\Event::RUN ('DTRoute.get_methodsAssigned.before', $this->methodsAssigned);

        return $this->methodsAssigned;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_query()
	{
		\MVC\Event::RUN ('DTRoute.get_query.before', $this->query);

        return $this->query;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_class()
	{
		\MVC\Event::RUN ('DTRoute.get_class.before', $this->class);

        return $this->class;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_classFile()
	{
		\MVC\Event::RUN ('DTRoute.get_classFile.before', $this->classFile);

        return $this->classFile;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_module()
	{
		\MVC\Event::RUN ('DTRoute.get_module.before', $this->module);

        return $this->module;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_c()
	{
		\MVC\Event::RUN ('DTRoute.get_c.before', $this->c);

        return $this->c;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_m()
	{
		\MVC\Event::RUN ('DTRoute.get_m.before', $this->m);

        return $this->m;
	}

	/**
	 * @return mixed
	 * @throws \ReflectionException
	 */
	public function get_additional()
	{
		\MVC\Event::RUN ('DTRoute.get_additional.before', $this->additional);

        return $this->additional;
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
