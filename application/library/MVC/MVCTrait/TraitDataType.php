<?php
/**
 * DataType.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\MVCTrait;

trait TraitDataType
{
    /**
     * @param $sDocCommentKey
     * @param $sProperty
     * @return string
     * @throws \ReflectionException
     */
    function getDocCommentValueOfProperty($sDocCommentKey = '@var', $sProperty = '')
    {
        // get array of properties
        $aProperty = array_keys($this->getPropertyArray());
        $bPropertyExists = in_array($sProperty, $aProperty);

        if (true === $bPropertyExists)
        {
            $oReflectionProperty = new \ReflectionProperty($this, $sProperty);
            $sDocComment = $oReflectionProperty->getDocComment();
            $aExplode = explode("\n", $sDocComment);

            // iterate DocComment lines
            foreach ($aExplode as $sLine)
            {
                // remove unwanted
                $sLine = str_replace('*', '', str_replace('/', '', $sLine));

                // key found
                if (stristr($sLine, $sDocCommentKey))
                {
                    // remove unwanted
                    $sLine = trim(str_replace('@', '', str_replace($sDocCommentKey, '', $sLine)));

                    // value left
                    return $sLine;
                }
            }
        }

        return '';
    }
}