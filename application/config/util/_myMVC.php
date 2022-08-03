<?php

$aConfig['MVC_CORE'] = array(

    // myMVC
    'version' => '2.x-dev',

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
