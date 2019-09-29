
# myMVC README

## myMVC
an open source MVC tiny framework since 2014 by ueffing.net, info [at] ueffing [dot] net.
license: GNU GENERAL PUBLIC LICENSE Version 3

## Requirements
    PHP >= 5.4
        shell_exec
        mbstring
            http://php.net/manual/en/mbstring.installation.php
        safe_mode_allowed_env_vars
            to enable to set MVC_ENV as an environment variable
            you may need to edit this php setting
            http://php.net/manual/en/function.putenv.php

    MVC_ENV set as environment variable (develop | test | live)
        this can be done in different ways:
        -	webserver (RECOMMENDED)
            -	public/.htaccess
                when using apache webserver (also see Section "Webserver")
            -	fastcgi_param  MVC_ENV production;
                wen using nginx webserver (also see Section "Webserver")
        -	setting a custom config entry inside config (not application/config)
            e.g.: create a file config/live.php. Inside this file you write:
                $aConfig['MVC_ENV'] = 'live';
            this custom config will even overwrite MVC_ENV var set by webserver.
            This is the way to go if you cannot however set webserver environments.
        -	export MVC_ENV=live;
            when using console (cli)

        once set, MVC_ENV can be accessed by
        -	getenv('MVC_ENV')
        -	\MVC\Registry::get('MVC_ENV')

    write access for the www user
        /application
        /application/session
        /application/cache
        /application/log
        /application/templates_c


Libraries via Composer Packages
    To install Libraries manually:
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

    ZF1 / ZF2
        Differences between 1 and 2
        http://blog.hock.in/2012/09/06/zf2-for-zf1-users-part-1/
        http://blog.hock.in/2012/09/12/zf2-for-zf1-users-part-2/


