<?php

namespace MVC\DB\Trait;

trait DbInitTrait
{
    /**
     * for use in your concrete DBInit class
     * @param array $aConfig
     * @return \DB\Trait\DbInitTrait|null
     */
    public static function init(array $aConfig = array())
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self($aConfig);
        }

        return self::$_oInstance;
    }
}
