<?php

/**
 * This Smarty modifier helps instantly translating Strings into other Languages using the PHP Extension 'gettext'
 * @author Guido K.B.W. Üffing <info ueffing net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3
 * @require gettext extension, ext-intl
 * @example
 *      {'Frontend'|gtext:backend}
 *      {'Frontend'|gtext:backend:de_DE}
 * @see https://blog.ueffing.net/post/2013/07/19/php-smarty-a-modifier-for-internationalization-tool-gettext/
 * @param string $sString String to be translated
 * @param string $sDomain e.g. "backend"; means the File (backend.mo) which will be consulted for Translation
 * @param string $sLang Translation into a certain Language, e.g. "de_DE"
 * @return string translated String
 * @throws \ReflectionException
 */
function smarty_modifier_gtext(string $sString = '', string $sDomain = 'term', string $sLang = '') : string
{
    static $sCurrentDomain = null;
    static $sCurrentLang = null;

    // Fallback lang
    if ('' === $sLang)
    {
        if (isset(\MVC\Session::is()->get('APP')['LANG']))
        {
            $sLang = str_replace('-', '_', \MVC\Session::is()->get('APP')['LANG']);
        }
        else
        {
            $sLang = str_replace('-', '_', \Locale::getDefault());
        }
    }

    if (empty($sString))
    {
        return $sString;
    }


    if ($sDomain !== $sCurrentDomain || $sLang !== $sCurrentLang) {
        $sCurrentDomain = $sDomain;
        $sCurrentLang = $sLang;

        // requires installation of php module: php{Version}-intl (and maybe libicu52)
        //
        // This function needs a "BCP 47 compliant language tag"
        // what is per definition, using a dash instead of an underscore
        // @see http://www.php.net/manual/de/locale.setdefault.php
        //      http://en.wikipedia.org/wiki/IETF_language_tag
        \Locale::setDefault(str_replace('_', '-', $sLang));

        // Setting the proper Codeset
        // here, don't use a dash '-'
        $sCodeset = 'UTF8';
        putenv('LANG=' . $sLang . '.' . $sCodeset);
        putenv('LANGUAGE=' . $sLang . '.' . $sCodeset);

        // set Codeset
        bind_textdomain_codeset($sDomain, $sCodeset);

        // name the Place of Translationtables
        // That is where your Translationfolders reside
        bindtextdomain($sDomain, sys_get_temp_dir()); # flush
        bindtextdomain ($sDomain, \MVC\Registry::get('APP')['GETTEXT']);

        // set locale
        setlocale(LC_MESSAGES, ''); # flush
        setlocale(LC_MESSAGES, $sLang . '.' . $sCodeset);

        // Translation will be loaded from
        // e.g.: /var/www/App/languages/de_DE/LC_MESSAGES/backend.mo
        textdomain($sDomain);
    }

    $sTranslated = gettext($sString);
    $aDebug = debug_backtrace();

    // Event
    \MVC\Event::run('smarty_modifier_gtext.after', array(
        'sAppLang' => \MVC\Registry::get('APP')['LANG'],
        'sString' => $sString,
        'sDomain' => $sDomain,
        'sLang' => $sLang,
        'sTranslated' => $sTranslated,
        'aDebug' => $aDebug[0],
    ));

    // return, so that further modifiers could handle it
    return $sTranslated;
}