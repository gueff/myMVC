# Idolon
A PHP Image Server

Idolon is a PHP Image Server that can be used to get variations of your original images. Idolon resizes on the fly, serves the resized result directly and also saves the result.

## Requirements
- PHP 7
- imagemagick's convert Method
    - therefore, get imagemagick installed on your Operating System
    - e.g. Linux:  `$ sudo apt-get install imagemagick`
    - @see https://www.imagemagick.org/script/index.php, https://github.com/ImageMagick/ImageMagick

## Installation
create the composer.json file with following content:
~~~
{
    "require": {
        "gueff/idolon":"1.1.0"
    }
}
~~~

run installation
~~~
$ composer install
~~~

## Usage

Frontend HTML
~~~
<!DOCTYPE html>
<html lang="en">
    <head></head>
    <body>
    
        <!-- request an image with width 250px -->        
        <img src="example.php?i=example.jpg&x=250">
        
    </body>
</html>
~~~

Backend example.php
~~~php
<?php

// Idolon Class
require_once 'Idolon.php';

$oIdolon = new \Idolon();
$oIdolon
    ->setImagePath(/path/to/my/image/folder/)
    ->serve();
~~~

**see example folder**
