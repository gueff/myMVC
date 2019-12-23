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

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;

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
     * Error constructor.
	 * sets error handlers;
	 * bind event 'mvc.error' to function
     * @throws \ReflectionException
     */
	public function __construct ()
	{
		register_shutdown_function ("\MVC\Error::FATAL");
		set_error_handler ("\MVC\Error::ERRORHANDLER");
		set_exception_handler ("\MVC\Error::EXCEPTION");

		Event::BIND ('mvc.error', function(DTArrayObject $oDTArrayObject) {
			\MVC\Error::addERROR ($oDTArrayObject);
		});
	}

	/**
	 * this catches an error on runtime, creates a new ErrorException Object of it and passes it to Exception Handler
	 * 
     * @param $iCode
     * @param $sMessage
     * @param $sFilename
     * @param $iLineNr
     * @param string $mContext
     * @throws \ReflectionException
     */
	public static function ERRORHANDLER ($iCode, $sMessage, $sFilename, $iLineNr, $mContext = '')
	{	
		$oErrorException = new \ErrorException ($sMessage, (int) $iCode, (int) $iSeverity = 0, $sFilename, (int) $iLineNr );		
		
		self::EXCEPTION ($oErrorException);
	}	
	
	/**
	 * Error handler, passes flow over the exception logger with new ErrorException.
	 * 
     * @param string $sMessage
     * @param int $iCode
     * @param int $iSeverity
     * @param string $sFilename
     * @param int $iLineNr
     * @throws \ReflectionException
     */
	public static function ERROR ($sMessage = '', $iCode = E_ERROR, $iSeverity = 0, $sFilename = '', $iLineNr = 0)
	{	
		$oErrorException = new \ErrorException ($sMessage, (int) $iCode, (int) $iSeverity, $sFilename, (int) $iLineNr );		
		
		self::EXCEPTION ($oErrorException);
	}

	/**
	 * Uncaught exception handler
     * @param $oErrorException
     * @throws \ReflectionException
     */
	public static function EXCEPTION ($oErrorException)
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

		$sMsg.= '(Code: ' . $oErrorException->getCode ()
            . ' / Class: ' . get_class ($oErrorException)
            . '), File: ' . $oErrorException->getFile ()
            . ', Line: ' . $oErrorException->getLine ()
            . ', Message: ' . $oErrorException->getMessage ()
            . ', Trace: ' . $oErrorException->getTraceAsString ();
		self::addERROR (
		    DTArrayObject::create()
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($sMsg))
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('$oException')->set_sValue($oErrorException))
        );
		Log::WRITE ($sMsg, $sLogfile);

		(true === filter_var (Registry::get ('MVC_DEBUG'), FILTER_VALIDATE_BOOLEAN)) ? Helper::DISPLAY (print_r($oErrorException, true)) : false;			
	}

	/**
	 * Checks for a fatal error, work around for set_error_handler not working on fatal errors.
     * @throws \ReflectionException
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
	 * @param DTArrayObject $oDTArrayObject
	 * @return void
	 */
	public static function addERROR (DTArrayObject $oDTArrayObject)
	{
	    // add time
        $oDTArrayObject->add_aKeyValue(DTKeyValue::create()->set_sKey('_sErrorTime')->set_sValue((string) microtime(true)));
		self::$_aError[] = $oDTArrayObject;
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