Setup
    Configurations
        main config
            /application/config/config.php

            you should *not* edit this config file.
            Instead, write a new *.php file
            (you can name that file as you like;
            it just has to be a php file with .php as suffix)
            and place it inside folder: /config/
            (caution: it is not /application/config/, but /config/)
            it will automatically be loaded.

            There you can extend or overwrite this config.

        custom config
            /config/*.php

            Any file in this directory which has suffix .php
            will be required automatically.
            This is the right place to extend or overwrite the default
            config, place policies and so on.




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
                    \MVC\Request::getInstance()->setWhitelistParams(array (
                        'GET' => array (
                            'module' => array (
                                'regex' => '/[^a-zA-Z0-9]+/', 'length' => 50, ),
                            'c' => array ( 'regex' => '/[^a-zA-Z0-9]+/', 'length' => 50, ),
                            'm' => array ( 'regex' => '/[^a-zA-Z0-9]+/', 'length' => 50, ),
                            'a' => array ( 'regex' => '/[^a-zA-Z0-9\\|\\:\\[\\]\\{\\},"\']+/', 'length' => 256, ),
                        ),
                    ))->saveRequest()->prepareQueryVarsForUsage ();

                Register Event Bindings
                    \MVC\Event::BIND ('mvc.invalidRequest', function() {
                        header ('Location: /?module=default&c=index&m=index');
                        exit ();
                    });

    Model

    View


Registry
    configuration is saved to the Registry and so systemwide available.
    E.g. Access:
        $sMvcBasePath = \MVC\Registry::get('MVC_BASE_PATH');


Events
            You can listen to Events in 2 ways:
            1. Event Names
            2. Class::method

            ----

            1. EventNames

                Event Names must be unique!
                Use an Event only once! (otherwise the event would be overwritten)

                BIND and RUN

                        Bind to an Event
                                \MVC\Event::BIND ('mvc.session', function() {

                                        $oPackage = \MVC\Event::$aPackage['mvc.session'];
                                        // see if there is a package relating to that event
                                        \MVC\Helper::DISPLAY ($oPackage);
                                });

                        Run an Event
                                \MVC\Event::RUN ('mvc.session');

                        Run an Event and deploy a Package which could be read inside the Bind/Closure
                                \MVC\Event::RUN ('mvc.session', $oPackage);

                        Helper Methods
                                Detect a Closure
                                        if (true === filter_var (\MVC\Helper::ISCLOSURE ($oPackage), FILTER_VALIDATE_BOOLEAN)) { .. }

                                Call a Closure
                                        call_user_func ($oPackage)


                EventNames
                in chronological order
                        The path shows where the event is going to be called (RUN)
                    mvc.request.saved
                        /application/library/MVC/Request.php
                        request is saved as a klassvar to \MVC\Request

                    mvc.request.prepared
                        /application/library/MVC/Request.php
                        request is prepared for usage

                    mvc.targetClassBeforeMethod.after
                        /application/library/MVC/Applicatilogon.php
                        the "BEFORE" method inside the requested Controller has been run

                    mvc.session.before
                        /application/library/MVC/Application.php
                        function which creates the Session is entered, but a Session has not been build yet

                    mvc.session
                        /application/library/MVC/Application.php
                        Session Object is built and copied to the registry

                            mvc.policy.before
                                /application/library/MVC/Policy.php

                            mvc.policy.after
                                /application/library/MVC/Policy.php

                    mvc.controller.before
                        /application/library/MVC/Controller.php

                    mvc.reflect.start
                        /application/library/MVC/Reflex.php

                            mvc.reflect.targetObject.before
                                /application/library/MVC/Reflex.php
                                contains the target Class as the already instanciated object
                                which for sure could be accessed
                                This event is called immediatly before the target method will be called

                            $sControllerClassName . '::' . $sMethod
                                /application/library/MVC/Reflex.php
                                e.g. "\Standard\Controller\Index::home"
                                run an event which KEY is
                                        Class::method
                                of the requested Target
                                and store the object of the target class within

                            mvc.reflect.targetObject.after
                                /application/library/MVC/Reflex.php
                                contains the target Class as the already instanciated object
                                which for sure could be accessed
                                This event is called immediatly after the target method was called

                    mvc.invalidRequest
                        /application/library/MVC/Controller.php
                        Request could not be handled

                    [..] Concrete Controller / User's Application
                    please see below, Point "2. Class::method"

                    mvc.view.echoOut.off
                        /application/library/MVC/View.php
                        disables the echo out of the rendered view template
                        view listens here

                    mvc.view.echoOut.on
                        /application/library/MVC/View.php
                        enables the echo out of the rendered view template
                        view listens here

                    mvc.view.render.before
                        /application/library/MVC/View.php
                        MVC_View render is called, but not rendered yet
                        contains MVC_View object

                    mvc.view.renderString.before
                        /application/library/MVC/View.php
                        MVC_View renderString is called, but not rendered yet
                        contains string $sTemplateString

                    mvc.view.renderString.after
                        /application/library/MVC/View.php
                        MVC_View renderString has been called, already rendered
                        contains string $sTemplateString

                    mvc.view.render.after
                        /application/library/MVC/View.php
                        MVC_View render has been called, already rendered
                        contains MVC_View object

                    mvc.reflex.destruct
                        /application/library/MVC/Reflex.php
                        MVC_MVC_Reflex end of runtime reached

                    mvc.controller.destruct
                        /application/library/MVC/Controller.php
                        MVC_Controller end of runtime reached

                    mvc.application.construct.finished
                        /application/library/MVC/Application.php

                    mvc.application.destruct
                        /application/library/MVC/Application.php
                        MVC_Application end of runtime reached

                    mvc.helper.stop
                        /application/library/MVC/Helper.php
                        \MVC\Helper::STOP method has been called.
                            This Event is fired immediatly before the last command in that method, which is: exit();

                    other
                        mvc.error
                            /application/library/MVC/Application.php
                            /application/library/MVC/Helper.php
                            /application/library/MVC/Policy.php
                            \MVC\Event::RUN('mvc.error', 'hereby an error is reported: bla blub...');
                            Triggered Errors this way will be caught by \MVC\Error class by default


            2. Class::method

                Using a Concrete Controller::method  of User's Application.
                Instead of an Event-Name to listen to you can always address a certain Method of a Controller.
                That gives you even more flexibility.
                Example:
                    If you want to listen to when the Method "\Standard\Controller\Index::home" is being called,
                    simply note the method as the event name.
                    Make sure to write it as the method was a static one, even it is not.

                    /*
                     * redirect if explicitly if the method "home" is requested
                     */
                    \MVC\Event::BIND ('\Standard\Controller\Index::home', function ($oObject)
                    {
                        \MVC\Request::REDIRECT('/');
                    });

