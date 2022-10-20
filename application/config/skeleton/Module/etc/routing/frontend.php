<?php

/*
 * this DataType class "\{module}\DataType\DTRoutingAdditional" is generated
 * @see modules/{module}/etc/config/DataType/
 */
$oDTRoutingAdditional = \{module}\DataType\DTRoutingAdditional::create()
    ->set_sTitle('{module}')
    ->set_sLayout('Frontend/layout/index.tpl')
    ->set_sMainmenu('Frontend/layout/menu.tpl')
    ->set_sContent('Frontend/content/index.tpl')
    ->set_sHeader('Frontend/layout/header.tpl')
    ->set_sNoscript('Frontend/content/_noscript.tpl')
    ->set_sCookieConsent('Frontend/content/_cookieConsent.tpl')
    ->set_sFooter('Frontend/layout/footer.tpl')
    ->set_aStyle(array (
        '/myMVC/assets/bootstrap-4.4.1-dist/css/bootstrap.min.css',
        '/myMVC/assets/font-awesome-4.7.0/css/font-awesome.min.css',
        '/myMVC/styles/myMVC.min.css',
    ))
    ->set_aScript(array (
        '/myMVC/assets/jquery/3.4.1/jquery-3.4.1.min.js',
        '/myMVC/assets/jquery-cookie/1.4.1/jquery.cookie.min.js',
        '/myMVC/assets/bootstrap-4.4.1-dist/js/bootstrap.min.js',
        '/myMVC/scripts/cookieConsent.min.js',
    ))
    ;

/*
 * Routes
 */
\MVC\Route::MIX(['GET','POST'],'/', 'module={module}&c=index&m=index', $oDTRoutingAdditional->getPropertyJson());
\MVC\Route::GET('/404/', 'module={module}&c=index&m=notFound', $oDTRoutingAdditional->set_sTitle('404')->set_sContent('Frontend/content/404.tpl')->getPropertyJson());
