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
 * @name $WebbixxView
 */
namespace Webbixx\View;

use MVC\Config;
use MVC\File;
use MVC\Helper;
use MVC\Registry;
use MVC\Request;

/**
 * Index
 * 
 * @extends \MVC\View
 */
class Index extends \MVC\View
{
    /**
     * Index constructor.
     * @throws \ReflectionException
     */
	public function __construct ()
	{
		parent::__construct ();

        $this->sendSecurityHeader();

		$this->sContentVar = 'sContent';
	}

    /**
     * set HTTP Security Header
     * @throws \ReflectionException
     */
    public function sendSecurityHeader()
    {
        header("Content-Security-Policy: " . trim(\MVC\Registry::get('CONTENT_SECURITY_POLICY')['Content-Security-Policy']));   // Default
        header("X-Content-Security-Policy: " . \MVC\Registry::get('CONTENT_SECURITY_POLICY')['Content-Security-Policy']);       // IE
        header("X-Webkit-CSP: " . \MVC\Registry::get('CONTENT_SECURITY_POLICY')['Content-Security-Policy']);                    // Chrome und Safari
        header("X-Frame-Options: allow-from " . \MVC\Registry::get('CONTENT_SECURITY_POLICY')['X-Frame-Options']);
        header("X-XSS-Protection: " . \MVC\Registry::get('CONTENT_SECURITY_POLICY')['X-XSS-Protection']);
        header("Strict-Transport-Security: " . \MVC\Registry::get('CONTENT_SECURITY_POLICY')['Strict-Transport-Security']);
    }

    /**
     * @param array $aRouting
     * @return void
     * @throws \ReflectionException
     * @throws \SmartyException
     */
    public function autoAssign(array $aRouting = array())
    {
        $this->sTemplate = $this->sTemplateDir . '/' . get($aRouting['template']['layout'], Config::get_MVC_SMARTY_TEMPLATE_DEFAULT());
        $this->assign('sLayoutTemplate', $this->sTemplate);
        $this->assign('sTitle', get($aRouting['title'], ''));
        $this->assign('aRegistry', Registry::getStorageArray());
        $this->assign('aRouting', $aRouting);

        foreach (get($aRouting['template']['var']['set'], array()) as $sKey => $sValue)
        {
            $this->assign($sKey, trim($sValue));
        }

        foreach (get($aRouting['template']['var']['load'], array()) as $sKey => $sValue)
        {
            $this->assign($sKey, trim($this->loadTemplateAsString ($sValue)));
        }

        $sStyle = '';
        $sScript = '';

        foreach (get($aRouting['template']['sStyle'], array()) as $sKey => $sValue)
        {
            $sStyle.= '<link href="' . $sValue . '" rel="stylesheet" type="text/css">' . "\n";
        }

        foreach (get($aRouting['template']['sScript'], array()) as $sKey => $sValue)
        {
            $sScript.='<script src="' . $sValue . '" type="text/javascript"></script>' . "\n";
        }

        $this->assign('sStyle', $sStyle);
        $this->assign('sScript', $sScript);
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function addPublicModuleFolder()
    {
        $sPublicModule = File::secureFilePath(Registry::get('MVC_PUBLIC_PATH') . '/' . Request::getModuleName());

        if (false === file_exists($sPublicModule))
        {
            mkdir($sPublicModule);
        }

        return $sPublicModule;
    }

    /**
     * @param string $sFileName
     * @param string $sContent
     * @return bool
     * @throws \ReflectionException
     */
    protected function savePublicFile($sFileName = '', $sContent = '')
    {
        $sPublicModule = $this->addPublicModuleFolder();

        $bSuccess = (boolean) file_put_contents(
            $sPublicModule . '/' . $sFileName,
            $sContent
        );

        return $bSuccess;
    }
}
