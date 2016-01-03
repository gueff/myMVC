<?php
/**
 * Log.php
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
 * Log
 */
class Log
{

	/**
	 * counter
	 * 
	 * @var integer
	 * @access public
	 * @static
	 */
	public static $iCount = 0;

	/**
	 * prepares debug output string
	 * 
	 * @access public
	 * @static
	 * @param array $aBacktrace
	 * @return string $sDebug
	 */
	public static function PREPARE_DEBUG (array $aBacktrace = array ())
	{
		$sDebug = '';
		(isset ($aBacktrace[0]['file'])) ? $sDebug.= $aBacktrace[0]['file'] : FALSE;
		(isset ($aBacktrace[0]['line'])) ? $sDebug.= ', ' . $aBacktrace[0]['line'] : FALSE;
		(isset ($aBacktrace[0]['class'])) ? $sDebug.= ' > ' : FALSE;

		return $sDebug;
	}

	/**
	 * prepares logfile
	 * 
	 * @access public
	 * @static
	 * @param string $sLogfile
	 * @return string $sLogfile
	 */
	public static function PREPARE_LOGFILE ($sLogfile = '')
	{
		// make sure it is a logfile inside the configured log directory
		($sLogfile === '') ? $sLogfile = Registry::get ('MVC_LOG_FILE_DEFAULT') : ($sLogfile = pathinfo (Registry::get ('MVC_LOG_FILE_DEFAULT'), PATHINFO_DIRNAME) . '/' . basename ($sLogfile));

		if (!file_exists ($sLogfile))
		{
			shell_exec ('touch ' . $sLogfile);

			if (!file_exists ($sLogfile))
			{
				//@todo ERROR
			}
		}

		return $sLogfile;
	}

	/**
	 * prepares message 
	 * 
	 * @access public
	 * @static
	 * @param string $sMessage
	 * @param string $sDebug
	 * @return string $sMessage
	 */
	public static function PREPARE_MESSAGE ($sMessage = '', $sDebug = '')
	{
		if (is_array ($sMessage))
		{
			$sMessage = print_r ($sMessage, true);
		}

		if (is_object ($sMessage))
		{
			ob_start ();
			var_dump ($sMessage);
			$sMessage = ob_get_contents ();
			ob_end_clean ();
		}

		$sMessage = strip_tags ($sMessage);

		// count 1 up
		self::$iCount++;

		$sMessage = ''
            . date ("Y-m-d H:i:s")
			. "\t" . ((false !== getenv('MVC_ENV')) ? getenv('MVC_ENV') : '---?---')
			. "\t" . ((array_key_exists('REMOTE_ADDR', $_SERVER)) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1')
			. "\t" . ((array_key_exists('MVC_UNIQUE_ID', $GLOBALS['aConfig'])) ? $GLOBALS['aConfig']['MVC_UNIQUE_ID'] : '---')
			. "\t" . (('' !== session_id ()) ? session_id () : str_pad ('...no session', 26, '.'))
			. "\t" . self::$iCount
			. "\t" . print_r ($sDebug, true)
			. "\t" . $sMessage
			. "\n";

		return $sMessage;
	}

	/**
	 * Writes a Message into Logfile 
	 * 
	 * @access public
	 * @static
	 * @param mixed $mMessage
	 * @param String $sLogfile OPTIONAL Logfilename.<br />
	 * It is going to be created if it does not exist<br />
	 * it will be in the same logdir of the default logfile
	 * @return void
	 */
	public static function WRITE ($mMessage, $sLogfile = '')
	{
		file_put_contents (
			self::PREPARE_LOGFILE($sLogfile), 
			self::PREPARE_MESSAGE(
				$mMessage, 
				self::PREPARE_DEBUG(debug_backtrace())
			), 
			FILE_APPEND
		);        		
	}

}
