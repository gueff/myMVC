<?php

#-------------------------------
# start
$aDataType = array(
    'dir' => \MVC\Config::get_MVC_MODULES() . '/Webbixx/DataType/',
    'unlinkDir' => true,
    'class' => array()
);

#-------------------------------
# DTExample
$aDataType['class'][] = array(
    'name' => 'DTExample',
    'file' => 'DTExample.php',
    'namespace' => 'Webbixx\\DataType',
    'constant' => array(),
    'property' => array(
        array('key' => 'sFoo', 'var' => 'string', 'value' => 'bar'),
    ),
);

#-------------------------------
# DTRoute
$aDataType['class'][] = array(
    'name' => 'DTRoute',
    'file' => 'DTRoute.php',
    'namespace' => 'Webbixx\\DataType',
    'constant' => array(),
    'property' => array(
        array('key' => 'path',),
        array('key' => 'query',),
        array('key' => 'title',),
        array('key' => 'layout',),
        array('key' => 'style', 'var' => 'array',),
        array('key' => 'load', 'var' => 'array',),
        array('key' => 'script', 'var' => 'array',),
        array('key' => 'class',),
        array('key' => 'method',),
    )
);

//#-------------------------------
# DTConfig
$aClass = array(
    'name' => 'DTConfig',
    'file' => 'DTConfig.php',
    'namespace' => 'Webbixx\\DataType',
    'createHelperMethods' => false,
    'constant' => array(),
    'property' => array(),
);

// put all global MVC_*key*/values as properties into Class
foreach ($GLOBALS['aConfig'] as $sKey => $mValue)
{
//    if (stristr($sKey, 'Webbixx')) # 'MVC_' == substr($sKey, 0, 4))
    if ('MVC_' == substr($sKey, 0, 4))
    {
        if ('boolean' === gettype($mValue))
        {
            $mValue = (int) $mValue;
        }

        $aClass['property'][] = array(
            'key' => $sKey,
            'var' => gettype($mValue),
            'value' => $mValue
        );
    }
}

$aDataType['class'][] = $aClass;
