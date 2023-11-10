<?php
/**
 * Dir.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

class Dir
{
    /**
     * @notice Dir::remove('/tmp/foo/') will delete folder 'foo' as well; a trailing slash has no meaning
     * @param string $sDirectory
     * @param bool   $bForce default=false; if set to true: ignores if directory is not empty; removes given directory no matter what
     * @return bool
     * @throws \ReflectionException
     */
    public static function remove(string $sDirectory = '', bool $bForce = false) : bool
    {
        if (true === str_contains($sDirectory, '*'))
        {
            Error::error('$sDirectory may not contain an asterisk: ' . $sDirectory);

            return false;
        }

        Registry::set('Dir_remove_bForce', $bForce);

        array_map(
            function(string $sFile){
                if (true === Registry::get('Dir_remove_bForce'))
                {
                    $sFile = File::secureFilePath($sFile);
                    (is_file($sFile)) && unlink($sFile);
                    (is_dir($sFile)) && self::remove($sFile, Registry::get('Dir_remove_bForce'));
                }
            },
            glob($sDirectory . '/{,.}[!.,!..]*', GLOB_BRACE)
        );

        return rmdir($sDirectory);
    }

    /**
     * checks if a directory is empty
     * @param string $sDirectory
     * @return bool folder is empty
     */
    public static function isEmpty(string $sDirectory = '') : bool
    {
        return !(new \FilesystemIterator($sDirectory))->valid();
    }

    /**
     * @param string $sDirectory
     * @param int    $iPermission
     * @param bool   $bRecursive
     * @return bool
     * @throws \ReflectionException
     */
    public static function make(string $sDirectory = '', int $iPermission = 0755, bool $bRecursive = true) : bool
    {
        // a similar file or dir already exists
        if (true === file_exists($sDirectory))
        {
            return false;
        }

        $bMkdir = mkdir($sDirectory, $iPermission, $bRecursive);

        // creating that dir fails
        if (false === $bMkdir)
        {
            Error::error('mkdir failed: `' . $sDirectory . '`');

            return false;
        }

        // creation failed; directory does not exist
        if (false === file_exists($sDirectory) || false === is_dir($sDirectory))
        {
            return false;
        }

        return true;
    }

    /**
     * checks if a given directory exists
     * @param string $sDirectory
     * @return bool exists
     */
    public static function exists(string $sDirectory = '') : bool
    {
        return (true === file_exists($sDirectory) && true === is_dir($sDirectory));
    }

    /**
     * copies a directory recursively
     * @param string $sSource
     * @param string $sDestination
     * @return void
     * @throws \ReflectionException
     */
    public static function recursiveCopy(string $sSource = '', string $sDestination = '') : void
    {
        $rDir = opendir($sSource);
        $bMkdir = mkdir($sDestination);
        (false === $bMkdir) ? Error::error('mkdir failed: `' . $sDestination . '`') : false;

        while (false !== ( $file = readdir($rDir)))
        {
            if (( $file != '.' ) && ( $file != '..' ))
            {
                if (is_dir($sSource . '/' . $file))
                {
                    self::recursiveCopy($sSource . '/' . $file, $sDestination . '/' . $file);
                }
                else
                {
                    $bCopy = copy($sSource . '/' . $file, $sDestination . '/' . $file);
                    (false === $bCopy) ? Error::error('copy failed: from `' . $sSource . '/' . $file . '` => to => `' . $sDestination . '/' . $file . '`') : false;
                }
            }
        }

        closedir($rDir);
    }
}
