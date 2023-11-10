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
     * @param string $sFilePathAbs
     * @return \MVC\DataType\DTFileinfo
     * @throws \ReflectionException
     */
    public static function info(string $sFilePathAbs = '') : DTFileinfo
    {
        if (true === empty($sFilePathAbs))
        {
            return DTFileinfo::create();
        }

        $aStat = stat($sFilePathAbs);
        $aInfo = posix_getpwuid($aStat['uid']);
        $aInfo['path'] = $sFilePathAbs;
        $aInfo['is_file'] = is_file($sFilePathAbs);
        $aInfo['is_dir'] = is_dir($sFilePathAbs);
        $aInfo['filemtime'] = filemtime($sFilePathAbs);
        $aInfo['filectime'] = filemtime($sFilePathAbs);
        $aInfo['mimetype'] = self::getMimeType($sFilePathAbs);
        $aPathInfo = pathinfo($sFilePathAbs);
        $aInfo = array_merge($aInfo, $aPathInfo);

        return DTFileinfo::create($aInfo);
    }

    /**
     * removes doubleDot+Slashes (../) from string
     * replaces multiple forwardSlashes (//) from string by a single forwardSlash
     * @param string $sAbsoluteFilePath
     * @param bool   $bIgnoreProtocols default=false; on true leaves :// as it is
     * @return string
     */
    public static function secureFilePath(string $sAbsoluteFilePath = '', bool $bIgnoreProtocols = false) : string
    {
        return Strings::replaceMultipleForwardSlashesByOneFromString(
            Strings::removeDoubleDotSlashesFromString($sAbsoluteFilePath),
            $bIgnoreProtocols
        );
    }

    /**
     * @param string $sFileAbsolute
     * @return string
     */
    public static function getMimeType(string $sFileAbsolute = '') : string
    {
        // get mime type of file (e.g.: application/pdf; charset=binary)
        if (false === file_exists($sFileAbsolute))
        {
            return '';
        }

        $sCmd = whereis('file') . ' -bi -- ' . escapeshellarg($sFileAbsolute);
        $mMimeType = strtok(Emvicy::shellExecute($sCmd),';');

        return (false === $mMimeType) ? '' : $mMimeType;
    }
}