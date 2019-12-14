<?php

$aConfig['MVC_CORE'] = array(

    // myMVC
    'version' => 'dev-master',

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
    ),

    'phpFunctionsRequired' => array(
        'mb_strlen',
        'iconv',
        'utf8_decode',
    ),
);
