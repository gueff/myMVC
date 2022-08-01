#!/bin/bash

MODULENAME="$(basename "$(pwd)")";
#-------------------



MVC_APPLICATION_PATH='../../application';
echo "installing libraries...";
php $MVC_APPLICATION_PATH/composer.phar --working-dir=./etc/config/$MODULENAME/ install;
echo "...done!";


