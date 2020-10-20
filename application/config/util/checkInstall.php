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
$oMyMVCInstaller = new MyMVCInstaller($aConfig);

/**
 * MyMVCInstaller
 */
class MyMVCInstaller
{
    /**
     * @var array
     */
    protected $aConfig;

    /**
     * @var
     */
	protected $aBootstrapperFileInfo;

    /**
     * @var bool
     */
	protected static $bOutputStarted = false;

	/**
	 * Constructor
	 * @access public
	 */ 
	public function __construct (array $aConfig = array())
	{
        $this->aConfig = $aConfig;
		$this->setupDirsAndFiles();
		$this->checkForPHPExtensions();

        if (true === $this->installMainLibraries() || true === $this->installModuleLibraries() || true === $this->checkOnModulesInstalled())
        {
            $this->_text("\n<hr /><dd><b><i class='fa fa-check text-success'></i></b> Installation completed.\n</dd>");
            ('cli' !== php_sapi_name()) ? $this->_text("<dd>Page will auto-reload in 5 seconds...</dd>") : '';
            $sMarkup = '<script>reload();</script>';
            echo ('cli' !== php_sapi_name()) ? $sMarkup : '';
            exit();
        }
	}

    /**
     *
     */
	protected function checkOnModulesInstalled()
    {
        $aModule = glob($this->aConfig['MVC_MODULES'] . '/*', GLOB_ONLYDIR);

        if (empty($aModule))
        {
            $this->prepareForOutput();
            $this->_text("\n<br><span class='text-info'><b>🛈</b> You need to install a Module to work on.</span>");
            $this->_text("\n<br>Open a console and enter:");
            $this->_text("\n<hr><kbd>cd " . $this->aConfig['MVC_BASE_PATH'] . "; " . PHP_BINDIR . "/php myMVC.phar</kbd>");

            if ('cli' !== php_sapi_name())
            {
                exit();
            }
        }
    }

    /**
     * @return bool
     */
	protected function flushOutput()
	{
		error_reporting (E_ALL);
		set_time_limit (0);
		ini_set('implicit_flush', 1);		
		('cli' !== php_sapi_name()) ? ob_end_flush () : false;
		ob_implicit_flush ();		
		
		return true;
	}

    /**
     * @return string
     */
	protected function checkPhpExtension()
	{
		$aExt = get_loaded_extensions();
		$aExtMissing = array();
		$sMsg = '';

		foreach ($this->aConfig['MVC_CORE']['phpExtensionsRequired'] as $sExt)
		{
			if (!in_array ($sExt, $aExt))
			{
				$aExtMissing[] = $sExt;
			}
		}
		
		if (false === empty($aExtMissing))
		{
			$sMsg = "\nPHP extensions are missing on your system: \n";
            $sMsg.= '<ul>';

			foreach ($aExtMissing as $sMissing)
            {
                $sMsg.= '<li>' . $sMissing . "</li>\n";
            }

			$sMsg.='</ul>' . "\n";
            $sMsg.= "Required Extensions: \n";
            $sMsg.= implode(', ', $this->aConfig['MVC_CORE']['phpExtensionsRequired']);
		}
		
		return $sMsg;
	}

    /**
     * @return string
     */
	protected function checkFunction()
	{
        $aFuncMissing = array();
        $sMsg = '';

        foreach ($this->aConfig['MVC_CORE']['phpFunctionsRequired'] as $sExt)
        {
            if (false === function_exists ($sExt))
            {
                $aFuncMissing[] = $sExt;
            }
        }

        if (false === empty($aFuncMissing))
        {
            $sMsg = "\nPHP functions are missing on your system: \n";
            $sMsg.= '<ul>';

            foreach ($aFuncMissing as $sMissing)
            {
                $sMsg.= '<li>' . $sMissing . "</li>\n";
            }

            $sMsg.='</ul>' . "\n";
            $sMsg.= "Required Extensions: \n";
            $sMsg.= implode(', ', $this->aConfig['MVC_CORE']['phpExtensionsRequired']);
        }

        return $sMsg;
	}

    /**
     * @return array
     */
	protected function getBootstrapperFileInfo()
	{
		$sFilename = $this->aConfig['MVC_PUBLIC_PATH'] . '/index.php';
		$aUser = posix_getpwuid(fileowner($sFilename));
		$aGroup = posix_getgrgid(filegroup($sFilename));
		
		return array(
			'aUser' => $aUser,
			'aGroup' => $aGroup,
		);
	}

