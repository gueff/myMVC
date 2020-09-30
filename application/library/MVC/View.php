<?php
/**
 * View.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVC
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
    public static $_bRender = true;

    /**
     * switch echo out
     *
     * @var boolean
     * @access public
     * @static
     */
    public static $_bEchoOut = true;

    /**
     * Current Template Directory
     *
     * @var string
     * @access public
     */
    public $sTemplateDir;

    /**
     * Standard Template / Layout
     *
     * @var string
     * @access public
     */
    public $sTemplate;

    /**
     * Defines the Content Variable,
     * which represents the Content in the Layout
     *
     * @var string
     * @access public
     */
    public $sContentVar = 'sContent';

    /**
     * smarty version
     *
     * @var integer
     * @access public
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

        if (true === Registry::isRegistered('MVC_VIEW_TEMPLATES'))
        {
            $this->sTemplateDir = Registry::get('MVC_VIEW_TEMPLATES');
        }
        else
        {
            $this->sTemplateDir = \MVC\Registry::get('MVC_MODULES') . '/' . \MVC\Request::getInstance ()->getModule() . '/templates';
        }

        $this->setAbsolutePathToTemplateDir ($this->sTemplateDir);
        $this->sTemplate = Registry::get('MVC_SMARTY_TEMPLATE_DEFAULT');
        $this->iSmartyVersion = (int) preg_replace ('/[^0-9]+/', '', self::SMARTY_VERSION);
        $this->setCompileDir (\MVC\Registry::get ('MVC_SMARTY_TEMPLATE_CACHE_DIR'));
        $this->setCacheDir (\MVC\Registry::get ('MVC_SMARTY_CACHE_DIR'));
        $this->caching = \MVC\Registry::get ('MVC_SMARTY_CACHE_STATUS');
        $aPlugInDir = array(\MVC\Registry::get ('MVC_APPLICATION_PATH') . '/vendor/smarty/smarty/libs/plugins/');
        (\MVC\Registry::isRegistered('MVC_SMARTY_PLUGINS_DIR')) ? $aPlugInDir = array_merge ($aPlugInDir, \MVC\Registry::get ('MVC_SMARTY_PLUGINS_DIR')) : false;
        $this->setPluginsDir ($aPlugInDir);
        $this->checkDirs ();

        \MVC\Event::BIND('mvc.view.echoOut.off', function () {

            \MVC\View::$_bEchoOut = false;
        });

        \MVC\Event::BIND('mvc.view.echoOut.on', function () {

            \MVC\View::$_bEchoOut = true;
        });
    }

    /**
     * checks if required dirs exist. If not, it tries to create them
     * @throws \ReflectionException
     */
    private function checkDirs ()
    {
        if (!file_exists (\MVC\Registry::get ('MVC_SMARTY_TEMPLATE_CACHE_DIR')))
        {
            mkdir (\MVC\Registry::get ('MVC_SMARTY_TEMPLATE_CACHE_DIR'));
        }
        if (!file_exists (\MVC\Registry::get ('MVC_SMARTY_CACHE_DIR')))
        {
            mkdir (\MVC\Registry::get ('MVC_SMARTY_CACHE_DIR'));
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
        Event::RUN ('mvc.view.renderString.before',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sTemplateString')->set_sValue($sTemplateString)
                )
        );

        $sRendered = '';

        if (true === self::$_bRender)
        {
            $sRendered = $this->fetch ('string:' . $sTemplateString);

            if (true === self::$_bEchoOut)
            {
                echo $sRendered;
            }
        }

        Event::RUN ('mvc.view.renderString.after',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sTemplateString')->set_sValue($sTemplateString)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sRendered')->set_sValue($sRendered)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('bEchoOut')->set_sValue(self::$_bEchoOut)
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
        Event::RUN ('mvc.view.render.before',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oView')->set_sValue($this)
                )
        );

        // Load Template and render
        $sTemplate = file_get_contents ($this->sTemplate, true);
        $this->renderString ($sTemplate);

        Event::RUN ('mvc.view.render.after',
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
     *
     * @access public
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
     *
     * @access public
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
            $aQueryArray = \MVC\Request::getInstance ()->getQueryArray ();
            (array_key_exists (Registry::get ('MVC_GET_PARAM_MODULE'), $aQueryArray['GET'])) ? $sAbsolutePathToTemplateDir = realpath (\MVC\Registry::get ('MVC_MODULES') . '/' . $aQueryArray['GET'][Registry::get ('MVC_GET_PARAM_MODULE')] . '/templates/') : false;
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
     *
     * @access public
     * @param string $sContentVar
     * @return void
     */
    public function setContentVar ($sContentVar)
    {
        $this->sContentVar = $sContentVar;
    }
}
