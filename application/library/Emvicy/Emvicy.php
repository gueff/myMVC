<?php

namespace Emvicy;

use MVC\Config;

/**
 * @param $iAmount
 * @return void
 */
function nl($iAmount = 1)
{
    echo str_repeat("\n", $iAmount);
}

/**
 * @param $sString
 * @return void
 */
function hr($sString = '-')
{
    nl();
    echo str_repeat($sString, 80);
    nl();
}
#------------------------------------

class Emvicy
{
    /**
     * @return void
     */
    public static function init()
    {
        self::argToGet();
        $sCmd1 = current(array_keys($_GET));

        if (method_exists('\Emvicy\Emvicy', $sCmd1))
        {
            self::$sCmd1();
            exit();
        }

        self::help();
    }

    /**
     * @param $sCmd
     * @param $bEcho
     * @return string
     */
    public static function shellExecute($sCmd = '', $bEcho = false)
    {
        if (true === $bEcho)
        {
            echo $sCmd;
            nl();
        }

        $sResult = trim((string) shell_exec($sCmd));

        if (true === $bEcho)
        {
            echo $sResult;
            nl();
        }

        return $sResult;
    }

    /**
     * @return void
     */
    protected static function argToGet()
    {
        parse_str(
            implode(
                '&',
                array_slice($GLOBALS['argv'], 1)
            ),
            $_GET
        );
    }

    /**
     * @required /bin/bash
     * @param string $sWhereIsItem
     * @return string abs path to program
     */
    public static function whereis(string $sWhereIsItem = '')
    {
        ob_start();
        system('/bin/bash -c "type -p ' . escapeshellarg(trim($sWhereIsItem)) . '"', $iCode);
        $mResult = ob_get_contents();
        $sResult = trim(((false === $mResult) ? '' : $mResult));
        ob_end_clean();

        if (true === empty($sResult))
        {
            echo 'program `' . $sWhereIsItem . '` not found. Abort.';
            nl(2);
            exit();
        }

        return $sResult;
    }

    /**
     * @return void
     */
    public static function help()
    {
        $sHelpFile = realpath(__DIR__) . '/doc/help.txt';
        echo file_get_contents($sHelpFile);
    }

