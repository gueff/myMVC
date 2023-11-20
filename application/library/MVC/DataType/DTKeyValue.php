<?php
/**
 * DTKeyValue.php
 * @package   myMVC
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

class DTKeyValue
{
    const DTHASH = 'be72abf628236331ab7b97775e8e4bb1';

    /**
     * @var string
     */
    protected $sKey;

    /**
     * @var integer
     */
    protected $iIndex;

    /**
     * @var mixed
     */
    protected $sValue;

    /**
     * @var mixed
     */
    protected $mOptional1;

    /**
     * @var mixed
     */
    protected $mOptional2;

    /**
     * @var mixed
     */
    protected $mOptional3;

    /**
     * @param array $aData
     * @throws \ReflectionException
     */
    public function __construct(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTKeyValue.__construct.before', $oDTValue);
        $aData = $oDTValue->get_mValue();

        $this->sKey = '';
        $this->sValue = null;
        $this->mOptional1 = null;
        $this->mOptional2 = null;
        $this->mOptional3 = null;

        foreach ($aData as $sKey => $mValue)
        {
            $sMethod = 'set_' . $sKey;

            if (method_exists($this, $sMethod))
            {
                $this->$sMethod($mValue);
            }
        }

        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTKeyValue.__construct.after', $oDTValue);
    }

    /**
     * @param array $aData
     * @return self
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTKeyValue.create.before', $oDTValue);
        $oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::RUN ('DTKeyValue.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @param $mValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_sKey($mValue)
    {
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::run('DTKeyValue.set_sKey.before', $oDTValue);
        $this->sKey = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param $iIndex
     * @return $this
     * @throws \ReflectionException
     */
    public function set_iIndex($iIndex = null)
    {
        $oDTValue = DTValue::create()->set_mValue($iIndex); \MVC\Event::run('DTKeyValue.set_iIndex.before', $oDTValue);
        $this->iIndex = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param $mValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_sValue($mValue)
    {
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::run('DTKeyValue.set_sValue.before', $oDTValue);
        $this->sValue = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param $mValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_mOptional1($mValue)
    {
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::run('DTKeyValue.set_mOptional1.before', $oDTValue);
        $this->mOptional1 = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param $mValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_mOptional2($mValue)
    {
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::run('DTKeyValue.set_mOptional2.before', $oDTValue);
        $this->mOptional2 = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @param $mValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_mOptional3($mValue)
    {
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::run('DTKeyValue.set_mOptional3.before', $oDTValue);
        $this->mOptional3 = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function get_sKey()
    {
        $oDTValue = DTValue::create()->set_mValue($this->sKey); \MVC\Event::run('DTKeyValue.get_sKey.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return int
     * @throws \ReflectionException
     */
    public function get_iIndex()
    {
        $oDTValue = DTValue::create()->set_mValue($this->iIndex); \MVC\Event::run('DTKeyValue.get_iIndex.before', $oDTValue);

        return (int) $oDTValue->get_mValue();
    }

    /**
     * @return mixed|null
     * @throws \ReflectionException
     */
    public function get_sValue()
    {
        $oDTValue = DTValue::create()->set_mValue($this->sValue); \MVC\Event::run('DTKeyValue.get_sValue.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return mixed|null
     * @throws \ReflectionException
     */
    public function get_mOptional1()
    {
        $oDTValue = DTValue::create()->set_mValue($this->mOptional1); \MVC\Event::run('DTKeyValue.get_mOptional1.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return mixed|null
     * @throws \ReflectionException
     */
    public function get_mOptional2()
    {
        $oDTValue = DTValue::create()->set_mValue($this->mOptional2); \MVC\Event::run('DTKeyValue.get_mOptional2.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return mixed|null
     * @throws \ReflectionException
     */
    public function get_mOptional3()
    {
        $oDTValue = DTValue::create()->set_mValue($this->mOptional3); \MVC\Event::run('DTKeyValue.get_mOptional3.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return string
     */
    public static function getPropertyName_sKey()
    {
        return 'sKey';
    }

    /**
     * @return string
     */
    public static function getPropertyName_sValue()
    {
        return 'sValue';
    }

    /**
     * @return string
     */
    public static function getPropertyName_mOptional1()
    {
        return 'mOptional1';
    }

    /**
     * @return string
     */
    public static function getPropertyName_mOptional2()
    {
        return 'mOptional2';
    }

    /**
     * @return string
     */
    public static function getPropertyName_mOptional3()
    {
        return 'mOptional3';
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

    /**
     * @return string JSON
     */
    public function getDataTypeConfigJSON()
    {
        return '{"name":"KeyValue","file":"KeyValue.php","extends":"","namespace":"MVC\\\\DataType","constant":[],"property":[{"key":"sKey","var":"string","value":null,"visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"sValue","var":"mixed","value":"null","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"mOptional1","var":"mixed","value":"null","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"mOptional2","var":"mixed","value":"null","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true},{"key":"mOptional3","var":"mixed","value":"null","visibility":"protected","static":false,"setter":true,"getter":true,"explicitMethodForValue":false,"listProperty":true,"createStaticPropertyGetter":true,"setValueInConstructor":true}],"createHelperMethods":true}';
    }
}