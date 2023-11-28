<?php
/**
 * ArrDot.php
 * @usage $oArrDot = new ArrDot(..array..); $oArrDot->get('foo.bar.baz');
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use Adbar\Dot;

/**
 * Arrays
 * @extends \Adbar\Dot
 * @see https://github.com/adbario/php-dot-notation
 */
class ArrDot extends Dot
{
    /**
     * searches for a value in given array; returns dot notation address on the first hit
     * @related https://stackoverflow.com/a/28473131/2487859
     * @example $oArrDot->getNotationByValue('john.doe@example.com')
     *          $oArrDot->getNotationByValue('john.doe@example.com', $aHaystackArray)
     *          may return 'User.email.form.markup.attr.value'
     * @param string $sNeedle
     * @param array  $aHaystack
     * @param string $sKeyCurrent
     * @return string Bsp.: string(28) "foo.bar.baz" (dot notation address)
     */
    public function getIndexOnValue(string $sNeedle = '', array $aHaystack = array(), string $sKeyCurrent = '') : string
    {
        (true === empty($aHaystack)) ? $aHaystack = $this->get() : false;

        foreach ($aHaystack as $mKey => $mValue)
        {
            if (is_array($mValue))
            {
                $mKeyNext = $this->getIndexOnValue(
                    $sNeedle,
                    $mValue,
                    $sKeyCurrent . $mKey . '.'
                );

                if ($mKeyNext)
                {
                    return $mKeyNext;
                }
            }
            else
            {
                if ($mValue == $sNeedle)
                {
                    return $sKeyCurrent . $mKey;
                }
            }
        }

        return '';
    }
}
