<?php
/**
 * Cache.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

/**
 * @extends \Cachix
 */
class Cache extends \Cachix
{
    public static function init(array $aConfig = array())
    {
        (empty($aConfig)) ? $aConfig = Config::get_MVC_CACHE_CONFIG() : false;

        parent::init($aConfig);
    }
}