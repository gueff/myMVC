<?php
/**
 * DTProperty.php
 * @package   myMVC
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <info@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $DataTypeDataType
 */
namespace MVC\DataType;

class DTProperty
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
     * @var bool
     */
    protected $static = false;

    /**
     * @var bool
     */
    protected $setter = true;

    /**
     * @var bool
     */
    protected $getter = true;

    /**
     * @var bool
     */
    protected $explicitMethodForValue = false;

    /**
     * @var bool
     */
    protected $listProperty = true;

    /**
     * @var bool
     */
    protected $createStaticPropertyGetter = true;

    /**
     * @var bool
     */
    protected $setValueInConstructor = true;

    /**
     * @var bool
     */
    protected $forceCasting = false;

    /**
     * DTDataTypeGeneratorProperty constructor.
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
     * @return DTProperty
     */
    public static function create(array $aData = array())
    {
        $oObject = new self($aData);

        return $oObject;
    }

    /**
     * @param string $sValue
     * @return $this
     */
    public function set_key(string $sValue)
    {
        $this->key = $sValue;

        return $this;
    }

    /**
     * @param string $sValue
     * @return $this
     */
    public function set_var(string $sValue)
    {
        $this->var = $sValue;

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
     * @param string $sValue
     * @return $this
     */
    public function set_visibility(string $sValue)
    {
        $this->visibility = $sValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     */
    public function set_static(bool $bValue)
    {
        $this->static = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     */
    public function set_setter(bool $bValue)
    {
        $this->setter = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     */
    public function set_getter(bool $bValue)
    {
        $this->getter = $bValue;

        return $this;
    }

    /**
     * @param boolean $bValue
     * @return $this
     */
    public function set_explicitMethodForValue(bool $bValue)
    {
        $this->explicitMethodForValue = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     */
    public function set_listProperty(bool $bValue)
    {
        $this->listProperty = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     */
    public function set_createStaticPropertyGetter(bool $bValue)
    {
        $this->createStaticPropertyGetter = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     */
    public function set_setValueInConstructor(bool $bValue)
    {
        $this->setValueInConstructor = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     */
    public function set_forceCasting(bool $bValue)
    {
        $this->forceCasting = $bValue;

        return $this;
    }

    /**
     * @return string
     */
    public function get_key(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function get_var(): string
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
    public function get_visibility(): string
    {
        return $this->visibility;
    }

    /**
     * @return bool
     */
    public function get_static()
    {
        return $this->static;
    }

    /**
     * @return bool
     */
    public function get_setter()
    {
        return $this->setter;
    }

    /**
     * @return bool
     */
    public function get_getter()
    {
        return $this->getter;
    }

    /**
     * @return bool
     */
    public function get_explicitMethodForValue()
    {
        return $this->explicitMethodForValue;
    }

    /**
     * @return bool
     */
    public function get_listProperty()
    {
        return $this->listProperty;
    }

    /**
     * @return bool
     */
    public function get_createStaticPropertyGetter()
    {
        return $this->createStaticPropertyGetter;
    }

    /**
     * @return bool
     */
    public function get_setValueInConstructor()
    {
        return $this->setValueInConstructor;
    }

    /**
     * @return bool
     */
    public function get_forceCasting()
    {
        return $this->forceCasting;
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
