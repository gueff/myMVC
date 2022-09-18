<?php

/*
 * Generating DataType Classes
 * @see https://mymvc.ueffing.net/generator-datatype
 * @usage:
 *      php generateDataTypes.php
 */
#---------------------------------------------------------------
// load MVC bootstrap
require_once realpath(__DIR__ . '/../../../../../') . '/application/config/util/bootstrap.php';
#---------------------------------------------------------------
\MVC\Config::init(get($GLOBALS['aConfig'], array()));
\Cachix::init(\MVC\Config::get_MVC_CACHE_CONFIG());
\Cachix::autoDeleteCache('DataType', 0);
#---------------------------------------------------------------

// load config $aDataType
require_once 'datatype.php';

// Generate!
\MVC\Generator\DataType::create(56)->initConfigArray($aDataType);
