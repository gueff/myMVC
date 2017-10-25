<?php
/**
 * Index.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $InfoToolModel
 */
namespace InfoTool\Model;

/**
 * Index
 */
class Index
{

	/**
	 * toolbar array
	 * 
	 * @var array
	 * @access private
	 */
	private $aToolbar = array ();

	/**
	 * adds Event Listerner to 'mvc.view.render.before'<br>
	 * starts collecting Infos and save it to Registry
	 * 
	 * @access public
	 * @param \Smarty $oView
	 * @return void
	 */
	public function __construct (\Smarty $oView)
	{			
		// add toolbar at the right time
		\MVC\Event::BIND ('mvc.view.render.before', function ($oView)
		{
			\InfoTool\Model\Index::injectToolbar ($oView);
		});

		// get toolbar values and save them to registry
		\MVC\Registry::set ('aToolbar', $this->collectInfo ($oView));
	}

	/**
	 * adds the toolbar to the html dom before closing body tag
	 * 
	 * @access public
	 * @static
	 * @param \Smarty $oView
	 * @return void
	 */
	public static function injectToolbar (\Smarty $oView)
	{
		$sToolBarVarName = 'sToolBar_' . uniqid ();
		$sInfoToolSmarty = '{$' . $sToolBarVarName . '}';

		// add toolbar template var to layout
		$aToolbar = \MVC\Registry::get ('aToolbar');
		$oView->assign ('aToolbar', $aToolbar);
		$oView->assign ($sToolBarVarName, $oView->loadTemplateAsString (realpath (__DIR__ . '/../') . '/templates/infoTool.tpl'));

		// disable regular view output
		\MVC\View::$_bEchoOut = FALSE;

		// inject toolbar var to regular string output via DOM
		INJECT:
		{
			$oDom = new \DOMDocument(null, null);

			// prevent error messages occuring by using DOM
			// @see http://stackoverflow.com/a/6090728/2487859
			libxml_use_internal_errors (true);
			// DOMDocument::loadHTML will treat your string as being in ISO-8859-1 unless you tell it otherwise. 
			// @see http://stackoverflow.com/a/8218649/2487859
			$oDom->loadHTML (
				mb_convert_encoding(
					$aToolbar['sRendered'], 
					'HTML-ENTITIES', 
					'UTF-8'
				)
			);			
			libxml_clear_errors ();
			
			// add toolbar tag as a placeholder before body closing tag
			$oNode = $oDom->createElement ($sToolBarVarName);
			$oBody = $oDom->getElementsByTagName ('body');

			foreach ($oBody as $oItem)
			{
				$oItem->appendChild ($oNode);
			}

			$sHtml = $oDom->saveHTML ();

			// render the toolbar
			$sInfoToolRendered = $oView->fetch ('string:' . $sInfoToolSmarty);

			// replace toolbar tag placeholder with rendered toolbar
			$sHtml = str_replace ('<' . $sToolBarVarName . '></' . $sToolBarVarName . '>', $sInfoToolRendered, $sHtml);
		}

		// new output, now including toolbar
		echo $sHtml;
	}

