<?php
/**
 * Lock.php
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

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;

/**
 * Class Lock
 * @package MVC
 */
class Lock
{
    /**
     * @param string $sKey
     * @param bool $bReturn
     * @return bool
     * @throws \ReflectionException
     */
    public static function create($sKey = '', $bReturn = false)
    {
        $aBacktrace = Helper::PREPAREBACKTRACEARRAY(debug_backtrace());
        $sCacheDir = (true === Registry::isRegistered('MVC_CACHE_DIR')) ? Registry::get('MVC_CACHE_DIR') : false;
        (false === file_exists($sCacheDir)) ? $sCacheDir = sys_get_temp_dir() : false;

        $sPrefix = preg_replace('/[^\\pL\d_]+/u', '-', $sKey);
        $sPrefix = trim($sPrefix, "-");
        $sPrefix = iconv('utf-8', "us-ascii//TRANSLIT", $sPrefix);
        $sPrefix = strtolower($sPrefix);
        $sPrefix = preg_replace('/[^-a-z0-9_]+/', '', $sPrefix);
        $sPrefix = substr($sPrefix, 0, 10);
        $sPrefix = str_pad ( $sPrefix, 10, '_' );
        $sKey = $sPrefix . '.' . str_pad(strlen($sKey), 2, '_', STR_PAD_LEFT) . '.' . md5($sKey) . '.' . md5(serialize($aBacktrace)) . '.lock';
        $sFile = $sCacheDir . '/' . $sKey;

        Log::WRITE('Lock: ' . $aBacktrace['sFile'] . ', ' . $aBacktrace['sLine']);

        if (file_exists($sFile) || false === mkdir($sFile, 0700))
        {
            Event::RUN('mvc.lock.create', DTArrayObject::create()
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue($aBacktrace))
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('bLocked')->set_sValue(true))
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sFile')->set_sValue($sFile))
            );

            if (true === $bReturn)
            {
                return false;
            }

            exit();
        }

        \register_shutdown_function('rmdir', $sFile);

        Event::RUN('mvc.lock.create', DTArrayObject::create()
            ->add_aKeyValue(DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue($aBacktrace))
            ->add_aKeyValue(DTKeyValue::create()->set_sKey('bLocked')->set_sValue(false))
            ->add_aKeyValue(DTKeyValue::create()->set_sKey('sFile')->set_sValue($sFile))
        );

        return true;
    }
}
