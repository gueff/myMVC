#!/bin/bash

MODULENAME="$(basename "$(pwd)")";
#-------------------

. publish.sh

MVC_APPLICATION_PATH='../../application';

echo "installing module libraries...";
php $MVC_APPLICATION_PATH/composer.phar --working-dir=./etc/config/$MODULENAME/ install;
echo "...done!";


