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
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTFileinfo.__construct.before', $oDTValue);
        $aData = $oDTValue->get_mValue();

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

        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTFileinfo.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return DTFileinfo
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::RUN ('DTFileinfo.create.before', $oDTValue);
        $oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::RUN ('DTFileinfo.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dirname($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_dirname.before', $aValue);
		$this->dirname = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_basename($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_basename.before', $oDTValue);
		$this->basename = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_path($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_path.before', $oDTValue);
		$this->path = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param bool $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_is_file($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_is_file.before', $oDTValue);
		$this->is_file = (bool) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param bool $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_is_dir($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_is_dir.before', $oDTValue);
		$this->is_dir = (bool) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_extension($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_extension.before', $oDTValue);
		$this->extension = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_filename($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_filename.before', $oDTValue);
		$this->filename = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_name($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_name.before', $oDTValue);
		$this->name = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_passwd($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_passwd.before', $oDTValue);
		$this->passwd = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param int $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_uid($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_uid.before', $oDTValue);
		$this->uid = (int) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param int $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_gid($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_gid.before', $oDTValue);
		$this->gid = (int) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_gecos($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_gecos.before', $oDTValue);
		$this->gecos = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dir($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_dir.before', $oDTValue);
		$this->dir = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_shell($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_shell.before', $oDTValue);
		$this->shell = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param int $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_filemtime($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_filemtime.before', $oDTValue);
		$this->filemtime = (int) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param int $aValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_filectime($aValue)
	{
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTFileinfo.set_filectime.before', $oDTValue);
		$this->filectime = (int) $oDTValue->get_mValue();

		return $this;
	}

    /**
     * @param int $sValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_mimetype($sValue)
    {
        $oDTValue = DTValue::create()->set_mValue($sValue); \MVC\Event::RUN ('DTFileinfo.set_mimetype.before', $oDTValue);
        $this->mimetype = (string) $oDTValue->get_mValue();

        return $this;
    }

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dirname()
	{
        $oDTValue = DTValue::create()->set_mValue($this->dirname); \MVC\Event::RUN ('DTFileinfo.get_dirname.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_basename()
	{
        $oDTValue = DTValue::create()->set_mValue($this->basename); \MVC\Event::RUN ('DTFileinfo.get_basename.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_path()
	{
        $oDTValue = DTValue::create()->set_mValue($this->path); \MVC\Event::RUN ('DTFileinfo.get_path.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_is_file()
	{
        $oDTValue = DTValue::create()->set_mValue($this->is_file); \MVC\Event::RUN ('DTFileinfo.get_is_file.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_is_dir()
	{
        $oDTValue = DTValue::create()->set_mValue($this->is_dir); \MVC\Event::RUN ('DTFileinfo.get_is_dir.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_extension()
	{
        $oDTValue = DTValue::create()->set_mValue($this->extension); \MVC\Event::RUN ('DTFileinfo.get_extension.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_filename()
	{
        $oDTValue = DTValue::create()->set_mValue($this->filename); \MVC\Event::RUN ('DTFileinfo.get_filename.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_name()
	{
        $oDTValue = DTValue::create()->set_mValue($this->name); \MVC\Event::RUN ('DTFileinfo.get_name.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_passwd()
	{
        $oDTValue = DTValue::create()->set_mValue($this->passwd); \MVC\Event::RUN ('DTFileinfo.get_passwd.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_uid()
	{
        $oDTValue = DTValue::create()->set_mValue($this->uid); \MVC\Event::RUN ('DTFileinfo.get_uid.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_gid()
	{
        $oDTValue = DTValue::create()->set_mValue($this->gid); \MVC\Event::RUN ('DTFileinfo.get_gid.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_gecos()
	{
        $oDTValue = DTValue::create()->set_mValue($this->gecos); \MVC\Event::RUN ('DTFileinfo.get_gecos.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dir()
	{
        $oDTValue = DTValue::create()->set_mValue($this->dir); \MVC\Event::RUN ('DTFileinfo.get_dir.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_shell()
	{
        $oDTValue = DTValue::create()->set_mValue($this->shell); \MVC\Event::RUN ('DTFileinfo.get_shell.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_filemtime()
	{
        $oDTValue = DTValue::create()->set_mValue($this->filemtime); \MVC\Event::RUN ('DTFileinfo.get_filemtime.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_filectime()
	{
        $oDTValue = DTValue::create()->set_mValue($this->filectime); \MVC\Event::RUN ('DTFileinfo.get_filectime.before', $oDTValue);

        return $oDTValue->get_mValue();
	}

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function get_mimetype()
    {
        $oDTValue = DTValue::create()->set_mValue($this->mimetype); \MVC\Event::RUN ('DTFileinfo.get_mimetype.before', $oDTValue);

        return $oDTValue->get_mValue();
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
