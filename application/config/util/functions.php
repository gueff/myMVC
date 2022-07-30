<?php

#--------------------------------------------------------------------------------
#

/**
 * simplifies the use of variables.
 * If a variable does not exist, null or a defined value is returned
 *
 * // usually
 * $mValue = (isset($aData['foo']['bar'])) ? $aData['foo']['bar'] : null;
 * // way easier with get()
 * $mValue = get($aData['foo']['bar']);
 *
 * @param      $sVar
 * @param null $mFallback
 * @return mixed|null
 * @example     if (get($_GET['foo']) === 123) {..}         // value of $_GET['foo'] or null
 *              if (get($_GET['foo'], 123) === 123) {..}    // value of $_GET['foo'] or 123
 *              $mValue = get($aData['foo']['bar']);        // value of $aData['foo']['bar'] or null
 */
function get(&$sVar, $mFallback = null)
{
    if (isset($sVar))
    {
        return $sVar;
    }

    return $mFallback;
}

#--------------------------------------------------------------------------------
# 