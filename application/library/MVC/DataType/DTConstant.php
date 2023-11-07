<?php
/**
 * DTConstant.php
 * @package   myMVC
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

class DTConstant
{
	public const DTHASH = 'db831a10dbfd980ff4183c8f0be6610c';

	/**
	 * @var string
	 */
	protected $key;

	/**
	 * @var mixed
	 */
	protected $value;

	/**
	 * @var string
	 */
	protected $visibility;

	/**
	 * DTConstant constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		\MVC\Event::RUN ('DTConstant.__construct.before', $aData);

		$this->key = '';
		$this->value = null;
		$this->visibility = '';

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		\MVC\Event::RUN ('DTConstant.__construct.after', $aData);
	}

    /**
     * @param array $aData
     * @return DTConstant
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTConstant.create.before', $aData);

        $oObject = new self($aData);

        \MVC\Event::RUN ('DTConstant.create.after', $oObject);

        return $oObject;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_key(string $mValue)
	{
		\MVC\Event::RUN ('DTConstant.set_key.before', $mValue);

		$this->key = $mValue;

		return $this;
	}

	/**
	 * @param mixed $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_value($mValue)
	{
		\MVC\Event::RUN ('DTConstant.set_value.before', $mValue);

		$this->value = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_visibility(string $mValue)
	{
		\MVC\Event::RUN ('DTConstant.set_visibility.before', $mValue);

		$this->visibility = $mValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_key() : string
	{
		\MVC\Event::RUN ('DTConstant.get_key.before', $this->key);

		return $this->key;
	}

	/**
	 * @return mixed
	 * @throws \ReflectionException
	 */
	public function get_value()
	{
		\MVC\Event::RUN ('DTConstant.get_value.before', $this->value);

		return $this->value;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_visibility() : string
	{
		\MVC\Event::RUN ('DTConstant.get_visibility.before', $this->visibility);

		return $this->visibility;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_key()
	{
        return 'key';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_value()
	{
        return 'value';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_visibility()
	{
        return 'visibility';
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