    /**
     * @return bool
     */
	protected function setupDirsAndFiles ()
	{
		(!file_exists ($this->aConfig['MVC_CACHE_DIR'])) ? mkdir ($this->aConfig['MVC_CACHE_DIR']) : FALSE;
		(!file_exists ($this->aConfig['MVC_SESSION_PATH'])) ? mkdir ($this->aConfig['MVC_SESSION_PATH']) : FALSE;
		(!file_exists ($this->aConfig['MVC_SMARTY_TEMPLATE_CACHE_DIR'])) ? mkdir ($this->aConfig['MVC_SMARTY_TEMPLATE_CACHE_DIR']) : FALSE;
		(!file_exists ($this->aConfig['MVC_CONFIG_DIR'])) ? mkdir ($this->aConfig['MVC_CONFIG_DIR']) : FALSE;
		(!file_exists ($this->aConfig['MVC_LOG_FILE_FOLDER'])) ? mkdir ($this->aConfig['MVC_LOG_FILE_FOLDER']) : FALSE;

		if (!file_exists ($this->aConfig['MVC_PUBLIC_PATH'] . '/.env'))
        {
            $sMsg = "# auto generated at " . date('Y-m-d H:i:s') . "\n";
            $sMsg.= "MVC_ENV=" . $this->aConfig['MVC_ENV'];

            return (boolean) file_put_contents(
                $this->aConfig['MVC_PUBLIC_PATH'] . '/.env',
                $sMsg
            );
        }

		return false;
    }

    protected function placeMarkup()
    {
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
    }

    /**
     * @param string $sInstallLock
     * @return bool
     */
    protected function writeInstallLock($sInstallLock = '')
    {
        if ('' !== $sInstallLock && false === file_exists($sInstallLock))
        {
            return touch($sInstallLock);
        }

        return false;
    }

    /**
     * @param string $sInstallLock
     * @return bool
     */
    protected function removeInstallLock($sInstallLock = '')
    {
        if ('' !== $sInstallLock && file_exists($sInstallLock))
        {
            return unlink($sInstallLock);
        }

        return false;
    }

    protected function checkForPHPExtensions()
    {
        $sPhpExtensionMissing = $this->checkPhpExtension();
        $sPhpFunctionMissing = $this->checkFunction();

        if ('' !== $sPhpExtensionMissing)
        {
            $this->placeMarkup();
            $this->_text('<h2>setup checking</h2>');
            $this->_text($sPhpExtensionMissing);
            exit();
        }

        if ('' !== $sPhpFunctionMissing)
        {
            $this->placeMarkup();
            $this->_text('<h2>setup checking</h2>');
            $this->_text($sPhpFunctionMissing);
            exit();
        }
    }

    protected function prepareForOutput($sInstallLock = '')
    {
        if (false === self::$bOutputStarted)
        {
            $this->placeMarkup();
            $this->flushOutput();
            $this->aBootstrapperFileInfo = $this->getBootstrapperFileInfo();
            $this->_text('<h2>setup checking</h2>');

            if ('' !== $sInstallLock)
            {
                // abort if installer is still running
                if (file_exists ($sInstallLock))
                {
                    $this->_text('<dd>The Installer seems to be running in the background. Please wait a few minutes before reloading this page.</dd>');
                    exit();
                }

                // write installer lock file
                $this->writeInstallLock($sInstallLock);
            }

            $this->_text('<dd>&bull; MVC_ENV is: <code>' . $this->aConfig['MVC_ENV'] . '</code></dd>');
            $this->_text('<dd>&bull; User/Group from <code>/public/index.php</code>: <code>'
                . $this->aBootstrapperFileInfo['aUser']['name']
                . '</code>(' . $this->aBootstrapperFileInfo['aUser']['uid'] . ') / <code>'
                . $this->aBootstrapperFileInfo['aGroup']['name']
                . '</code>(' . $this->aBootstrapperFileInfo['aGroup']['gid'] . ')</dd>');

            // add composer home if missing
            if (false === getenv ('COMPOSER_HOME'))
            {
                putenv ('COMPOSER_HOME=' . $this->aConfig['MVC_APPLICATION_PATH'] . '/.composer');
            }

            self::$bOutputStarted = true;
        }
    }

