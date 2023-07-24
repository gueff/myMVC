<?php

namespace Emvicy;

class Install
{
    /**
     * @param $sModuleName
     * @param array $aConfig
     * @param bool $bPrimary
     * @return false|void
     */
    public static function run($sModuleName = '', array $aConfig = array(), bool $bPrimary = true)
    {
        $sModuleName = ucfirst(trim($sModuleName));

        // check if not exist yet
        if (is_dir($aConfig['MVC_MODULES_DIR'] . '/' . $sModuleName ))
        {
            echo "\nERROR\tmodule '" . $sModuleName . "' already exists. Exit.\n\n";
            return false;
        }

        echo "\n...creating module/" . $sModuleName . "/* with subdirectories and -files\n";

        // copy new module skeleton
        self::recursiveCopy($aConfig['MVC_APPLICATION_CONFIG_DIR'] . '/skeleton/Module', $aConfig['MVC_MODULES_DIR'] . '/' . $sModuleName);

        // replace placeholder
        Emvicy::shellExecute(whereis('grep') . ' -rl "{module}" ' . $aConfig['MVC_MODULES_DIR'] . '/' . $sModuleName . ' | '
                   . whereis('xargs') . ' '
                   . whereis('sed') . ' -i "s/{module}/' . $sModuleName . '/g"'
        );

        // rename folder
        Emvicy::shellExecute(whereis('mv') . ' "' . $aConfig['MVC_MODULES_DIR'] . '/' . $sModuleName . '/etc/config/{module}" "' . $aConfig['MVC_MODULES_DIR'] . '/' . $sModuleName . '/etc/config/' . $sModuleName . '"')  ;

        // rename config file
        Emvicy::shellExecute(whereis('mv') . ' "' . $aConfig['MVC_MODULES_DIR'] . '/' . $sModuleName . '/etc/config/' . $sModuleName . '/config/_example" "' . $aConfig['MVC_MODULES_DIR'] . '/' . $sModuleName . '/etc/config/' . $sModuleName . '/config/' . getenv('MVC_ENV') . '.php"')  ;

        // rename files from *.phtml to *.php using mv command
        Emvicy::shellExecute(
            whereis('find') . ' ' . $aConfig['MVC_MODULES_DIR'] . '/' . $sModuleName . '/ -depth -name "*.phtml" '
            . ' -exec ' . whereis('sh') . ' -c \'f="{}"; ' . whereis('mv') . ' -- "$f" "${f%.phtml}.php"\' \;'
        );

        if (false === $bPrimary)
        {
            self::removePrimaryEssentials($aConfig['MVC_MODULES_DIR'] . '/' . $sModuleName);
        }

        // set rights
        chmod($aConfig['MVC_MODULES_DIR'] . '/' . $sModuleName . '/_install.sh', 0775);
        chmod($aConfig['MVC_MODULES_DIR'] . '/' . $sModuleName . '/_publish.sh', 0775);

        echo " ✔ module created: " . $sModuleName . "\n\n";
    }

    /**
     * @param string $sModule
     * @return void
     */
    protected static function removePrimaryEssentials(string $sModule = '')
    {
        $aRemove = array(
            '/etc/config/_mvc.php',
        );

        foreach ($aRemove as $sRemove)
        {
            $sFileUnlink = $sModule . $sRemove;
            echo '>>> removing: ' . $sFileUnlink;
            nl();
            unlink($sFileUnlink);
        }
    }

    /**
     * @param       $sModuleName
     * @param       $sControllerName
     * @param array $aConfig
     * @return void
     */
    public static function createController($sModuleName = '', $sControllerName = '', array $aConfig = array())
    {
        $sModuleName = ucfirst(trim($sModuleName));
        $sControllerFile = $aConfig['MVC_MODULES_DIR'] . '/' . $sModuleName . '/Controller/' . $sControllerName . '.php';

        echo "creating: " . $sControllerFile . "\n\n";

        // check if not exist yet
        if (file_exists($sControllerFile))
        {
            echo "\nERROR\tController already exists: '" . $sControllerFile . "'. Exit.\n\n";
            exit();
        }

        // copy new module skeleton
        Emvicy::shellExecute('cp ' . $aConfig['MVC_APPLICATION_CONFIG_DIR'] . '/skeleton/Module/Controller/Index.phtml' . ' ' . $sControllerFile);
        Emvicy::shellExecute('find ' . $aConfig['MVC_MODULES_DIR'] . '/' . $sModuleName . '/ -name "*.phtml" -exec rename \'s/.phtml$/.php/\' {} \;');

        echo " ✔ Controller created: " . $sControllerFile . "\n\n";
    }

    /**
     * copies recursively
     * @param string $sSource
     * @param string $sDestination
     */
    public static function recursiveCopy($sSource, $sDestination)
    {
        $dir = opendir($sSource);
        @mkdir($sDestination);

        while (false !== ( $file = readdir($dir)))
        {
            if (( $file != '.' ) && ( $file != '..' ))
            {
                if (is_dir($sSource . '/' . $file))
                {
                    self::recursiveCopy($sSource . '/' . $file, $sDestination . '/' . $file);
                }
                else
                {
                    copy($sSource . '/' . $file, $sDestination . '/' . $file);
                }
            }
        }

        closedir($dir);
    }
}
