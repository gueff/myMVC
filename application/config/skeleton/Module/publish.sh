#!/bin/bash

MODULENAME="$(basename "$(pwd)")";
#-------------------





echo "copying public Data...";
cp -r ./_INSTALL/public/*			../../public/
echo "...done!";
