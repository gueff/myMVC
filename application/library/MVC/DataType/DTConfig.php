<?php
/**
 * DTConfig.php
 * @package   myMVC
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

class DTConfig
{
	public const DTHASH = 'd6d0e2004444ffd7b227bbf08eeb19ff';

	/**
	 * @var string
	 */
	protected $dir;

	/**
	 * @var bool
	 */
	protected $unlinkDir;

	/**
	 * @var \MVC\DataType\DTClass[]
	 */
	protected $class;

	/**
	 * DTConfig constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTConfig.__construct.before', $oDTValue);
        $aData = $oDTValue->get_mValue();

		$this->dir = '';
		$this->unlinkDir = false;
		$this->class = array();

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTConfig.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return DTConfig
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTConfig.create.before', $oDTValue);
        $oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::RUN ('DTConfig.create.after', $oDTValue);
        
        return $oDTValue->get_mValue();
    }

    /**
     * @param \MVC\DataType\DTClass $oDTClass
     * @return $this
     * @throws \ReflectionException
     */
    public function add_DTClass(\MVC\DataType\DTClass $oDTClass)
    {
        $oDTValue = DTValue::create()->set_mValue($oDTClass); \MVC\Event::RUN ('DTConfig.add_DTClass.before', $oDTValue);
        $this->class[] = $oDTValue->get_mValue();

        return $this;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dir(string $mValue)
	{
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::RUN ('DTConfig.set_dir.before', $oDTValue);
		$this->dir = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_unlinkDir(bool $mValue)
	{
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::RUN ('DTConfig.set_unlinkDir.before', $oDTValue);
		$this->unlinkDir = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param array  $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_class(array $aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTConfig.set_class.before', $oDTValue);
        $aValue = $oDTValue->get_mValue();

		foreach ($aValue as $mKey => $aData)
        {
            if (false === ($aData instanceof \MVC\DataType\DTClass))
            {
                $aValue[$mKey] = new \MVC\DataType\DTClass($aData);
            }
        }

		$this->class = $aValue;

		return $this;
	}

    /**
     * @param \MVC\DataType\DTClass $mValue
     * @return $this
     * @throws \ReflectionException
     */
	public function add_class(\MVC\DataType\DTClass $mValue)
	{
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::RUN ('DTConfig.add_class.before', $oDTValue);
		$this->class[] = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dir() : string
	{
        $oDTValue = DTValue::create()->set_mValue($this->dir); \MVC\Event::RUN ('DTConfig.get_dir.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_unlinkDir() : bool
	{
        $oDTValue = DTValue::create()->set_mValue($this->unlinkDir); \MVC\Event::RUN ('DTConfig.get_unlinkDir.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return \MVC\DataType\DTClass[]
	 * @throws \ReflectionException
	 */
	public function get_class()
	{
        $oDTValue = DTValue::create()->set_mValue($this->class); \MVC\Event::RUN ('DTConfig.get_class.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_dir()
	{
        return 'dir';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_unlinkDir()
	{
        return 'unlinkDir';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_class()
	{
        return 'class';
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