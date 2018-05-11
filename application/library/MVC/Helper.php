<?php
/**
 * Helper.php
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
 * Helper
 */
class Helper
{

	/**
	 * Mini OnScreen Debugger shows one bigger window bottom left on screen
	 * 
	 * @access public
	 * @static
	 * @param string|array $mData
	 * @return void
	 */
	public static function DEBUG ($mData = '')
	{
		// source
		$aBacktrace = self::PREPAREBACKTRACEARRAY(debug_backtrace ());
		
		ob_start();
		var_dump($mData);
		$mData = ob_get_contents();
		ob_end_clean();
			
		// output CLI
		if (isset ($GLOBALS['argc']))
		{
			echo "\n---DEBUG-------------------------";
			echo "\nFile:\t\t\t" . $aBacktrace['sFile'] . "";
			echo "\nLine:\t\t\t" . $aBacktrace['sLine'] . "";
			echo "\nClass::function:\t" . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . "\n";
			if (isset ($mData))
			{
				echo "\n" . '$data:' . "\n" . $mData . "\n\n";
			}
			echo "\n---/DEBUG------------------------\n\n";
		}
		// output Web
		else
		{			
			echo '<div class="draggable" style="position: fixed !important; bottom:30px !important;left:5px !important;z-index:1 !important;float:left !important;text-align:left !important;background-color:white !important;border:1px solid gray !important;padding:5px !important;filter: Alpha (opacity=80) !important;opacity: 0.8 !important; moz-opacity: 0.8 !important;-moz-border-radius: 3px !important; border-radius: 3px !important;width: 600px !important;height: 550px !important;">
				<h1 style="color:red !important;margin:0 !important;padding:2px 0 0 0 !important;font-size:16px !important;">DEBUG</h1>
                <div style="overflow-wrap: break-word !important;word-wrap: break-word !important;hyphens: auto !important;">
                    <b>File:</b> ' . $aBacktrace['sFile'] . '<br>
                    <b>Line:</b> ' . $aBacktrace['sLine'] . '<br>
                    <b>Class/Method:</b> ' . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . '<br>
                </div>
				<textarea style="float:left !important;border:1px solid red !important;width:100% !important;min-height:400px !important;z-index:100 !important;font-size:12px !important;-moz-border-radius: 3px !important; border-radius: 3px !important;padding:10px !important;font-family: monospace !important;">' . $mData . '</textarea>
			</div>';
		}
	}

