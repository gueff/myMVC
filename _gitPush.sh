#!/bin/bash

sRepository="gueff/myMVC";
sGitUser="gueff";
sGitToken="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";
sBranch="2.x";

#--------------------

# update phanlist
. _phanlistcreate.sh

git remote set-url origin "https://$sGitUser:$sGitToken@github.com/$sRepository"

# update
git pull;
git add -A;

# commit
git commit -m "update";
git push origin "$sBranch";
