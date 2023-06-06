<?php
/**
 * DTKeyValue.php
 * @package   myMVC
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <info@ueffing.net>
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
     * DTKeyValue constructor.
     * @param array $aData
     */
    public function __construct(array $aData = array())
    {
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
    }

    /**
     * @param array $aData
     * @return DTKeyValue
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
    public function set_sKey($mValue)
    {
        $this->sKey = $mValue;

        return $this;
    }

    /**
     * @param integer $iIndex
     * @return $this
     */
    public function set_iIndex($iIndex = null)
    {
        $this->iIndex = $iIndex;

        return $this;
    }

    /**
     * @param mixed $mValue
     * @return $this
     */
    public function set_sValue($mValue)
    {
        $this->sValue = $mValue;

        return $this;
    }

    /**
     * @param mixed $mValue
     * @return $this
     */
    public function set_mOptional1($mValue)
    {
        $this->mOptional1 = $mValue;

        return $this;
    }

    /**
     * @param mixed $mValue
     * @return $this
     */
    public function set_mOptional2($mValue)
    {
        $this->mOptional2 = $mValue;

        return $this;
    }

    /**
     * @param mixed $mValue
     * @return $this
     */
    public function set_mOptional3($mValue)
    {
        $this->mOptional3 = $mValue;

        return $this;
    }

    /**
     * @return string
     */
    public function get_sKey()
    {
        return $this->sKey;
    }

    /**
     * @return integer
     */
    public function get_iIndex()
    {
        return $this->iIndex;
    }

    /**
     * @return mixed
     */
    public function get_sValue()
    {
        return $this->sValue;
    }

    /**
     * @return mixed
     */
    public function get_mOptional1()
    {
        return $this->mOptional1;
    }

    /**
     * @return mixed
     */
    public function get_mOptional2()
    {
        return $this->mOptional2;
    }

    /**
     * @return mixed
     */
    public function get_mOptional3()
    {
        return $this->mOptional3;
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