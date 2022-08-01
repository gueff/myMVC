<?php

// Idolon Class
require_once '../../Idolon.php';

$aConfig = [
    'sImagePath' => realpath(__DIR__ . '/../'),
    'sParamKeyI' => 'image',
    'sParamKeyX' => 'dimensionX',
    'sParamKeyY' => 'dimensionY',
    'sParamKeyR' => 'redirect',
];

$oIdolon = new \Idolon($aConfig);
$oIdolon->serve();

