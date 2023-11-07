<?php
/**
 * DTProperty.php
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

class DTProperty
{
    use TraitDataType;

    const DTHASH = '88ac10667ca82b0079db6d1dce6d6808';

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $var;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string
     */
    protected $visibility;

    /**
     * @var bool
     */
    protected $static;

    /**
     * @var bool
     */
    protected $setter;

    /**
     * @var bool
     */
    protected $getter;

    /**
     * @var bool
     */
    protected $explicitMethodForValue;

    /**
     * @var bool
     */
    protected $listProperty;

    /**
     * @var bool
     */
    protected $createStaticPropertyGetter;

    /**
     * @var bool
     */
    protected $setValueInConstructor;

    /**
     * @var bool
     */
    protected $forceCasting;

    /**
     * @var bool
     */
    protected $required;

    /**
     * @var bool
     */
    protected $addMyMVCEvents;

    /**
     * DTProperty constructor.
     * @param array $aData
     * @throws \ReflectionException
     */
    public function __construct(array $aData = array())
    {
        \MVC\Event::RUN ('DTProperty.__construct.before', $aData);

        $this->key = '';
        $this->var = "string";
        $this->value = null;
        $this->visibility = "protected";
        $this->static = false;
        $this->setter = true;
        $this->getter = true;
        $this->explicitMethodForValue = false;
        $this->listProperty = true;
        $this->createStaticPropertyGetter = true;
        $this->setValueInConstructor = true;
        $this->forceCasting = false;
        $this->required = false;
        $this->addMyMVCEvents = true;

        foreach ($aData as $sKey => $mValue)
        {
            $sMethod = 'set_' . $sKey;

            if (method_exists($this, $sMethod))
            {
                $this->$sMethod($mValue);
            }
        }

        \MVC\Event::RUN ('DTProperty.__construct.after', $aData);
    }

    /**
     * @param array $aData
     * @return DTProperty
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTProperty.create.before', $aData);

        $oObject = new self($aData);

        \MVC\Event::RUN ('DTProperty.create.after', $oObject);

        return $oObject;
    }

    /**
     * @param string $sValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_key($sValue)
    {
        \MVC\Event::RUN ('DTProperty.set_key.before', $sValue);

        $this->key = $sValue;

        return $this;
    }

    /**
     * @param string $sValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_var($sValue)
    {
        \MVC\Event::RUN ('DTProperty.set_var.before', $sValue);

        $this->var = $sValue;

        return $this;
    }

    /**
     * @param mixed $mValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_value($mValue)
    {
        \MVC\Event::RUN ('DTProperty.set_value.before', $mValue);

        $this->value = $mValue;

        return $this;
    }

    /**
     * @param string $sValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_visibility($sValue)
    {
        \MVC\Event::RUN ('DTProperty.set_visibility.before', $sValue);

        $this->visibility = $sValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_static($bValue)
    {
        \MVC\Event::RUN ('DTProperty.set_static.before', $bValue);

        $this->static = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_setter($bValue)
    {
        \MVC\Event::RUN ('DTProperty.set_setter.before', $bValue);

        $this->setter = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_getter($bValue)
    {
        \MVC\Event::RUN ('DTProperty.set_getter.before', $bValue);

        $this->getter = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_explicitMethodForValue($bValue)
    {
        \MVC\Event::RUN ('DTProperty.set_explicitMethodForValue.before', $bValue);

        $this->explicitMethodForValue = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_listProperty($bValue)
    {
        \MVC\Event::RUN ('DTProperty.set_listProperty.before', $bValue);

        $this->listProperty = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_createStaticPropertyGetter($bValue)
    {
        \MVC\Event::RUN ('DTProperty.set_createStaticPropertyGetter.before', $bValue);

        $this->createStaticPropertyGetter = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_setValueInConstructor($bValue)
    {
        \MVC\Event::RUN ('DTProperty.set_setValueInConstructor.before', $bValue);

        $this->setValueInConstructor = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_forceCasting($bValue)
    {
        \MVC\Event::RUN ('DTProperty.set_forceCasting.before', $bValue);

        $this->forceCasting = $bValue;

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_required($bValue)
    {
        \MVC\Event::RUN ('DTProperty.set_required.before', $bValue);

        $this->required = $bValue;

        return $this;
    }

    /**
     * @param bool $aValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_addMyMVCEvents($aValue)
    {
        \MVC\Event::RUN ('DTProperty.set_addMyMVCEvents.before', $aValue);

        $this->addMyMVCEvents = $aValue;

        return $this;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function get_key()
    {
        \MVC\Event::RUN ('DTProperty.get_key.before', $this->key);

        return $this->key;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function get_var()
    {
        \MVC\Event::RUN ('DTProperty.get_var.before', $this->var);

        return $this->var;
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function get_value()
    {
        \MVC\Event::RUN ('DTProperty.get_value.before', $this->value);

        return $this->value;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function get_visibility()
    {
        \MVC\Event::RUN ('DTProperty.get_visibility.before', $this->visibility);

        return $this->visibility;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_static()
    {
        \MVC\Event::RUN ('DTProperty.get_static.before', $this->static);

        return $this->static;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_setter()
    {
        \MVC\Event::RUN ('DTProperty.get_setter.before', $this->setter);

        return $this->setter;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_getter()
    {
        \MVC\Event::RUN ('DTProperty.get_getter.before', $this->getter);

        return $this->getter;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_explicitMethodForValue()
    {
        \MVC\Event::RUN ('DTProperty.get_explicitMethodForValue.before', $this->explicitMethodForValue);

        return $this->explicitMethodForValue;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_listProperty()
    {
        \MVC\Event::RUN ('DTProperty.get_listProperty.before', $this->listProperty);

        return $this->listProperty;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_createStaticPropertyGetter()
    {
        \MVC\Event::RUN ('DTProperty.get_createStaticPropertyGetter.before', $this->createStaticPropertyGetter);

        return $this->createStaticPropertyGetter;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_setValueInConstructor()
    {
        \MVC\Event::RUN ('DTProperty.get_setValueInConstructor.before', $this->setValueInConstructor);

        return $this->setValueInConstructor;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_forceCasting()
    {
        \MVC\Event::RUN ('DTProperty.get_forceCasting.before', $this->forceCasting);

        return $this->forceCasting;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_required()
    {
        \MVC\Event::RUN ('DTProperty.get_required.before', $this->required);

        return $this->required;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_addMyMVCEvents()
    {
        \MVC\Event::RUN ('DTProperty.get_addMyMVCEvents.before', $this->addMyMVCEvents);

        return $this->addMyMVCEvents;
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
     * @return string
     */
    public static function getPropertyName_static()
    {
        return 'static';
    }

    /**
     * @return string
     */
    public static function getPropertyName_setter()
    {
        return 'setter';
    }

    /**
     * @return string
     */
    public static function getPropertyName_getter()
    {
        return 'getter';
    }

    /**
     * @return string
     */
    public static function getPropertyName_explicitMethodForValue()
    {
        return 'explicitMethodForValue';
    }

    /**
     * @return string
     */
    public static function getPropertyName_listProperty()
    {
        return 'listProperty';
    }

    /**
     * @return string
     */
    public static function getPropertyName_createStaticPropertyGetter()
    {
        return 'createStaticPropertyGetter';
    }

    /**
     * @return string
     */
    public static function getPropertyName_setValueInConstructor()
    {
        return 'setValueInConstructor';
    }

    /**
     * @return string
     */
    public static function getPropertyName_forceCasting()
    {
        return 'forceCasting';
    }

    /**
     * @return string
     */
    public static function getPropertyName_required()
    {
        return 'required';
    }

    /**
     * @return string
     */
    public static function getPropertyName_addMyMVCEvents()
    {
        return 'addMyMVCEvents';
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
