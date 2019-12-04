#!/bin/bash

MODULENAME="$(basename "$(pwd)")";
#-------------------



MVC_APPLICATION_PATH='../../application';

echo "removing public Data...";
rm -rf	../../public/$MODULENAME*
echo "...done!";


