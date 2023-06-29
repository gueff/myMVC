<?php

putenv('myMVC.phar=1');
require_once realpath(__DIR__) . '/application/config/util/bootstrap.php';
require_once realpath(__DIR__) . '/config/_myMVC.php';
\MVC\Config::init($GLOBALS['aConfig']);
$oEmvicy = \Emvicy\Emvicy::init();
