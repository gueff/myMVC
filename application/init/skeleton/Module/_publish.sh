#!/bin/bash

MODULENAME="$(basename "$(pwd)")";
sHerePublish=`pwd`;

#------------------------------------------------------------

cd "$sHerePublish";
/bin/echo "copying public Data...";

# copy
/bin/cp -r ./etc/_INSTALL/public/*			../../public/

/bin/echo "...done!";