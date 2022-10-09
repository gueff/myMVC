<?php
#---------------------------------------------------------------
require_once realpath(__DIR__ . '/../../../../../') . '/application/config/util/bootstrap.php';
\MVC\Config::init(get($GLOBALS['aConfig'], array()));
\MVC\Cache::init(\MVC\Config::get_MVC_CACHE_CONFIG());
\MVC\Cache::autoDeleteCache('DataType', 0);

#---------------------------------------------------------------
#  Defining DataType Classes

// Classes created by this script are placed into folder:
// `/modules/{module}/DataType/`
// @see https://mymvc.ueffing.net/3.1.x/generating-datatype-classes

// base setup
$aDataType = array(
    'dir' => \MVC\Config::get_MVC_MODULES_DIR() . '/{module}/DataType/',
    'unlinkDir' => false
);

// classes
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
            'required' => true,
            'forceCasting' => true,
        ),
        array(
            'key' => 'sLayout',
            'var' => 'string',
            'required' => true,
            'forceCasting' => true,
        ),
        array(
            'key' => 'sMainmenu',
            'var' => 'string',
            'required' => true,
            'forceCasting' => true,
        ),
        array(
            'key' => 'sContent',
            'var' => 'string',
            'required' => true,
            'forceCasting' => true,
        ),
        array(
            'key' => 'sHeader',
            'var' => 'string',
            'required' => true,
            'forceCasting' => true,
        ),
        array(
            'key' => 'sNoscript',
            'var' => 'string',
            'required' => true,
            'forceCasting' => true,
        ),
        array(
            'key' => 'sCookieConsent',
            'var' => 'string',
            'required' => true,
            'forceCasting' => true,
        ),
        array(
            'key' => 'sFooter',
            'var' => 'string',
            'required' => true,
            'forceCasting' => true,
        ),
        array(
            'key' => 'aStyle',
            'var' => 'array',
            'required' => true,
            'forceCasting' => true,
        ),
        array(
            'key' => 'aScript',
            'var' => 'array',
            'required' => true,
            'forceCasting' => true,
        ),
    ),
);

#---------------------------------------------------------------
#  create!

\MVC\Generator\DataType::create(56)->initConfigArray($aDataType);
