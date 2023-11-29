<?php

# @usage
#   php emvicy.php datatype


#---------------------------------------------------------------
#  Defining DataType Classes

$sModuleCurrentDir = realpath(__DIR__ . '/../../../../');
$sModuleCurrent = basename($sModuleCurrentDir);
$sDataTypeDir = $sModuleCurrentDir . '/DataType';
$sNamespace = str_replace('/', '\\', substr($sDataTypeDir, strlen($aConfig['MVC_MODULES_DIR'] . '/')));

// base setup
$aDataType = array(

    // directory
    'dir' => $sDataTypeDir,

    // remove complete dir before new creation
    'unlinkDir' => false,

    // enable creation of events in datatype methods
    'createEvents' => true,
);

// classes
$aDataType['class']['DTRoutingAdditional'] = array(
    'name' => 'DTRoutingAdditional',
    'file' => 'DTRoutingAdditional.php',
    'namespace' => $sNamespace,
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
# copy settings to module's config
# in your code you can access this datatype config by: \MVC\Config::MODULE()['DATATYPE'];

$aConfig['MODULE'][$sModuleCurrent]['DATATYPE'] = $aDataType;

