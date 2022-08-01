<?php

// float numbers need to be presented C-style
setlocale(LC_NUMERIC, 'C');

/**
 * Idolon config
 */
$aConfig['MODULE_IDOLON'] = array(

    // Token
    // This is the string directly located after domain which indicates an image request
    // e.g. http://www.example.com/image/screenshot/png/200/100/1/
    // Here in this example, "image" ist the token
    // Note: Idolon will automatically listen for (/image/) then.
    '@image' => array(
        'IDOLON_IMAGE_PATH' => $aConfig['MVC_BASE_PATH'] . '/public/myMVC/images/',

        /** @new 2020-01-16 */
        'IDOLON_CACHE_PATH' => $aConfig['MVC_CACHE_DIR'] . '/Idolon/',
//        'IDOLON_MAX_CACHE_FILES_FOR_IMAGE' => 10,
//        'IDOLON_PREVENT_OVERSIZING' => true,
    ),

//    // Lowell Images
//    '@lowell' => array(
//        'IDOLON_IMAGE_PATH' => $aConfig['MVC_BASE_PATH'] . '/public/assets/lowell/images/',
////        'IDOLON_MAX_CACHE_FILES_FOR_IMAGE' => 10,
////        'IDOLON_PREVENT_OVERSIZING' => true,
//    ),

    // how many variations of an image should be stored for maximum
    'IDOLON_MAX_CACHE_FILES_FOR_IMAGE' => 3,

    /**
     * if activated,
     * an image cannot resize to higher values than its dimensions, but only to lower ones
     * true: prevents resizing to higher x or y values than original has
     */
    'IDOLON_PREVENT_OVERSIZING' => true,
);