Helper
    the helper class methods can be accessed from everywhere by simply call its static methods.
    e.g.: to show a debug window on the screen (or via CLI):
    \MVC\Helper::DISPLAY('Hello World');
    \MVC\Helper::DEBUG($myArray);

Logging
    Standard
        \MVC\Log::WRITE('My Message');

    Using an alternative Logfile
        \MVC\Log::WRITE('My Message', 'specialLogfile.log');

    All Log Entries show:
        -	Date and Time
        -	IP Address
        -	a uniqueID for the current Request
        -	the Session ID
        -	an increasing Counter for each log entry for the time Request is running
        -	the file and lineNr from where the log was called
        -	The Log Message

        Extra LogInfos for Events:
        -	"BIND"	with the Eventname and where the Event was called from.
        -	"RUN"	with the Eventname and where the Event was called from. No further logic is bonded to that Event actually
        -	"RUN+"	with the Eventname and where the Event was called from. In this case some logic was bonded to that event (via "BIND") and all bonded logics are listed in detail

    The Log method writes per default into /var/www/myMVC/application/log/default.log .
    Watching logs during developing is already helpful, so if you are on linux
    you can easily watch it like so:
    tail -f * /var/www/myMVC/application/log/


Policy
    Policy Rules are bonded to a specific Controller::Method

    Example:
    Create a file "/config/policy.php",
    Inside this file you define your policies:

    <?php

    $aConfig['MVC_POLICY'] = array(

        // The matching Class
        // (do no use leading slashes for Controller Names)
        'Standard\\Controller\\Index' => array(

            // the matching method
            'home' => array(

                    // What to call
                    // (do no use leading slashes for Controller Names)
                    'Standard\\Policy\\Example::test1'
                ,	'Standard\\Policy\\Example::test2'
            )
        )
    );

## Generator for DataType Classes `\MVC\Generator\DataType`

### Instantiation

_PHP auto detect compatible_
~~~php
$oDTGenerator = \MVC\Generator\DataType::create();
~~~

_PHP 5.3 compatible_
~~~php
$oDTGenerator = \MVC\Generator\DataType::create(53);
~~~

_PHP 7 and up compatible_
~~~php
$oDTGenerator = \MVC\Generator\DataType::create(7);
~~~

_PHP 7.3 compatible_
~~~php
$oDTGenerator = \MVC\Generator\DataType::create(73);
~~~

### Init with Config: Object
~~~php
$oDTGenerator = \MVC\Generator\DataType::create()->initConfigObject($oDTConfig);
~~~

#### Config `$oDTConfig`
~~~php
$oDTConfig = DTDataTypeGeneratorConfig::create()
    ->set_dir(Registry::get('MVC_MODULES') . '/Foo/DataType/')
    ->set_unlinkDir(false)
    ->add_DTClass(
        DTDataTypeGeneratorClass::create()
            ->set_name('DTFoo')
            ->set_file('DTFoo.php')
            ->set_namespace('Foo\DataType')
            ->add_DTProperty(DTDataTypeGeneratorProperty::create()->set_key('bSuccess')->set_var(DTDataTypeGeneratorProperty::BOOLEAN))
            ->add_DTProperty(DTDataTypeGeneratorProperty::create()->set_key('iId')->set_var(DTDataTypeGeneratorProperty::INTEGER))
    )
    ->add_DTClass(
        DTDataTypeGeneratorClass::create()
            ->set_name('DTBar')
            ->set_file('DTBar.php')
            ->set_namespace('Foo\DataType')
            ->add_DTProperty(DTDataTypeGeneratorProperty::create()->set_key('bSuccess')->set_var(DTDataTypeGeneratorProperty::BOOLEAN))
            ->add_DTProperty(DTDataTypeGeneratorProperty::create()->set_key('iId')->set_var(DTDataTypeGeneratorProperty::INTEGER))
    );
~~~

### Init with Config: array
~~~php
$oDTGenerator = \MVC\Generator\DataType::create()->initConfigArray($aDataTypeConfig);
~~~

#### Config `$aDataTypeConfig`

~~~php

/**
 * DataType Array
 */
