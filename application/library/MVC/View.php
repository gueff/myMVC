<?php
/**
 * View.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;

/**
 * View
 *
 * @extends \Smarty
 */
class View extends \Smarty
{
    /**
     * switch rendering on/off
     * @var bool render
     */
    public static $bRender = true;

    /**
     * switch echo out
     * @var boolean
     */
    public static $bEchoOut = true;

    /**
     * Current Template Directory
     * @var string
     */
    public $sTemplateDir;

    /**
     * default Template / Layout; relative path
     * @var string
     */
    public $sTemplateRelative;

    /**
     * default Template / Layout; absolute path
     * @var string
     */
    public $sTemplate;

    /**
     * Defines the Content Variable,
     * which represents the Content in the Layout
     * @var string
     */
    public $sContentVar = 'sContent';

    /**
     * smarty version
     *
     * @var integer
     */
    public $iSmartyVersion;

    /**
     * View constructor.
     * instantiates smarty object and set major smarty configs
     * @throws \ReflectionException
     */
    public function __construct ()
    {
        parent::__construct ();

        $this->sTemplateDir = Config::get_MVC_VIEW_TEMPLATES();

        if (false === file_exists($this->sTemplateDir))
        {
            $this->sTemplateDir = Config::get_MVC_MODULES() . '/' . Request::getModuleName() . '/templates';
        }

        $this->setAbsolutePathToTemplateDir ($this->sTemplateDir);
        $this->sTemplate = Config::get_MVC_SMARTY_TEMPLATE_DEFAULT();
        $this->iSmartyVersion = (int) preg_replace ('/[^0-9]+/', '', self::SMARTY_VERSION);
        $this->setCompileDir (Config::get_MVC_SMARTY_TEMPLATE_CACHE_DIR());
        $this->setCacheDir (Config::get_MVC_SMARTY_CACHE_DIR());
        $this->caching = Config::get_MVC_SMARTY_CACHE_STATUS();
        $aPlugInDir = array(Config::get_MVC_APPLICATION_PATH() . '/vendor/smarty/smarty/libs/plugins/');
        (!empty(Config::get_MVC_SMARTY_PLUGINS_DIR())) ? $aPlugInDir = array_merge ($aPlugInDir, Config::get_MVC_SMARTY_PLUGINS_DIR()) : false;
        $this->setPluginsDir ($aPlugInDir);
        $this->checkDirs();

        \MVC\Event::bind('mvc.view.echoOut.off', function () {
            \MVC\View::$bEchoOut = false;
        });

        \MVC\Event::bind('mvc.view.echoOut.on', function () {
            \MVC\View::$bEchoOut = true;
        });
    }

    /**
     * checks if required dirs exist. If not, it tries to create them
     * @throws \ReflectionException
     */
    private function checkDirs ()
    {
        if (!file_exists (Config::get_MVC_SMARTY_TEMPLATE_CACHE_DIR()))
        {
            mkdir (Config::get_MVC_SMARTY_TEMPLATE_CACHE_DIR());
        }
        if (!file_exists (Config::get_MVC_SMARTY_CACHE_DIR()))
        {
            mkdir (Config::get_MVC_SMARTY_CACHE_DIR());
        }
    }

    /**
     * returns a given template rendered as String
     * @param string $sTemplate
     * @return string
     * @throws \SmartyException
     */
    public function loadTemplateAsString ($sTemplate = '')
    {
        return $this->fetch ('string:' . file_get_contents ($sTemplate, true));
    }

    /**
     * renders a given string and print it out (depending on self::$_bEchoOut)
     * @param string $sTemplateString
     * @throws \ReflectionException
     * @throws \SmartyException
     */
    public function renderString ($sTemplateString = '')
    {
        Event::run ('mvc.view.renderString.before',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sTemplateString')->set_sValue($sTemplateString)
                )
        );

        $sRendered = '';

