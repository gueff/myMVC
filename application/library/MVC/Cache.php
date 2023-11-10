<?php
/**
 * Cache.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

/**
 * @extends \Cachix
 */
class Cache extends \Cachix
{
    /**
     * @param array $aConfig
     * @return void
     * @throws \ReflectionException
     */
    public static function init(array $aConfig = array()) : void
    {
        if (true === empty($aConfig))
        {
            $aConfig = Config::get_MVC_CACHE_CONFIG();
        }

        parent::init($aConfig);
    }
}