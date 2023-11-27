<?php
/**
 * DTArrayObject.php
 * @package   myMVC
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;


class DTArrayObject
{
    const DTHASH = '75575fbb25ada598d5a34e03168fbfa7';

    /**
     * @var \MVC\DataType\DTKeyValue[]
     */
    protected $aKeyValue;

    /**
     * @param array $aData
     * @throws \ReflectionException
     */
    public function __construct(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTArrayObject.__construct.before', $oDTValue);
        $aData = $oDTValue->get_mValue();

        $this->aKeyValue = array();

        foreach ($aData as $sKey => $mValue)
        {
            $sMethod = 'set_' . $sKey;

            if (method_exists($this, $sMethod))
            {
                $this->$sMethod($mValue);
            }
            else
            {
                $this->add_aKeyValue(DTKeyValue::create()
                    ->set_sKey($sKey)
                    ->set_sValue($mValue));
            }
        }

        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTArrayObject.__construct.after', $oDTValue);
    }

    /**
     * @param array $aData
     * @return self
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTArrayObject.create.before', $oDTValue);
        $oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::RUN ('DTArrayObject.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @param $aValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_aKeyValue($aValue)
    {
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTArrayObject.set_aKeyValue.before', $oDTValue);
        $aValue = $oDTValue->get_mValue();

        foreach ($aValue as $mKey => $aData)
        {
            if (false === ($aData instanceof \MVC\DataType\DTKeyValue))
            {
                $aValue[$mKey] = new \MVC\DataType\DTKeyValue($aData);
            }
        }

        $this->aKeyValue = $aValue;

        return $this;
    }

    /**
     * @param \MVC\DataType\DTKeyValue $mValue
     * @return $this
     * @throws \ReflectionException
     */
    public function add_aKeyValue(\MVC\DataType\DTKeyValue $mValue)
    {
        $oDTValue = DTValue::create()->set_mValue($mValue); \MVC\Event::RUN ('DTArrayObject.add_aKeyValue.before', $oDTValue);

        $this->aKeyValue[] = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @return array|\MVC\DataType\DTKeyValue[]
     * @throws \ReflectionException
     */
    public function get_aKeyValue()
    {
        $oDTValue = DTValue::create()->set_mValue($this->aKeyValue); \MVC\Event::RUN ('DTArrayObject.get_aKeyValue.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @return string
     */
    public static function getPropertyName_aKeyValue()
    {
        return 'aKeyValue';
    }

    /**
     * overrides an existing DTKeyValue Object or adds for new if it does not exist.
     * if parameter $bUnset = true, the DTKeyValue match entry will be deleted
     * @param \MVC\DataType\DTKeyValue|null $oDTKeyValueNew
     * @param bool                          $bUnset
     * @return $this
     * @throws \ReflectionException
     */
    function setDTKeyValueByKey(DTKeyValue $oDTKeyValueNew = null, bool $bUnset = false)
    {
        $oDTValue = DTValue::create()->set_mValue($oDTKeyValueNew); \MVC\Event::RUN ('DTArrayObject.setDTKeyValueByKey.before', $oDTValue->get_mValue());
        $oDTKeyValueNew = $oDTValue->get_mValue();

        if (null === $oDTKeyValueNew)
        {
            return $this;
        }

        $oDTKeyValueOld = $this->getDTKeyValueByKey($oDTKeyValueNew->get_sKey());

        // override
        if (true === isset($this->aKeyValue[$oDTKeyValueOld->get_iIndex()]))
        {
            if (false === $bUnset)
            {
                $oDTKeyValueNew->set_iIndex($oDTKeyValueOld->get_iIndex());
                $this->aKeyValue[$oDTKeyValueOld->get_iIndex()] = $oDTKeyValueNew;
            }
            else
            {
                $this->aKeyValue[$oDTKeyValueOld->get_iIndex()] = null;
                unset($this->aKeyValue[$oDTKeyValueOld->get_iIndex()]);
            }
        }
        // add
        else
        {
            if (false === $bUnset)
            {
                $this->add_aKeyValue($oDTKeyValueNew);
            }
        }

        return $this;
    }

    /**
     * @param                                  $sKey
     * @param \MVC\DataType\DTArrayObject|null $oDTArrayObject optional another $oDTArrayObject
     * @return mixed|\MVC\DataType\DTKeyValue
     * @throws \ReflectionException
     */
    function getDTKeyValueByKey($sKey = '', DTArrayObject $oDTArrayObject = null)
    {
        $oDTValue = DTValue::create()->set_mValue($sKey); \MVC\Event::RUN ('DTArrayObject.getDTKeyValueByKey.before', $oDTValue->get_mValue());
        $sKey = $oDTValue->get_mValue();

        if (null === $oDTArrayObject)
        {
            $oDTArrayObject = $this;
        }

        foreach ($oDTArrayObject->get_aKeyValue() as $iKey => $oDTKeyValue)
        {
            if ($sKey === $oDTKeyValue->get_sKey())
            {
                $oDTKeyValue->set_iIndex($iKey);
                return $oDTKeyValue;
            }
        }

        return DTKeyValue::create();
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
     * returns a simple "key" and "value" array of key value pairs stored in this object
     * notice: it does only use "sKey" and "sValue" of the DTKeyValue Object
     * @return array
     * @throws \ReflectionException
     */
    public function flatten()
    {
        $aDTKeyValue = $this->get_aKeyValue();
        $aFlatten = array();

        foreach ($aDTKeyValue as $oDTKeyValue)
        {
            (false === empty($oDTKeyValue->get_sKey()))
                ? $aFlatten[$oDTKeyValue->get_sKey()] = $oDTKeyValue->get_sValue()
                : false;
        }

        return $aFlatten;
    }
}
