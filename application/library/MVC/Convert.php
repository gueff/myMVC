<?php
/**
 * Convert.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

class Convert
{
    /**
     * converts an object into array
     * @param mixed $mObject
     * @return array
     */
    public static function objectToArray($mObject)
    {
        (is_object($mObject))
            ? $mObject = (array)$mObject
            : false;

        if (is_array($mObject))
        {
            $aNew = array();

            foreach ($mObject as $sKey => $mValue)
            {
                $sFirstChar = trim(substr(trim($sKey), 0, 1));
                (('*' === $sFirstChar))
                    ? $sKey = trim(substr(trim($sKey), 1))
                    : false;
                $aNew[$sKey] = self::objectToArray($mValue);
            }
        }
        else
        {
            $aNew = $mObject;
        }

        return $aNew;
    }
}