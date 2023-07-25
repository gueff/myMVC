<?php
/**
 * TraitDataType.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <mymvc@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\MVCTrait;

trait TraitDataType
{
    /**
     * @param $sProperty
     * @param $sDocCommentKey
     * @return string
     * @throws \ReflectionException
     */
    function getDocCommentValueOfProperty($sProperty = '', $sDocCommentKey = '@var')
    {
        // get array of properties
        $oReflectionClass = new \ReflectionClass($this);
        $aProperty = array_keys(get_class_vars($oReflectionClass->getName()));
        $bPropertyExists = in_array($sProperty, $aProperty);

        if (false === $bPropertyExists)
        {
            return '';
        }

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

        return '';
    }
}