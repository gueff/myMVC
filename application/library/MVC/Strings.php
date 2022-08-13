<?php

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
        $sString = iconv('utf-8', "us-ascii//TRANSLIT", $sString);
        (true === $bStrToLower) ? $sString = strtolower($sString) : false;
        $sString = (string) preg_replace('/[^-a-z0-9_]+/', '', $sString);

        return $sString;
    }
}