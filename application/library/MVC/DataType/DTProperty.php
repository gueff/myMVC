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
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTProperty.__construct.before', $oDTValue);
        $aData = $oDTValue->get_mValue();

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

        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTProperty.__construct.after', $oDTValue);
    }

    /**
     * @param array $aData
     * @return DTProperty
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTProperty.create.before', $oDTValue);
        $oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::RUN ('DTProperty.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @param string $sValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_key($sValue)
    {
        $oDTValue = DTValue::create()->set_mValue($sValue); \MVC\Event::RUN ('DTProperty.set_key.before', $oDTValue);
        $this->key = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param string $sValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_var($sValue)
    {
        $oDTValue = DTValue::create()->set_mValue($sValue); \MVC\Event::RUN ('DTProperty.set_var.before', $oDTValue);
        $this->var = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param mixed $mValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_value($mValue)
    {
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::RUN ('DTProperty.set_value.before', $oDTValue);
        $this->value = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param string $sValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_visibility($sValue)
    {
        $oDTValue = DTValue::create()->set_mValue($sValue); \MVC\Event::RUN ('DTProperty.set_visibility.before', $oDTValue);
        $this->visibility = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_static($bValue)
    {
        $oDTValue = DTValue::create()->set_mValue($bValue); \MVC\Event::RUN ('DTProperty.set_static.before', $oDTValue);
        $this->static = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_setter($bValue)
    {
        $oDTValue = DTValue::create()->set_mValue($bValue); \MVC\Event::RUN ('DTProperty.set_setter.before', $oDTValue);
        $this->setter = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_getter($bValue)
    {
        $oDTValue = DTValue::create()->set_mValue($bValue); \MVC\Event::RUN ('DTProperty.set_getter.before', $oDTValue);
        $this->getter = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_explicitMethodForValue($bValue)
    {
        $oDTValue = DTValue::create()->set_mValue($bValue); \MVC\Event::RUN ('DTProperty.set_explicitMethodForValue.before', $oDTValue);
        $this->explicitMethodForValue = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_listProperty($bValue)
    {
        $oDTValue = DTValue::create()->set_mValue($bValue); \MVC\Event::RUN ('DTProperty.set_listProperty.before', $oDTValue);
        $this->listProperty = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_createStaticPropertyGetter($bValue)
    {
        $oDTValue = DTValue::create()->set_mValue($bValue); \MVC\Event::RUN ('DTProperty.set_createStaticPropertyGetter.before', $oDTValue);
        $this->createStaticPropertyGetter = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_setValueInConstructor($bValue)
    {
        $oDTValue = DTValue::create()->set_mValue($bValue); \MVC\Event::RUN ('DTProperty.set_setValueInConstructor.before', $oDTValue);
        $this->setValueInConstructor = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_forceCasting($bValue)
    {
        $oDTValue = DTValue::create()->set_mValue($bValue); \MVC\Event::RUN ('DTProperty.set_forceCasting.before', $oDTValue);
        $this->forceCasting = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param bool $bValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_required($bValue)
    {
        $oDTValue = DTValue::create()->set_mValue($bValue); \MVC\Event::RUN ('DTProperty.set_required.before', $oDTValue);
        $this->required = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param bool $aValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_addMyMVCEvents($aValue)
    {
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTProperty.set_addMyMVCEvents.before', $oDTValue);
        $this->addMyMVCEvents = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function get_key()
    {
        $oDTValue = DTValue::create()->set_mValue($this->key); \MVC\Event::RUN ('DTProperty.get_key.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function get_var()
    {
        $oDTValue = DTValue::create()->set_mValue($this->var); \MVC\Event::RUN ('DTProperty.get_var.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function get_value()
    {
        $oDTValue = DTValue::create()->set_mValue($this->value); \MVC\Event::RUN ('DTProperty.get_value.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function get_visibility()
    {
        $oDTValue = DTValue::create()->set_mValue($this->visibility); \MVC\Event::RUN ('DTProperty.get_visibility.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_static()
    {
        $oDTValue = DTValue::create()->set_mValue($this->static); \MVC\Event::RUN ('DTProperty.get_static.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_setter()
    {
        $oDTValue = DTValue::create()->set_mValue($this->setter); \MVC\Event::RUN ('DTProperty.get_setter.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_getter()
    {
        $oDTValue = DTValue::create()->set_mValue($this->getter); \MVC\Event::RUN ('DTProperty.get_getter.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_explicitMethodForValue()
    {
        $oDTValue = DTValue::create()->set_mValue($this->explicitMethodForValue); \MVC\Event::RUN ('DTProperty.get_explicitMethodForValue.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_listProperty()
    {
        $oDTValue = DTValue::create()->set_mValue($this->listProperty); \MVC\Event::RUN ('DTProperty.get_listProperty.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_createStaticPropertyGetter()
    {
        $oDTValue = DTValue::create()->set_mValue($this->createStaticPropertyGetter); \MVC\Event::RUN ('DTProperty.get_createStaticPropertyGetter.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_setValueInConstructor()
    {
        $oDTValue = DTValue::create()->set_mValue($this->setValueInConstructor); \MVC\Event::RUN ('DTProperty.get_setValueInConstructor.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_forceCasting()
    {
        $oDTValue = DTValue::create()->set_mValue($this->forceCasting); \MVC\Event::RUN ('DTProperty.get_forceCasting.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_required()
    {
        $oDTValue = DTValue::create()->set_mValue($this->required); \MVC\Event::RUN ('DTProperty.get_required.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_addMyMVCEvents()
    {
        $oDTValue = DTValue::create()->set_mValue($this->addMyMVCEvents); \MVC\Event::RUN ('DTProperty.get_addMyMVCEvents.before', $oDTValue);

        return $oDTValue->get_mValue();
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
