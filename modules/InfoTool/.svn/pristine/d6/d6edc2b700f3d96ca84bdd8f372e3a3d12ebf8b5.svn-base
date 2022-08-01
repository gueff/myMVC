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

use MVC\DataType\DTArrayObject;
use MVC\Event;
use MVC\Helper;

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
    protected $aToolbar = array ();

	/**
     * Index constructor.
	 * adds Event Listerner to 'mvc.view.render.before'<br>
	 * starts collecting Infos and save it to Registry
     *
     * @param \Smarty $oView
     * @throws \ReflectionException
     */
	public function __construct (\Smarty $oView)
	{			
		// add toolbar at the right time
		\MVC\Event::BIND ('mvc.view.render.begin', function (\MVC\DataType\DTArrayObject $oDTArrayObject) {
			\InfoTool\Model\Index::injectToolbar ($oDTArrayObject->getDTKeyValueByKey('oView')->get_sValue());
		});

		// get toolbar values and save them to registry
		\MVC\Registry::set ('aToolbar', $this->collectInfo ($oView));
	}

	/**
	 * adds the toolbar to the html dom before closing body tag
	 * 
     * @param \Smarty $oView
     * @throws \ReflectionException
     * @throws \SmartyException
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
		INJECT: {

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
     * @param \Smarty $oView
     * @return array
     * @throws \ReflectionException
     */
    protected function collectInfo (\Smarty $oView)
	{
		$aToolbar = array ();

		$aToolbar['sPHP'] = phpversion ();
		$aToolbar['sOS'] = PHP_OS;
        $aToolbar['sOS'] = PHP_OS;
        $aToolbar['sUniqueId'] = \MVC\Registry::get('MVC_UNIQUE_ID');
        $aToolbar['sMyMvcVersion'] = (\MVC\Registry::isRegistered('MVC_CORE') && isset(\MVC\Registry::get('MVC_CORE')['version']))
            ? \MVC\Registry::get('MVC_CORE')['version']
            : '?';
        $aToolbar['sMyMVCCore'] = (\MVC\Registry::isRegistered('MVC_CORE')) ? $this->buildMarkupListTree(\MVC\Registry::get('MVC_CORE')) : '?';

        $aToolbar['sEnv'] = \MVC\Registry::get('MVC_ENV');
        $aToolbar['aEnv'] = $this->buildMarkupListTree($_ENV);
        $aToolbar['aGet'] = $this->buildMarkupListTree($_GET);
		$aToolbar['aPost'] = $this->buildMarkupListTree($_POST);
		$aToolbar['aCookie'] = $this->buildMarkupListTree($_COOKIE);
		$aToolbar['aRequest'] = $this->buildMarkupListTree($_REQUEST);
        $aToolbar['session_id'] = session_id();
        $aToolbar['aSessionSettings'] = $this->buildMarkupListTree(array(

            'namespace' => \MVC\Session::is()->getNamespace() . ' (which means: $_SESSION["' . \MVC\Session::is()->getNamespace() . '"])',
            'session_id' => $aToolbar['session_id'],
            'MVC_SESSION_ENABLE' => ((\MVC\Registry::isRegistered('MVC_SESSION_ENABLE')) ? json_encode(\MVC\Registry::get('MVC_SESSION_ENABLE')) : 'false'),
            'MVC_SESSION_PATH' => \MVC\Registry::get('MVC_SESSION_PATH'),
            'MVC_SESSION_OPTIONS' => (\MVC\Registry::get ('MVC_SESSION_OPTIONS')),
            'oSession' => \MVC\Session::is(),
        ));
		$aToolbar['aSessionKeyValues'] = $this->buildMarkupListTree($_SESSION);
        $aToolbar['aSessionFiles'] = $this->buildMarkupListTree(
            preg_grep('/^([^.])/', scandir(\MVC\Registry::get ('MVC_SESSION_OPTIONS')['save_path']))
        );

		$aToolbar['aSmartyTemplateVars'] = $this->buildMarkupListTree($oView->getTemplateVars());
		$aConstants = get_defined_constants (true);
		$aToolbar['aConstant'] = $this->buildMarkupListTree($aConstants['user']);
		$aToolbar['aServer'] = $this->buildMarkupListTree($_SERVER);
		$aToolbar['oMvcRequestGetWhitelistParams'] = $this->buildMarkupListTree(\MVC\Request::getInstance ()->getWhitelistParams());
		$aToolbar['oMvcRequestGetQueryArray'] = $this->buildMarkupListTree(array_reverse(\MVC\Request::getInstance ()->getQueryArray()));
		$aToolbar['aEvent'] = ((\MVC\Registry::isRegistered ('MVC_EVENT')) ? \MVC\Registry::get ('MVC_EVENT') : array());
        $aToolbar['aEventBIND'] = $this->buildMarkupListTree($aToolbar['aEvent']['BIND']);
        $aToolbar['aEventBINDNAME'] = $this->buildMarkupListTree(Event::$aEvent);
        $aToolbar['aEventRUN'] = $this->buildMarkupListTree($aToolbar['aEvent']['RUN']);
        $aToolbar['aEventRUNBONDED'] = (isset($aToolbar['aEvent']['RUN_BONDED']) && false === empty($aToolbar['aEvent']['RUN_BONDED'])) ? $this->buildMarkupListTree($aToolbar['aEvent']['RUN_BONDED']) : array();
        $aToolbar['aEventUNBIND'] = (isset($aToolbar['aEvent']['UNBIND']) && false === empty($aToolbar['aEvent']['UNBIND'])) ? $this->buildMarkupListTree($aToolbar['aEvent']['UNBIND']) : array();
		$aToolbar['aRouting'] = array(
			'aRequest' => \MVC\Request::GETCURRENTREQUEST(),
			'sModule' => \MVC\Request::getInstance ()->getModule (),
			'sController' => \MVC\Request::getInstance ()->getController (),
			'sMethod' => \MVC\Request::getInstance ()->getMethod (),
			'sArg' => ((isset($aToolbar['oMvcRequestGetQueryArray']['GET']['a'])) ? $aToolbar['oMvcRequestGetQueryArray']['GET']['a'] : ''),
			'aRoute' => $this->buildMarkupListTree(\MVC\Registry::get ('MVC_ROUTING_CURRENT')),
			'sRoutingJsonBuilder' => \MVC\Registry::get ('MVC_ROUTING_JSON_BUILDER'),
			'sRoutingHandling' => \MVC\Registry::get ('MVC_ROUTING_HANDLING')
		);
        $aToolbar['sRoutingPath'] = \MVC\Request::GETCURRENTREQUEST()['path'];
        $aToolbar['sRoutingQuery'] = (isset(\MVC\Request::GETCURRENTREQUEST()['query'])) ? \MVC\Request::GETCURRENTREQUEST()['query'] : '';

		$aPolicy = \MVC\Registry::get ('MVC_POLICY');
		$sController = '\\' . \MVC\Request::getInstance ()->getModule () . '\\Controller\\' . \MVC\Request::getInstance ()->getController ();
		$sMethod = \MVC\Request::getInstance ()->getMethod ();
		$aToolbar['aPolicy']['aRule'] = $this->buildMarkupListTree((\MVC\Registry::isRegistered ('MVC_POLICY')) ? \MVC\Registry::get ('MVC_POLICY') : array ());
		$aToolbar['aPolicy']['aApplied'] = $this->buildMarkupListTree((isset($aPolicy[$sController][$sMethod])) ? $aPolicy[$sController][$sMethod] : false);
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
        $aToolbar['sRegistry'] = $this->buildMarkupListTree($aToolbar['aRegistry']);
		$aToolbar['aCache'] = $this->buildMarkupListTree($this->getCaches());
        $aToolbar['aError'] = \MVC\Error::getERROR();

		$iMicrotime = microtime (true);
		$sMicrotime = sprintf ("%06d", ($iMicrotime - floor ($iMicrotime)) * 1000000);
		$oDateTime = new \DateTime (date ('Y-m-d H:i:s.' . $sMicrotime, $iMicrotime));
		$oStart = \MVC\Session::is()->get ('startDateTime');
		$dDiff = (date_format ($oDateTime, "s.u") - date_format ($oStart, "s.u"));
		$aToolbar['sConstructionTime'] = round ($dDiff, 3);
		
		return $aToolbar;
	}

    /**
     * @param $aData
     * @return string
     */
    protected function buildMarkupListTree($aData)
    {
        if (false === is_array($aData))
        {
            return '';
        }

        $sMarkup = '<ul class="myMvcToolbar-tree">';

        foreach ($aData as $sKey => $mValue)
        {
            $sMarkup.= '<li class="myMvcToolbar-tree"><span class="myMvcToolbar-bg-primary">' . trim($sKey) . '</span> <span class="myMvcToolbar-bg-info">=></span> ';

            if (is_array($mValue))
            {
                $sMarkup.= ' <span class="myMvcToolbar-bg-info">array(...</span> ';
                $sMarkup.= $this->buildMarkupListTree($mValue);
            }
            elseif (is_object($mValue))
            {
                ob_start();
                var_dump($mValue);
                $mValue = ob_get_contents();
                ob_end_clean();
                $sMarkup.= htmlentities(trim(preg_replace('!\s+!', ' ', $mValue)));
            }
            else
            {
                $sMarkup.= htmlentities(trim(preg_replace('!\s+!', ' ', $mValue)));
            }

            $sMarkup.= '</li>';
        }

        $sMarkup.= '</ul>';

        return $sMarkup;
    }

	/**
	 * get cachefiles
	 * 
     * @return array
     * @throws \ReflectionException
     */
    protected function getCaches ()
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
