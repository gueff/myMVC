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
 * @name ${module}View
 */
namespace {module}\View;

use MVC\Registry;

/**
 * Index
 * 
 * @extends \MVC\View
 */
class Index extends \MVC\View
{
    /**
     * Index constructor.
     * @throws ReflectionException
     */
	public function __construct ()
	{
		parent::__construct ();

		$this->sContentVar = 'sContent';
	}

    /**
     * @param array $aRouting
     * @throws \SmartyException
     */
    public function autoAssign(array $aRouting = array())
    {
        $this->sTemplate = $this->sTemplateDir . '/' . $aRouting['template']['layout'];
        $this->assign ('sLayoutTemplate', $this->sTemplate);
        $this->assign ('sTitle', $aRouting['title']);
        $this->assign('aRegistry', Registry::getStorageArray());
        $this->assign('aRouting', $aRouting);

        foreach ($aRouting['template']['var']['set'] as $sKey => $sValue)
        {
            $this->assign($sKey, trim($sValue));
        }

        foreach ($aRouting['template']['var']['load'] as $sKey => $sValue)
        {
            $this->assign($sKey, trim($this->loadTemplateAsString ($sValue)));
        }

        foreach ($aRouting['template']['sStyle'] as $sKey => $sValue)
        {
            $this->assign($sKey, trim($this->loadTemplateAsString ($sValue)));
        }

        foreach ($aRouting['template']['sScript'] as $sKey => $sValue)
        {
            $this->assign($sKey, trim($this->loadTemplateAsString ($sValue)));
        }
    }
}
