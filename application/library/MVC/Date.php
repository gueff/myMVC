<?php
/**
 * Date.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
 */

namespace MVC;

class Date
{
    /**
     * checks if a requested value equals to the requested date format
     * @example var_dump(MVC\Date::validateDate('2022-10-09', 'Y-m-d')); # true
     * @credits https://www.php.net/manual/en/function.checkdate.php#113205
     * @param mixed $mValue
     * @param string $sFormat default='Y-m-d H:i:s'
     * @return bool
     */
    public static function validateDate($mValue, string $sFormat = 'Y-m-d H:i:s')
    {
        $oDateTime = \DateTime::createFromFormat($sFormat, $mValue);
        return $oDateTime && $oDateTime->format($sFormat) == $mValue;
    }

    /**
     * gives the week number of the requested simplified ISO Date (Y-m-d)
     * @param string $sDateIso | empty=current day
     * @return int week number (KW)
     * @throws \Exception
     */
    public static function getWeekNumberOnIsoDate($sDateIso = '')
    {
        ('' === $sDateIso) ? $sDateIso = date('Y-m-d') : false;
        $oDateTime = new \DateTime($sDateIso);
        $iWeekNumber = (int) $oDateTime->format("W");

        return $iWeekNumber;
    }

    /**
     * gives the amount of week numbers of the requested year (YYYY)
     * @param int $iYear
     * @return int amount week numbers
     */
    public static function getAmountOfWeekNumbersOfYear($iYear = 0)
    {
        $iYear = (0 === $iYear) ? date('Y') : (int) $iYear;

        $iAmountWeekNumberOfYear = (int) idate('W', mktime(0, 0, 0, 12, 28, $iYear));

        return $iAmountWeekNumberOfYear;
    }

    /**
     * checks if a simplified ISO-date (Y-m-d) lays in between two other simplified ISO-Dates (Y-m-d)
     * @param string $sDateIsoRangeStart
     * @param string $sDateIsoRangeEnd
     * @param string $sDateIso
     * @return bool
     */
    function dateIsBetween2Dates($sDateIsoRangeStart = '', $sDateIsoRangeEnd = '', $sDateIso = '')
    {
        // Fallback: today
        ('' === $sDateIso) ? $sDateIso = date('Y-m-d', strtotime(date('Y-m-d'))) : false;
        ('' === $sDateIsoRangeStart) ? $sDateIsoRangeStart = date('Y-m-d', strtotime(date('Y-m-d'))) : false;
        ('' === $sDateIsoRangeEnd) ? $sDateIsoRangeEnd = date('Y-m-d', strtotime(date('Y-m-d'))) : false;

        if (($sDateIso >= $sDateIsoRangeStart) && ($sDateIso <= $sDateIsoRangeEnd))
        {
            return true;
        }

        return false;
    }
}