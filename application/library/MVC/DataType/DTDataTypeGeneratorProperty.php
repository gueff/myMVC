<?php

/**
 * @name $DataTypeDataType
 */
namespace MVC\DataType;

class DTDataTypeGeneratorProperty
{
	const DTHASH = 'ea51e4827f6a00eed609212fe6bc7461';

	const STRING = "string";

	const BOOLEAN = "bool";

	const INTEGER = "int";

	const FLOAT = "float";

	const CALLABLE = "callable";

	const ITERABLE = "iterable";

	const OBJECT = "object";

	/**
	 * @var string
	 */
	protected $key = '';

	/**
	 * @var string
	 */
	protected $var = 'string';

    /**
     * @var mixed
     */
	protected $value = null;

	/**
	 * @var string
	 */
	protected $visibility = 'protected';

    /**
     * DTProperty constructor.
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
     * @return DTDataTypeGeneratorProperty
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
	public function set_key(string $mValue)
	{
		$this->key = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_var(string $mValue)
	{
		$this->var = $mValue;

		return $this;
	}

	/**
	 * @param $mValue
	 * @return $this
	 */
	public function set_value($mValue)
	{
		$this->value = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 */
	public function set_visibility(string $mValue)
	{
		$this->visibility = $mValue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_key() : string
	{
		return $this->key;
	}

	/**
	 * @return string
	 */
	public function get_var() : string
	{
		return $this->var;
	}

	/**
	 * @return mixed
	 */
	public function get_value()
	{
		return $this->value;
	}

	/**
	 * @return string
	 */
	public function get_visibility() : string
	{
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
	public static function getPropertyName_var()
	{
        return 'var';
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