$aConfig['MODULE_DATATYPE_CONFIG'] = array(

    // where to place the DataType Class Files.
    // folder will be created if not exists.
    'dir' => $aConfig['MVC_MODULES'] . '/Foo/DataType/',

    // remove dir and create for new each time config changes.
    // you may want this during development.
    // default is `false`, if not set here
    'unlinkDir' => false,

    // The Classes
    'class' => array(

        array(
            // ! mandatory
            'name' => 'DTFoo',
            'file' => 'DTFoo.php',

            // optional; no need to even note the key here if not used
            'extends' => '',

            // optional; no need to even note the key here if not used
            'namespace' => 'Foo\DataType',

            // optional; no need to even note the key here if not used
            'constant' => array(
                array('key' => 'FOO'                , 'value' => true, 'visibility' => 'protected')
            ),

            // ! mandatory
            'property' => array(
                array('key' => 'sKey'               , 'var' => 'string'),
                array('key' => 'deliverable'        , 'var' => 'int'),
                array('key' => 'aJsonContext'       , 'var' => 'array'),
                array('key' => 'bSuccess'           , 'var' => 'bool'),
                array('key' => 'DELETE_RESTRICT'    , 'var' => 'string', 'value' => ' ON DELETE RESTRICT '  , 'visibility' => 'public'),
            )
        ),
    )
);
~~~

### Hint
- use `bool`, not `boolean`
- use `int`, not `integer`

### Valid types
- https://www.php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration


___

## Cookie Consent
    Due to 2018-05-25 EU-wide GDPR law, it may make sense to get users cookie Consent before setting any session cookie.
    Since Rev. 71 (2018-05-27) there will be no session cookie set automatically, if there MVC_SESSION_ENABLE is NOT SET or has NOT VALUE set to TRUE.

    So. if you want to get session auto-started in MVC\Application::setSession() as it did before, you need to
    - either set MVC_SESSION_ENABLE in config to TRUE
    - or get users cookie consent

    Here is an example how to get a users cookie consent could be accomplished:

    In the target Class::__preconstruct()
    -OR better-
    In the target's Event-Class::__construct()
    place this Event Listener, which will check if 'mvc_cookieConsent' cookie was set.
    If so, the necessary value MVC_SESSION_ENABLE is written to the registry with the value of "true".

    Target Class Side
        /**
        * GDPR cookie consent
        */
        \MVC\Event::BIND ('mvc.session.before', function(){

            // get consent to set session cookie
            if (isset($_COOKIE['myMVC_cookieConsent']) && "true" == $_COOKIE['myMVC_cookieConsent'])
            {
                \MVC\Registry::set('MVC_SESSION_ENABLE', true);
            }
        });

    Frontend
        Now you need to place some JS Code to your HTML asking for cookie consent.
        If user agree, a cookie named "mvc_cookieConsent" with value of "true" is written as cookie to users browser.

        Example:

        <script>
        $( document ).ready(function() {

            // cookie consent
            if ('undefined' === typeof $.cookie('myMVC_cookieConsent')) {$('#myMVC_cookieConsent').fadeIn();}
            $('#myMVC_cookieConsent button').on('click', function(oEvent){
                if (true === $('#myMVC_cookieConsent input').is(':checked')) {
                    $.cookie('myMVC_cookieConsent', true, {expires: 365, path:"/"});
                    $('#myMVC_cookieConsent').fadeOut();
                }
            });
        });
        </script>



