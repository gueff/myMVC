<?php
/**
 * File.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

class File
{
    /**
     * get infos about a file via stat
     * @access public
     * @static
     * @param string $sFile file
     * @param string $sKey  (optional) if $sKey is given, only this info wil be returned
     * @return array|mixed
     */
    public static function getFileInfo($sFile = null, $sKey = null)
    {
        if (false === isset($sFile))
        {
            return array();
        }

        $aStat = stat($sFile);
        $aInfo = posix_getpwuid($aStat['uid']);

        if (false === empty ($sKey))
        {
            if (array_key_exists($sKey, $aInfo))
            {
                return $aInfo[$sKey];
            }
        }

        return $aInfo;
    }

    /**
     * removes doubleDot+Slashes (../) from string
     * replaces multiple forwardSlashes (//) from string by a single forwardSlash
     * @param string $sAbsoluteFilePath
     * @param bool   $bIgnoreProtocols default=false; on true leaves :// as it is
     * @return string
     */
    public static function secureFilePath($sAbsoluteFilePath = '', $bIgnoreProtocols = false)
    {
        $sAbsoluteFilePath = Strings::removeDoubleDotSlashesFromString($sAbsoluteFilePath);
        $sAbsoluteFilePath = Strings::replaceMultipleForwardSlashesByOneFromString($sAbsoluteFilePath, $bIgnoreProtocols);

        /**@var string */
        return $sAbsoluteFilePath;
    }
}