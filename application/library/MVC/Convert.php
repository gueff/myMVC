<?php
/**
 * Convert.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
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
    public static function objectToArray(mixed $mObject) : array
    {
        if (true === is_object($mObject))
        {
            $mObject = (array) $mObject;
        }

        if (is_array($mObject))
        {
            $aNew = array();

            foreach ($mObject as $sKey => $mValue)
            {
                $sFirstChar = trim(substr(trim($sKey), 0, 1));

                if (('*' === $sFirstChar))
                {
                    $sKey = trim(substr(trim($sKey), 1));
                }

                $aNew[$sKey] = self::objectToArray($mValue);
            }
        }
        else
        {
            $aNew = (array) $mObject;
        }

        /** @var array $aNew */
        return $aNew;
    }
}