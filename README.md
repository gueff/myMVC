	README
	======

	myMVC
	    an open source MVC tiny framework
	    2014 by ueffing.net, info@ueffing.net
	    license: GNU GENERAL PUBLIC LICENSE Version 3


	Requirements
	    PHP >= 5.3
	        shell_exec

		write access for the www user
			/application
			/application/session
			/application/cache
			/application/log
			/application/templates_c


	Libraries via Composer Packages
		To install Libraries:		
			cd application;	
			php composer.phar self-update; php composer.phar install;

		Further Information about Composer / JSON Config File and Handling
			https://packagist.org/
			https://getcomposer.org/doc/01-basic-usage.md
			https://www.digitalocean.com/community/articles/how-to-install-and-use-composer-on-your-vps-running-ubuntu

		Libs
			Less
				http://leafo.net/lessphp/
				http://lessphp.gpeasy.com/#transitioning-from-leafolessphp

		Autoloading / PSR-0
			As of 2014-10-21 PSR-0 has been marked as deprecated		
			@see http://www.php-fig.org/psr/psr-0/


	Setup
	    Configurations
			main config
				/application/config/config.php
			custom config
				/config/*.php
			

	Usage
	    Request Examples
			http://{domain}
			http://{domain}/?m=index
			http://{domain}/?module=default&c=index&m=index

	    MVC
			GET Param "module"
			-   targets the Module Folder /modules/"module"

			GET Param "c"
			-   targets the Controller /modules/"module"/Controller/"c".php

			GET Param "m"
			-   targets a Method inside the requested /modules/"module"/Controller/"c".php

			GET Param "a"
				-	contains Arguments which will be given to the target method
					/modules/"module"/Controller/"c".php -> "m"
				-	Consider writing Arguments in JSON Syntax
		  
		Controller
			MVC_BEFORE
				Each Controller *must* have a method named "MVC_BEFORE" (see main config)
				which one is called by MVC_Application::__construct() in a very early stage.
				
				Examples
					Override the whitelisting behaviour of the request object:
						// Override the whitelisting
						MVC_Request::getInstance()->setWhitelistParams(array ( 
							'GET' => array ( 
								'module' => array ( 
									'regex' => '/[^a-zA-Z0-9]+/', 'length' => 50, ),
								'c' => array ( 'regex' => '/[^a-zA-Z0-9]+/', 'length' => 50, ), 
								'm' => array ( 'regex' => '/[^a-zA-Z0-9]+/', 'length' => 50, ), 
								'a' => array ( 'regex' => '/[^a-zA-Z0-9\\|\\:\\[\\]\\{\\},"\']+/', 'length' => 256, ), 
							), 
						))->saveRequest()->prepareQueryVarsForUsage ();

					Register Event Bindings
						MVC_Event::BIND ('mvc.invalidRequest', function() {
							header ('Location: /?module=default&c=index&m=index');
							exit ();
						});			

		Model

		View


	Registry
	    configuration is saved to the Registry and so systemwide available.
	    E.g. Access:
	        $sMvcBasePath = Zend_Registry::get('MVC_BASE_PATH');


	Events
		Event Names must be unique!
		Use an Event only once! (otherwise the event would be overwritten)

		BIND and RUN

			Bind to an Event
				MVC_Event::BIND ('mvc.session', function() {

					$oPackage = MVC_Event::$aPackage['mvc.session'];
					// see if there is a package relating to that event
					MVC_Helper::DISPLAY ($oPackage);
				});

			Run an Event
				MVC_Event::RUN ('mvc.session');

			Run an Event and deploy a Package which could be read inside the Bind/Closure
				MVC_Event::RUN ('mvc.session', $oPackage);

			Helper Methods
				Detect a Closure
					if (TRUE === filter_var (MVC_Helper::ISCLOSURE ($oPackage), FILTER_VALIDATE_BOOLEAN)) { .. }

				Call a Closure
					call_user_func ($oPackage)


		EventNames
	        in chronological order			
	            mvc.request.saved
	                request is saved as a klassvar to MVC_Request

	            mvc.request.prepared
	                request is prepared for usage

	            mvc.targetClassBeforeMethod
	                the "BEFORE" method inside the requested Controller has been run

	            mvc.session.before
	                function which creates the Session is entered, but a Session has not been build yet

	            mvc.session
	                Session Object is built and copied to the registry

	            mvc.ids.before
	                inside IDS constructor, nothing happened yet
	                this is called before any check is done

	            mvc.ids.impact
					An IDS Impact is noticed
					contains Monitor $oIdsResult

	            mvc.ids.execption
					An Execption inside IDS
					contains Exception $oException

	            mvc.ids.after
	                inside IDS constructor, checks have been run
	                then there may be a event:
	                -   mvc.ids.impact
	                -   mvc.ids.execption

				mvc.application.construct.finished

	            mvc.reflect.start

	            mvc.invalidRequest
	                    Request could not be handled

	            [..] Concrete Controller / User's Application

				mvc.view.echoOut.off
					disables the echo out of the rendered view template
					view listens here 

				mvc.view.echoOut.on
					enables the echo out of the rendered view template
					view listens here 

				mvc.view.render.before
					MVC_View render is called, but not rendered yet
					contains MVC_View object

				mvc.view.renderString.before
					MVC_View renderString is called, but not rendered yet
					contains string $sTemplateString

				mvc.view.renderString.after
					MVC_View renderString has been called, already rendered
					contains string $sTemplateString

				mvc.view.render.after
					MVC_View render has been called, already rendered
					contains MVC_View object

	            mvc.reflex.destruct
	                MVC_MVC_Reflex end of runtime reached

	            mvc.controller.destruct
					MVC_Controller end of runtime reached

	            mvc.application.destruct
					MVC_Application end of runtime reached

	            mvc.helper.stop
	                MVC_Helper::STOP method has been called.
					This Event is fired immediatly before the last command in that method, which is: exit();
						
			other
				mvc.error
					MVC_Event::RUN('mvc.error', 'hereby an error is reported: bla blub...');	
					Triggered Errors this way will be caught by MVC_Error class by default

	Helper
	    the helper class methods can be accessed from everywhere by simply call the static method.
	    e.g.: to show a debug window on the screen:
	    MVC_Helper::DEBUG('Hello World');

	    Logging
	        Standard
	            MVC_Helper::LOG('My Message');

	        Using an alternative Logfile
	            MVC_Helper::LOG('My Message', 'specialLogfile.log');

	IDS
		Test requests
			http://dev.mvc.de/Custom/?a='%20OR%201=1--		
			http://dev.mvc.de/Custom/?a=%22%3E%3C%27%3C%3E
			
		@see
			https://phpids.org/faq/


	Webserver
	    Apache 
	        myMVC is ready to work with a default Apache web server configuration. 
	        A .htacces file is already placed into the myMVC's webroot:

	            # Deactivate session auto start
	            # Required for Zend_Session
	            # @see http://framework.zend.com/manual/de/zend.session.advanced_usage.html
	            php_value session.auto_start 0

	            # activate rewrite Rules
	            RewriteEngine On

	            # prevent httpd from serving dotfiles (.htaccess, .svn, .git, etc.)
	            RedirectMatch 403 /\..*$

	            # Deny Hacktool Dfind
	            RewriteRule w00tw00t\.at\. - [F,L]

	            # pass-through files
	            RewriteCond %{REQUEST_FILENAME} !-f

	            # forward to index.php
	            RewriteRule .* index.php


	    Nginx 
	        You can use myMVC with Nginx and PHP with FPM SAPI. 
	        Here is a sample host configuration. It defines the bootstrap file and makes myMVC 
	        catch all requests to unexisting files, which allows us to have nice-looking URLs.

	        server {
	            set $host_path "/www/myMVC";
	            access_log  /www/myMVC/log/access.log  main;

	            server_name  mysite;
	            root   $host_path/htdocs;
	            set $myMVC_bootstrap "index.php";

	            charset utf-8;

	            location / {
	                index  index.html $myMVC_bootstrap;
	                try_files $uri $uri/ /$myMVC_bootstrap?$args;
	            }

	            location ~ ^/(application|modules) {
	                deny  all;
	            }

	            #avoid processing of calls to unexisting static files by myMVC
	            location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
	                try_files $uri =404;
	            }

	            # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
	            #
	            location ~ \.php {
	                fastcgi_split_path_info  ^(.+\.php)(.*)$;

	                #let myMVC catch the calls to unexising PHP files
	                set $fsn /$myMVC_bootstrap;
	                if (-f $document_root$fastcgi_script_name){
	                    set $fsn $fastcgi_script_name;
	                }

	                fastcgi_pass   127.0.0.1:9000;
	                include fastcgi_params;
	                fastcgi_param  SCRIPT_FILENAME  $document_root$fsn;

	                #PATH_INFO and PATH_TRANSLATED can be omitted, but RFC 3875 specifies them for CGI
	                fastcgi_param  PATH_INFO        $fastcgi_path_info;
	                fastcgi_param  PATH_TRANSLATED  $document_root$fsn;
	            }

	            # prevent nginx from serving dotfiles (.htaccess, .svn, .git, etc.)
	            location ~ /\. {
	                deny all;
	                access_log off;
	                log_not_found off;
	            }
	        }

	Routing
		configure your routing.json file to your needs.
		here is a basic example of how the routing.json could be defined.	

		{
				"/":			""
			,	"/404/":		"module=default&c=index&m=error404"
			,	"/@/":			"module=admin&c=index&m=index"
			,	"/@/Login/":	"module=admin&c=auth&m=login"
			,	"/@/Logout/":	"module=admin&c=auth&m=logout"
		}
		
		Some Example Explanations:
			Route			Module, Controller, Method, Parameters			Remark
			------------------------------------------------------------|--------------------
			"/":			""											|	if / is requested, the MVC_ROUTING_FALLBACK is called
																		|	which is, per default, 'module=default&c=index&m=fallback'
																		|
			"/404/":		"module=default&c=index&m=error404"			|	if /404/ is requested,
																		|	the following Method is called, so it exists:
																		|	Default_Controller_Index->error404()


	CLI Wrapper
		You can easily run any route via commandline; 
		just use the same path/query as in Frontend.
		take care to place the expression into single quotes !

		examples:
			$ php index.php '/'
			$ php index.php '/404/?a={"foo":"bar"}'
			$ php index.php '/@/Login/'


	myMVC manager
		you can use this tool to create or delete a module
		the file manager.php is strored in the root directory of this project

		Usage:
		$ php manager.php
