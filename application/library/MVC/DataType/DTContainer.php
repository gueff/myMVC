<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;


/**
 * @example
   $oDTContainer = DTContainer::create()
   ->set_bSuccess(false)
   ->set_mData(123)
   ->add_Message(E_USER_NOTICE, 'foo')
   ->add_Message(E_USER_WARNING, 'bar')
   ->add_Message(E_USER_NOTICE, 'baz')
   ->add_Message(E_USER_ERROR, 'fatal error on foo')
   ;
   info($oDTContainer->get_Message()->get(E_USER_NOTICE));
 */

class DTContainer
{
    protected static $_oInstance;

    /**
     * @required true
     * @var bool
     */
    protected $bSuccess;

    /**
     * @required true
     * @var \MVC\ArrDot
     */
    protected $oMessage;

    /**
     * @required true
     * @var mixed
     */
    protected $mData;

    /**
     *
     */
    protected function __construct()
    {
        $this->bSuccess = false;
        $this->oMessage = new \MVC\ArrDot();
        $this->mData = null;
    }

    /**
     * @return self
     */
    public static function create() : self
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self();
        }

        return self::$_oInstance;
    }

    /**
     * @param string $sMessage
     * @param string $sValue
     * @return $this
     */
    public function add_Message(string $sMessage = '', string $sValue = '')
    {
        $this->oMessage->push($sMessage, $sValue);

        return $this;
    }

    /**
     * @return \MVC\ArrDot
     * @throws \ReflectionException
     */
    public function get_Message()
    {
        $oDTValue = DTValue::create()->set_mValue($this->oMessage);
        \MVC\Event::run('DTContainer.get_Message.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @param bool $mValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_bSuccess(bool $mValue)
    {
        $oDTValue = DTValue::create()->set_mValue($mValue);
        \MVC\Event::run('DTContainer.set_bSuccess.before', $oDTValue);
        $this->bSuccess = (bool) $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function get_bSuccess() : bool
    {
        $oDTValue = DTValue::create()->set_mValue($this->bSuccess);
        \MVC\Event::run('DTContainer.get_bSuccess.before', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @param mixed $mValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_mData(mixed $mValue)
    {
        $oDTValue = DTValue::create()->set_mValue($mValue);
        \MVC\Event::run('DTContainer.set_mData.before', $oDTValue);
        $this->mData = $oDTValue->get_mValue();

        return $this;
    }

    /**
     * @return mixed|null
     * @throws \ReflectionException
     */
    public function get_mData()
    {
        $oDTValue = DTValue::create()->set_mValue($this->mData);
        \MVC\Event::run('DTContainer.get_mData.before', $oDTValue);

        return $oDTValue->get_mValue();
    }
}