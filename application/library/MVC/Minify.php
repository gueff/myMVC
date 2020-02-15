<?php

/**
 * Minify.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVC
 */
namespace MVC;

use JSMin\JSMin;

class Minify
{
    /**
     * @param array $aContentFilterMinify
     * array(
            'css' => array(
                $aConfig['MVC_PUBLIC_PATH'] . '/myMVC/styles/',
            ),
            'js' => array(
                $aConfig['MVC_PUBLIC_PATH'] . '/myMVC/scripts/',
            ),
        )
     * @throws ReflectionException
     */
    public static function init(array $aContentFilterMinify = array())
    {
        foreach ($aContentFilterMinify as $sType => $aScriptDirAbs)
        {
            ('js' == $sType) ? self::minifyJs($aScriptDirAbs) : false;
            ('css' == $sType) ? self::minifyCss($aScriptDirAbs) : false;
        }
    }

    /**
     * creates minified JS files
     * @param array $aScriptDirAbs
     */
    public static function minifyJs(array $aScriptDirAbs = array())
    {
        foreach ($aScriptDirAbs as $sScriptDirAbs)
        {
            $aScript = array_filter(glob($sScriptDirAbs . '*.js'), function($sValue){return ('.min.js' !== mb_substr($sValue, -7));});

            foreach ($aScript as $sScript)
            {
                if (false === file_exists($sScript)) {continue;}

                 $sJsMin = JSMin::minify(file_get_contents($sScript));
                file_put_contents(
                    $sScriptDirAbs . pathinfo($sScript, PATHINFO_FILENAME) . '.min.js',
                    $sJsMin
                );
            }
        }
    }

    /**
     * creates minified css files
     * @param array $aScriptDirAbs
     */
    public static function minifyCss(array $aScriptDirAbs = array())
    {
        foreach ($aScriptDirAbs as $sScriptDirAbs)
        {
            $aStyle = array_filter(glob($sScriptDirAbs . '*.css'), function($sValue){return ('.min.css' !== mb_substr($sValue, -8));});

            foreach ($aStyle as $sStyle)
            {
                if (false === file_exists($sStyle)) {continue;}

                $sContent = file_get_contents($sStyle);

                // Remove comments
                $sContent  = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $sContent);

                // Remove space after colons
                $sContent = str_replace(': ', ':', $sContent);

                // Remove whitespace
                $sContent = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $sContent);

                file_put_contents(
                    $sScriptDirAbs . pathinfo($sStyle, PATHINFO_FILENAME) . '.min.css',
                    $sContent
                );
            }
        }
    }
}