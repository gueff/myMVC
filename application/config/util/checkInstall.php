<?php

/**
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * instantiate MyMVCInstaller
 */
$oMyMVCInstaller = new MyMVCInstaller();

/**
 * MyMVCInstaller
 */
class MyMVCInstaller
{

	/**
	 *
	 * @var string
	 * @access private
	 */
	private $_sApplicationDir;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private $_sStagingDir;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private $_sMvcEnv;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private $_sConfigFile;
	
	/**
	 *
	 * @var array
	 * @access private
	 */
	private $_aConfig;
	
	/**
	 *
	 * @var array
	 * @access private
	 */
	private $_aBootstrapperFileInfo;
	
	/**
	 *
	 * @var string
	 * @access private
	 */
	private $_sInstallLock;
	
	/**
	 *
	 * @var boolean
	 * @access private
	 */
	private $_bPreset = false;
	
	/**
	 * Constructor
	 * @access public
	 */
	public function __construct ()
	{
		$this->_sApplicationDir = realpath (__DIR__ . '/../../');
		$this->_sStagingDir = realpath (__DIR__ . '/../') . '/staging/';
		$this->_sStageSample = $this->_sStagingDir . 'develop.sample';
		$this->_sInstallLock = $this->_sApplicationDir . '/INSTALLER_RUNNING.sh';
		$this->_sMvcEnv = getenv ('MVC_ENV');
		$this->_sConfigFile = $this->_sStagingDir . $this->_sMvcEnv . '/config.php';
		
		if (false === file_exists ($this->_sConfigFile))
		{
			$this->_installingSampleConfig ();
		}

		include $this->_sConfigFile;
		$this->_aConfig = $aConfig;

		$this->_setupDirsAndFiles ();
		$this->_setup ();
	}

	/**
	 * @access private
	 * @return boolean
	 */
	private function preset()
	{
		if (true === $this->_bPreset)
		{
			return true;
		}
		
		error_reporting (E_ALL);
		set_time_limit (0);
		ini_set('implicit_flush', 1);		
		('cli' !== php_sapi_name()) ? ob_end_flush () : false;
		ob_implicit_flush ();		
		
		return true;
	}


	/**
	 * 
	 * @access private
	 * @return string
	 */
	private function checkPhpExtension()
	{
		$aMustHave = array(
			'Core',
			'ctype',
			'curl',
			'date',
			'dom',
			'fileinfo',
			'filter',
			'iconv',
			'json',
			'mbstring',
			'Phar',
			'posix',
			'Reflection',
			'session',
			'SimpleXML',
			'standard',
			'SPL',
		);
		
		$aExt = get_loaded_extensions();
		$sMsg = '';
		
		foreach ($aMustHave as $sExt)
		{
			if (!in_array ($sExt, $aExt))
			{
				$sMsg.= '&bull; the requested PHP extension <b>' . $sExt . '</b> is missing from your system.<br />';
			}
		}
		
		if ('' !== $sMsg)
		{
			$sMsg.= '<br />Please install and activate required PHP extensions first.<br />Abort.';
		}
		
		return $sMsg;
	}

	/**
	 * @access private
	 * @return void
	 */
	private function checkFunction()
	{
		$aMustHave = array(
			'mb_strlen',
			'iconv',
			'utf8_decode',
			'posix_isatty',
		);
		
		$sMsg = '';
		
		foreach ($aMustHave as $sExt)
		{
			if (false === function_exists ($sExt))
			{
				$sMsg.= '&bull; the requested PHP function <b>' . $sExt . '</b> is missing from your system.<br />';
			}
		}
		
		if ('' !== $sMsg)
		{
			$sMsg.= '<br />Please install and activate related PHP extensions first.<br />Abort.';
		}
		
		return $sMsg;
	}

	/**
	 * 
	 * @access private
	 * @return void
	 */
	private function _getBootstrapperFileInfo()
	{
		$sFilename = realpath (__DIR__ . '/../../../') . '/public/index.php';
		$aUser = posix_getpwuid(fileowner($sFilename));
		$aGroup = posix_getgrgid(filegroup($sFilename));
		
		return array(
			'aUser' => $aUser,
			'aGroup' => $aGroup,
		);
	}

