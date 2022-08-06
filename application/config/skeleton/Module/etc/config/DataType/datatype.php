<?php

/**
 * Generating DataType Classes
 * @see https://mymvc.ueffing.net/generator-datatype
 */

#-------------------------------
# start
$aConfig['MODULE_{module}']['aDataType'] = array(
    'dir' => \MVC\Config::get_MVC_MODULES() . '/{module}/DataType/',
    'unlinkDir' => false,
    'class' => array()
);

#-------------------------------
# simple Example
$aConfig['MODULE_{module}']['aDataType']['class'][] = array(
    'name' => 'DTExampleFoo',
    'file' => 'DTExampleFoo.php',
    'namespace' => '{module}\\DataType',
    'constant' => array(),
    'property' => array(
        array('key' => 'foo', 'var' => 'string', 'value' => 'bar'),
    ),
);

#-------------------------------
# Another Example
$aConfig['MODULE_{module}']['aDataType']['class'][] = array(
    'name' => 'DTExampleRoute',
    'file' => 'DTExampleRoute.php',
    'namespace' => '{module}\\DataType',
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

#-------------------------------
# more complex Example

/**
 * build a Class "DTConfig" on all MODULE_{module} configs
 * except EVENT_BIND ones (does not work for closures)
 *
 * you can then use the generated DT Class like this
 * DTConfig{module}::create()->get_aDataType())
 * DTConfig{module}::create()->get_SESSION())
 * DTConfig{module}::create()->get_CSP())
 */

# 1. start declaring
$aClass = array(
    'name' => 'DTConfig{module}',
    'file' => 'DTConfig{module}.php',
    'namespace' => '{module}\\DataType',
    'createHelperMethods' => false,
    'constant' => array(),
    'property' => array(),
);

# 2. put all global MODULE_{module} key/values as properties into Class
foreach ($GLOBALS['aConfig']['MODULE_{module}'] as $sKey => $mValue)
{
    // skip these
    if ('EVENT_BIND' === $sKey)
    {
        continue;
    }

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

# 3. add class to parent class array
$aConfig['MODULE_{module}']['aDataType']['class'][] = $aClass;