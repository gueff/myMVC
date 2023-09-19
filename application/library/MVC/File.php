<?php
/**
 * File.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use Emvicy\Emvicy;
use MVC\DataType\DTFileinfo;

class File
{
    /**
     * get infos about a file via stat, posix_getpwuid, pathinfo
     * @param $sFile
     * @return \MVC\DataType\DTFileinfo
     * @throws \ReflectionException
     */
    public static function info($sFile = null)
    {
        if (false === isset($sFile))
        {
            return DTFileinfo::create();
        }

        $aStat = stat($sFile);
        $aInfo = posix_getpwuid($aStat['uid']);
        $aInfo['path'] = $sFile;
        $aInfo['is_file'] = is_file($sFile);
        $aInfo['is_dir'] = is_dir($sFile);
        $aInfo['filemtime'] = filemtime($sFile);
        $aInfo['filectime'] = filemtime($sFile);
        $aInfo['mimetype'] = self::getMimeType($sFile);
        $aPathInfo = pathinfo($sFile);
        $aInfo = array_merge($aInfo, $aPathInfo);
        $oDTFileinfo = DTFileinfo::create($aInfo);

        return $oDTFileinfo;
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

    /**
     * @param string $sFileAbsolute
     * @return string
     */
    public static function getMimeType(string $sFileAbsolute = '')
    {
        // get mime type of file (e.g.: application/pdf; charset=binary)
        if (false === file_exists($sFileAbsolute))
        {
            return '';
        }

        $sCmd = whereis('file') . ' -bi -- ' . escapeshellarg($sFileAbsolute);
        $mMimeType = strtok(Emvicy::shellExecute($sCmd),';');
        $sMimeType = (false === $mMimeType) ? '' : $mMimeType;

        return $sMimeType;
    }
}