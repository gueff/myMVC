<?php
/**
 * Error.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;

/**
 * Error
 */
class Error
{
    /**
     * @var string[]
     */
    public static $aExceptionTranslation = [
        E_ERROR => "E_ERROR",
        E_WARNING => "E_WARNING",
        E_PARSE => "E_PARSE",
        E_NOTICE => "E_NOTICE",
        E_CORE_ERROR => "E_CORE_ERROR",
        E_CORE_WARNING => "E_CORE_WARNING",
        E_COMPILE_ERROR => "E_COMPILE_ERROR",
        E_COMPILE_WARNING => "E_COMPILE_WARNING",
        E_USER_ERROR => "E_USER_ERROR",
        E_USER_WARNING => "E_USER_WARNING",
        E_USER_NOTICE => "E_USER_NOTICE",
        E_STRICT => "E_STRICT",
        E_RECOVERABLE_ERROR => "E_RECOVERABLE_ERROR",
        E_DEPRECATED => "E_DEPRECATED",
        E_USER_DEPRECATED => "E_USER_DEPRECATED",
        E_ALL => "E_ALL"
    ];

	/**
	 * @var array error
	 */
	protected static $_aError;

	/**
	 * sets error handlers;
	 * bind event 'mvc.error' to function
     * @throws \ReflectionException
     */
	public static function init()
	{
		register_shutdown_function ("\MVC\Error::fatal");
		set_error_handler ("\MVC\Error::errorHandler");
		set_exception_handler ("\MVC\Error::exception");

		Event::bind ('mvc.error', function(DTArrayObject $oDTArrayObject) {
			\MVC\Error::addERROR ($oDTArrayObject);
		});
	}

	/**
	 * this catches an error on runtime, creates a new ErrorException Object of it and passes it to Exception Handler
     * @param $iCode
     * @param $sMessage
     * @param $sFilename
     * @param $iLineNr
     * @param string $mContext
     * @throws \ReflectionException
     */
	public static function errorHandler ($iCode, $sMessage, $sFilename, $iLineNr, $mContext = '')
	{	
		$oErrorException = new \ErrorException ($sMessage, (int) $iCode, (int) $iSeverity = 0, $sFilename, (int) $iLineNr );		
		
		self::exception ($oErrorException);
	}	
	
	/**
	 * Error handler, passes flow over the exception logger with new ErrorException.
     * @param string $sMessage
     * @param int $iCode
     * @param int $iSeverity
     * @param string $sFilename
     * @param int $iLineNr
     * @throws \ReflectionException
     */
	public static function error ($sMessage = '', $iCode = E_ERROR, $iSeverity = 0, $sFilename = '', $iLineNr = 0)
	{	
		$oErrorException = new \ErrorException ($sMessage, (int) $iCode, (int) $iSeverity, $sFilename, (int) $iLineNr );		
		
		self::exception ($oErrorException);
	}

	/**
	 * Uncaught exception handler
     * @param $oErrorException
     * @throws \ReflectionException
     */
	public static function exception($oErrorException)
	{
		$sLogfile = Config::get_MVC_LOG_FILE_ERROR();
		$sMsg = '';

        /** @var \ErrorException $oErrorException */
		if (method_exists ($oErrorException, 'getSeverity'))
		{
			if (in_array ($oErrorException->getCode(), array (E_WARNING, E_USER_WARNING)))
			{
				$sLogfile = Config::get_MVC_LOG_FILE_WARNING();
			}

			if (in_array ($oErrorException->getCode(), array (E_NOTICE, E_USER_NOTICE, E_DEPRECATED)))
			{
				$sLogfile = Config::get_MVC_LOG_FILE_NOTICE();
			}
		}

        $sMsg.= self::$aExceptionTranslation[$oErrorException->getCode()] . "\t";
		$sMsg.= '(Code: ' . $oErrorException->getCode()
            . ' / Class: ' . get_class ($oErrorException)
            . '), File: ' . $oErrorException->getFile()
            . ', Line: ' . $oErrorException->getLine()
            . ', Message: ' . $oErrorException->getMessage()
            . ', Trace: ' . $oErrorException->getTraceAsString();
		self::addERROR (
		    DTArrayObject::create()
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($sMsg))
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('$oException')->set_sValue($oErrorException))
        );
		Log::write ($sMsg, $sLogfile);
	}

	/**
	 * Checks for a fatal error, work around for set_error_handler not working on fatal errors.
     * @throws \ReflectionException
     */
	public static function fatal()
	{
		$aError = error_get_last ();

		if (!empty($aError))
		{
			self::error (
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
	 * @access public
	 * @static
	 * @param DTArrayObject $oDTArrayObject
	 * @return void
	 */
	public static function addERROR (DTArrayObject $oDTArrayObject)
	{
	    // add time
        $oDTArrayObject->add_aKeyValue(
            DTKeyValue::create()
                ->set_sKey('_sErrorTime')
                ->set_sValue((string) microtime(true))
        );
		self::$_aError[] = $oDTArrayObject;
	}

	/**
	 * returns error array 
	 * @access public
	 * @static
	 * @return array
	 */
	public static function getERROR ()
	{
		return self::$_aError;
	}
}