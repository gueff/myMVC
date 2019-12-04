<?php

$aConfig = array(
    'dir' => \MVC\Registry::get("MVC_MODULES") . '/{module}/DataType/',
    'unlinkDir' => false,
    'class' => array(
        array(
            'name' => 'Foo',
            'file' => 'Foo.php',
            'namespace' => '{module}\\DataType',
            'constant' => array(
            ),
            'property' => array(
                array('key' => 'sFoo',),
            ),
        ),
    ),
);
