<?php

// Idolon Class
require_once '../../Idolon.php';

$oIdolon = new \Idolon();
$oIdolon
    ->setImagePath(
        realpath(__DIR__ . '/../')
    )
    ->setSanitize(function(){
            (isset($_GET['x'])) ? $_GET['x'] = (int) $_GET['x'] : false;
            (isset($_GET['y'])) ? $_GET['y'] = (int) $_GET['y'] : false;
            (isset($_GET['r'])) ? $_GET['r'] = (int) $_GET['r'] : $_GET['r'] = 1;            
        })
    ->setFilter(function(){
            (isset($_GET['i'])) ? $_GET['i'] = preg_replace('/[^a-zA-Z0-9\-\._, ]+/', '-', $_GET['i']) : false;
        })    
    ->serve();