    /**
     * @return bool
     */
    public static function get_force()
    {
        $sForce = substr(strtolower(get($_GET['force'], '')), 0, 1);

        if (true === in_array($sForce, array('1','y','j')))
        {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function get_primary()
    {
        $sPrimary = substr(strtolower(get($_GET['primary'], 'yes')), 0, 1);

        if (true === in_array($sPrimary, array('0','n')))
        {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public static function get_module()
    {
        $sModule = get($_GET['module'], '');
        $sModule = ucfirst(strtolower(preg_replace("/[^[:alpha:]]/ui", '', $sModule)));

        return $sModule;
    }

    /**
     * @param int $iLength
     * @return string
     */
    public static function get_stdin(int $iLength = 10)
    {
        return trim(fread(STDIN, $iLength));
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function clearcache()
    {
        $sDir = Config::get_MVC_CACHE_DIR() . '/*';
        array_map('unlink', array_filter((array) glob($sDir)));
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function cc()
    {
        self::clearcache();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function clearlog()
    {
        $sDir = Config::get_MVC_LOG_FILE_FOLDER() . '*';
        array_map('unlink', array_filter((array) glob($sDir)));
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function cl()
    {
        self::clearlog();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function clearsession()
    {
        $sDir = Config::get_MVC_SESSION_PATH() . '/*';
        array_map('unlink', array_filter((array) glob($sDir)));
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function cs()
    {
        self::clearsession();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function cleartemp()
    {
        $sDir = Config::get_MVC_SMARTY_TEMPLATE_CACHE_DIR(). '/*';
        array_map('unlink', array_filter((array) glob($sDir)));
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function ct()
    {
        self::cleartemp();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function clearall()
    {
        self::clearcache();
        self::clearlog();
        self::clearsession();
        self::cleartemp();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function ca()
    {
        self::clearall();
    }

    /**
     * @return false|void
     */
    public static function create()
    {
        $bForce = self::get_force();
        $sModule = self::get_module();
        $bPrimary = self::get_primary();

        if (true === empty($sModule))
        {
            return false;
        }

        echo 'Modulename: ' . $sModule;
        nl();
        echo 'primary: ' . $bPrimary;
        nl();

        if (false === $bForce)
        {
            echo "accept: (y)/n";
            nl();
            $sStdin = strtolower(self::get_stdin(1));

            echo 'Eingabe: ' . $sStdin;
            nl();

            if ($sStdin !== '' && $sStdin !== 'y')
            {
                echo 'abort.';
                nl();
                return false;
            }
        }

        echo 'creating...';
        nl();

        $oInstall = \Emvicy\Install::run(
            $sModule,
            $GLOBALS['aConfig'],
            $bPrimary
        );
    }

    /**
     * @return void
     */
    public static function c()
    {
        self::create();
    }

    /**
     * php emvicy.php serve
     * @return void
     * @throws \ReflectionException
     */
    public static function serve()
    {
        $sCmd="export MVC_ENV='" . getenv('MVC_ENV') . "'; "
              . PHP_BINARY . " -S 127.0.0.1:1969 -t " . \MVC\Config::get_MVC_WEB_ROOT() . '/public/';
        echo $sCmd;
        hr();
        self::shellExecute($sCmd, true);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function s()
    {
        self::serve();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function lint()
    {
        $sCmd = self::whereis('find') . ' ' . \MVC\Config::get_MVC_BASE_PATH() . ' -type f -name "*.php" '
            . ' -exec ' . PHP_BINARY . ' -l {} \; 2>&1 '
            . '| (! ' . self::whereis('grep') . ' -v "errors detected")';
        $sResult = self::shellExecute($sCmd, false);
        $aMessage = preg_split("@\n@", $sResult, -1, PREG_SPLIT_NO_EMPTY);

        if (true === empty(get($sResult, '')))
        {
            self::response(true);
        }
        else
        {
            self::response(false, $aMessage);
        }
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function l()
    {
        self::lint();
    }

    /**
     * @param bool   $bSuccess
     * @param array  $aMessage
     * @return void
     */
    public static function response(bool $bSuccess = false, array $aMessage = array())
    {
        $aResponse = array(
            'bSuccess' => $bSuccess,
            'aMessage' => $aMessage,
        );

        echo json_encode($aResponse);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function update()
    {
        // update framework
        $xGit = self::whereis('git');
        $sCmd = $xGit . ' pull';
        self::shellExecute($sCmd, true);
        $sCmd = 'cd ' . Config::get_MVC_APPLICATION_PATH() . '; ' . PHP_BINARY . ' composer.phar update; cd ' . Config::get_MVC_BASE_PATH() . ';';
        self::shellExecute($sCmd, true);

        // update vendor libs in modules
        $bUnlink = false;
        $aModule = preg_grep('/^([^.])/', scandir($GLOBALS['aConfig']['MVC_MODULES_DIR']));

        foreach ($aModule as $sModule)
        {
            // search for composer.lock files and unlink them
            $sModuleConfigFile = $GLOBALS['aConfig']['MVC_MODULES_DIR'] . '/' . $sModule . '/etc/config/' . $sModule . '/composer.lock';

            if (true === file_exists($sModuleConfigFile))
            {
                $bUnlink = true;
                unlink($sModuleConfigFile);
            }
        }

        if (true == $bUnlink)
        {
            $sCmd = PHP_BINARY . ' emvicy.php;';
            self::shellExecute($sCmd, true);
        }
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function up()
    {
        self::update();
    }

    /**
     * @example php emvicy.php log id=2023070711413964a7ddd36254a nl=true
     * @required grep, awk, sed
     * @return void
     * @throws \ReflectionException
     */
    public static function log()
    {
        $sLogId = (false === empty(get($_GET['id'])))
            ? get($_GET['id'])
            : Config::get_MVC_UNIQUE_ID()
        ;

        $bNewline = (false === empty(get($_GET['nl'])))
            ? (boolean) get($_GET['nl'])
            : false
        ;

        // sort with awk on 8. field (myMVC Log increment number)
        $sCmd = "cd " . Config::get_MVC_LOG_FILE_FOLDER() . "; "
                . self::whereis('grep') .  " " . $sLogId . " *.log "
                . "| " . self::whereis('awk') . " '{ print $0 | \"" . self::whereis('sort') . " -nk8\"}'";

        // replace string \n in output by a real linebreak
        (true === $bNewline) ? $sCmd.= " | " . self::whereis('sed') . " -E 's/" . '\\\n' . "/" . '\n' . "/g'" : false;

        hr();
        echo $sCmd;
        hr();
        $sLog = trim((string) (shell_exec($sCmd)));

        nl();
        echo $sLog;
        nl(2);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function version()
    {
        echo Config::get_MVC_VERSION();
        nl();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function v()
    {
        self::version();
    }

}