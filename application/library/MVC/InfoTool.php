<?php
/**
 * InfoTool.php
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;


/**
 * InfoTool
 */
class InfoTool
{
    /**
     * toolbar array
     * @var array
     */
    protected $aToolbar = array ();

    /**
     * Index constructor.
     * adds Event Listerner to 'mvc.view.render.before'
     * starts collecting Infos and save it to Registry
     * @param \Smarty $oView
     * @throws \ReflectionException
     */
    public function __construct (\Smarty $oView)
    {
        // add toolbar at the right time
        \MVC\Event::BIND ('mvc.view.render.before', function (\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\InfoTool::injectToolbar ($oDTArrayObject->getDTKeyValueByKey('oView')->get_sValue());
        });

        // get toolbar values and save them to registry
        \MVC\Registry::set ('aToolbar', $this->collectInfo ($oView));
    }

    /**
     * adds the toolbar to the html dom before closing body tag
     * @param \Smarty $oView
     * @return void
     * @throws \DOMException
     * @throws \ReflectionException
     */
    public static function injectToolbar (\Smarty $oView)
    {
        $aToolbar = \MVC\Registry::get ('aToolbar');
        $sHtml = '';

        $sToolBarVarName = 'sToolBar_' . uniqid();
        $sInfoToolSmarty = '{$' . $sToolBarVarName . '}';

        // add toolbar template var to layout
        $oView->assign('aToolbar', $aToolbar);
        $oView->assign($sToolBarVarName, $oView->loadTemplateAsString(realpath(__DIR__) . '/templates/infoTool.tpl'));

        // disable regular view output
        \MVC\View::$bEchoOut = false;

        // inject toolbar var to regular string output via DOM
        if (true === isset($aToolbar['sRendered']) && false === empty($aToolbar['sRendered']))
        {
            $oDom = new \DOMDocument(null, null);

            // prevent error messages occuring by using DOM
            // @see http://stackoverflow.com/a/6090728/2487859
            libxml_use_internal_errors(true);

            // DOMDocument::loadHTML will treat your string as being in ISO-8859-1 unless you tell it otherwise.
            // @see http://stackoverflow.com/a/8218649/2487859
            $oDom->loadHTML(mb_convert_encoding($aToolbar['sRendered'], 'HTML-ENTITIES', 'UTF-8'));
            libxml_clear_errors();

            // add toolbar tag as a placeholder before body closing tag
            $oNode = $oDom->createElement($sToolBarVarName);
            $oBody = $oDom->getElementsByTagName('body');

            foreach ($oBody as $oItem)
            {
                $oItem->appendChild($oNode);
            }

            $sHtml = $oDom->saveHTML();

            // render the toolbar
            $sInfoToolRendered = $oView->fetch('string:' . $sInfoToolSmarty);

            // replace toolbar tag placeholder with rendered toolbar
            $sHtml = str_replace('<' . $sToolBarVarName . '></' . $sToolBarVarName . '>', $sInfoToolRendered, $sHtml);
        }

        // new output, now including toolbar
        echo $sHtml;
    }

