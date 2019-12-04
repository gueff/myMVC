<?php
/**
 * DTConstant.php
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

class DTConstant
{
	const DTHASH = 'acb9966aa6a0f331436d23076ca651ed';

	/**
	 * @var string
	 */
	protected $key = '';

	/**
	 * @var mixed
	 */
	protected $value;

	/**
	 * @var string
	 */
	protected $visibility = '';

    /**
     * DTConstant constructor.
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
     * @return DTConstant
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
	 * @param mnixed $mValue
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
