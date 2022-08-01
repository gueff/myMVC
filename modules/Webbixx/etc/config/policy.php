<?php

$aConfig['MVC_POLICY'] = array(

    // The matching Class
    '\\Webbixx\\Controller\\Index' => array(

        // the matching method => the Rule Method to be called
        'index' => array('\\Webbixx\\Policy\\Index::policy1'),
    )
);
