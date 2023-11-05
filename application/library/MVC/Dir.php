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
    public static function remove(string $sDirectory = '', bool $bForce = false): bool
    {
        if (strstr($sDirectory, '*'))
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
                    (is_file($sFile)) ? unlink($sFile) : false;
                    (is_dir($sFile)) ? self::remove($sFile, Registry::get('Dir_remove_bForce')) : false;
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
    public static function isEmpty(string $sDirectory = '')
    {
        return !(new \FilesystemIterator($sDirectory))->valid();
    }

    /**
     * @param string $sDirectory
     * @param int    $iPermission e.g. 0640, 0755, 0777
     * @param bool   $bRecursive default=true
     * @return bool
     */
    public static function make(string $sDirectory = '', int $iPermission = 0755, bool $bRecursive = true)
    {
        if (
            // a similar file or dir already exists
            (true === file_exists($sDirectory)) ||
            // creating that dir fails
            (false === mkdir($sDirectory, $iPermission, $bRecursive))
        )
        {
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
    public static function exists(string $sDirectory = '')
    {
        return (true === file_exists($sDirectory) && true === is_dir($sDirectory));
    }
}
