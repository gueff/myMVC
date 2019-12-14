#!/bin/bash

MODULENAME="$(basename "$(pwd)")";
#-------------------





echo "copying public Data...";
cp -r ./etc/_INSTALL/public/*			../../public/
echo "...done!";