	/**
	 * 
	 * @access private
	 * @return boolean
	 */
	private function _installingSampleConfig ()
	{
		$this->preset();
		$sMarkup = '<div style="position:absolute;top: 10px; right: 10px;margin: 0 auto;background-color: #F5F5F5; color: black;border: 1px solid silver;padding: 20px;border-radius: 3px;box-shadow: 0px 0px 10px 0px rgba(50,50,50,1);opacity:0.9;font-family:monospace;"><b>&#x2713;</b> Config for Environment "' . $this->_sMvcEnv . '" installed.</div>';
		echo ('cli' === php_sapi_name()) ? strip_tags($sMarkup) . "\n" : $sMarkup;
		$sCmd = 'cp -r ' . $this->_sStageSample . ' ' . $this->_sStagingDir . $this->_sMvcEnv;
		$sResult = shell_exec ($sCmd);
		
		return true;
	}

	/**
	 * 
	 * @access private
	 * @return void
	 */
	private function _setupDirsAndFiles ()
	{
		(!file_exists ($this->_aConfig['MVC_CACHE_DIR'])) ? mkdir ($this->_aConfig['MVC_CACHE_DIR']) : FALSE;
		(!file_exists ($this->_aConfig['MVC_SESSION_PATH'])) ? mkdir ($this->_aConfig['MVC_SESSION_PATH']) : FALSE;
		(!file_exists ($this->_aConfig['MVC_SMARTY_TEMPLATE_CACHE_DIR'])) ? mkdir ($this->_aConfig['MVC_SMARTY_TEMPLATE_CACHE_DIR']) : FALSE;
		(!file_exists ($this->_aConfig['MVC_APPLICATION_CONFIG_EXTEND_DIR'])) ? mkdir ($this->_aConfig['MVC_APPLICATION_CONFIG_EXTEND_DIR']) : FALSE;
		(!file_exists ($this->_aConfig['MVC_LOG_FILE_FOLDER'])) ? mkdir ($this->_aConfig['MVC_LOG_FILE_FOLDER']) : FALSE;
	}

