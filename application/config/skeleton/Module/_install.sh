#!/bin/bash

MODULENAME="$(basename "$(pwd)")";
#-------------------

unset MVC_ENV;
sFallbackMvcEnv="develop";

if [ -z ${MVC_ENV+x} ]; then
    echo "MVC_ENV has not been set yet.";
    echo "MVC_ENV will now be set to '$sFallbackMvcEnv'.";
    export MVC_ENV=$sFallbackMvcEnv;
else
    echo "MVC_ENV is set to '$MVC_ENV'";
fi

. publish.sh

MVC_APPLICATION_PATH='../../application';
echo "installing module libraries...";
php $MVC_APPLICATION_PATH/composer.phar --working-dir=./etc/config/$MODULENAME/ install;
echo "...done!";


