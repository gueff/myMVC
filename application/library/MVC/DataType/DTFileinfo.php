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
     * @var string
     */
    protected $mimetype;

	/**
	 * DTFileinfo constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		\MVC\Event::RUN ('DTFileinfo.__construct.before', $aData);

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
        $this->mimetype = '';

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		\MVC\Event::RUN ('DTFileinfo.__construct.after', $aData);
	}

    /**
     * @param array $aData
     * @return DTFileinfo
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        \MVC\Event::RUN ('DTFileinfo.create.before', $aData);

        $oObject = new self($aData);

        \MVC\Event::RUN ('DTFileinfo.create.after', $oObject);

        return $oObject;
    }

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dirname($aValue)
	{
		\MVC\Event::RUN ('DTFileinfo.set_dirname.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_basename.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_path.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_is_file.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_is_dir.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_extension.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_filename.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_name.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_passwd.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_uid.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_gid.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_gecos.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_dir.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_shell.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_filemtime.before', $aValue);

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
		\MVC\Event::RUN ('DTFileinfo.set_filectime.before', $aValue);

		$this->filectime = (int) $aValue;

		return $this;
	}

    /**
     * @param int $sValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_mimetype($sValue)
    {
        \MVC\Event::RUN ('DTFileinfo.set_mimetype.before', $sValue);

        $this->mimetype = (string) $sValue;

        return $this;
    }

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dirname()
	{
		\MVC\Event::RUN ('DTFileinfo.get_dirname.before', $this->dirname);

		return $this->dirname;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_basename()
	{
		\MVC\Event::RUN ('DTFileinfo.get_basename.before', $this->basename);

		return $this->basename;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_path()
	{
		\MVC\Event::RUN ('DTFileinfo.get_path.before', $this->path);

		return $this->path;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_is_file()
	{
		\MVC\Event::RUN ('DTFileinfo.get_is_file.before', $this->is_file);

		return $this->is_file;
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_is_dir()
	{
		\MVC\Event::RUN ('DTFileinfo.get_is_dir.before', $this->is_dir);

		return $this->is_dir;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_extension()
	{
		\MVC\Event::RUN ('DTFileinfo.get_extension.before', $this->extension);

		return $this->extension;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_filename()
	{
		\MVC\Event::RUN ('DTFileinfo.get_filename.before', $this->filename);

		return $this->filename;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_name()
	{
		\MVC\Event::RUN ('DTFileinfo.get_name.before', $this->name);

		return $this->name;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_passwd()
	{
		\MVC\Event::RUN ('DTFileinfo.get_passwd.before', $this->passwd);

		return $this->passwd;
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_uid()
	{
		\MVC\Event::RUN ('DTFileinfo.get_uid.before', $this->uid);

		return $this->uid;
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_gid()
	{
		\MVC\Event::RUN ('DTFileinfo.get_gid.before', $this->gid);

		return $this->gid;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_gecos()
	{
		\MVC\Event::RUN ('DTFileinfo.get_gecos.before', $this->gecos);

		return $this->gecos;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dir()
	{
		\MVC\Event::RUN ('DTFileinfo.get_dir.before', $this->dir);

		return $this->dir;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_shell()
	{
		\MVC\Event::RUN ('DTFileinfo.get_shell.before', $this->shell);

		return $this->shell;
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_filemtime()
	{
		\MVC\Event::RUN ('DTFileinfo.get_filemtime.before', $this->filemtime);

		return $this->filemtime;
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_filectime()
	{
		\MVC\Event::RUN ('DTFileinfo.get_filectime.before', $this->filectime);

		return $this->filectime;
	}

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function get_mimetype()
    {
        \MVC\Event::RUN ('DTFileinfo.get_mimetype.before', $this->mimetype);

        return $this->mimetype;
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