	/**
	 * 
	 * @access private
	 * @return boolean
	 */
	private function _setup ()
	{
		if (
			file_exists ($this->_sApplicationDir . '/vendor') && file_exists ($this->_sApplicationDir . '/composer.lock') && file_exists ($this->_sApplicationDir . '/.composer')
		)
		{
			(file_exists($this->_sInstallLock)) ? unlink($this->_sInstallLock) : false;
			return true;
		}

		$this->preset();		
		$this->_aBootstrapperFileInfo = $this->_getBootstrapperFileInfo();

		$sMarkup = '<!DOCTYPE html><html lang="en">'
		. '<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"><title>myMVC</title><link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"><link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"><link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"><link rel="stylesheet" href="/myMVC/styles/myMVC.css"></head>'
		. '<body><a name="top"></a>'
			. '<div class="container">'
			. '<div class="header"><h3 class="text-muted">myMVC <small>[maɪ ɛm viː siː]</small></h3></div><hr/>'
			. '<div id="jumboHomepage" class="jumbotron">'
			. '<noscript><p>please activate Javascript<br />then run this page again.</p></noscript>'
			. '</div>'
			. '<footer class="footer"><p>&copy; ueffing.net ' . date('Y') . '</p></footer>'
			. '</div>'
			. '<script>function text(sTxt){var sInnerHTML = document.getElementById("jumboHomepage").innerHTML; document.getElementById("jumboHomepage").innerHTML = sInnerHTML + sTxt};function reload(){setTimeout(function(){window.location.reload(1);}, 5000);}</script>'
		. '</body></html>';
		echo ('cli' !== php_sapi_name()) ? $sMarkup : '';
		
		$this->_text('<h1>myMVC</h1><h2>Auto-Installer</h2>');

		// abort if installer is still running
		if (file_exists ($this->_sInstallLock))
		{
			$this->_text('<dd>The Installer seems to be running in the background. Please wait a few minutes before reloading this page.</dd>');
			exit();
		}
		
		// write installer lock file
		touch($this->_sInstallLock);
		
		$sPhpExtensionMissing = $this->checkPhpExtension();		
		if ('' !== $sPhpExtensionMissing)
		{
			$this->_text('<dd>'. trim($sPhpExtensionMissing) . '</dd>');
			exit();
		}		
		
		$sPhpFunctionMissing = $this->checkFunction();		
		if ('' !== $sPhpFunctionMissing)
		{
			$this->_text('<dd>'. trim($sPhpFunctionMissing) . '</dd>');
			exit();
		}		
		
		$this->_text('<dd>&bull; MVC_ENV is: <code>' . $this->_sMvcEnv . '</code></dd>');
		$this->_text('<dd>&bull; User/Group from <code>/public/index.php</code>: <code>' . $this->_aBootstrapperFileInfo['aUser']['name'] . '</code>(' . $this->_aBootstrapperFileInfo['aUser']['uid'] . ') / <code>' . $this->_aBootstrapperFileInfo['aGroup']['name'] . '</code>(' . $this->_aBootstrapperFileInfo['aGroup']['gid'] . ')</dd>');

		// add composer home if missing
		if (false === getenv ('COMPOSER_HOME'))
		{
			putenv ('COMPOSER_HOME=' . $this->_aConfig['MVC_APPLICATION_PATH'] . '/.composer');
		}

		// save runfile
		$sCmd = 'cd ' . $this->_aConfig['MVC_APPLICATION_PATH'] . ';'
			. PHP_BINDIR . '/php ' . $this->_aConfig['MVC_APPLICATION_PATH'] . '/composer.phar self-update;'
			. PHP_BINDIR . '/php ' . $this->_aConfig['MVC_APPLICATION_PATH'] . '/composer.phar install;'
			. 'rm ' . $this->_sInstallLock . ';';
		
		file_put_contents($this->_sInstallLock, "#!/bin/bash\n" . $sCmd);

		$iPid = $this->_runInBackground ('/bin/bash ' . $this->_sInstallLock);		
		$this->_text('<dd>&bull; Installing required libraries via composer in Background with PID <code>' . $iPid . '</code>. Please wait.</dd>');
		$this->_text('<pre>' . $sCmd . '</pre>');

		while ($this->_isProcessRunning ($iPid))
		{
			$this->_flush ();
		}		

		if (array_key_exists ('MVC_COMPOSER_DIR', $this->_aConfig))
		{
			if (file_exists ($this->_aConfig['MVC_COMPOSER_DIR']))
			{
				$this->_text("<dd>installing custom libs defined by custom config</dd>");
				$sCmd = "cd " . $this->_aConfig['MVC_APPLICATION_PATH'] . "; php " . $this->_aConfig['MVC_APPLICATION_PATH'] . "/composer.phar --working-dir=" . $this->_aConfig['MVC_COMPOSER_DIR'] . " install";
				$this->_text('<pre>' . $sCmd . "\n" . '</pre>');
				$iPid = $this->_runInBackground ($sCmd);
				$this->_text('<dd>PID: ' . $iPid . '</dd>');

				while ($this->_isProcessRunning ($iPid))
				{
					$this->_flush ();
				}
			}
		}

		(file_exists($this->_sInstallLock)) ? unlink($this->_sInstallLock) : false;
		
		$this->_text("\n<hr /><dd><b><i class='fa fa-check text-success'></i></b> Installation completed.\n</dd>");
		('cli' !== php_sapi_name()) ? $this->_text("<dd>Page will auto-reload in 5 seconds...</dd>") : '';
		$sMarkup = '<script>reload();</script>';
		echo ('cli' !== php_sapi_name()) ? $sMarkup : '';
		
		exit ();
	}

	/**
	 * 
	 * @param type $sCommand
	 * @access private
	 * @return void
	 */
	private function _runInBackground ($sCommand)
	{
		$iPid = trim (shell_exec ($sCommand . ' > /dev/null 2>/dev/null & echo $!'));
		return $iPid;
	}

	/**
	 * 
	 * @param type $iPid
	 * @access private
	 * @return void
	 */
	private function _isProcessRunning ($iPid)
	{
		exec ('/bin/ps ' . $iPid, $iProcessState);
		return(count ($iProcessState) >= 2);
	}

	/**
	 * 
	 */
	private function _flush ()
	{
		$this->_text("<i class='fa fa-asterisk fa-spin text-primary'></i>");
		
		(ob_get_level() > 0) ? ob_flush() : false;		
		flush ();
		sleep (3);
	}

	/**
	 * 
	 * @param type $sText
	 * @access private
	 * @return void
	 */
	private function _text($sText = '')
	{
		if ('cli' === php_sapi_name())
		{
			$sText = trim(strip_tags($sText));
			echo ('' === $sText) ? "." : html_entity_decode($sText) . "\n";
		}
		else
		{
			echo '<script>text("' . $sText . '");</script>';
		}
	}
}
