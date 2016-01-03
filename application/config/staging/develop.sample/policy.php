<?php

$aConfig['MVC_POLICY'] = array (
	
	// The matching Class
	'\\Standard\\Controller\\Index' => array (
		
		// the matching method
		'policy' => array (
			
			// What to call
			'\\Standard\\Policy\\Example::test1'
			, '\\Standard\\Policy\\Example::test2'
		)
	)
);
