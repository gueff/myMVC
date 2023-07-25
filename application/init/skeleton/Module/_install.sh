#!/bin/bash

MODULENAME="$(basename "$(pwd)")";
sHere=`pwd`;
sModuleDir=`realpath "../../modules/"`;
xPhp=`type -p php`;
/usr/bin/clear;

# read .env
. ../../public/.env;

#------------------------------------------------------------
# install further modules

cd "$sHere";
cd "$sModuleDir";

#...

#------------------------------------------------------------
# public files
cd "$sHere";
. _publish.sh

#------------------------------------------------------------
# init

cd "$sHere";
cd ../../public/;
$xPhp index.php;

#------------------------------------------------------------
# generate DTClasses

cd "$sHere";
cd ./etc/config/DataType/;
$xPhp *.php;

#------------------------------------------------------------
# done

cd "$sHere";
/bin/echo "...done!";

