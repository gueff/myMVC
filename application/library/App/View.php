<?php
/**
 * View.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace App;

use MVC\Config;
use MVC\DataType\DTRoute;
use MVC\DataType\DTRoutingAdditional;
use MVC\Route;

/**
 * Controller
 */
class View extends \MVC\View
{
    protected static $_oInstance;

    /**
     * Index constructor.
     * @throws \ReflectionException
     */
    protected function __construct()
	{
		parent::__construct ();
 	}

    /**
     * @return self
     */
    public static function init() : self
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self();
        }

        Config::set_MVC_MODULE_PRIMARY_VIEW(self::$_oInstance);

        return self::$_oInstance;
    }

    /**
     * set HTTP Security Header
     * @return bool
     * @throws \ReflectionException
     */
    public function sendSecurityHeader()
    {
        $aCSPMapping = array(
            // header key                   CSP config key
            'Content-Security-Policy'   => 'Content-Security-Policy',   // Default
            'X-Content-Security-Policy' => 'Content-Security-Policy',   // IE
            'X-Webkit-CSP'              => 'Content-Security-Policy',   // Chrome, Safari
            'X-Frame-Options'           => 'X-Frame-Options',
            'X-XSS-Protection'          => 'X-XSS-Protection',
            'Strict-Transport-Security' => 'Strict-Transport-Security',
        );

        $aCSP = get(Config::MODULE()['CSP'], array());

        foreach ($aCSPMapping as $sKey => $sValue)
        {
            if (null === get($aCSP[$sKey]))
            {
                continue;
            }

            header($sKey . ': ' . trim(preg_replace('!\s+!', ' ', $aCSP[$sKey])));
        }

        return true;
    }

    /**
     * @param \MVC\DataType\DTRoute $oDTRoute
     * @return void
     * @throws \ReflectionException
     */
    public function autoAssign(DTRoute $oDTRoute = null)
    {
        (true === is_null($oDTRoute)) ? $oDTRoute = Route::getCurrent() : false;
        $oDTRoutingAdditional = DTRoutingAdditional::create(json_decode($oDTRoute->get_additional(), true));

        $this->sTemplateRelative = (false === empty($oDTRoutingAdditional->get_sLayout())) ? $oDTRoutingAdditional->get_sLayout() : Config::get_MVC_SMARTY_TEMPLATE_DEFAULT();
        $this->sTemplate = $this->sTemplateDir . '/' . $this->sTemplateRelative;
        $this->assign('sTemplateRelative', $this->sTemplateRelative);
        $this->assign('sTemplate', $this->sTemplate);
        $this->assign('oDTRoute', $oDTRoute);
        $this->assign('oDTRoutingAdditional', $oDTRoutingAdditional);
        $this->assign('layout', trim($this->loadTemplateAsString($oDTRoutingAdditional->get_sLayout())));
    }
}