        if (true === self::$bRender)
        {
            $sRendered = $this->fetch ('string:' . $sTemplateString);

            if (true === self::$bEchoOut)
            {
                echo $sRendered;
            }
        }

        Event::run ('mvc.view.renderString.after',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sTemplateString')->set_sValue($sTemplateString)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sRendered')->set_sValue($sRendered)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('bEchoOut')->set_sValue(self::$bEchoOut)
                )
        );
    }

    /**
     * renders the template $this->sTemplate
     * @throws \ReflectionException
     * @throws \SmartyException
     */
    public function render ()
    {
        Event::run ('mvc.view.render.before',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oView')->set_sValue($this)
                )
        );

        // Load Template and render
        $sTemplate = (true === is_file($this->sTemplate)) ? file_get_contents ($this->sTemplate, true) : '';
        $this->renderString ($sTemplate);

        Event::run ('mvc.view.render.after',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oView')->set_sValue($this)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sTemplate')->set_sValue($sTemplate)
                )
        );
    }

    /**
     * assigns a value to a Template Variable
     * @param string $sValue
     * @param string $sVar
     */
    public function assignValue ($sValue, $sVar = '')
    {
        ('' === $sVar) ? $sVar = $this->sContentVar : false;
        $this->assign ($sVar, $sValue);
    }

    /**
     * Sets the given Template
     * @param string $sTemplate
     * @return void
     */
    public function setTemplate ($sTemplate)
    {
        $this->sTemplate = $sTemplate;
    }

    /**
     * set absolute Path to Smarty Template Dir and saves this into includePath
     * @param string $sAbsolutePathToTemplateDir
     * @throws \ReflectionException
     */
    public function setAbsolutePathToTemplateDir ($sAbsolutePathToTemplateDir = '')
    {
        if ($sAbsolutePathToTemplateDir === '')
        {
            $aQueryArray = Request::getQueryVarArray();
            (array_key_exists (Config::get_MVC_GET_PARAM_MODULE(), $aQueryArray['GET']))
                ? $sAbsolutePathToTemplateDir = realpath (Config::get_MVC_MODULES() . '/' . $aQueryArray['GET'][Config::get_MVC_GET_PARAM_MODULE()] . '/templates/')
                : false
            ;
        }

        if (is_dir ($sAbsolutePathToTemplateDir))
        {
            $aIncludePath = explode (PATH_SEPARATOR, get_include_path ());

            if (!in_array ($sAbsolutePathToTemplateDir, $aIncludePath))
            {
                $aIncludePath[] = $sAbsolutePathToTemplateDir;
            }

            $sImplodePaths = implode (PATH_SEPARATOR, $aIncludePath);

            set_include_path ($sImplodePaths);
        }

        $this->setTemplateDir ($sAbsolutePathToTemplateDir);
    }

    /**
     * sets the content variable $this->sContentVar (which is per default="sContent")
     * @param string $sContentVar
     * @return void
     */
    public function setContentVar ($sContentVar)
    {
        $this->sContentVar = $sContentVar;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function getSmartyTemplateDefault()
    {
        return Config::get_MVC_SMARTY_TEMPLATE_DEFAULT();
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getSmartyPlugInsDir()
    {
        return Config::get_MVC_SMARTY_PLUGINS_DIR();
    }

    /**
     * @return mixed|string
     * @throws \ReflectionException
     */
    public static function getSmartyTemplateCacheDir()
    {
        return Config::get_MVC_SMARTY_TEMPLATE_CACHE_DIR();
    }

    /**
     * @return mixed|string
     * @throws \ReflectionException
     */
    public static function getSmartyCacheDir()
    {
        return Config::get_MVC_SMARTY_CACHE_DIR();
    }

    /**
     * @return mixed|string
     * @throws \ReflectionException
     */
    public static function getSmartyCacheStatus()
    {
        return Config::get_MVC_SMARTY_CACHE_STATUS();
    }
}
