<?php

// Idolon Class
require_once '../../Idolon.php';

$oIdolon = new \Idolon();
$oIdolon
    ->setImagePath(
        realpath(__DIR__ . '/../')  // examples folder
    )
    ->serve();
