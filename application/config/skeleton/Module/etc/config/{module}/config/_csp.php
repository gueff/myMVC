<?php

/**
 * Module Api CSP
 * For further Rules Explanation @see https://content-security-policy.com/
 */
$aConfig['MODULE']['{module}']['CSP'] = array();

// Websites (URLs) which are allowed to embed our Site into e.g. a <frame>
$aConfig['MODULE']['{module}']['CSP']['X-Frame-Options'] = " allow-from 'none'";

// Content-Security-Policy
$aConfig['MODULE']['{module}']['CSP']['Content-Security-Policy'] = str_replace("\n", '', trim("
default-src 'self';
script-src 'self' 'unsafe-inline';
style-src 'self' 'unsafe-inline';
img-src 'self' blob: data: ;
connect-src 'self';
font-src 'self';
object-src 'none';
media-src 'self';
child-src 'self';
sandbox allow-downloads allow-forms allow-same-origin allow-scripts allow-popups allow-modals allow-orientation-lock allow-pointer-lock allow-presentation allow-popups-to-escape-sandbox allow-top-navigation;
report-uri /;
form-action 'self';
frame-ancestors 'none';
frame-src 'self';
"));

// @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-XSS-Protection
$aConfig['MODULE']['{module}']['CSP']['X-XSS-Protection'] = '1; mode=block';

// 63072000 for 24 months; @see https://support.servertastic.com/knowledgebase/article/http-strict-transport-security-php
$aConfig['MODULE']['{module}']['CSP']['Strict-Transport-Security'] = 'max-age=63072000';
