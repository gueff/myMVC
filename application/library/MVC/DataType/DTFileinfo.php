<?php
/**
 * DTFileinfo.php
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

class DTFileinfo
{
	use TraitDataType;

	const DTHASH = '1301c656d77cf30864476f75fb648a51';

	/**
	 * @required false
	 * @var string
	 */
	protected $dirname;

	/**
	 * @required false
	 * @var string
	 */
	protected $basename;

	/**
	 * @required false
	 * @var string
	 */
	protected $path;

	/**
	 * @required false
	 * @var bool
	 */
	protected $is_file;

	/**
	 * @required false
	 * @var bool
	 */
	protected $is_dir;

	/**
	 * @required false
	 * @var string
	 */
	protected $extension;

	/**
	 * @required false
	 * @var string
	 */
	protected $filename;

	/**
	 * @required false
	 * @var string
	 */
	protected $name;

	/**
	 * @required false
	 * @var string
	 */
	protected $passwd;

	/**
	 * @required false
	 * @var int
	 */
	protected $uid;

	/**
	 * @required false
	 * @var int
	 */
	protected $gid;

	/**
	 * @required false
	 * @var string
	 */
	protected $gecos;

	/**
	 * @required false
	 * @var string
	 */
	protected $dir;

	/**
	 * @required false
	 * @var string
	 */
	protected $shell;

	/**
	 * @required false
	 * @var int
	 */
	protected $filemtime;

	/**
	 * @required false
	 * @var int
	 */
	protected $filectime;

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
		$this->path = '';
		$this->is_file = false;
		$this->is_dir = false;
		$this->extension = '';
		$this->filename = '';
		$this->name = '';
		$this->passwd = '';
		$this->uid = 0;
		$this->gid = 0;
		$this->gecos = '';
		$this->dir = '';
		$this->shell = '';
		$this->filemtime = 0;
		$this->filectime = 0;

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
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dirname($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_dirname.before', \MVC\DataType\DTArrayObject::create(array('dirname' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->dirname = (string) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_basename($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_basename.before', \MVC\DataType\DTArrayObject::create(array('basename' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->basename = (string) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_path($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_path.before', \MVC\DataType\DTArrayObject::create(array('path' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->path = (string) $aValue;

		return $this;
	}

	/**
	 * @param bool $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_is_file($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_is_file.before', \MVC\DataType\DTArrayObject::create(array('is_file' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->is_file = (bool) $aValue;

		return $this;
	}

	/**
	 * @param bool $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_is_dir($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_is_dir.before', \MVC\DataType\DTArrayObject::create(array('is_dir' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->is_dir = (bool) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_extension($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_extension.before', \MVC\DataType\DTArrayObject::create(array('extension' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->extension = (string) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_filename($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_filename.before', \MVC\DataType\DTArrayObject::create(array('filename' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->filename = (string) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_name($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_name.before', \MVC\DataType\DTArrayObject::create(array('name' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->name = (string) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_passwd($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_passwd.before', \MVC\DataType\DTArrayObject::create(array('passwd' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->passwd = (string) $aValue;

		return $this;
	}

	/**
	 * @param int $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_uid($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_uid.before', \MVC\DataType\DTArrayObject::create(array('uid' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->uid = (int) $aValue;

		return $this;
	}

	/**
	 * @param int $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_gid($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_gid.before', \MVC\DataType\DTArrayObject::create(array('gid' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->gid = (int) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_gecos($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_gecos.before', \MVC\DataType\DTArrayObject::create(array('gecos' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->gecos = (string) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dir($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_dir.before', \MVC\DataType\DTArrayObject::create(array('dir' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->dir = (string) $aValue;

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_shell($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_shell.before', \MVC\DataType\DTArrayObject::create(array('shell' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->shell = (string) $aValue;

		return $this;
	}

	/**
	 * @param int $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_filemtime($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_filemtime.before', \MVC\DataType\DTArrayObject::create(array('filemtime' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->filemtime = (int) $aValue;

		return $this;
	}

	/**
	 * @param int $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_filectime($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_filectime.before', \MVC\DataType\DTArrayObject::create(array('filectime' => $aValue))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		$this->filectime = (int) $aValue;

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
	public function get_path()
	{
		\MVC\Event::RUN ('DTFileinfo.get_path.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('path')->set_sValue($this->path))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->path;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_is_file()
	{
		\MVC\Event::RUN ('DTFileinfo.get_is_file.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('is_file')->set_sValue($this->is_file))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->is_file;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_is_dir()
	{
		\MVC\Event::RUN ('DTFileinfo.get_is_dir.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('is_dir')->set_sValue($this->is_dir))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->is_dir;
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
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_filemtime()
	{
		\MVC\Event::RUN ('DTFileinfo.get_filemtime.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('filemtime')->set_sValue($this->filemtime))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->filemtime;
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_filectime()
	{
		\MVC\Event::RUN ('DTFileinfo.get_filectime.before', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('filectime')->set_sValue($this->filectime))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Debug::prepareBacktraceArray(debug_backtrace()))));

		return $this->filectime;
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
	public static function getPropertyName_path()
	{
        return 'path';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_is_file()
	{
        return 'is_file';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_is_dir()
	{
        return 'is_dir';
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
	 * @return string
	 */
	public static function getPropertyName_filemtime()
	{
        return 'filemtime';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_filectime()
	{
        return 'filectime';
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
