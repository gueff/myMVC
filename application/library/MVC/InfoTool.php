<?php
/**
 * InfoTool.php
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
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
     * adds Event Listener to 'mvc.view.render.before'
     * starts collecting Infos and save it to Registry
     * @param \Smarty $oView
     * @throws \ReflectionException
     */
    public function __construct (\Smarty $oView)
    {
        // add toolbar at the right time
        Event::BIND ('mvc.view.render.before', function (\MVC\DataType\DTArrayObject $oDTArrayObject) {
            InfoTool::injectToolbar ($oDTArrayObject->getDTKeyValueByKey('oView')->get_sValue());
        });

        // get toolbar values and save them to registry
        Registry::set ('aToolbar', $this->collectInfo ($oView));
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
        $aToolbar = Registry::get ('aToolbar');
        $sHtml = '';

        $sToolBarVarName = 'sToolBar_' . uniqid();
        $sInfoToolSmarty = '{$' . $sToolBarVarName . '}';

        // add toolbar template var to layout
        $oView->assign('aToolbar', $aToolbar);
        $oView->assign($sToolBarVarName, $oView->loadTemplateAsString(realpath(__DIR__) . '/templates/infoTool.tpl'));

        // disable regular view output
        View::$bEchoOut = false;

        // inject toolbar var to regular string output via DOM
        if (true === isset($aToolbar['sRendered']) && false === empty($aToolbar['sRendered']))
        {
            $oDom = new \DOMDocument('', '');

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

        $aMethod = get_class_methods('MVC\Config');
        $aTmp = array();

        foreach ($aMethod as $sMethod)
        {
            if ('get' === substr($sMethod, 0, 3))
            {
                $sTmpVar = str_replace('get_', '', $sMethod);
                $aTmp['sVar'] = $sTmpVar;

                if (in_array($sTmpVar, array('MVC_ROUTING', 'MVC_MODULE_CURRENT_VIEW')))
                {
                    $aTmp['mResult'] = '⚠ (would be too large to dump here)';
                }
                else
                {
                    $aTmp['mResult'] = Config::$sMethod();
                }

                $aTmp['sMethod'] = 'Config::' . $sMethod . '()';
                $aToolbar['aConfig'][] = $aTmp;
            }
        }

        $aToolbar['sPHP'] = phpversion ();
        $aToolbar['sOS'] = PHP_OS;
        $aToolbar['sUniqueId'] = Config::get_MVC_UNIQUE_ID();
        $aToolbar['sMyMvcVersion'] = Config::get_MVC_VERSION();
        $aToolbar['sMyMVCCore'] = $this->buildMarkupListTree(Config::get_MVC_CORE());
        $aToolbar['sEnv'] = getenv('MVC_ENV');
        $aToolbar['aEnvGetenv'] = $this->buildMarkupListTree(getenv());
        $aToolbar['aEnvEnv'] = $this->buildMarkupListTree($_ENV);
        $aToolbar['aGet'] = $this->buildMarkupListTree($_GET);
        $aToolbar['aPost'] = $this->buildMarkupListTree($_POST);
        $aToolbar['aCookie'] = $this->buildMarkupListTree($_COOKIE);
        $aToolbar['aRequest'] = $this->buildMarkupListTree($_REQUEST);
        $aToolbar['session_id'] = Session::is()->getSessionId();
        $aToolbar['aSessionSettings'] = array(
            'MVC_SESSION_ENABLE' => Config::get_MVC_SESSION_ENABLE(),
            'MVC_SESSION_PATH' => Config::get_MVC_SESSION_PATH(),
            'MVC_SESSION_OPTIONS' => $this->buildMarkupListTree(Config::get_MVC_SESSION_OPTIONS()),
            'oSession' => Session::is(),
        );
        $aToolbar['aSessionKeyValues'] = $this->buildMarkupListTree(Session::is()->getAll());
        $aToolbar['aSessionFiles'] = $this->buildMarkupListTree(
            preg_grep('/^([^.])/', scandir(Config::get_MVC_SESSION_OPTIONS()['save_path']))
        );
        $aToolbar['aSessionRules']['aEnableSessionForController'] = (false === empty(\MVC\Config::MODULE()['SESSION']['aEnableSessionForController']))
            ? $this->buildMarkupListTree(\MVC\Config::MODULE()['SESSION']['aEnableSessionForController'])
            : 'none'
        ;
        $aToolbar['aSessionRules']['aDisableSessionForController'] = (false === empty(\MVC\Config::MODULE()['SESSION']['aDisableSessionForController']))
            ? $this->buildMarkupListTree(\MVC\Config::MODULE()['SESSION']['aDisableSessionForController'])
            : 'none'
        ;
        $aToolbar['aSmartyTemplateVars'] = $oView->getTemplateVars();
        $aToolbar['sSmartyTemplateVars'] = $this->buildMarkupListTree($oView->getTemplateVars());
        $aConstants = get_defined_constants (true);
        $aToolbar['aConstant'] = $this->buildMarkupListTree($aConstants['user']);
        $aToolbar['aServer'] = $this->buildMarkupListTree($_SERVER);
        $aToolbar['sPathParam'] = $this->buildMarkupListTree(Request::getPathParam());
        $aToolbar['aPathParam'] = Request::getPathParam();
        $aToolbar['aEvent'] = Config::get_MVC_EVENT();
        $aToolbar['aEventBIND'] = $this->buildMarkupListTree($aToolbar['aEvent']['BIND']);
        $aToolbar['aEventBINDNAME'] = $this->buildMarkupListTree(Event::$aEvent);
        $aToolbar['aEventRUN'] = $this->buildMarkupListTree($aToolbar['aEvent']['RUN']);
        $aToolbar['aEventRUNBONDED'] = (isset($aToolbar['aEvent']['RUN_BONDED']) && false === empty($aToolbar['aEvent']['RUN_BONDED'])) ? $this->buildMarkupListTree($aToolbar['aEvent']['RUN_BONDED']) : array();
        $aToolbar['aEventUNBIND'] = (isset($aToolbar['aEvent']['UNBIND']) && false === empty($aToolbar['aEvent']['UNBIND'])) ? $this->buildMarkupListTree($aToolbar['aEvent']['UNBIND']) : array();
        $aToolbar['aRouting'] = array(
            'aRequest' => Request::getCurrentRequest()->getPropertyArray(),
            'sModule' => Route::getCurrent()->get_module(),
            'sController' => Route::getCurrent()->get_c(),
            'sMethod' => Route::getCurrent()->get_method(),
            'aRoutingCurrent' => Route::getCurrent()->getPropertyArray(),
            'sRoutingCurrent' => $this->buildMarkupListTree(Route::getCurrent()->getPropertyArray()),
            'aRoute' => $this->buildMarkupListTree(array_keys(Route::$aRoute)),
        );

        $aToolbar['sRoutingPath'] = Request::getCurrentRequest()->get_path();
        $aToolbar['sRoutingQuery'] = Request::getCurrentRequest()->get_query(); # (isset(Request::getCurrentRequest()->get_query())) ? Request::getCurrentRequest()['query'] : '';

        $aToolbar['aPolicy']['aRule'] = $this->buildMarkupListTree(Policy::getRules());
        $aPolicy = Policy::getRulesApplied();
        $aTmpPolicy = array();

        /** @var \MVC\DataType\DTArrayObject $oDTArrayObject */
        foreach ($aPolicy as $oDTArrayObject)
        {
            $aTmpPolicy[] = $oDTArrayObject->getDTKeyValueByKey('sPolicy')->get_sValue();
        }

        $aToolbar['aPolicy']['aApplied'] = $this->buildMarkupListTree($aTmpPolicy);

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
        $aToolbar['aRegistry'] = Registry::getStorageArray ();
        $aToolbar['sRegistry'] = $this->buildMarkupListTree($aToolbar['aRegistry']);
        $aToolbar['aCache'] = $this->buildMarkupListTree($this->getCaches());
        $aToolbar['aError'] = Error::getERROR();

        $aToolbar['aModuleCurrentConfig'] = $this->buildMarkupListTree(Config::MODULE());

        $fMicrotime = microtime (true);
        $sMicrotime = sprintf ("%06d", ($fMicrotime - floor ($fMicrotime)) * 1000000);
        $oDateTime = new \DateTime (date ('Y-m-d H:i:s.' . $sMicrotime));

        $oStart = (false === empty(Session::is()->get('startDateTime')))
            ? Session::is()->get('startDateTime')
            : new \DateTime (date ('Y-m-d H:i:s.' . $sMicrotime))
        ;

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
            (true === empty($mValue)) ? $mValue = '' : false;

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
                Config::get_MVC_CACHE_DIR(),
                0
            ),
            \RecursiveIteratorIterator::SELF_FIRST,
            0
        );

        foreach ($oObjects as $sName => $oObject)
        {
            $sTmp = str_replace (Config::get_MVC_CACHE_DIR(), '', $sName);

            if ($sTmp != '.' && $sTmp != '..')
            {
                $aCache[] = $sTmp;
            }
        }

        return $aCache;
    }
}