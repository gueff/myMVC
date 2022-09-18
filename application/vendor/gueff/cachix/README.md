# Cachix
A simple PHP Caching Class working with files

## Requirements
- PHP 7
- Linux commands `rm`, `find` and `grep` to be executable via PHP's `shell_exec` command

## Installation
create the composer.json file with following content:
~~~
{
    "require": {
        "gueff/cachix":"1.0.0"
    }
}
~~~

run installation
~~~
$ composer install
~~~

## Usage

~~~php
<?php

// init Config
\Cachix::init(array(
    'bCaching' => true,
	'sCacheDir' => '/tmp/',
	'iDeleteAfterMinutes' => 10,
	'sBinRemove' => '/bin/rm',
	'sBinFind' => '/usr/bin/find',
	'sBinGrep' => '/bin/grep'
));

// build a Cache-Key
$sKey = 'myCacheKey.Token';

// autodelete cachefiles
// which contain the string ".Token" in key-names
\Cachix::autoDeleteCache('.Token');

// first time saving data to cache...
if (empty(\Cachix::getCache($sKey)))
{
    // Data to be cached
    $aData = ['foo' => 'bar'];
    
    \Cachix::saveCache(
       	$sKey,
     	$aData
    );
}
// ...or read from existing Cache
else
{
    $aData = \Cachix::getCache($sKey);
}
~~~
