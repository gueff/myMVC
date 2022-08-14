<?php
/**
 * Log.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

/**
 * Log
 */
class Log
{
	/**
	 * counter
	 * @var integer
	 */
	public static $iCount = 0;

	/**
	 * prepares debug output string
     * @param array $aBacktrace
     * @return string
     * @throws \ReflectionException
     */
	public static function prepareDebug (array $aBacktrace = array ())
	{
        $aData = Debug::prepareBacktraceArray($aBacktrace);

        if (substr($aData['sFile'], 0, strlen(Config::get_MVC_BASE_PATH())) === Config::get_MVC_BASE_PATH())
        {
            $aData['sFile'] = substr($aData['sFile'], strlen(Config::get_MVC_BASE_PATH()));
        }

		$sDebug = $aData['sFile'] . ', ' . $aData['sLine'];

		return $sDebug;
	}

	/**
	 * prepares logfile
     * @param $sLogfile
     * @return mixed|string
     * @throws \ReflectionException
     */
	public static function prepareLogfile ($sLogfile = '')
	{
		// make sure it is a logfile inside the configured log directory
		($sLogfile === '')
            ? $sLogfile = self::getLogFileDefault()
            : ($sLogfile = pathinfo (self::getLogFileDefault(), PATHINFO_DIRNAME) . '/' . basename ($sLogfile));

		if (!file_exists ($sLogfile))
		{
            touch($sLogfile);

			if (!file_exists ($sLogfile))
			{
				Error::addERROR('cannot create logfile: ' . $sLogfile);
			}
		}

		return $sLogfile;
	}

	/**
	 * prepares message 
	 * @param string $sMessage
	 * @param string $sDebug
	 * @return string $sMessage
	 */
	public static function prepareMessage ($sMessage = '', $sDebug = '')
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
			. "\t" . (('' !== session_id ()) ? session_id () : str_pad ('...........no session', 32, '.'))
			. "\t" . self::$iCount
			. "\t" . print_r ($sDebug, true)
			. "\t" . $sMessage
			. "\n";

		return $sMessage;
	}

	/**
	 * Writes a Message into Logfile 
     * @param $mMessage
     * @param $sLogfile OPTIONAL Logfilename. It is going to be created if it does not exist, it will be in the same logdir of the default logfile
     * @return void
     * @throws \ReflectionException
     */
	public static function write ($mMessage, $sLogfile = '')
	{
		file_put_contents (
			self::prepareLogfile($sLogfile),
			self::prepareMessage(
				$mMessage, 
				self::prepareDebug(debug_backtrace())
			), 
			FILE_APPEND
		);        		
	}

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function getLogFileDefault()
    {
        $sLogFileDefault = Config::get_MVC_LOG_FILE_DEFAULT();

        if (false === file_exists($sLogFileDefault))
        {
            $sLogFileDefault = realpath(__DIR__ . '/../../') . '/log/default.log';
        }

        return $sLogFileDefault;
    }
}