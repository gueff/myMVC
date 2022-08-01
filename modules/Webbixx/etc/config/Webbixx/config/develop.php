<?php

error_reporting(E_ALL);
date_default_timezone_set('Europe/Berlin');

// enable debug output
$aConfig['MVC_DEBUG'] = true;

//-------------------------------------------------------------------------------------
// Module Webbixx

// MVC fallback routing
$aConfig['MVC_ROUTING_FALLBACK'] = 'module=Webbixx&c=index&m=notFound'; # query

$aConfig['MODULE_Webbixx'] = array();

/**
 * Where to activate Session;
 * name Controllers
 */
$aConfig['MODULE_Webbixx']['SESSION'] = array(

    // enable session for these controllers
    'aEnableSessionForController' => array(
        '*', # any
        #'Index',
    ),
    // disable session for these controllers
    'aDisableSessionForController' => array(
        #'*', # any
        #'Index',
    ),
);

/**
 * Event Bindings
 */
$aConfig['MODULE_Webbixx']['EVENT_BIND'] = array(

//    'mvc.request.saveRequest.after' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
//    'mvc.request.prepareQueryVarsForUsage.after' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
//    'mvc.runTargetClassPreconstruct.after' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
//    'mvc.application.setSession.before' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        },
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \Webbixx\Event\Index::enableSession($oDTArrayObject);
//        }
//    ),
//    'mvc.application.setSession.after' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
//    'mvc.policy.apply.execute' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),

    'mvc.controller.init.before' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        },
        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \Idolon\Event\Index::startIdolon($oDTArrayObject);
        }
    ),
//    'mvc.reflex.reflect.before' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
    'mvc.reflex.reflect.targetObject.before' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        },
        function(\MVC\DataType\DTArrayObject $oDTArrayObject) use ($aConfig) {
            \MVC\Minify::init();
        },
        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Router::createFinalJson();
        }
    ),
    'mvc.reflex.reflect.targetObject.after' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        },
        function (\MVC\DataType\DTArrayObject $oDTArrayObject) {
            $oView = $oDTArrayObject
                ->getDTKeyValueByKey('oReflectionObject')
                ->get_sValue()
                ->oView;
            // switch on InfoTool
            new \InfoTool\Model\Index ($oView);
        },
    ),
//    'mvc.controller.construct.after' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
//    'mvc.view.render.before' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
//    'mvc.view.renderString.before' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
//    'mvc.view.renderString.after' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
//    'mvc.view.render.after' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
//    'mvc.reflex.destruct.before' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
//    'mvc.controller.destruct.before' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
//    'mvc.application.construct.after' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
//    'mvc.application.destruct.before' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
    'mvc.helper.stop.after' => array(
        function (\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::write("\n\n*** STOP ***\n" . print_r($oDTArrayObject->get_akeyvalue()[0]->get_sValue(), true));
        }
    ),
//    'mvc.lock.create' => array(
//        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
//            \MVC\Log::write($oDTArrayObject, 'mvc.log');
//        }
//    ),
    'mvc.error' => array(
        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::write($oDTArrayObject, 'error.log');
        }
    ),
);


//-------------------------------------------------------------------------------------
// Frontend

/**
 * For further Rules Explanation @see https://content-security-policy.com/
 */
$aConfig['CONTENT_SECURITY_POLICY'] = array();

/**
 * Websites (URLs) which are allowed to embed our Site into e.g. a <frame>
 */
$aConfig['CONTENT_SECURITY_POLICY']['X-Frame-Options'] = "'none'";

$aConfig['CONTENT_SECURITY_POLICY']['Content-Security-Policy'] = ""

    /**
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/default-src
     */
    .   "default-src  'self'; "

    /**
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/script-src
     */
    .   "script-src   'self' " .
        "'unsafe-inline' " .
//        "http://cdnjs.cloudflare.com/ " .
//        "https://cdnjs.cloudflare.com/ " .
//        "http://cdn.jsdelivr.net/ " .
//        "https://cdn.jsdelivr.net/ " .
        "; "

    /**
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/style-src
     */
    .   "style-src    'self' " .
        "'unsafe-inline' " .
//        "http://cdnjs.cloudflare.com/ " .
//        "https://cdnjs.cloudflare.com/ " .
//        "http://cdn.jsdelivr.net/ " .
//        "https://cdn.jsdelivr.net/ " .
//        "http://fonts.googleapis.com/ " .
//        "https://fonts.googleapis.com/ " .
        "; "

    /**
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/img-src
     */
    .   "img-src      'self' " .
        "blob: " .
        "data: " .
        "; "

    /**
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/connect-src
     */
    .   "connect-src  'self'; "

    /**
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/font-src
     */
    .   "font-src     'self' " .
//        "http://cdnjs.cloudflare.com " .
//        "https://cdnjs.cloudflare.com " .
        "; "

    /**
     * To disallow all plugins, the object-src directive should be set to 'none' which will disallow plugins.
     * The plugin-types directive is only used if you are allowing plugins with object-src at all.
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/plugin-types
     */
    .   "object-src   'none'; "
    #. "plugin-types ;"

    /**
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/media-src
     */
    .   "media-src    'self'; "

    /**
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/child-src
     */
    .   "child-src    'self';"

    /**
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/sandbox
     */
    .   "sandbox      " .
        "allow-forms " .
        "allow-same-origin " .
        "allow-scripts " .
        "allow-popups " .
        "allow-modals " .
        "allow-orientation-lock " .
        "allow-pointer-lock " .
        "allow-presentation " .
        "allow-popups-to-escape-sandbox " .
        "allow-top-navigation; "

    /**
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/report-uri
     */
    .   "report-uri   /; "

    /**
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/form-action
     */
    .   "form-action  'self'; "

    /**
     * The HTTP Content-Security-Policy (CSP) frame-ancestors directive specifies valid parents
     * that may embed a page using <frame>, <iframe>, <object>, <embed>, or <applet>.
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/frame-ancestors
     */
    .   "frame-ancestors " . $aConfig['CONTENT_SECURITY_POLICY']['X-Frame-Options'] . "; "

    /**
     * frames
     * that may embed a page using <frame>, <iframe>, <object>, <embed>, or <applet>.
     */
    .   "frame-src 'self'; "

    //end
    ;

/**
 * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-XSS-Protection
 */
$aConfig['CONTENT_SECURITY_POLICY']['X-XSS-Protection'] = '1; mode=block';

/**
 * 63072000 for 24 months
 * @see https://support.servertastic.com/knowledgebase/article/http-strict-transport-security-php
 */
$aConfig['CONTENT_SECURITY_POLICY']['Strict-Transport-Security'] = 'max-age=63072000'; # 63072000 for 24 months


