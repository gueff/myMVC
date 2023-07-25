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
        \MVC\Event::RUN ('DTProperty.__construct.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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

        \MVC\Event::RUN ('DTProperty.__construct.after', \MVC\DataType\DTArrayObject::create($aData));
    }

    /**
     * @param array $aData
     * @return DTProperty
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTProperty.create.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        $oObject = new self($aData);

        \MVC\Event::RUN ('DTProperty.create.after', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('DTProperty')->set_sValue($oObject)));

        return $oObject;
    }

    /**
     * @param string $sValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_key($sValue)
    {
        \MVC\Event::RUN ('DTProperty.set_key.before', \MVC\DataType\DTArrayObject::create(array('key' => $sValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
        \MVC\Event::RUN ('DTProperty.set_var.before', \MVC\DataType\DTArrayObject::create(array('var' => $sValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
        \MVC\Event::RUN ('DTProperty.set_value.before', \MVC\DataType\DTArrayObject::create(array('value' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
        \MVC\Event::RUN ('DTProperty.set_visibility.before', \MVC\DataType\DTArrayObject::create(array('visibility' => $sValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
        \MVC\Event::RUN ('DTProperty.set_static.before', \MVC\DataType\DTArrayObject::create(array('static' => $bValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
        \MVC\Event::RUN ('DTProperty.set_setter.before', \MVC\DataType\DTArrayObject::create(array('setter' => $bValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
        \MVC\Event::RUN ('DTProperty.set_getter.before', \MVC\DataType\DTArrayObject::create(array('getter' => $bValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
        \MVC\Event::RUN ('DTProperty.set_explicitMethodForValue.before', \MVC\DataType\DTArrayObject::create(array('explicitMethodForValue' => $bValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
        \MVC\Event::RUN ('DTProperty.set_listProperty.before', \MVC\DataType\DTArrayObject::create(array('listProperty' => $bValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
        \MVC\Event::RUN ('DTProperty.set_createStaticPropertyGetter.before', \MVC\DataType\DTArrayObject::create(array('createStaticPropertyGetter' => $bValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
        \MVC\Event::RUN ('DTProperty.set_setValueInConstructor.before', \MVC\DataType\DTArrayObject::create(array('setValueInConstructor' => $bValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
        \MVC\Event::RUN ('DTProperty.set_forceCasting.before', \MVC\DataType\DTArrayObject::create(array('forceCasting' => $bValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
        \MVC\Event::RUN ('DTProperty.set_required.before', \MVC\DataType\DTArrayObject::create(array('required' => $bValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
        \MVC\Event::RUN ('DTProperty.set_addMyMVCEvents.before', \MVC\DataType\DTArrayObject::create(array('addMyMVCEvents' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        $this->addMyMVCEvents = $aValue;

        return $this;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function get_key()
    {
        \MVC\Event::RUN ('DTProperty.get_key.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('key')->set_sValue($this->key))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        return $this->key;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function get_var()
    {
        \MVC\Event::RUN ('DTProperty.get_var.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('var')->set_sValue($this->var))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        return $this->var;
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function get_value()
    {
        \MVC\Event::RUN ('DTProperty.get_value.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('value')->set_sValue($this->value))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        return $this->value;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function get_visibility()
    {
        \MVC\Event::RUN ('DTProperty.get_visibility.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('visibility')->set_sValue($this->visibility))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        return $this->visibility;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_static()
    {
        \MVC\Event::RUN ('DTProperty.get_static.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('static')->set_sValue($this->static))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        return $this->static;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_setter()
    {
        \MVC\Event::RUN ('DTProperty.get_setter.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('setter')->set_sValue($this->setter))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        return $this->setter;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_getter()
    {
        \MVC\Event::RUN ('DTProperty.get_getter.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('getter')->set_sValue($this->getter))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        return $this->getter;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_explicitMethodForValue()
    {
        \MVC\Event::RUN ('DTProperty.get_explicitMethodForValue.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('explicitMethodForValue')->set_sValue($this->explicitMethodForValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        return $this->explicitMethodForValue;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_listProperty()
    {
        \MVC\Event::RUN ('DTProperty.get_listProperty.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('listProperty')->set_sValue($this->listProperty))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        return $this->listProperty;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_createStaticPropertyGetter()
    {
        \MVC\Event::RUN ('DTProperty.get_createStaticPropertyGetter.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('createStaticPropertyGetter')->set_sValue($this->createStaticPropertyGetter))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        return $this->createStaticPropertyGetter;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_setValueInConstructor()
    {
        \MVC\Event::RUN ('DTProperty.get_setValueInConstructor.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('setValueInConstructor')->set_sValue($this->setValueInConstructor))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        return $this->setValueInConstructor;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_forceCasting()
    {
        \MVC\Event::RUN ('DTProperty.get_forceCasting.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('forceCasting')->set_sValue($this->forceCasting))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        return $this->forceCasting;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_required()
    {
        \MVC\Event::RUN ('DTProperty.get_required.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('required')->set_sValue($this->forceCasting))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

        return $this->required;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_addMyMVCEvents()
    {
        \MVC\Event::RUN ('DTProperty.get_addMyMVCEvents.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('addMyMVCEvents')->set_sValue($this->addMyMVCEvents))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

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
