<?php
/**
 * Closure.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
 */

namespace MVC;

class Closure
{
    /**
     * checks whether the unknown parameter is a closure object
     * @access public
     * @static
     * @param mixed $mUnknown
     * @return boolean
     */
    public static function is($mUnknown)
    {
        return is_object($mUnknown) && ($mUnknown instanceof \Closure);
    }

    /**
     * Dumps a Closure
     * @param Closure|string $mClosure name of function or Closure
     * @return string
     * @throws \ReflectionException
     */
    public static function dump($mClosure)
    {
        $oReflectionFunction = new \ReflectionFunction ($mClosure);
        $aParam = array();

        /** @var ReflectionParameter $oReflectionParameter */
        foreach ($oReflectionFunction->getParameters() as $oReflectionParameter)
        {
            $sTemp = '';
            $oRflectionType = $oReflectionParameter->getType();
            $aType = $oRflectionType instanceof ReflectionUnionType
                ? $oRflectionType->getTypes()
                : [$oRflectionType];

            $aType = array_filter(
                $aType,
                function($value)
                {
                    return !is_null($value) && $value !== '' && 'NULL' != gettype($value);
                }
            );

            if (empty($aType))
            {
                continue;
            }

            /**
             * @see https://www.php.net/manual/de/reflectionparameter.isarray.php
             *      https://www.php.net/manual/de/functions.arrow.php
             */
            $bIsArray = in_array(
                'array',
                array_map(
                    fn(\ReflectionNamedType $oReflectionNamedType) => $oReflectionNamedType->getName(),
                    $aType
                )
            );

            if (true === $bIsArray)
            {
                $sTemp .= 'array ';
            }
            else
            {
                if ($oReflectionParameter->getName())
                {
                    $sTemp .= $oReflectionParameter->getName() . ' ';
                }
            }

            if ($oReflectionParameter->isPassedByReference())
            {
                $sTemp .= '&';
            }

            $sTemp .= '$' . $oReflectionParameter->name;

            if ($oReflectionParameter->isOptional())
            {
                $sTemp .= ' = ' . var_export($oReflectionParameter->getDefaultValue(), true);
            }

            $aParam [] = $sTemp;
        }

        $sString = 'function (' . preg_replace('!\s+!', ' ', implode(', ', $aParam)) . '){' . PHP_EOL;
        $aLine = file($oReflectionFunction->getFileName());

        for ($iCount = $oReflectionFunction->getStartLine(); $iCount < $oReflectionFunction->getEndLine(); $iCount++)
        {
            $sString .= $aLine[$iCount];
        }

        return $sString;
    }

    /**
     * alias for Closure::dump()
     * @param Closure|string $mClosure name of function or Closure
     * @return string
     * @throws \ReflectionException
     */
    public static function toString($mClosure)
    {
        return self::dump($mClosure);
    }
}