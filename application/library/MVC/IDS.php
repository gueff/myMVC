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
	 * If attack was detected, event 'mvc.ids.impact' will be run containing the Report object
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
			$oIdsReport = $oIdsMonitor->run ($aRequest);
			
			// save to registry
			Registry::set('MVC_IDS_INIT', $oIdsInit);
			Registry::set('MVC_IDS_IMPACT', $oIdsReport);
			
			// impact is given and threshold is reached
			if	(
						!$oIdsReport->isEmpty() 
					&&	filter_var($oIdsReport->getImpact(), FILTER_VALIDATE_INT) >= $oIdsInit->config['General']['impactThreshold']
				)
			{
				\MVC\Log::WRITE("WARN\t" . self::getReport ($oIdsReport), 'ids.log');
				Event::RUN ('mvc.ids.impact', $oIdsReport);
			}
			// threshold not reached but an impact is given
			elseif(!$oIdsReport->isEmpty())
			{
				\MVC\Log::WRITE("INFO\t" . self::getReport ($oIdsReport), 'ids.log');
			}			
		}
		catch (\Exception $oExc)
		{
			Event::RUN ('mvc.ids.execption', $oExc);
		}

		Event::RUN ('mvc.ids.after', $this);
	}
	
	/**
	 * get Report String from Report Object
	 * 
	 * @param \IDS\Report $oIdsReport
	 * @access public
	 * @static
	 * @return string
	 */
	public static function getReport(\IDS\Report $oIdsReport)
	{
		$sReport = '';
		$sReport.= 'Total impact: ' . $oIdsReport->getImpact() . "\n";
		$sReport.= 'Affected tags: ' . implode(', ', $oIdsReport->getTags()) . "\n";

		foreach ($oIdsReport->getIterator () as $oEvent)
		{
			$sReport.= 'Variable: ' . $oEvent->getName () . '|';
			$sReport.= 'Value: ' . htmlentities($oEvent->getValue ()) . "\n";
			$sReport.= 'Impact: ' . $oEvent->getImpact () . ' | ';
			$sReport.= 'Tags: ' . implode (', ', $oEvent->getTags ()) . "\n";

			foreach ($oEvent as $oFilter)
			{
				$sReport.= 'Description: ' . $oFilter->getDescription () . ' | ';
				$sReport.= 'Tags: ' . implode (', ', $oFilter->getTags ()) . "\n";
			}
		}	
		
		return $sReport;
	}
	
	/**
	 * dispose affected Variables
	 * 
	 * @param \IDS\Report $oIdsReport
	 * @access public
	 * @static
	 */
	public static function dispose(\IDS\Report $oIdsReport)
	{
		$aName = array();
		$aDisposed = array();
		
		// get Name of Variables
		foreach ($oIdsReport->getIterator() as $oEvent )
		{
			$aName[] = $oEvent->getName();
		}	

		// iterate infected and dispose those
		foreach ($aName as $sName)
		{
			// get Type and Key
			$aType = explode('.', $sName);
			$sType = (isset($aType[0])) ? $aType[0] : '';
			$sKey = (isset($aType[1])) ? $aType[1] : '';
			$aAffected = (isset($GLOBALS['_' . $sType][$sKey])) ? $GLOBALS['_' . $sType][$sKey] : array();

			if (!empty($aAffected))
			{
				if ('GET' == $sType)
				{
					if (isset($_GET[$sKey]))
					{
						$_GET[$sKey] = null;
						unset($_GET[$sKey]);
					}
				}
				if ('POST' == $sType)
				{
					if (isset($_POST[$sKey]))
					{
						$_POST[$sKey] = null;
						unset($_POST[$sKey]);
					}
				}
				if ('COOKIE' == $sType)
				{
					if (isset($_COOKIE[$sKey]))
					{
						$_COOKIE[$sKey] = null;
						unset($_COOKIE[$sKey]);
					}
				}	

				$aDisposed[] = $sType . '[' . $sKey . ']';
				\MVC\Log::WRITE("INFO\tdisposed: " . $sType . '[' . $sKey . ']', 'ids.log');
				
				// overwrite
				$oRequest = Request::getInstance ();
				$oRequest->saveRequest();
			}		
		}
		
		\MVC\Registry::set('MVC_IDS_DISPOSED', $aDisposed);
	}
}
