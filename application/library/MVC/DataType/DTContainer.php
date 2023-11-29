<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;


use MVC\Convert;

/**
 * @example
 * $oDTContainer = DTContainer::create()
   * ->set_bSuccess(false)
   * ->set_mData(123)
   * ->add_Message(E_USER_NOTICE, 'foo')
   * ->add_Message(E_USER_WARNING, 'bar')
   * ->add_Message(E_USER_NOTICE, 'baz')
   * ->add_Message(E_USER_ERROR, 'fatal error on foo')
   * ;
   * info($oDTContainer->get_Message()->get(E_USER_NOTICE));
 */

class DTContainer
{
    /**
     * @var self
     */
    protected static $_oInstance;

    /**
     * @var false|string
     */
    protected $sIdentifier;

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
        $this->sIdentifier = microtime(true) . '.' . uniqid();
        $this->bSuccess = false;
        $this->oMessage = new \MVC\ArrDot();
        $this->mData = null;
    }

    /**
     * @return self
     */
    public static function create() : self
    {
        return new self();
    }

    /**
     * @param string $sMessage
     * @param int    $iLevel
     * @return $this
     */
    public function add_Message(string $sMessage = '', int $iLevel = E_USER_NOTICE)
    {
        $sLevel = Convert::constValueToKey($iLevel);
        (true === empty($sLevel)) ? $sLevel = 'E_USER_NOTICE' : false;
        $sMessage = preg_replace('/[^\da-zA-Z0-9 \/\-_=>:]/i', '', $sMessage);
        $this->oMessage->push($sLevel, $sMessage);

        return $this;
    }

    /**
     * @return mixed|null
     * @throws \ReflectionException
     */
    public function get_sIdentifier()
    {
        $oDTValue = DTValue::create()->set_mValue($this->sIdentifier);
        \MVC\Event::run('DTContainer.get_sIdentifier.before', $oDTValue);

        return $oDTValue->get_mValue();
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