    /**
     * collects all Info for being displayed by the Toolbar
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
        $aToolbar['sUniqueId'] = \MVC\Config::get_MVC_UNIQUE_ID();
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
        $aToolbar['session_id'] = \MVC\Session::is()->getSessionId();
        $aToolbar['aSessionSettings'] = $this->buildMarkupListTree(array(

            'namespace' => \MVC\Session::is()->getNamespace() . ' (which means: $_SESSION["' . \MVC\Session::is()->getNamespace() . '"])',
            'session_id' => $aToolbar['session_id'],
            'MVC_SESSION_ENABLE' => \MVC\Config::get_MVC_SESSION_ENABLE(),
            'MVC_SESSION_PATH' => \MVC\Config::get_MVC_SESSION_PATH(),
            'MVC_SESSION_OPTIONS' => \MVC\Config::get_MVC_SESSION_OPTIONS(),
            'oSession' => \MVC\Session::is(),
        ));
        $aToolbar['aSessionKeyValues'] = $this->buildMarkupListTree((isset($_SESSION)) ? $_SESSION : array());
        $aToolbar['aSessionFiles'] = $this->buildMarkupListTree(
            preg_grep('/^([^.])/', scandir(\MVC\Config::get_MVC_SESSION_OPTIONS()['save_path']))
        );

        $aToolbar['aSmartyTemplateVars'] = $this->buildMarkupListTree($oView->getTemplateVars());
        $aConstants = get_defined_constants (true);
        $aToolbar['aConstant'] = $this->buildMarkupListTree($aConstants['user']);
        $aToolbar['aServer'] = $this->buildMarkupListTree($_SERVER);
        $aToolbar['oMvcRequestGetWhitelistParams'] = $this->buildMarkupListTree(\MVC\Config::get_MVC_REQUEST_WHITELIST_PARAMS());
        $aToolbar['oMvcRequestGetQueryArray'] = $this->buildMarkupListTree(array_reverse(\MVC\Request::getQueryVarArray()));
        $aToolbar['aEvent'] = \MVC\Config::get_MVC_EVENT();
        $aToolbar['aEventBIND'] = $this->buildMarkupListTree($aToolbar['aEvent']['BIND']);
        $aToolbar['aEventBINDNAME'] = $this->buildMarkupListTree(Event::$aEvent);
        $aToolbar['aEventRUN'] = $this->buildMarkupListTree($aToolbar['aEvent']['RUN']);
        $aToolbar['aEventRUNBONDED'] = (isset($aToolbar['aEvent']['RUN_BONDED']) && false === empty($aToolbar['aEvent']['RUN_BONDED'])) ? $this->buildMarkupListTree($aToolbar['aEvent']['RUN_BONDED']) : array();
        $aToolbar['aEventUNBIND'] = (isset($aToolbar['aEvent']['UNBIND']) && false === empty($aToolbar['aEvent']['UNBIND'])) ? $this->buildMarkupListTree($aToolbar['aEvent']['UNBIND']) : array();
        $aToolbar['aRouting'] = array(
            'aRequest' => \MVC\Request::getCurrentRequest(),
            'sModule' => \MVC\Request::getModuleName(),
            'sController' => \MVC\Request::getControllerName(),
            'sMethod' => \MVC\Request::getMethodName(),
            'sArg' => ((isset($aToolbar['oMvcRequestGetQueryArray']['GET']['a'])) ? $aToolbar['oMvcRequestGetQueryArray']['GET']['a'] : ''),
            'aRoute' => $this->buildMarkupListTree(\MVC\Registry::get ('MVC_ROUTING_CURRENT')),
            'sRoutingJsonBuilder' => \MVC\Config::get_MVC_ROUTING_JSON_BUILDER(),
            'sRoutingHandling' => \MVC\Config::get_MVC_ROUTING_HANDLING()
        );
        $aToolbar['sRoutingPath'] = \MVC\Request::getCurrentRequest()['path'];
        $aToolbar['sRoutingQuery'] = (isset(\MVC\Request::getCurrentRequest()['query'])) ? \MVC\Request::getCurrentRequest()['query'] : '';

        $aPolicy = \MVC\Config::get_MVC_POLICY();
        $sController = '\\' . \MVC\Request::getModuleName() . '\\Controller\\' . \MVC\Request::getControllerName();
        $sMethod = \MVC\Request::getMethodName();
        $aToolbar['aPolicy']['aRule'] = $this->buildMarkupListTree(\MVC\Config::get_MVC_POLICY());
        $aToolbar['aPolicy']['aApplied'] = $this->buildMarkupListTree((isset($aPolicy[$sController][$sMethod])) ? $aPolicy[$sController][$sMethod] : false);
        $aToolbar['aPolicy']['sAppliedAt'] = ((isset($aPolicy[$sController][$sMethod])) ? $sController . '::' . $sMethod : false);
        $aToolbar['sTemplate'] = $oView->sTemplate;

        $aToolbar['sTemplateContent'] = (null !== get($aToolbar['sTemplate']) && true === is_file($oView->sTemplate)) ? file_get_contents ($aToolbar['sTemplate'], true) : '';
        $sRendered = '';

        if (true === is_file($oView->sTemplate))
        {
            ob_start ();
            $sTemplate = file_get_contents ($oView->sTemplate, true);
            $oView->renderString ($sTemplate);
            $sRendered = ob_get_contents ();
            ob_end_clean ();
        }

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
        $oStart = (false === empty(\MVC\Session::is()->get('startDateTime'))) ? \MVC\Session::is()->get('startDateTime') : new \DateTime (date ('Y-m-d H:i:s.' . $sMicrotime, $iMicrotime));
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
     * @return array
     * @throws \ReflectionException
     */
    protected function getCaches ()
    {
        $aCache = array ();
        $oObjects = new \RecursiveIteratorIterator (
            new \RecursiveDirectoryIterator (
                \MVC\Config::get_MVC_CACHE_DIR(),
                0
            ),
            \RecursiveIteratorIterator::SELF_FIRST,
            0
        );

        foreach ($oObjects as $sName => $oObject)
        {
            $sTmp = str_replace (\MVC\Config::get_MVC_CACHE_DIR(), '', $sName);

            if ($sTmp != '.' && $sTmp != '..')
            {
                $aCache[] = $sTmp;
            }
        }

        return $aCache;
    }
}