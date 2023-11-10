<?php
/**
 * Date.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
 */

namespace MVC;

class Date
{
    /**
     * checks if a requested value equals to the requested date format
     * @example var_dump(MVC\Date::validateDate('2022-10-09', 'Y-m-d')); # true
     * @credits https://www.php.net/manual/en/function.checkdate.php#113205
     * @param string  $sValue
     * @param string $sFormat default='Y-m-d H:i:s'
     * @return bool
     */
    public static function validateDate(string $sValue, string $sFormat = 'Y-m-d H:i:s') : bool
    {
        $oDateTime = \DateTime::createFromFormat($sFormat, $sValue);
        return $oDateTime && $oDateTime->format($sFormat) == $sValue;
    }

    /**
     * gives the week number of the requested simplified ISO Date (Y-m-d)
     * @param string $sDateIso | empty=current day
     * @return int week number (KW)
     * @throws \Exception
     */
    public static function getWeekNumberOnIsoDate(string $sDateIso = '') : int
    {
        if ('' === $sDateIso)
        {
            $sDateIso = date('Y-m-d');
        }

        $oDateTime = new \DateTime($sDateIso);

        return (int) $oDateTime->format("W");
    }

    /**
     * gives the amount of week numbers of the requested year (YYYY)
     * @param int $iYear
     * @return int amount week numbers
     */
    public static function getAmountOfWeekNumbersOfYear(int $iYear = 0) : int
    {
        $iYear = (0 === $iYear) ? date('Y') : $iYear;

        return (int) idate('W', mktime(0, 0, 0, 12, 28, $iYear));
    }

    /**
     * checks if a simplified ISO-date (Y-m-d) lays in between two other simplified ISO-Dates (Y-m-d)
     * @param string $sDateIsoRangeStart
     * @param string $sDateIsoRangeEnd
     * @param string $sDateIso
     * @return bool
     */
    public static function dateIsBetween2Dates(string $sDateIsoRangeStart = '', string $sDateIsoRangeEnd = '', string $sDateIso = '') : bool
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