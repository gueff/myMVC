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

/**
 * View
 * 
 * @extends \Smarty
 */
class View extends \Smarty
{
	/**
	 * switch echo out 
	 * 
	 * @var boolean
	 * @access public
	 * @static
	 */
	public static $_bEchoOut = true;

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
	 * instantiates smarty object and set major smarty configs
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct ()
	{		
		parent::__construct ();
		
		$this->sTemplate = Registry::get('MVC_SMARTY_TEMPLATE_DEFAULT');			
		$this->iSmartyVersion = (int) preg_replace ('/[^0-9]+/', '', self::SMARTY_VERSION);
		$this->setAbsolutePathToTemplateDir ();		
		$this->setCompileDir (\MVC\Registry::get ('MVC_SMARTY_TEMPLATE_CACHE_DIR'));
		$this->setCacheDir (\MVC\Registry::get ('MVC_SMARTY_CACHE_DIR'));
		$this->caching = \MVC\Registry::get ('MVC_SMARTY_CACHE_STATUS');
		$aPlugInDir = array(\MVC\Registry::get ('MVC_APPLICATION_PATH') . '/vendor/smarty/smarty/libs/plugins/');
		(\MVC\Registry::isRegistered('MVC_SMARTY_PLUGINS_DIR')) ? $aPlugInDir = array_merge ($aPlugInDir, \MVC\Registry::get ('MVC_SMARTY_PLUGINS_DIR')) : false;		
		$this->setPluginsDir ($aPlugInDir);
		$this->checkDirs ();
		
		\MVC\Event::BIND('mvc.view.echoOut.off', function () {
			
			MVC_View::$bEchoOut = false;
		});		
		
		\MVC\Event::BIND('mvc.view.echoOut.on', function () {
			
			MVC_View::$bEchoOut = true;
		});				
	}

	/**
	 * checks if required dirs exist. If not, it tries to create them
	 * 
	 * @access private
	 * @return void
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
	 * 
	 * @param string $sTemplate
	 * @return string rendered template
	 */
	public function loadTemplateAsString ($sTemplate)
	{
		return $this->fetch ('string:' . file_get_contents ($sTemplate, true));
	}


	/**
	 * renders a given string and print it out (depending on self::$_bEchoOut)
	 * 
	 * @access public
	 * @param string $sTemplateString
	 * @return void
	 */
	public function renderString ($sTemplateString)
	{		
		\MVC\Event::RUN('mvc.view.renderString.before', $sTemplateString);
		
		$sRendered = $this->fetch ('string:' . $sTemplateString);
		
		if (true === self::$_bEchoOut)
		{
			echo $sRendered;
		}
		
		\MVC\Event::RUN('mvc.view.renderString.after', $sRendered);
	}

	/**
	 * renders the template $this->sTemplate
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public function render ()
	{		
		\MVC\Event::RUN('mvc.view.render.before', $this);
		
		// Load Template and render
		$sTemplate = file_get_contents ($this->sTemplate, true);		
		
		$this->renderString ($sTemplate);		
		
		\MVC\Event::RUN('mvc.view.render.after', $this);
	}

	/**
	 * assigns a value to a Template Variable
	 * 
	 * @access public
	 * @param string $sValue
	 * @param string $sVar
	 * @return void
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
	 * 
	 * @access public
	 * @param string $sAbsolutePathToTemplateDir
	 * @return void
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
