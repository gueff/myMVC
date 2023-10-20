#!/bin/bash

MODULENAME="$(basename "$(pwd)")";
sHere=`pwd`;
sModuleDir=`realpath "../../modules/"`;
xPhp=`type -p php`;
xGit=`type -p git`;
/usr/bin/clear;

# read .env
. ../../.env;

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

cd "$sHere";
cd ../../;
$xPhp emvicy.php up;

#------------------------------------------------------------
# generate DTClasses

cd "$sHere";
cd ./etc/config/DataType/;
$xPhp *.php;

#------------------------------------------------------------
# done

cd "$sHere";
/bin/echo "...done!";

