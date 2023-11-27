<?php
/**
 * Asset.php
 * @usage Asset::init()->get('User.email.form.markup');
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use Symfony\Component\Yaml\Yaml;

/**
 * Application
 */
class Asset extends ArrDot
{
    /**
     * @var \MVC\Asset
     */
    protected static $_oInstance;

    /**
     * @param string $sPathAbs
     * @return self
     */
    public static function init(string $sPathAbs = '') : self
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self(
                (true === file_exists($sPathAbs))
                    ? Yaml::parseFile($sPathAbs)
                    : array()
            );
        }

        return self::$_oInstance;
    }
}