	/**
	 * shows a smaller message on the screen right side.<br />
	 * if you call display more than once, all messages are showed among each other<br />
	 * use it to debug a string or array or whatever
	 * 
	 * @access public
	 * @static
	 * @param mixed $mData
	 * @return void
	 */
	public static function DISPLAY ($mData = '')
	{
		static $sDisplay;
		static $iCount;

		$iCount++;

		// Source
		$aBacktrace = self::PREPAREBACKTRACEARRAY(debug_backtrace ());

		ob_start();
		var_dump($mData);
		$mData = ob_get_contents();
		ob_end_clean();
		
		// Output for CLI
		if (isset ($GLOBALS['argc']))
		{
			echo "\n---DISPLAY-------------------------";
			echo "\nDisplay Count:\t\t" . $iCount . "";
			echo "\nFile:\t\t\t" . $aBacktrace['sFile'] . "";
			echo "\nLine:\t\t\t" . $aBacktrace['sLine'] . "";
			echo "\nClass::function:\t" . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . "\n";
			if (isset ($mData))
			{
				echo "\n" . '$data:' . "\n" . $mData . "\n\n";
			}
			echo "\n---/DISPLAY------------------------\n\n";
		}
		// Output Web
		else
		{
			// show source
            $sConsultation = '<div style="overflow-wrap: break-word !important;word-wrap: break-word !important;hyphens: auto !important;background-color:white !important;color:red !important;font-weight: normal !important;">';
            $sConsultation.= '<span style="color: white; background-color: blue; padding: 2px;">' . $iCount . '</span>';
            (isset ($aBacktrace['sFile'])) ? $sConsultation.= '<b>File:</b> ' . $aBacktrace['sFile'] . '<br>' : '';
            (isset ($aBacktrace['sLine'])) ? $sConsultation.= '<b>Line:</b> ' . $aBacktrace['sLine'] . '<br>' : '';
            (isset ($aBacktrace['sClass']) && isset ($aBacktrace['sFunction'])) ? $sConsultation.= '<b>Class/Method:</b> ' . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . '<br>' : '';
            $sConsultation.= '</div>';            
            
			if (is_array ($mData))
			{
				$sDisplay.= $sConsultation . '<textarea style="font-size:10px;width:100% !important;height:200px !important;margin:0 !important;background-color:blue !important;color:white !important;border: none !important;padding: 5px !important;font-family: monospace !important;">' . $mData . '</textarea>';
			}
			else
			{
				$sDisplay.= $sConsultation . '<div style="font-size:10px;width:100%;padding:2px 0px 10px 0px;margin:0;background-color:blue;color:white;border:none;"><pre style="font-size:12px !important;overflow:auto !important;max-height:300px !important;background-color:transparent !important;color:#fff !important;border: none !important;padding: 5px !important;font-family: monospace !important;">' . $mData . '</pre></div>';
			}

			// Display
			echo '<div class="draggable" style="overflow:auto;z-index:10000 !important;position:fixed !important;bottom:10px !important;right:10px !important;background-color:blue !important;color:white !important;border:1px solid #333 !important;width:500px !important;overflow:y-scroll !important;-moz-border-radius:3px !important; border-radius: 3px !important;font-size:12px !important;font-family: monospace !important;"><b>';
			echo $sDisplay;
			echo '</b></div>';
		}
	}

	/**
	 * Stops any further execution: exits the script.<br />
	 * Shows a Message from where the STOP command was called (default).
	 * 
	 * @access public
	 * @static
	 * @staticvar type $iCount
	 * @param string $sData
	 * @param boolean $bOccurrence show occurrence of STOP true|FALSE
	 * @return void
	 */
	public static function STOP ($sData = '', $bOccurrence = true)
	{
		static $iCount;
		$iCount++;

		// source
		$aBacktrace = self::PREPAREBACKTRACEARRAY(debug_backtrace ());

		ob_start();
		var_dump($sData);
		$mData = ob_get_contents();
		ob_end_clean();
		
		// output CLI
		if (isset ($GLOBALS['argc']))
		{
			$sConsultation = "\n---STOP-------------------------";
			$sConsultation.= "\nStopped at:";
			$sConsultation.= "\nFile:\t\t\t" . $aBacktrace['sFile'] . "";
			$sConsultation.= "\nLine:\t\t\t" . $aBacktrace['sLine'] . "";
			$sConsultation.= "\nClass::function:\t" . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . "\n";

			echo ($bOccurrence === true) ? $sConsultation : '';

			if (isset ($sData) && !empty ($sData))
			{
				echo ($bOccurrence === true) ? "\nData:\n" : '';
				echo $mData . "\n";
			}
			echo "\n---/STOP------------------------\n\n";
		}
		// output Web
		else
		{
			// show source
            $sConsultation = '<div style="overflow-wrap: break-word !important;word-wrap: break-word !important;hyphens: auto !important;background-color:white !important;color:red !important;font-weight: normal !important;">';
            (isset ($aBacktrace['sFile'])) ? $sConsultation.= '<b>File:</b> ' . $aBacktrace['sFile'] . '<br>' : '';
            (isset ($aBacktrace['sLine'])) ? $sConsultation.= '<b>Line:</b> ' . $aBacktrace['sLine'] . '<br>' : '';
            (isset ($aBacktrace['sClass']) && isset ($aBacktrace['sFunction'])) ? $sConsultation.= '<b>Class/Method:</b> ' . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . '<br>' : '';
            $sConsultation.= '</div>';  
            
			// display
			echo '<div class="draggable" style="padding:10px !important;z-index:10000 !important;position:fixed !important;top:10px !important;left:10px !important;background-color:red !important;color:white !important;border:1px solid #333 !important;width:400px !important;height:auto !important;overflow:auto !important;-moz-border-radius: 3px !important; border-radius: 3px !important;"><b>';
			echo ($bOccurrence === true) ? '<h1 style="font-size:20px !important;">STOP</h1><p>Stopped at:</p>' . $sConsultation : '';

			if (isset ($sData) && !empty ($sData))
			{
				echo ($bOccurrence === true) ? '<h2>Data</h2><p>' : '';
				echo '<pre style="font-size:10px;overflow:auto !important;max-height:300px !important;background-color:transparent !important;color:#fff !important;border: none !important;">' . $mData . '</pre></p>';
			}
			echo '</b></div>';
		}

		Event::RUN ('mvc.helper.stop', $aBacktrace);
		exit ();
	}

