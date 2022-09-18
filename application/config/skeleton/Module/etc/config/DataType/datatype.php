<?php

/**
 * Generating DataType Classes
 * @see https://mymvc.ueffing.net/generator-datatype
 */
$aDataType = array(
    'dir' => \MVC\Config::get_MVC_MODULES() . '/{module}/DataType/',
    'unlinkDir' => true
);

$aDataType['class'][] = array(
    'name' => 'DTRoutingAdditional',
    'file' => 'DTRoutingAdditional.php',
    'namespace' => '{module}\\DataType',
    'createHelperMethods' => true,
    'constant' => array(),
    'property' => array(
        array(
            'key' => 'sTitle',
            'var' => 'string',
        ),
        array(
            'key' => 'sLayout',
            'var' => 'string',
        ),
        array(
            'key' => 'sMainmenu',
            'var' => 'string',
        ),
        array(
            'key' => 'sContent',
            'var' => 'string',
        ),
        array(
            'key' => 'sHeader',
            'var' => 'string',
        ),
        array(
            'key' => 'sNoscript',
            'var' => 'string',
        ),
        array(
            'key' => 'sCookieConsent',
            'var' => 'string',
        ),
        array(
            'key' => 'sFooter',
            'var' => 'string',
        ),
        array(
            'key' => 'aStyle',
            'var' => 'array',
        ),
        array(
            'key' => 'aScript',
            'var' => 'array',
        ),
    ),
);
