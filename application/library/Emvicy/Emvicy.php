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
     * @param string $sWhereIsItem
     * @return string abs path to executable
     */
    public static function whereis(string $sWhereIsItem = '')
    {
        $sCmd = 'export sEmvicyWhereIs=' . escapeshellarg($sWhereIsItem) . ';';
        $sCmd.= realpath(__DIR__) . '/bash/whereis.sh 2>&1;';
        $sResult = trim(shell_exec($sCmd));

        // unset var
        $sCmd = 'unset sEmvicyWhereIs;';
        shell_exec($sCmd);

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

        if (true === empty($sModule))
        {
            return false;
        }

        echo 'Modulename: ' . $sModule;
        nl();
        echo 'primary: ' . self::get_primary();
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
            self::get_primary()
        );
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
        shell_exec($sCmd);
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
        $sResult = trim((string) shell_exec($sCmd));
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
}