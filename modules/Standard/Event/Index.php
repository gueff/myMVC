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
 * @name $StandardEvent
 */
namespace Standard\Event;

/**
 * Index
 */
class Index
{

	/**
	 * Standard\Event\Index
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
	protected function __construct ()
	{
		/*
		 *  this is not bonded to an event, instead it is executed directly
		 */
		\MVC\Request::ENSURECORRECTPROTOCOL ();

		/*
		 * What to do on invalid requets
		 */
		\MVC\Event::BIND ('mvc.invalidRequest', function() {
			
			\MVC\Request::REDIRECT ('/');
		});

//		/*
//		 * Example:
//		 * redirect if explicitly the method "home" is requested
//		 */
//		\MVC\Event::BIND ('\Standard\Controller\Index::home', function ($oObject)
//		{
//			// e.g. call "fallback" instead (Re-Route)
//			$oObject->fallback();
//			exit();
//		});
		
		/*
		 * What to do if IDS detects an impact
		 */
		\MVC\Event::BIND ('mvc.ids.impact', function($oIdsReport) {

			// dispose infected Variables mentioned in report
			\MVC\IDS::dispose($oIdsReport);
		});
		
		/*
		 * switch on the debug toolbar in develop environment
		 * immediatly after the target class/method was called
		 */
		if ('develop' === \MVC\Registry::get('MVC_ENV'))
		{
			\MVC\Event::BIND ('mvc.reflect.targetObject.after', function ($oObject)
			{
				// switch on ToolBar
				new \InfoTool\Model\Index ($oObject->oStandardViewIndex);
			});
		}
		
		/*
		 * We want to log the end of the request
		 */
		\MVC\Event::BIND ('mvc.application.destruct', function () {
			
			\MVC\Log::WRITE (str_repeat('*', 25) . "\t" . 'End of Request' . str_repeat ("\n", 6));
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
	public function __destruct ()
	{
		;
	}

}
