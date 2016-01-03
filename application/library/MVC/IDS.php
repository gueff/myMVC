<?php
/**
 * IDS.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVC
 */
namespace MVC;

/**
 * @
 */
use IDS\Init;
use IDS\Monitor;

/**
 * IDS
 */
class IDS
{
	/**
	 * tries to detect attacks via IDS monitor;
	 * If attack was detected, event 'mvc.ids.impact' will be run containing the result object
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct ()
	{
		Event::RUN ('mvc.ids.before');

		try
		{
			$oRequest = Request::getInstance ();
			$aRequest = $oRequest->getQueryArray ();

			$oIdsInit = Init::init (Registry::get ('MVC_IDS_CONFIG'));
			$oIdsInit->config['General']['base_path'] = Registry::get ('MVC_LIBRARY') . '/IDS/';
			$oIdsInit->config['Caching']['path'] = Registry::get ('MVC_CACHE_DIR');

			// start monitoring on requests
			$oIdsMonitor = new Monitor ($oIdsInit);
			$oIdsResult = $oIdsMonitor->run ($aRequest);
			
			// save to registry
			Registry::set('MVC_IDS_IMPACT', $oIdsResult);
			
			// report if threshold is reached
			if (filter_var ($oIdsResult->getImpact (), FILTER_VALIDATE_INT) >= $oIdsInit->config['General']['impactThreshold'])
			{
				Event::RUN ('mvc.ids.impact', $oIdsResult);
			}
		}
		catch (\Exception $oExc)
		{
			Event::RUN ('mvc.ids.execption', $oExc);
		}

		Event::RUN ('mvc.ids.after', $this);
	}
}