	/**
	 * collects all Info for being displayed by the Toolbar
	 * 
	 * @access private
	 * @param \Smarty $oView
	 * @return array $aToolbar containing all Info for toolbar
	 */
	private function collectInfo (\Smarty $oView)
	{
		$aToolbar = array ();

		$aToolbar['sPHP'] = phpversion ();
		$aToolbar['sOS'] = PHP_OS;
		$aToolbar['sEnv'] = \MVC\Registry::get('MVC_ENV');

		$aToolbar['aGet'] = array_map('htmlentities', $_GET);		
		$aToolbar['aPost'] = array_map('htmlentities', $_POST);
		$aToolbar['aCookie'] = array_map('htmlentities', $_COOKIE);
		$aToolbar['aRequest'] = array_map('htmlentities', $_REQUEST);
		$aToolbar['aSession'] = $_SESSION;
		$aToolbar['aSmartyTemplateVars'] = $oView->getTemplateVars ();
		$aConstants = get_defined_constants (true);
		$aToolbar['aConstant'] = $aConstants['user'];
		$aToolbar['aServer'] = $_SERVER;

		$aToolbar['oMvcRequestGetWhitelistParams'] = \MVC\Request::getInstance ()->getWhitelistParams ();
		$aToolbar['oMvcRequestGetQueryArray'] = \MVC\Request::getInstance ()->getQueryArray ();
		$aToolbar['aEvent'] = ((\MVC\Registry::isRegistered ('MVC_EVENT')) ? \MVC\Registry::get ('MVC_EVENT') : array ());

		$aRequest = \MVC\Request::GETCURRENTREQUEST ();		
		$aToolbar['aRouting'] = array(
			'aRequest' => \MVC\Request::GETCURRENTREQUEST (),
			'sModule' => \MVC\Request::getInstance ()->getModule (),
			'sController' => \MVC\Request::getInstance ()->getController (),
			'sMethod' => \MVC\Request::getInstance ()->getMethod (),
			'sArg' => ((isset($aToolbar['oMvcRequestGetQueryArray']['GET']['a'])) ? $aToolbar['oMvcRequestGetQueryArray']['GET']['a'] : ''),
			'aRoute' => \MVC\Registry::get ('MVC_ROUTING_CURRENT'),
			'sRoutingJsonBuilder' => \MVC\Registry::get ('MVC_ROUTING_JSON_BUILDER'),
			'sRoutingHandling' => \MVC\Registry::get ('MVC_ROUTING_HANDLING')
		);
		
		$aPolicy = \MVC\Registry::get ('MVC_POLICY');
		$sController = '\\' . \MVC\Request::getInstance ()->getModule () . '\\Controller\\' . \MVC\Request::getInstance ()->getController ();
		$sMethod = \MVC\Request::getInstance ()->getMethod ();
		
		$aToolbar['aPolicy']['aRule'] = ((\MVC\Registry::isRegistered ('MVC_POLICY')) ? \MVC\Registry::get ('MVC_POLICY') : array ());
		$aToolbar['aPolicy']['aApplied'] = ((isset($aPolicy[$sController][$sMethod])) ? $aPolicy[$sController][$sMethod] : false);
		$aToolbar['aPolicy']['sAppliedAt'] = ((isset($aPolicy[$sController][$sMethod])) ? $sController . '::' . $sMethod : false);
		
		$sTemplate = ((file_exists($oView->sTemplate)) ? $oView->sTemplate : ((file_exists($oView->_joined_template_dir . '/' . $oView->sTemplate)) ? $oView->_joined_template_dir . '/' . $oView->sTemplate : false));
		$aToolbar['sTemplate'] = $sTemplate;
		$aToolbar['sTemplateContent'] = file_get_contents ($aToolbar['sTemplate']);
		
		ob_start ();
		$sTemplate = file_get_contents ($oView->sTemplate, true);
		$oView->renderString ($sTemplate);
		$sRendered = ob_get_contents ();
		ob_end_clean ();
		$aToolbar['sRendered'] = $sRendered;

		$aToolbar['aFilesIncluded'] = get_required_files ();
		$aToolbar['aMemory'] = array (
			'iRealMemoryUsage' => (memory_get_usage (true) / 1024)
			, 'dMemoryUsage' => (memory_get_usage () / 1024)
			, 'dMemoryPeakUsage' => (memory_get_peak_usage () / 1024)
		);
		$aToolbar['aRegistry'] = \MVC\Registry::getStorageArray ();
		$aToolbar['aCache'] = $this->getCaches ();
		$aToolbar['aError'] = \MVC\Error::getERROR ();
		$aToolbar['oIds'] = ( (\MVC\Registry::isRegistered ('MVC_IDS_IMPACT')) ? \MVC\Registry::get ('MVC_IDS_IMPACT') : '' );
		$aToolbar['aIdsConfig'] = ( (\MVC\Registry::isRegistered ('MVC_IDS_INIT')) ? \MVC\Registry::get ('MVC_IDS_INIT') : '' );
		$aToolbar['aIdsDisposed'] = ( (\MVC\Registry::isRegistered ('MVC_IDS_DISPOSED')) ? \MVC\Registry::get ('MVC_IDS_DISPOSED') : '' );
		
		$iMicrotime = microtime (true);
		$sMicrotime = sprintf ("%06d", ($iMicrotime - floor ($iMicrotime)) * 1000000);
		$oDateTime = new \DateTime (date ('Y-m-d H:i:s.' . $sMicrotime, $iMicrotime));
		$oStart = \MVC\Session::getInstance ()->get ('startDateTime');
		$dDiff = (date_format ($oDateTime, "s.u") - date_format ($oStart, "s.u"));
		$aToolbar['sConstructionTime'] = round ($dDiff, 3);
		
		return $aToolbar;
	}

	/**
	 * get cachefiles
	 * 
	 * @access private
	 * @return array $aCache
	 */
	private function getCaches ()
	{
		$aCache = array ();
		$oObjects = new \RecursiveIteratorIterator (
			new \RecursiveDirectoryIterator (
				\MVC\Registry::get ('MVC_CACHE_DIR'),
				0
			), 
			\RecursiveIteratorIterator::SELF_FIRST,
			0
		);

		foreach ($oObjects as $sName => $oObject)
		{
			$sTmp = str_replace (\MVC\Registry::get ('MVC_CACHE_DIR'), '', $sName);

			if ($sTmp != '.' && $sTmp != '..')
			{
				$aCache[] = $sTmp;
			}
		}

		return $aCache;
	}
}
