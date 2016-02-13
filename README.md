Download [latest Release](https://github.com/gueff/myMVC/releases)

# myMVC
A tiny MVC Framework, written in PHP. Open Source and free of charge.
- Open Source
- MVC Structure, +Events, +Policies
- Smarty Template Engine
- PHP7 ready 
- Modular
- Expandable
- myMVC InfoTool: an integrated Debug-/Info-Toolbar (Frontend + Browser Console)

Website : https://www.mymvc.org/

# Installing myMVC

This is about how to set up and run a working application built with myMVC. 

## 1. Preliminary
**[Download](https://github.com/gueff/myMVC/releases) and extract** myMVC into your www folder (e.g.: `/var/www/myMVC/`), so that you finally get this structure:

- `/var/www/myMVC/application/`
- `/var/www/myMVC/modules/`
- `/var/www/myMVC/public/`
	
## 2. Auto Installer
You can choose how to install myMVC - either via command line or via browser.

### 2.a: Install via Command line
Open up a console, cd to your copy of myMVC: 

	cd /var/www/myMVC/public/
	
enter the following command to start Installation process:
	
	php index.php

The Auto-Installer will instantly begin to install all necessary files. (In case of errors, a text will prompt up showing details about what went wrong). 
	
### 2.b: Install via Browser

**It needs a webserver like Apache or Nginx** already set up, configured and running. 
If you don't like to setup and run a webserver like Apache or Nginx, **you can also run php's internal webserver**: 

	cd /var/www/myMVC/public/; php -S localhost:1969;

-	**Connect a domain** (not needed if you run php' internal webserver) to `/var/www/myMVC/public/` (ask google for how to set up a virtual host for [Apache](https://www.google.com/#q=apache+setup+virtual+host), [Nginx](https://www.google.com/#q=nginx+setup+virtual+host))

-	**Run the Auto-Installer** by calling that domain (or, if you run the php internal server: localhost:1969) in your browser. The Auto-Installer will instantly begin to install all necessary files. 
(In case of errors, a text will prompt up showing details about what went wrong). 
-	The Page will reload after **Installation succeeded** and you should see the myMVC Welcome Webpage.