	/**
	 * Writes a Message into Logfile 
	 * 
	 * @access public
	 * @static
	 * @param String $sMessage Meldung
	 * @param String $sLogfile OPTIONAL Logfilename.<br />
	 * It is going to be created if it does not exist<br />
	 * it will be in the same logdir of the default logfile
	 * 
	 * @deprecated since version 14.<br />
	 * Will be removed in future versions<br />
	 * Use instead: \MVC\Log::WRITE($sMessage, $sLogfile);
	 * @return void
	 */
	public static function LOG ($sMessage = '', $sLogfile = '')
	{		
		$aDebug = self::PREPAREBACKTRACEARRAY (debug_backtrace ());
		Log::WRITE(
			"DEPRECATED: " . __METHOD__
			. "\tReplaced by:\t" 
			. '\MVC\Log::WRITE($sMessage, $sLogfile); --> called in: ' .  $aDebug['sFile'] . ', ' . $aDebug['sLine'] 
			, 'notice.log'
		);
		
		// Replaced by:
		Log::WRITE($sMessage, $sLogfile);
	}

	/**
	 * checks wether the unknown parameter is a closure object
	 * 
	 * @access public
	 * @static
	 * @param mixed $mUnknown
	 * @return boolean
	 */
	public static function ISCLOSURE ($mUnknown)
	{
		return is_object ($mUnknown) && ($mUnknown instanceof \Closure);
	}

	/**
	 * Dumps a Closure
	 * taken from http://www.metashock.de/2013/05/dump-source-code-of-closure-in-php/
	 * 
	 * @access public
	 * @static
	 * @param mixed $mClosure name of function or Closure
	 * @return string
	 */
	public static function CLOSUREDUMP ($mClosure)
	{		
		$oReflectionFunction = new \ReflectionFunction ($mClosure);
		$aParam = array ();

		foreach ($oReflectionFunction->getParameters () as $mValue)
		{
			$sTemp = '';

			if ($mValue->isArray ())
			{
				$sTemp .= 'array ';
			}
			else if ($mValue->getClass ())
			{
				$sTemp .= $mValue->getClass ()->name . ' ';
			}

			if ($mValue->isPassedByReference ())
			{
				$sTemp .= '&';
			}

			$sTemp .= '$' . $mValue->name;

			if ($mValue->isOptional ())
			{
				$sTemp .= ' = ' . var_export ($mValue->getDefaultValue (), true);
			}

			$aParam [] = $sTemp;
		}

		$sString = 'function (' . implode (', ', $aParam) . '){' . PHP_EOL;
		$aLine = file ($oReflectionFunction->getFileName ());

		for ($iCount = $oReflectionFunction->getStartLine (); $iCount < $oReflectionFunction->getEndLine (); $iCount++)
		{
			$sString .= $aLine[$iCount];
		}

		return $sString;
	}

