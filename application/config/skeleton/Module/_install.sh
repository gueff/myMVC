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

# myMVC_module_DB
/usr/bin/git clone --branch 3.3.x \
https://github.com/gueff/myMVC_module_DB.git \
DB;

#OpenApi;
/usr/bin/git clone --branch 1.1.x \
https://github.com/gueff/myMVC_module_OpenApi.git \
OpenApi;

# myMVC_module_Idolon
/usr/bin/git clone --branch 2.0.x \
https://github.com/gueff/myMVC_module_Idolon.git \
Idolon;

# myMVC_module_Email
/usr/bin/git clone --branch 1.3.x \
https://github.com/gueff/myMVC_module_Email.git \
Idolon;

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

