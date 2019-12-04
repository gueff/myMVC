<?php

//-------------------------------------------------------------------------------------
// Module LCP

$aConfig['MODULE_{module}'] = array(

    /**
     * Module specific
     * Session Settings
     */
    'SESSION' => array(

        /**
         * Where to activate Session;
         * name Controllers
         */
        'aEnableSessionForController' => array(
            'Index',
        ),
    ),

    /**
     * Event Bindings
     */
    'EVENT_BIND' => array(

        /** @var \MVC\DataType\DTArrayObject $oDTArrayObject */
        'mvc.error' => function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::WRITE($oDTArrayObject->getDTKeyValueByKey('oException')->get_sValue()->getMessage(), 'error.log');
        },
        /** @var \MVC\DataType\DTArrayObject $oDTArrayObject */
        'mvc.invalidRequest' => function (\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::WRITE($oDTArrayObject);
        },
        /** @var \MVC\DataType\DTArrayObject $oDTArrayObject */
        'mvc.policy.apply.execute' => function (\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::WRITE($oDTArrayObject);
        },
        /** @var \MVC\DataType\DTArrayObject $oDTArrayObject */
        'mvc.application.destruct' => function (\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::WRITE($oDTArrayObject);
        },
        /** @var \MVC\DataType\DTArrayObject $oDTArrayObject */
        'mvc.helper.stop' => function (\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::WRITE("\n\n*** STOP ***\n" . print_r($oDTArrayObject->get_akeyvalue()[0]->get_sValue(), true));
        },
        /** @var \MVC\DataType\DTArrayObject $oDTArrayObject */
        'mvc.application.construct.done' => function (\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::WRITE($oDTArrayObject);
        },
        // get consent to set session cookie
        /** @var \MVC\DataType\DTArrayObject $oDTArrayObject */
        'mvc.setSession.begin' => function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \LCP\Event\Index::enableSession($oDTArrayObject);
        },
    )
);


//-------------------------------------------------------------------------------------
// Frontend

/**
 * get used in /modules/Blogimus/View/Index.php::sendSecurityHeader()
 * For further Rules Explanation @see https://content-security-policy.com/
 */
SECURITY_HEADER_CONFIG: {

    /**
     * Websites (URLs) which are allowed to embed our Site into e.g. a <frame>
     */
    $aConfig['CONTENT_SECURITY_FRAME_PARENTS'] = "'none'";
    $aConfig['CONTENT_SECURITY_POLICY'] = ""

        /**
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/default-src
         */
        . "default-src  'self'; "

        /**
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/script-src
         */
        . "script-src   'self' " .
        "'unsafe-inline' " .
        "; "

        /**
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/style-src
         */
        . "style-src    'self' " .
        "'unsafe-inline' " .
        "; "

        /**
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/img-src
         */
        . "img-src      'self' " .
        "blob: " .
        "data: " .
        "; "

        /**
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/connect-src
         */
        . "connect-src  'self'; "

        /**
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/font-src
         */
        . "font-src     'self' " .
        "; "

        /**
         * To disallow all plugins, the object-src directive should be set to 'none' which will disallow plugins.
         * The plugin-types directive is only used if you are allowing plugins with object-src at all.
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/plugin-types
         */
        . "object-src   'none'; "
        #. "plugin-types ;"

        /**
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/media-src
         */
        . "media-src    'self'; "

        /**
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/child-src
         */
        . "child-src    'self';"

        /**
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/sandbox
         */
        . "sandbox      " .
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
        . "report-uri   /; "

        /**
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/form-action
         */
        . "form-action  'self'; "

        /**
         * The HTTP Content-Security-Policy (CSP) frame-ancestors directive specifies valid parents
         * that may embed a page using <frame>, <iframe>, <object>, <embed>, or <applet>.
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/frame-ancestors
         */
        . "frame-ancestors " . $aConfig['CONTENT_SECURITY_FRAME_PARENTS'] . "; "
    ;

    /**
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-XSS-Protection
     */
    $aConfig['X_XSS_Protection'] = '1; mode=block';

    /**
     * 63072000 for 24 months
     * @see https://support.servertastic.com/knowledgebase/article/http-strict-transport-security-php
     */
    $aConfig['STRICT_TRANSPORT_SECURITY'] = 'max-age=63072000'; # 63072000 for 24 months
}

