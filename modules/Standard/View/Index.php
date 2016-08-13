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
 * @name $StandardView
 */
namespace Standard\View;

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

		// Standard Variable
		$this->sContentVar = 'sContent';
	}

	/**
	 * sends a 404 header
	 * 
	 * @access public
	 * @return void
	 */
	public function sendHeader404 ()
	{
		//@see http://php.net/manual/de/function.header.php#92305
		header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
	}

}
