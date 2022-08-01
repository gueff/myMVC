<?php

/**
 * @name $WebbixxDataType
 */
namespace Webbixx\DataType;

class DTExample
{
	const DTHASH = '5a5616188eda3503b6f06a0f78040ac8';

	/**
	 * @var string
	 */
	protected $sFoo;

	/**
	 * DTExample constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		\MVC\Event::RUN ('DTExample.__construct.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->sFoo = "bar";

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		\MVC\Event::RUN ('DTExample.__construct.after', \MVC\DataType\DTArrayObject::create($aData));
	}

    /**
     * @param array $aData
     * @return DTExample
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTExample.create.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));
        
        $oObject = new self($aData);

        \MVC\Event::RUN ('DTExample.create.after', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('DTExample')->set_sValue($oObject)));
        
        return $oObject;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sFoo($mValue)
	{
		\MVC\Event::RUN ('DTExample.set_sFoo.before', \MVC\DataType\DTArrayObject::create(array('sFoo' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		$this->sFoo = $mValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sFoo()
	{
		\MVC\Event::RUN ('DTExample.get_sFoo.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('sFoo')->set_sValue($this->sFoo))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));

		return $this->sFoo;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sFoo()
	{
        return 'sFoo';
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
