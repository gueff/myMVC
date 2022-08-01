# Idolon Module for myMVC
Just add this module to your [myMVC](https://github.com/gueff/myMVC) and get it run with this 3 Steps:

This is a Module for [myMVC](https://github.com/gueff/myMVC) which integrates the Idolon Image Server (https://github.com/gueff/idolon). Image Variation Requests become very easy.

## Dependencies
- Linux
- php 7
    - execution of `shell_exec()`
- imagemagick
- gueff/idolon 1.1.0
- [myMVC > 1.1.1 (current; dev-master)](https://github.com/gueff/myMVC)
    - ZIP: https://github.com/gueff/myMVC/archive/master.zip
      
       
## 1. Download this Repository
and place it inside myMVC's `modules` folder.
Name it "Idolon". At the end it must look like this:
~~~
    application
    config
    modules
        Idolon
            Controller
            etc
            Event
            Model
            install.sh
            README.md
    public
    composer.json
    myMVC.phar
    README.md
~~~

## 2. Add Idolon Library
therefore, run install.sh
~~~bash
./install.sh
~~~

## 3. Add Idolon Config
### 3.1. create a new config file
Just create a new file by copying the file `etc/config/Idolon/config/develop.example` to `etc/config/Idolon/config/develop.php` 

### 3.2. Modify the config
Modify the config so that it fit your needs.

**This is the Content of the Config file `idolon.php`**

~~~
// float numbers need to be presented C-style
setlocale(LC_NUMERIC, 'C');

/**
 * Idolon config
 */
$aConfig['MODULE_IDOLON'] = array(

    // Token
    // This is the string directly located after domain which indicates an image request
    // e.g. http://www.example.com/image/screenshot/png/200/100/1/
    // Here in this example, "@image" ist the token
    // Note: Idolon will automatically listen for (/@image/) then.
    '@image' => array(
        'IDOLON_IMAGE_PATH' => $aConfig['MVC_BASE_PATH'] . '/public/images/default/',
        'IDOLON_CACHE_PATH' => $aConfig['MVC_CACHE_DIR'] . '/Idolon/',
//        'IDOLON_MAX_CACHE_FILES_FOR_IMAGE' => 10,
//        'IDOLON_PREVENT_OVERSIZING' => true,
    ),

    // Other Images
    '@other' => array(
        'IDOLON_IMAGE_PATH' => $aConfig['MVC_BASE_PATH'] . '/public/images/other/',
        'IDOLON_CACHE_PATH' => $aConfig['MVC_CACHE_DIR'] . '/Idolon/',
//        'IDOLON_MAX_CACHE_FILES_FOR_IMAGE' => 10,
//        'IDOLON_PREVENT_OVERSIZING' => true,
    ),

    // how many variations of an image should be stored for maximum
    'IDOLON_MAX_CACHE_FILES_FOR_IMAGE' => 10,

    /**
     * if activated,
     * an image cannot resize to higher values than its dimensions, but only to lower ones
     * true: prevents resizing to higher x or y values than original has
     */
    'IDOLON_PREVENT_OVERSIZING' => true,
);
~~~



## 4. Activate Idolon via Event Listener

just add a listener to the `EVENT_BIND` section of your Module Config.
~~~
$aConfig['MODULE_whatever'] = array(

    /**
     * Event Bindings
     */
    'EVENT_BIND' => array(

        /**
         * Idolon Image Handler
         * Listen on a specific Token in QueryPath
         */
        'mvc.controller.construct.before' => array(
            function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
                \Idolon\Event\Index::startIdolon($oDTArrayObject);
            }
        ),
    );
~~~

## Example
Due to the Config, this will serve the Image `screenshot1.png` from the public folder `/images/` with 750x352 px:
~~~
<!-- request image with original width + heigt -->
<img src="http://www.example.com/@image/screenshot1/png/">

<!-- request image with width of 750px; height will be calculated -->
<img src="http://www.example.com/@image/screenshot1/png/750/">

<!-- request image with width of 750px and height of 352px; redirect with proper dimension request if necessary -->
<img src="http://www.example.com/@image/screenshot1/png/750/300/1/">
~~~

### Explanation
- The Request `http://www.example.com/@image/screenshot1/png/750/352/1/`is made.
- The Event Listener (`\MVC\Event::BIND('mvc.controller.before', function(){..}`) checks the current Request.
- If the first string after the domain is `@image` this means an image request has been detected.
- So in this Example, the Request `http://www.example.com/@image/screenshot1/png/750/352/1/` will be handled by Idolon Module.


