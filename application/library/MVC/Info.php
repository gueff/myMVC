<?php
/**
 * Info.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

class Info
{
    /**
     * @var array
     */
    public static $aData = array();

    public static function add(string $sName = 'info', mixed $mData = null, mixed $mContext = null)
    {
        $aData = func_get_args();
        #$aData[] = debug_backtrace();

        self::$aData[$sName][] = $aData;
    }

    public static function get(string $sName = '')
    {
        return get(self::$aData[$sName]);
    }
}