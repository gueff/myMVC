<?php
/**
 * Strings.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
 */

namespace MVC;

class Strings
{
    /**
     * removes doubleDot+Slashes (../) from string
     * @param string $sString
     * @return string
     */
    public static function removeDoubleDotSlashesFromString($sString = '')
    {
        // removes any "../"
        $sString = (string) preg_replace('#(\.\.\/)+#', '', trim($sString));

        return $sString;
    }

    /**
     * replaces multiple forwardSlashes (//) from string by a single forwardSlash
     * @param string $sString
     * @param bool   $bIgnoreProtocols default=false; on true leaves :// as it is
     * @return string
     */
    public static function replaceMultipleForwardSlashesByOneFromString($sString = '', $bIgnoreProtocols = false)
    {
        // removes multiple "/" [e.g.: //, ///, ////, etc.]
        if (true === $bIgnoreProtocols)
        {
            $sString = (string) preg_replace('#([^:])(\/{2,})#', '$1/', trim($sString));
        }
        else
        {
            $sString = (string) preg_replace('#/+#', '/', trim($sString));
        }

        return $sString;
    }

    /**
     * replaces special chars, umlauts by `-` (or given char)
     * @param $sString
     * @param $sReplacement
     * @param $bStrToLower
     * @return string
     */
    public static function seofy ($sString = '', $sReplacement = '-', $bStrToLower = true)
    {
        $sString = preg_replace('/[^\\pL\d_]+/u', $sReplacement, $sString);
        $sString = trim($sString, $sReplacement);
        $sString = transliterator_transliterate('de-ASCII; Any-Latin; Latin-ASCII;', $sString);
        $sString = iconv("utf-8","ascii//translit//ignore", $sString);
        (true === $bStrToLower) ? $sString = strtolower($sString) : false;
        $sString = (string) preg_replace('/[^-a-zA-Z0-9_]+/', '', $sString);

        return $sString;
    }

    /**
     * @param $sString
     * @return bool
     */
    public static function isJson($sString = '')
    {
        if (false === is_string($sString))
        {
            return false;
        }

        json_decode($sString);
        $bIsJson = (json_last_error() === JSON_ERROR_NONE);

        return $bIsJson;
    }

    /**
     * @param $sString
     * @return bool string is utf8
     */
    public static function isUtf8($sString = '')
    {
        $iStrlen = strlen($sString);

        for($iCnt = 0; $iCnt < $iStrlen; $iCnt++)
        {
            $iOrd = ord($sString[$iCnt]);

            if($iOrd < 0x80)
            {
                continue; // 0bbbbbbb
            }
            elseif(($iOrd & 0xE0) === 0xC0 && $iOrd > 0xC1)
            {
                $iN = 1; // 110bbbbb (exkl C0-C1)
            }
            elseif(($iOrd & 0xF0) === 0xE0)
            {
                $iN = 2; // 1110bbbb
            }
            elseif(($iOrd & 0xF8) === 0xF0 && $iOrd < 0xF5)
            {
                $iN = 3; // 11110bbb (exkl F5-FF)
            }
            else
            {
                return false; // invalid UTF-8 char
            }

            for($iCnt2 = 0; $iCnt2 < $iN; $iCnt2++) // $iN followbytes? // 10bbbbbb
            {
                if(++$iCnt === $iStrlen || (ord($sString[$iCnt]) & 0xC0) !== 0x80)
                {
                    return false; // invalid UTF-8 char
                }
            }
        }

        return true; // no valid UTF-8 char found
    }

    /**
     * returns a random uuid Version4 string
     * @example 889abaf2-461d-42a1-86f4-07eb3e9876a5
     * @return string
     */
    public static function uuid4()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}