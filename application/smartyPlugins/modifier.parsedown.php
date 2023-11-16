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

    return $sMarkup;
}