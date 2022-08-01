<?php

/**
 * @name $FooDataType
 */
namespace Foo\DataType;

class DTFoo
{
	const DTHASH = '7330b8f10013a944f047d3898b9d172a';

	const FOO = "BAR";

	/**
	 * @var bool
	 */
	protected $bSuccess;

	/**
	 * DTFoo constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		\MVC\Event::RUN ('DTFoo.__construct.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->bSuccess = true;

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		\MVC\Event::RUN ('DTFoo.__construct.after', \MVC\DataType\DTArrayObject::create($aData));
	}

    /**
     * @param array $aData
     * @return DTFoo
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTFoo.create.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));
        
        $oObject = new self($aData);

        \MVC\Event::RUN ('DTFoo.create.after', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('DTFoo')->set_sValue($oObject)));
        
        return $oObject;
    }

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_bSuccess($mValue)
	{
		\MVC\Event::RUN ('DTFoo.set_bSuccess.before', \MVC\DataType\DTArrayObject::create(array('bSuccess' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->bSuccess = $mValue;

		return $this;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_bSuccess()
	{
		\MVC\Event::RUN ('DTFoo.get_bSuccess.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('bSuccess')->set_sValue($this->bSuccess))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->bSuccess;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_bSuccess()
	{
        return 'bSuccess';
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
