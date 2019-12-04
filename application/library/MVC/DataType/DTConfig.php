<?php
/**
 * DTConfig.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $DataTypeDataType
 */
namespace MVC\DataType;

class DTConfig
{
	const DTHASH = 'a96372cbaface05c7ba9a83083ae7483';

	/**
	 * @var string
	 */
	protected $dir = '';

	/**
	 * @var bool
	 */
	protected $unlinkDir = '';

	/**
	 * @var \MVC\DataType\DTClass[]
	 */
	protected $class = array();

    /**
     * DTConfig constructor.
     * @param array $aData
     */
    public function __construct(array $aData = array())
    {
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
     * @return DTConfig
     */
    public static function create(array $aData = array())
    {
        $oObject = new self($aData);

        return $oObject;
    }

    /**
     * @param \MVC\DataType\DTClass $oDTClass
     * @return $this
     */
    public function add_DTClass(\MVC\DataType\DTClass $oDTClass)
    {
        $this->class[] = $oDTClass;

        return $this;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_dir(string $mValue)
	{
		$this->dir = $mValue;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 */
	public function set_unlinkDir(bool $mValue)
	{
		$this->unlinkDir = $mValue;

		return $this;
	}

	/**
	 * @param \MVC\DataType\DTClass $mValue
	 * @return $this
	 */
	public function set_class(\MVC\DataType\DTClass $mValue)
	{
		$this->class = $mValue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_dir() : string
	{
		return $this->dir;
	}

	/**
	 * @return bool
	 */
	public function get_unlinkDir() : bool
	{
		return $this->unlinkDir;
	}

	/**
	 * @return \MVC\DataType\DTClass[]
	 */
	public function get_class()
	{
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
