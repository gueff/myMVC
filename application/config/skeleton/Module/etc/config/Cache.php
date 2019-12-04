<?php

//-------------------------------------------------------------------------------------
// vendor Cachix

$aConfig['CACHIX_CONFIG'] = array(

    'bCaching' => true,
    'sCacheDir' => $aConfig['MVC_CACHE_DIR'],
    'iDeleteAfterMinutes' => 1440,
    'sBinRemove' => '/bin/rm',
    'sBinFind' => '/usr/bin/find',
    'sBinGrep' => '/bin/grep'

);
