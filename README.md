# myMVC
A tiny MVC Framework, written in PHP. Open Source and free of charge.
- Open Source
- MVC Structure, +Events, +Policies
- Smarty Template Engine
- PHP7 ready 
- Modular
- Expandable
- myMVC InfoTool: an integrated Debug-/Info-Toolbar (Frontend + Browser Console)

Website : https://mymvc.ueffing.net/

# Installing myMVC

## Installing via command line (preferred)

e.g. for a `develop` Environment

    $ export MVC_ENV="develop"; svn co https://github.com/gueff/myMVC.git/trunk/ myMVC; cd myMVC/public; php index.php

The Auto-Installer will instantly begin to install all necessary files. (In case of errors, a text will prompt up showing details about what went wrong). 

## Installing via Browser

**[Download](https://github.com/gueff/myMVC/releases) and extract** myMVC into your www folder (e.g.: `/var/www/myMVC/`), so that you finally get this structure:

- `/var/www/myMVC/application/`
- `/var/www/myMVC/modules/`
- `/var/www/myMVC/public/`

run php's internal webserver:

    cd /var/www/myMVC/public/; php -S localhost:1969;

Call `localhost:1969` in your browser. 

The Auto-Installer will instantly begin to install all necessary files (In case of errors, a text will prompt up showing details about what went wrong). The Page will reload after Installation has succeeded and you should see the myMVC Welcome Webpage.

## Run
run php's internal webserver:

    cd /var/www/myMVC/public/; php -S localhost:1969;

Call `localhost:1969` in your browser. 

## Usage

see https://github.com/gueff/myMVC/blob/master/application/doc/README.md
