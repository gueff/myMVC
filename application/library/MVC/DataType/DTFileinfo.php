<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

class DTFileinfo
{
	const DTHASH = '6047d7946fd8e855470bc69790e0c220';

	/**
	 * @var string
	 */
	protected $dirname;

	/**
	 * @var string
	 */
	protected $basename;

	/**
	 * @var string
	 */
	protected $extension;

	/**
	 * @var string
	 */
	protected $filename;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $passwd;

	/**
	 * @var int
	 */
	protected $uid;

	/**
	 * @var int
	 */
	protected $gid;

	/**
	 * @var string
	 */
	protected $gecos;

	/**
	 * @var string
	 */
	protected $dir;

	/**
	 * @var string
	 */
	protected $shell;

	/**
	 * DTFileinfo constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		\MVC\Event::RUN ('DTFileinfo.__construct.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->dirname = '';
		$this->basename = '';
		$this->extension = '';
		$this->filename = '';
		$this->name = '';
		$this->passwd = '';
		$this->uid = 0;
		$this->gid = 0;
		$this->gecos = '';
		$this->dir = '';
		$this->shell = '';

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		\MVC\Event::RUN ('DTFileinfo.__construct.after', \MVC\DataType\DTArrayObject::create($aData));
	}

    /**
     * @param array $aData
     * @return DTFileinfo
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTFileinfo.create.before', \MVC\DataType\DTArrayObject::create($aData)->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));
        
        $oObject = new self($aData);

        \MVC\Event::RUN ('DTFileinfo.create.after', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('DTFileinfo')->set_sValue($oObject)));
        
        return $oObject;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dirname($mValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_dirname.before', \MVC\DataType\DTArrayObject::create(array('dirname' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->dirname = (string) $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_basename($mValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_basename.before', \MVC\DataType\DTArrayObject::create(array('basename' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->basename = (string) $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_extension($mValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_extension.before', \MVC\DataType\DTArrayObject::create(array('extension' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->extension = (string) $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_filename($mValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_filename.before', \MVC\DataType\DTArrayObject::create(array('filename' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->filename = (string) $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_name($mValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_name.before', \MVC\DataType\DTArrayObject::create(array('name' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->name = (string) $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_passwd($mValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_passwd.before', \MVC\DataType\DTArrayObject::create(array('passwd' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->passwd = (string) $mValue;

		return $this;
	}

	/**
	 * @param int $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_uid($mValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_uid.before', \MVC\DataType\DTArrayObject::create(array('uid' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->uid = (int) $mValue;

		return $this;
	}

	/**
	 * @param int $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_gid($mValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_gid.before', \MVC\DataType\DTArrayObject::create(array('gid' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->gid = (int) $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_gecos($mValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_gecos.before', \MVC\DataType\DTArrayObject::create(array('gecos' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->gecos = (string) $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dir($mValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_dir.before', \MVC\DataType\DTArrayObject::create(array('dir' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->dir = (string) $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_shell($mValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_shell.before', \MVC\DataType\DTArrayObject::create(array('shell' => $mValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->shell = (string) $mValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dirname()
	{
		\MVC\Event::RUN ('DTFileinfo.get_dirname.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('dirname')->set_sValue($this->dirname))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->dirname;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_basename()
	{
		\MVC\Event::RUN ('DTFileinfo.get_basename.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('basename')->set_sValue($this->basename))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->basename;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_extension()
	{
		\MVC\Event::RUN ('DTFileinfo.get_extension.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('extension')->set_sValue($this->extension))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->extension;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_filename()
	{
		\MVC\Event::RUN ('DTFileinfo.get_filename.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('filename')->set_sValue($this->filename))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->filename;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_name()
	{
		\MVC\Event::RUN ('DTFileinfo.get_name.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('name')->set_sValue($this->name))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->name;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_passwd()
	{
		\MVC\Event::RUN ('DTFileinfo.get_passwd.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('passwd')->set_sValue($this->passwd))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->passwd;
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_uid()
	{
		\MVC\Event::RUN ('DTFileinfo.get_uid.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('uid')->set_sValue($this->uid))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->uid;
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_gid()
	{
		\MVC\Event::RUN ('DTFileinfo.get_gid.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('gid')->set_sValue($this->gid))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->gid;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_gecos()
	{
		\MVC\Event::RUN ('DTFileinfo.get_gecos.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('gecos')->set_sValue($this->gecos))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->gecos;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dir()
	{
		\MVC\Event::RUN ('DTFileinfo.get_dir.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('dir')->set_sValue($this->dir))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->dir;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_shell()
	{
		\MVC\Event::RUN ('DTFileinfo.get_shell.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('shell')->set_sValue($this->shell))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->shell;
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_dirname()
	{
        return 'dirname';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_basename()
	{
        return 'basename';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_extension()
	{
        return 'extension';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_filename()
	{
        return 'filename';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_name()
	{
        return 'name';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_passwd()
	{
        return 'passwd';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_uid()
	{
        return 'uid';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_gid()
	{
        return 'gid';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_gecos()
	{
        return 'gecos';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_dir()
	{
        return 'dir';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_shell()
	{
        return 'shell';
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
