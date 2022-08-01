<?php

// load MVC bootstrap
require_once realpath(__DIR__ . '/../../') . '/application/config/util/bootstrap.php';

#-------------------------

\MVC\Config::init(get($GLOBALS['aConfig'], array()));
\Cachix::init(\MVC\Registry::get('CACHIX_CONFIG'));
\Cachix::autoDeleteCache('DataType', 0);

// Generate!
foreach (glob ('./etc/config/DataType/*.php') as $sFile)
{
    require_once $sFile;
    \MVC\Generator\DataType::create(56)->initConfigArray($aDataType);
}

#---------------


// config
$oDTConfig = \MVC\DataType\DTConfig::create()
    ->set_dir(\MVC\Config::get_MVC_MODULES() . '/Webbixx/DataType/')
    ->set_unlinkDir(false)
    ->add_DTClass(

        \MVC\DataType\DTClass::create()
            ->set_name('DTFoo')
            ->set_file('DTFoo.php')
            ->set_namespace('Webbixx\DataType')
            ->set_createHelperMethods(true)
            ->add_DTConstant(
                \MVC\DataType\DTConstant::create()
                    ->set_key('FOO')
                    ->set_value('"BAR"')
                    ->set_visibility('public')
            )
            ->add_DTProperty(
                \MVC\DataType\DTProperty::create()
                    ->set_key('bSuccess')
                    ->set_var('bool')
                    ->set_value(true)

                    // optional property settings
                    ->set_visibility('protected')
                    ->set_static(false)
                    ->set_setter(true)
                    ->set_getter(true)
                    ->set_listProperty(true)
                    ->set_createStaticPropertyGetter(true)
                    ->set_setValueInConstructor(true)
                    ->set_explicitMethodForValue(false)
            )
    )
;

// generate
$oDTGenerator = \MVC\Generator\DataType::create(56)->initConfigObject($oDTConfig);