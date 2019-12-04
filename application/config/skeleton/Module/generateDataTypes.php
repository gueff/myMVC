<?php

// load MVC bootstrap
require_once realpath(__DIR__ . '/../../') . '/application/config/util/bootstrap.php';

#-------------------------

\Cachix::init(\MVC\Registry::get('CACHIX_CONFIG'));

// Generate!
foreach (glob ('./etc/config/DataType/*.php') as $sFile)
{
    require_once $sFile;
    \MVC\Generator\DataType::create(56)->initConfigArray($aConfig);
}
