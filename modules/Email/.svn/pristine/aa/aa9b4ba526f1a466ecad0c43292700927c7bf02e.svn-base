<?php
/**
 * Index.php
 *
 * @module Email
 * @package Email\Controller
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace Email\Controller;

use Email\DataType\Config;
use MVC\Registry;

class Index
{
    /**
     * @var array
     */
    protected $aJson;

    /**
     * @var \Email\Model\Index
     */
    protected $oModelEmail;
	
    /**
     * Index constructor.
     * @param $sString
     * @throws \ReflectionException
     */
	public function __construct($sString)
	{
        // decode JSON
        $this->aJson = json_decode($sString, true);
		
		$this->oModelEmail = new \Email\Model\Index(
		    Config::create(
		        Registry::get('MODULE_EMAIL_CONFIG')
            )
        );
	}	

	/**
	 * Processes the mails to be sent in the spooler folder
	 */
	public function spool ()
	{
		$this->oModelEmail->spool();
		exit();		
	}
	
	/**
	 * Escalation to failed mails
	 */
	public function escalate ()
	{
		$this->oModelEmail->escalate();
		exit();		
	}	
}
