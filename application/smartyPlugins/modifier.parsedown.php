<?php


/**
 * @package   myMVC
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 * @example   {'# title'|parsedown}
 * @param string $sMarkdown
 * @return string
 */
function smarty_modifier_parsedown(string $sMarkdown = '') : string
{
    $oParsedown = new \Parsedown();
    $sMarkup = $oParsedown->text($sMarkdown);

    $sStart = '<p>';
    $sEnd = '</p>';

    $sMarkup = (true === str_starts_with($sMarkup, $sStart)) ? substr($sMarkup, strlen($sStart)) : '';
    $sMarkup = (true === str_ends_with($sMarkup, $sEnd)) ? substr($sMarkup, 0, (strlen($sMarkup) - strlen($sEnd))) : '';

    return $sMarkup;
}