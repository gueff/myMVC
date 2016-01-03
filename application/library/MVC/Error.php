<?php
/**
 * Error.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVC
 */
namespace MVC;

/**
 * Error
 */
class Error
{

	/**
	 * @var array error
	 * @access protected
	 * @static
	 */
	protected static $_aError;

	/**
	 * sets error handlers; 
	 * bind event 'mvc.error' to function
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct ()
	{
		register_shutdown_function ("\MVC\Error::FATAL");
		set_error_handler ("\MVC\Error::ERRORHANDLER");
		set_exception_handler ("\MVC\Error::EXCEPTION");

		Event::BIND ('mvc.error', function($mPackage)
		{
			\MVC\Error::addERROR ($mPackage);
		});
	}

	/**
	 * this catches an error on runtime, creates a new ErrorException Object of it and passes it to Exception Handler
	 * 
	 * @access public
	 * @static
	 * @param integer $iCode
	 * @param string $sMessage
	 * @param string $sFilename
	 * @param integer $iLineNr
	 * @param mixed $mContext
	 * @return void
	 */
	public static function ERRORHANDLER ($iCode, $sMessage, $sFilename, $iLineNr, $mContext = '')
	{	
		$oErrorException = new \ErrorException ($sMessage, (int) $iCode, (int) $iSeverity = 0, $sFilename, (int) $iLineNr );		
		
		self::EXCEPTION ($oErrorException);
	}	
	
	/**
	 * Error handler, passes flow over the exception logger with new ErrorException.
	 * 
	 * @access public
	 * @static
	 * @param string $sMessage
	 * @param integer $iCode
	 * @param integer $iSeverity
	 * @param string $sFilename
	 * @param integer $iLineNr
	 * @return void
	 */
	public static function ERROR ($sMessage = '', $iCode = E_ERROR, $iSeverity = 0, $sFilename = '', $iLineNr = 0)
	{	
		$oErrorException = new \ErrorException ($sMessage, (int) $iCode, (int) $iSeverity, $sFilename, (int) $iLineNr );		
		
		self::EXCEPTION ($oErrorException);
	}

	/**
	 * Uncaught exception handler
	 * 
	 * @access public
	 * @static
	 * @param \ErrorException $oErrorException
	 * @return void
	 */
	public static function EXCEPTION (\ErrorException $oErrorException)
	{		
		
		$sLogfile = 'error.log';
		$sMsg = '';

		if (method_exists ($oErrorException, 'getSeverity'))
		{
			$iSeverity = $oErrorException->getSeverity ();
			$sMsg.= 'Severity: ' . $iSeverity . "\t";

			if (in_array ($iSeverity, array (E_WARNING, E_USER_WARNING)))
			{
				$sLogfile = 'warning.log';
			}

			if (in_array ($iSeverity, array (E_NOTICE, E_USER_NOTICE, E_DEPRECATED)))
			{
				$sLogfile = 'notice.log';
			}
		}

		
		
		$sMsg.= '(Code: ' . $oErrorException->getCode () . ' / Class: ' . get_class ($oErrorException) . '), File: ' . $oErrorException->getFile () . ', Line: ' . $oErrorException->getLine () . ', Message: ' . $oErrorException->getMessage () . ', Trace: ' . $oErrorException->getTraceAsString ();
		self::addERROR ($sMsg);		
		Log::WRITE ($sMsg, $sLogfile);

		(true === filter_var (Registry::get ('MVC_DEBUG'), FILTER_VALIDATE_BOOLEAN)) ? Helper::DISPLAY (print_r($oErrorException, true)) : false;			
	}

	/**
	 * Checks for a fatal error, work around for set_error_handler not working on fatal errors.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function FATAL ()
	{
		$aError = error_get_last ();

		if (!empty($aError))
		{
			(true === filter_var (Registry::get ('MVC_DEBUG'), FILTER_VALIDATE_BOOLEAN)) ? Helper::DISPLAY($aError) : false;			
			
			self::ERROR (
				$aError["message"], 
				E_ERROR, 
				0, 
				$aError["file"], 
				$aError["line"] 
			);
		}
	}

	/**
	 * adds an error to the error array 
	 * 
	 * @access public
	 * @static
	 * @param mixed $mData
	 * @return void
	 */
	public static function addERROR ($mData)
	{
		self::$_aError[] = $mData;
	}

	/**
	 * returns error array 
	 * 
	 * @access public
	 * @static
	 * @return array
	 */
	public static function getERROR ()
	{
		return self::$_aError;
	}
}