	/**
	 * gets the uri protocol
	 *
	 * @access public
	 * @static
	 * @param mixed $mSsl
	 * @return string http:// | https://
	 */
	public static function GETURIPROTOCOL ($mSsl = NULL)
	{
		// detect on ssl or not
		if (isset ($mSsl))
		{
			// http
			if ((int) $mSsl === 0 || $mSsl == FALSE)
			{
				return 'http://';
			}
			// https
			elseif ((int) $mSsl === 1 || $mSsl == true)
			{
				return 'https://';
			}
		}
		// autodetect
		else
		{
			// http
			if (self::DETECTSSL () === FALSE)
			{
				return 'http://';
			}
			// http
			elseif (self::DETECTSSL () === true)
			{
				return 'https://';
			}
		}

		\MVC\Event::RUN('mvc.error', 'could not detect protocol of requested page.');
		
		return NULL;
	}

	/**
	 * check page is running in ssl mode
	 * 
	 * @access public
	 * @static
	 * @return boolean 
	 */
	public static function DETECTSSL ()
	{
		if (Registry::isRegistered ('MVC_SECURE_REQUEST'))
		{
			return Registry::get('MVC_SECURE_REQUEST');
		}
		
		return (array_key_exists('HTTPS', $_SERVER) && strtolower($_SERVER['HTTPS']) !== 'off') || Registry::isRegistered ('MVC_SSL_PORT') && $_SERVER['SERVER_PORT'] == Registry::get('MVC_SSL_PORT');

		return FALSE;
	}

	/**
	 * get infos about a file via stat
	 * 
	 * @access public
	 * @static
	 * @param string $sFile file
	 * @param string $sKey (optional) if $sKey is given, only this info wil be returned
	 * @return array
	 */
	public static function GETFILEINFO ($sFile = NULL, $sKey = NULL)
	{
		if (!isset($sFile) || !isset($sKey))
		{
			return array();
		}
		
		$aStat = stat ($sFile);
		$aInfo = posix_getpwuid ($aStat['uid']);

		if (!empty ($sKey))
		{
			if (array_key_exists($sKey, $aInfo))
			{
				return $aInfo[$sKey];
			}
		}

		return $aInfo;
	}

	/**
	 * makes sure the requested page will be delivered with the correct protocol (http|https)
	 * 
	 * @access public
	 * @static
	 * @deprecated will be removed in future versions. use instead: \MVC\Request::ENSURECORRECTPROTOCOL();
	 * @return void
	 */
	public static function ENSURECORRECTPROTOCOL ()
	{
		$aDebug = self::PREPAREBACKTRACEARRAY (debug_backtrace ());
		Log::WRITE(
			"DEPRECATED: " . __METHOD__
			. "\tReplaced by:\t" 
			. '\MVC\Request::ENSURECORRECTPROTOCOL(); --> called in: ' .  $aDebug['sFile'] . ', ' . $aDebug['sLine']
			, 'notice.log'
		);
		
		// Replaced by:
		Request::ENSURECORRECTPROTOCOL();
	}
	
	/**
	 * prepares backtrace array for output
	 * 
	 * @access public
	 * @static
	 * @param array $aBacktrace
	 * @return array
	 */
	public static function PREPAREBACKTRACEARRAY(array $aBacktrace = array())
	{
		$aData = array();
		$aData['sFile'] = (isset($aBacktrace[0]['file'])) ?  $aBacktrace[0]['file'] : '';
		$aData['sLine'] = (isset($aBacktrace[0]['line'])) ? $aBacktrace[0]['line'] : '';
		$aData['sClass'] = (isset($aBacktrace[1]['class'])) ? $aBacktrace[1]['class'] : '';
		$aData['sFunction'] = (isset($aBacktrace[1]['function'])) ? $aBacktrace[1]['function'] : '';
		
		return $aData;
	}
}
