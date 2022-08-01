<?php
/**
 * Index.php
 *
 * @module Email
 * @package Email\Model
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace Email\Model;

use Email\DataType\Config;
use Email\DataType\Email;
use Email\DataType\EmailAttachment;
use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;
use MVC\Event;
use MVC\Helper;
use MVC\Log;


class Index
{
	/**
	 * Max. Time of renewed delivery attempts for retry mails before they are moved to /fail folder.
	 * @var integer
	 */
	protected $iMaxSecondsOfRetry = (60 * 60 * 2); // 2 h
	
	/**
	 *
	 * @var string
	 */
	protected $sSpoolerNewPath;
	
	/**
	 *
	 * @var string
	 */
	protected $sSpoolerDonePath;
	
	/**
	 *
	 * @var string
	 */
	protected $sSpoolerRetryPath;
	
	/**
	 *
	 * @var string
	 */
	protected $sSpoolerFailedPath;

	/**
	 * number of mails to be processed by the spooler
	 * 5	=== 5 / minute
	 *		=== 300 / hour
	 *		=== 1000 / ~3,5 hours
	 * 
	 * Default value: 10
	 * 
	 * @var integer
	 */
	protected $iAmountToSpool = 10;

    /**
     * @var null
     */
    protected $oCallback;

    /**
     * @var Config
     */
    protected $oConfig;

    /**
     * Index constructor.
     * @param Config $oConfig
     */
	public function __construct (Config $oConfig)
    {
        $this->oConfig = $oConfig;

        // fallback abs spooler dir
        if (empty($this->oConfig->get_sAbsolutePathToFolderSpooler()) || false === file_exists($this->oConfig->get_sAbsolutePathToFolderSpooler()))
        {
            $this->oConfig->set_sAbsolutePathToFolderSpooler(realpath(__DIR__ . '/../') . '/etc/data/spooler/');
        }

        // fallback abs attachment dir
        if (empty($this->oConfig->get_sAbsolutePathToFolderAttachment()) || false === file_exists($this->oConfig->get_sAbsolutePathToFolderAttachment()))
        {
            $this->oConfig->set_sAbsolutePathToFolderAttachment(realpath(__DIR__ . '/../') . '/etc/data/attachment/');
        }

        $this->sSpoolerNewPath = realpath($this->oConfig->get_sAbsolutePathToFolderSpooler() . $this->oConfig->get_sFolderNew()) . '/';
        $this->sSpoolerDonePath = realpath($this->oConfig->get_sAbsolutePathToFolderSpooler() . $this->oConfig->get_sFolderDone()) . '/';
        $this->sSpoolerRetryPath = realpath($this->oConfig->get_sAbsolutePathToFolderSpooler() . $this->oConfig->get_sFolderRetry()) . '/';
        $this->sSpoolerFailedPath = realpath($this->oConfig->get_sAbsolutePathToFolderSpooler() . $this->oConfig->get_sFolderFail()) . '/';

        // set fallback smtp
        if (null === $this->oConfig->get_oCallback() || true === empty($this->oConfig->get_oCallback()))
        {
            $this->oConfig->set_oCallback(function(Email $oEmail) {
                \Email\Model\Smtp::sendViaPhpMailer($oEmail);
            });
        }
    }

	/**
	 * sets number of max. mails to be processed within a spool
	 *
	 * @param integer $iAmountToSpool
	 */
	public function setAmountToSpool($iAmountToSpool)
	{
	    $this->oConfig->set_iAmountToSpool((int) $iAmountToSpool);
	}

	/**
	 * returns the maximum number of mails to be processed within a spool
	 *
	 * @return integer
	 */
	public function getAmountToSpool()
	{
		return $this->oConfig->get_iAmountToSpool();
	}

	/**
	 * stores a mail in the spooler folder "new
	 *
     * @param Email|null $oEmail
     * @return string
     * @throws \ReflectionException
     */
	public function saveToSpooler (Email $oEmail = null)
	{
		if (is_null($oEmail))
		{
			return '';
		}

		$sFilename = $this->sSpoolerNewPath . uniqid () . '_' . date('Y-m-d_H-i-s');
		$sData = $oEmail->getPropertyJson();
        $bSuccess = (true === file_put_contents($sFilename, $sData)) ? true : false;

        Event::RUN('email.model.index.saveToSpooler.done',
            DTArrayObject::create()
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sFilename')->set_sValue($sFilename))
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sData')->set_sValue($sData))
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('bSuccess')->set_sValue($bSuccess))
        );

        if (false === file_put_contents($sFilename, $sData))
        {
            return '';
        }

		return $sFilename;
	}

	/**
	 * processes the mails to be sent in the spooler folder
     *
     * @return array
     * @throws \ReflectionException
     */
	public function spool ()
	{
		$this->_handleRetries();

		// mails to be sent from New
		$aFiles = array_diff(scandir ($this->sSpoolerNewPath), $this->oConfig->get_aIgnoreFile());

		$iCnt = 0;
		$aResponse = array();

		foreach ($aFiles as $sFile)
		{
			$iCnt++;

			// limit of mails to be processed reached; abort.
			if ($iCnt > $this->oConfig->get_iAmountToSpool())
			{
				break;
			}

			// get Email
			$aMail = json_decode(file_get_contents($this->sSpoolerNewPath . $sFile), true);
			$oEmail = Email::create($aMail);

            // send eMail
            /** @var DTArrayObject $oSendResponse */
            $oSendResponse = $this->send($oEmail);
            $sMessage = '';
            $sOldName = $this->sSpoolerNewPath . $sFile;

            if (true === $oSendResponse->getDTKeyValueByKey('bSuccess')->get_sValue())
            {
                $sNewName = $this->sSpoolerDonePath . $sFile;
                $sStatus = basename($this->sSpoolerDonePath);
                $sMessage = 'move mail to "' . $sStatus . '"';
            }
            else
            {
                $sNewName = $this->sSpoolerRetryPath . $sFile;
                $sStatus = basename($this->sSpoolerRetryPath);
                $sMessage = 'move mail to "' . $sStatus . '"';
            }

            $bRename = rename(
                $sOldName,
                $sNewName
            );

            $oSpoolResponse = DTArrayObject::create()
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('bSuccess')->set_sValue($bRename))
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($sMessage))

                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sOldname')->set_sValue($sOldName))
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sNewname')->set_sValue($sNewName))
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sStatus')->set_sValue($sStatus))
            ;

            $oResponse = DTArrayObject::create()
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('oSendResponse')->set_sValue($oSendResponse)) // bSuccess, sMessage, oException
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('oSpoolResponse')->set_sValue($oSpoolResponse))
                ;

            $aResponse[] = $oResponse;

            Event::RUN('email.model.index.spool', $oResponse);
		}

		return $aResponse;
	}
	
	/**
	 * Moves mails from retry folder either to /new or to /fail depending on whether the Max.
     * Time of new delivery attempts for retry mails is reached or not.
     */
	protected function _handleRetries()
	{
		// get Retry Mails
		$aRetry = array_diff(scandir ($this->sSpoolerRetryPath), $this->oConfig->get_aIgnoreFile());

		foreach ($aRetry as $sFile)
		{			
			// Determine the age of the file
			$sFilemtime = filemtime($this->sSpoolerRetryPath . $sFile);

			// Calculate time difference
			$iTimeDiff = (time() - $sFilemtime);

			// Try shipping again;
			// so move to /new folder
			if ($iTimeDiff < $this->oConfig->get_iMaxSecondsOfRetry())
			{
                $sOldName = $this->sSpoolerRetryPath . $sFile;
                $sNewName = $this->sSpoolerNewPath . $sFile;

                $aMsg = array();
                $aMsg[] = "MAIL\t" . $sOldName . "\t" . '$iTimeDiff: ' . $iTimeDiff . ' less than $iMaxRetryDurationTime: ' . $this->oConfig->get_iMaxSecondsOfRetry() . ' (seconds)';
                $aMsg[] = "MAIL\t" . 'try sending again.; move to folder "new": ' . $sNewName;

				$bRename = rename(
                    $sOldName,
                    $sNewName
				);
			}
			// Don't try again;
			// Move final to /fail folder
			else
			{
                $sOldName = $this->sSpoolerRetryPath . $sFile;
                $sNewName = $this->sSpoolerFailedPath . $sFile;

                $aMsg = array();
                $aMsg[] = "MAIL\t" . $sOldName . "\t" . '$iTimeDiff: ' . $iTimeDiff . ' not less than $iMaxRetryDurationTime: ' . $this->oConfig->get_iMaxSecondsOfRetry() . ' (seconds)';
                $aMsg[] = "MAIL\t" . 'do not try sending again.; move to folder "fail": ' . $sNewName;

                $bRename = rename(
                    $sOldName,
                    $sNewName
				);
			}

            Event::RUN('email.model.index._handleRetries',
                DTArrayObject::create()
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sOldname')->set_sValue($sOldName))
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sNewname')->set_sValue($sNewName))
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('bMoveSuccess')->set_sValue($bRename))
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('aMessage')->set_sValue($aMsg))
            );
		}		
	}

    /**
     * @return array
     */
	public function getEscalatedMails()
    {
        // Working folder is fail folder
        chdir($this->sSpoolerFailedPath);

        // First determine all fail mails
        $aAllFailed = array_diff(scandir ('./'), $this->oConfig->get_aIgnoreFile());

        // Now find all already escalated mails
        $aEscalated = glob('escalated*', GLOB_BRACE);

        // exclude escalated mails
        $aFailed = array_diff(
            $aAllFailed,
            $aEscalated
        );

        return $aFailed;
    }

	/**
	 * Escalates failed mails
	 * @throws \ReflectionException
	 */
	public function escalate()
	{
		$aFailed = $this->getEscalatedMails();

		foreach ($aFailed as $sFile)
		{
			$sMailFileName = $this->sSpoolerFailedPath . $sFile;
			$sEscalatedFileName = $this->sSpoolerFailedPath . 'escalated.' . $sFile;
			
			\MVC\Event::RUN('email.model.index.escalate',
			    DTArrayObject::create()
				->add_aKeyValue(
				    DTKeyValue::create()->set_sKey('sMailFileName')->set_sValue($sMailFileName)
				)
				->add_aKeyValue(
				    DTKeyValue::create()->set_sKey('sEscalatedFileName')->set_sValue($sEscalatedFileName)
				)					
			);
			
			$bRename = rename(
				$sMailFileName,
				$sEscalatedFileName
			);	
		}		
	}

    /**
     * @param Email $oEmail
     * @return array
     */
    public static function getAttachmentArray(Email $oEmail)
    {
        $aAttachment = array();

        /** @var DTArrayObject $oDTArrayObject */
        foreach ($oEmail->get_oAttachment() as $aDTArrayObject)
        {
            /** @var DTKeyValue $aDTKeyValue */
            foreach ($aDTArrayObject as $aDTKeyValue)
            {
                $oEmailAttachment = EmailAttachment::create($aDTKeyValue['sValue']);

                $aAttachment[] = array(
                    'name' => $oEmailAttachment->get_name(),
                    'content' => file_get_contents($oEmailAttachment->get_file())
                );
            }
        }

        return $aAttachment;
    }

    /**
     * Send E-Mail
     * @param Email $oEmail
     * @return DTArrayObject
     * @throws \ReflectionException
     */
	public function send (Email $oEmail)
	{
	    // call Callback/Closure function
        $mResult = call_user_func($this->oConfig->get_oCallback(), $oEmail);

        $sMessageFail = "ERROR\t" . ' *** Closure execution failed: ' . \MVC\Helper::CLOSUREDUMP($this->oConfig->get_oCallback());

        /** @var DTArrayObject $oDTArrayObject */
        $oDTArrayObject = (false === $mResult)
            ? \MVC\DataType\DTArrayObject::create()
                ->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('bSuccess')->set_sValue(false))
                ->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('sMessage')->set_sValue($sMessageFail))
                ->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('oException')->set_sValue(new \Exception($sMessageFail)))
            : $mResult;

        // error occurred
        if (false === $oDTArrayObject->getDTKeyValueByKey('bSuccess')->get_sValue())
        {
            Event::RUN('mvc.error', $oDTArrayObject);
            Log::WRITE($oDTArrayObject->getDTKeyValueByKey('sMessage')->get_sValue(), 'email.log');
            return $oDTArrayObject;
        }

        return $oDTArrayObject;
	}

    /**
     * @param string $sAbsoluteFilePath
     * @return bool
     * @throws \ReflectionException
     */
	public function deleteAttachment($sAbsoluteFilePath = '')
    {
        $bUnlink = false;

        // security
        $sAbsoluteFilePath = $this->oConfig->get_sAbsolutePathToFolderAttachment() . Helper::secureFilePath(basename($sAbsoluteFilePath));

        if (true == file_exists($sAbsoluteFilePath))
        {
            $bUnlink = unlink($sAbsoluteFilePath);
        }

        Event::RUN(
            'email.model.index.deleteEmailAttachment',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()
                        ->set_sKey('bUnlink')
                        ->set_sValue($bUnlink)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()
                        ->set_sKey('sFile')
                        ->set_sValue($sAbsoluteFilePath)
                )
        );

        return $bUnlink;
    }

    /**
     * deletes email json-file in spooler folder
     * @param string $sAbsoluteFilePath
     * @return bool
     * @throws \ReflectionException
     */
	public function deleteEmailFile($sAbsoluteFilePath = '')
    {
        // security
        // Path must be to one of the set folders
        $sAbsoluteFilePath = Helper::secureFilePath($sAbsoluteFilePath);
        $bIsLocatedInAcceptedFolder = in_array(
            substr($sAbsoluteFilePath, 0, strlen($this->sSpoolerNewPath)),
            array(
                $this->sSpoolerNewPath,
                $this->sSpoolerDonePath,
                $this->sSpoolerFailedPath,
                $this->sSpoolerRetryPath
            )
        );

        $bUnlink = false;

        if (true === $bIsLocatedInAcceptedFolder || true == file_exists($sAbsoluteFilePath))
        {
            $bUnlink = unlink($sAbsoluteFilePath);
        }

        Event::RUN(
            'email.model.index.deleteEmailFile',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()
                        ->set_sKey('bUnlink')
                        ->set_sValue($bUnlink)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()
                        ->set_sKey('sFile')
                        ->set_sValue($sAbsoluteFilePath)
                )
        );

        return $bUnlink;
    }

    /**
     * moves an e-mail to folder /new
     *
     * @param string $sCurrentStatusFolder
     * @param string $sBasenameFile
     * @return string $sNewName Abs.Filepath | empty=fail
     */
    public function renewEmail($sCurrentStatusFolder = '', $sBasenameFile = '')
    {
        $sPath = 'sSpooler' . ucfirst($sCurrentStatusFolder) . 'Path';

        $sOldName = $this->$sPath . $sBasenameFile;
        $sNewName = $this->sSpoolerNewPath . $sBasenameFile;
        $bRename = false;

        if (file_exists($sOldName) && $sOldName != $sNewName)
        {
            $bRename = rename(
                $sOldName,
                $sNewName
            );
        }

        if (true === $bRename)
        {
            return $sNewName;
        }

        return '';
    }

    /**
     * @param EmailAttachment $oEmailAttachment
     * @return string fail=leer
     */
    public function saveAttachment(EmailAttachment $oEmailAttachment)
    {
        $aInfo = pathinfo($oEmailAttachment->get_name());

        $sAbsPathFile = $this->oConfig->get_sAbsolutePathToFolderAttachment()
            . md5($oEmailAttachment) . '.'
            . uniqid(microtime(true), true) . '.'
            . $aInfo['extension'];

        $bSsave = (boolean) file_put_contents(
            $sAbsPathFile,
            base64_decode($oEmailAttachment->get_content())
        );

        if (true === $bSsave && file_exists($sAbsPathFile))
        {
            return $sAbsPathFile;
        }

        return '';
    }
}
