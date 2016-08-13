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

/**
 * Index
 * 
 * @extends \MVC\View
 */
class Index extends \MVC\View
{
	/**
	 * Constructor
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct ()
	{
		parent::__construct ();

		// Standard Template
		$this->sTemplate = $this->sTemplateDir . '/layout/index.tpl';

		// Standard Variable in Standard Template
		$this->sContentVar = 'sContent';
	}

}
