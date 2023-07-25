<?php

/**
 * run this script on cli
 * @usage php emvicy.php
 */
putenv('emvicy=1');
require_once realpath(__DIR__) . '/application/init/util/bootstrap.php';
require_once realpath(__DIR__) . '/config/_mvc.php';
\MVC\Config::init($GLOBALS['aConfig']);
$oEmvicy = \Emvicy\Emvicy::init();
