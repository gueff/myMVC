<?php
/**
 * Index.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name ${module}Event
 */
namespace {module}\Event;

/**
 * Index
 */
class Index
{
	/**
	 * {module}\Event\Index
	 * 
	 * @var {module}\Event\Index
	 * @access private
	 * @static
	 */
	private static $_oInstance = NULL;
	
	/**
	 * Constructor
	 * 
	 * @access protected
	 * @return void
	 */
	protected function __construct()
	{
		// this is not bonded to an event, instead it is executed directly
		\MVC\Helper::ENSURECORRECTPROTOCOL();

		\MVC\Event::BIND('mvc.ids.impact', function($mPackage) {
			\MVC\Log::WRITE($mPackage, 'ids.log');
		});

		\MVC\Event::BIND('mvc.invalidRequest', function() {
			\MVC\Request::REDIRECT('/');
		});
	}

	/**
	 * Singleton instance
	 *
	 * @access public
	 * @static
	 * @return {module}\Event\Index
	 */
	public static function getInstance ()
	{
		if (null === self::$_oInstance)
		{
			self::$_oInstance = new self ();
		}

		return self::$_oInstance;
	}	
	
	/**
	 * prevent any cloning
	 * 
	 * @access private
	 * @return void
	 */
	private function __clone ()
	{
		;
	}
	
	/**
	 * Destructor
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct()
	{
		;
	}
}
 
