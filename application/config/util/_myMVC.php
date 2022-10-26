<?php
/**
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
 */

$sVersionFile = $aConfig['MVC_BASE_PATH'] . '/.version';
$sVersion = (true === file_exists($sVersionFile)) ?
current(
    array_values(
        array_filter(
            array_map(
                'trim',
                array_filter(
                    file($sVersionFile),
                    function ($mVar){return $mVar[0] != '#';})),
            'strlen')
    )
) : '?';

$aConfig['MVC_CORE'] = array(

    // myMVC
    // @see /.version
    'version' => $sVersion,

    // These PHP extensions are required
    'phpExtensionsRequired' => array(
        'Core',
        'ctype',
        'curl',
        'date',
        'dom',
        'fileinfo',
        'filter',
        'iconv',
        'json',
        'mbstring',
        'Phar',
        'posix',
        'Reflection',
        'session',
        'SimpleXML',
        'standard',
        'SPL',
        'zip'
    ),

    'phpFunctionsRequired' => array(
        'mb_strlen',
        'iconv',
        'utf8_decode',
    ),
);