    /**
     * @return bool
     */
	protected function installMainLibraries()
	{
        $sInstallLock = $this->aConfig['MVC_APPLICATION_PATH'] . '/INSTALLER_RUNNING.sh';

		if (
            file_exists ($this->aConfig['MVC_APPLICATION_PATH'] . '/.composer') &&
            file_exists ($this->aConfig['MVC_APPLICATION_PATH'] . '/composer.json') &&
            file_exists ($this->aConfig['MVC_APPLICATION_PATH'] . '/composer.lock') &&
		    file_exists ($this->aConfig['MVC_APPLICATION_PATH'] . '/vendor')
        )
		{
			$this->removeInstallLock($sInstallLock);
			return false;
		}

        $aComposerJson = json_decode(file_get_contents($this->aConfig['MVC_APPLICATION_PATH'] . '/composer.json'), true);

        if (empty($aComposerJson))
        {
            return false;
        }

        $this->prepareForOutput($sInstallLock);

        // save runfile
        $sCmd = 'cd ' . $this->aConfig['MVC_APPLICATION_PATH'] . '; '
            . PHP_BINDIR . '/php ' . $this->aConfig['MVC_APPLICATION_PATH'] . '/composer.phar self-update; '
            . PHP_BINDIR . '/php ' . $this->aConfig['MVC_APPLICATION_PATH'] . '/composer.phar install --prefer-dist; '
            . 'rm ' . $sInstallLock . ';';

        file_put_contents($sInstallLock, "#!/bin/bash\n" . $sCmd);
        $iPid = $this->_runInBackground ('/bin/bash ' . $sInstallLock);
        $this->_text('<dd>&bull; Installing required <kbd>Main Application libraries</kbd> via composer in Background with PID <code>' . $iPid . '</code>. Please wait.</dd>');

        while ($this->_isProcessRunning ($iPid))
        {
            $this->_flush ();
        }

        $this->removeInstallLock($sInstallLock);

        return true;
	}

    /**
     * @return bool
     */
    protected function installModuleLibraries()
    {
        if (false === isset($this->aConfig['MVC_COMPOSER_DIR']) || false == file_exists($this->aConfig['MVC_COMPOSER_DIR'] . '/composer.json'))
        {
            return false;
        }

        $sInstallLock = $this->aConfig['MVC_COMPOSER_DIR'] . '/INSTALLER_RUNNING.sh';

        if (
            file_exists($this->aConfig['MVC_COMPOSER_DIR'] . '/composer.json') &&
            file_exists ($this->aConfig['MVC_COMPOSER_DIR'] . '/composer.lock') &&
            file_exists($this->aConfig['MVC_COMPOSER_DIR'] . '/vendor')
        )
        {
            $this->removeInstallLock($sInstallLock);
            return false;
        }

        $aComposerJson = json_decode(file_get_contents($this->aConfig['MVC_COMPOSER_DIR'] . '/composer.json'), true);

        if (empty($aComposerJson))
        {
            return false;
        }

        $this->prepareForOutput($sInstallLock);

        // save runfile
        $sCmd = 'cd ' . $this->aConfig['MVC_COMPOSER_DIR'] . '; '
            . PHP_BINDIR . '/php ' . $this->aConfig['MVC_APPLICATION_PATH'] . '/composer.phar self-update; '
            . PHP_BINDIR . '/php ' . $this->aConfig['MVC_APPLICATION_PATH'] . '/composer.phar --working-dir="' . $this->aConfig['MVC_COMPOSER_DIR'] . '" install --prefer-dist; '
            . 'rm ' . $sInstallLock . ';';

        file_put_contents($sInstallLock, "#!/bin/bash\n" . $sCmd);
        $iPid = $this->_runInBackground ('/bin/bash ' . $sInstallLock);
        $this->_text('<dd>&bull; Installing required <kbd>Module libraries</kbd> via composer in Background with PID <code>' . $iPid . '</code>. Please wait.</dd>');

        while ($this->_isProcessRunning ($iPid))
        {
            $this->_flush ();
        }

        $this->removeInstallLock($sInstallLock);

        return true;
    }

    /**
     * @param $sCommand
     * @return string
     */
	protected function _runInBackground ($sCommand)
	{
		$iPid = trim (shell_exec ($sCommand . ' > /dev/null 2>/dev/null & echo $!'));

		return $iPid;
	}

    /**
     * @param $iPid
     * @return bool
     */
	protected function _isProcessRunning ($iPid = 0)
	{
	    if (0 === $iPid)
        {
            return false;
        }

		exec ('/bin/ps ' . $iPid, $iProcessState);
        $bIsRunning = (count ($iProcessState) >= 2);

		return $bIsRunning;
	}

	protected function _flush ()
	{
		$this->_text("<i class='fa fa-asterisk fa-spin text-primary'></i>");
		
		(ob_get_level() > 0) ? ob_flush() : false;		
		flush ();
		sleep (3);
	}

    /**
     * @param string $sText
     */
	protected function _text($sText = '')
	{
		if ('cli' === php_sapi_name())
		{
			$sText = trim(strip_tags($sText));
			echo ('' === $sText) ? "." : html_entity_decode($sText) . "\n";
		}
		else
		{
            echo '<script>text("' . str_replace("\n", '<br>', trim($sText)) . '");</script>';
		}
	}
}
