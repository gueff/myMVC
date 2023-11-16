<?php

/**
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

function smarty_modifier_highlight_html(string $sMarkup = '') : string
{
    return \MVC\Strings::highlight_html($sMarkup);
}


