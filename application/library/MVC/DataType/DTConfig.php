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
		\MVC\Event::RUN ('DTConfig.__construct.before', $aData);

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

		\MVC\Event::RUN ('DTConfig.__construct.after', $aData);
	}

    /**
     * @param array $aData
     * @return DTConfig
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTConfig.create.before', $aData);
        
        $oObject = new self($aData);

        \MVC\Event::RUN ('DTConfig.create.after', $oObject);
        
        return $oObject;
    }

    /**
     * @param \MVC\DataType\DTClass $oDTClass
     * @return $this
     */
    public function add_DTClass(\MVC\DataType\DTClass $oDTClass)
    {
        \MVC\Event::RUN ('DTConfig.add_DTClass.before', $oDTClass);

        $this->class[] = $oDTClass;

        return $this;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dir(string $mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_dir.before', $mValue);

		$this->dir = $mValue;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_unlinkDir(bool $mValue)
	{
		\MVC\Event::RUN ('DTConfig.set_unlinkDir.before', $mValue);

		$this->unlinkDir = $mValue;

		return $this;
	}

	/**
	 * @param array  $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_class(array $aValue)
	{
		\MVC\Event::RUN ('DTConfig.set_class.before', $aValue);

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
	 */
	public function add_class(\MVC\DataType\DTClass $mValue)
	{
        \MVC\Event::RUN ('DTConfig.add_class.before', $mValue);

		$this->class[] = $mValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dir() : string
	{
		\MVC\Event::RUN ('DTConfig.get_dir.before', $this->dir);

		return $this->dir;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_unlinkDir() : bool
	{
		\MVC\Event::RUN ('DTConfig.get_unlinkDir.before', $this->unlinkDir);

		return $this->unlinkDir;
	}

	/**
	 * @return \MVC\DataType\DTClass[]
	 * @throws \ReflectionException
	 */
	public function get_class()
	{
		\MVC\Event::RUN ('DTConfig.get_class.before', $this->class);

		return $this->class;
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