Webserver
    Apache
        myMVC is ready to work with a default Apache web server configuration.
        A ".htacces" file is already placed into the myMVC's webroot:

            ################################################################################
            #
            #   This file is for Apache Webserver only
            #   @see application/doc/README
            #
            ################################################################################

            # google pagespeed
            # see https://developers.google.com/speed/pagespeed/module/configuration
            #ModPagespeed on

            # Environment
            SetEnv MVC_ENV live

            # Deactivate session auto start
            php_value session.auto_start 0

            # activate rewrite Rules
            RewriteEngine On

            # prevent httpd from serving dotfiles (.htaccess, .svn, .git, etc.)
            RedirectMatch 403 /\..*$

            # pass-through files
            RewriteCond %{REQUEST_FILENAME} !-f

            # forward to index.php
            RewriteRule .* index.php



    Nginx
        You can use myMVC with Nginx and PHP with FPM SAPI.
        Here is a sample host configuration. It defines the bootstrap file and makes myMVC
        catch all requests to unexisting files, which allows us to have nice-looking URLs.

        server {
            set $host_path "/var/www/myMVC/trunk/public";
            access_log  /var/www/myMVC/trunk/application/log/access.log  main;

            server_name  dev.mymvc.de;
            root   $host_path/htdocs;
            set $myMVC_bootstrap "index.php";

            charset utf-8;

            location / {
                    index  index.html $myMVC_bootstrap;
                    try_files $uri $uri/ /$myMVC_bootstrap?$args;
            }

            location ~ ^/(application|modules|config) {
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
                    fastcgi_param  MVC_ENV			develop;
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
            "/":		{"query":""}
        ,	"/404/":	{"query":"module=default&c=index&m=error404"}
        ,	"/@/":		{"query":"module=admin&c=index&m=index"}
        ,	"/@/Login/":	{"query":"module=admin&c=auth&m=login"}
        ,	"/@/Logout/":	{"query":"module=admin&c=auth&m=logout"}
    }

    Some Example Explanations:
        Route			Module, Controller, Method, Parameters			Remark
        ------------------------------------------------------------------------|--------------------
        "/":			{"query":""}                                    |	if / is requested, the MVC_ROUTING_FALLBACK is called
                                            |	which is, per default, 'module=default&c=index&m=fallback'
                                            |
        "/404/":		{"query":"module=default&c=index&m=error404"}	|	if /404/ is requested,
                                            |	the following Method is called, so it exists:
                                            |	Default_Controller_Index->error404()


CLI Wrapper
            Requesting directly
                myMVC serves simple CLI Requests
                Allows calling via CLI without any need of a /route/ (see below "Requesting routes").
                Write Parameter separated by spaces.
                When adding JSON in `a`-parameter, encapsulate with single quote `'`
                Example:
                    $ export MVC_ENV="develop"; php index.php module=standard c=index m=index a='{"foo":"bar","baz":[1,2,3]}'

            Requesting routes
                You can easily run any route via commandline;
                just use the same path/query as in Frontend.
                take care to place the request expression into single quotes !

                examples:
                        $ export MVC_ENV="develop"; php index.php '/'
                        $ export MVC_ENV="develop"; php index.php '/about/'
                        $ export MVC_ENV="develop"; php index.php '/about/?a={"foo":"bar"}'


myMVC manager
    you can use this tool to create or delete a module
    the file manager.php is strored in the root directory of this project

    Usage:
    $ php manager.php




Composer Setup
Default
    {
        "require": {
            "php":
                    ">=5.4.0"
            ,
            "smarty/smarty":
                    ">=3.1.31"
            ,
            "ezyang/htmlpurifier":
                    "v4.9.3"
            ,
            "monolog/monolog":
                    "1.23.*"
            ,
            "gueff/cachix":"dev-master"
        },
        "require-dev": {
            "phpunit/phpunit":
                    "*",
            "facebook/webdriver":
                    "dev-master",
            "phpunit/phpunit-selenium":
                    "2.0.3"
        }
    }

Example: with ZF1
        {
            "require": {
                "php":
                        ">=5.4.0"
                ,
                "zendframework/zendframework1":
                        "1.12.*"
                ,
                "smarty/smarty":
                        ">=3.1.31"
                ,
                "ezyang/htmlpurifier":
                        "v4.9.3"
                ,
                "monolog/monolog":
                        "1.23.*"
                ,
                "gueff/cachix":"dev-master"
            },
            "require-dev": {
                "phpunit/phpunit":
                        "*",
                "facebook/webdriver":
                        "dev-master",
                "phpunit/phpunit-selenium":
                        "2.0.3"
            }
        }

Example: with ZF2
        {
            "repositories": [
                {
                    "type": "composer",
                    "url": "https://packages.zendframework.com/"
                }
            ],
            "require": {
                "php":
                        ">=5.4.0"
                ,
                "zendframework/zendframework":
                        "dev-master"
                ,
                "smarty/smarty":
                        ">=3.1.31"
                ,
                "ezyang/htmlpurifier":
                        "v4.9.3"
                ,
                "monolog/monolog":
                        "1.23.*"
                ,
                "gueff/cachix":"dev-master"
            },
            "require-dev": {
                "phpunit/phpunit":
                        "*",
                "facebook/webdriver":
                        "dev-master",
                "phpunit/phpunit-selenium":
                        "2.0.3"
            },
            "autoload": {
                "psr-0": {
                    "ZendX":
                        "vendor/zendframework/zendframework1/extras/library"
                }
            }
        }