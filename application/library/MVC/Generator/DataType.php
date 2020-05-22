<?php
/**
 * DataType.php
 * @package   myMVC
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <info@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Generator;

use MVC\DataType\DTClass;
use MVC\DataType\DTConfig;
use MVC\DataType\DTConstant;
use MVC\DataType\DTProperty;
use MVC\Helper;
use MVC\Lock;

class DataType
{
    /**
     * @var int
     */
    protected $iPhpVersion = 70;

    /**
     * @var array
     */
    protected $aType = array(
        'string',
        'int',
        'bool',
        'array',
        'float',
        'double',
    );

    /**
     * DataType constructor.
     * @param int $iPhpVersion (e.g. 70: "php7.0", 56: "php5.6",...)
     */
    public function __construct($iPhpVersion = 0)
    {
        $this->iPhpVersion = (0 === $iPhpVersion)
            ? substr(preg_replace("/[^\d]+/", '', phpversion()), 0, 2)
            : (int)$iPhpVersion;
    }

    /**
     * @param int $iPhpVersion
     * @return DataType
     */
    public static function create($iPhpVersion = 0)
    {
        $oObject = new self($iPhpVersion);

        return $oObject;
    }

    /**
     * @param array $aConfig
     * @return bool
     * @throws \ReflectionException
     */
    public function initConfigArray(array $aConfig = array())
    {
        $oDTDataTypeGeneratorConfig = $this->buildDTDataTypeGeneratorConfigObject($aConfig);
        $bSuccess = $this->initConfigObject($oDTDataTypeGeneratorConfig);

        return $bSuccess;
    }

    /**
     * @param array $aConfig
     * @return DTConfig
     */
    public function buildDTDataTypeGeneratorConfigObject(array $aConfig = array())
    {
        // Config
        $oDTDataTypeGeneratorConfig = DTConfig::create();
        $oDTDataTypeGeneratorConfig->set_dir($aConfig['dir']);
        $oDTDataTypeGeneratorConfig->set_unlinkDir($aConfig['unlinkDir']);

        // Class
        foreach ($aConfig['class'] as $aDTClass)
        {
            $oDTDataTypeGeneratorClass = DTClass::create();
            $oDTDataTypeGeneratorClass->set_name($aDTClass['name']);

            (0 == strlen($oDTDataTypeGeneratorClass->get_file()))
                ? $oDTDataTypeGeneratorClass->set_file($oDTDataTypeGeneratorClass->get_name() . '.php')
                : $oDTDataTypeGeneratorClass->set_file($aDTClass['file']);

            (isset($aDTClass['namespace']))
                ? $oDTDataTypeGeneratorClass->set_namespace($aDTClass['namespace'])
                : false;
            (isset($aDTClass['extends']))
                ? $oDTDataTypeGeneratorClass->set_extends($aDTClass['extends'])
                : false;
            (isset($aDTClass['createHelperMethods']))
                ? $oDTDataTypeGeneratorClass->set_createHelperMethods($aDTClass['createHelperMethods'])
                : false;

            // Constant
            if (isset($aDTClass['constant']) && !empty($aDTClass['constant']))
            {
                foreach ($aDTClass['constant'] as $aConstant)
                {
                    $oDTDataTypeGeneratorConstant = DTConstant::create();
                    (isset($aConstant['key']))
                        ? $oDTDataTypeGeneratorConstant->set_key($aConstant['key'])
                        : false;
                    (isset($aConstant['value']))
                        ? $oDTDataTypeGeneratorConstant->set_value($aConstant['value'])
                        : false;
                    (isset($aConstant['visibility']))
                        ? $oDTDataTypeGeneratorConstant->set_visibility($aConstant['visibility'])
                        : false;
                    $oDTDataTypeGeneratorClass->add_DTConstant($oDTDataTypeGeneratorConstant);
                }
            }

            // Property
            if (isset($aDTClass['property']) && !empty($aDTClass['property']))
            {
                foreach ($aDTClass['property'] as $aProperty)
                {
                    $oDTDataTypeGeneratorProperty = DTProperty::create();
                    (isset($aProperty['key']))
                        ? $oDTDataTypeGeneratorProperty->set_key($aProperty['key'])
                        : false;
                    (isset($aProperty['value']))
                        ? $oDTDataTypeGeneratorProperty->set_value($aProperty['value'])
                        : false;
                    (isset($aProperty['var']))
                        ? $oDTDataTypeGeneratorProperty->set_var($aProperty['var'])
                        : false;
                    (isset($aProperty['visibility']))
                        ? $oDTDataTypeGeneratorProperty->set_visibility($aProperty['visibility'])
                        : false;
                    (isset($aProperty['static']))
                        ? $oDTDataTypeGeneratorProperty->set_static($aProperty['static'])
                        : false;
                    (isset($aProperty['setter']))
                        ? $oDTDataTypeGeneratorProperty->set_setter($aProperty['setter'])
                        : false;
                    (isset($aProperty['getter']))
                        ? $oDTDataTypeGeneratorProperty->set_getter($aProperty['getter'])
                        : false;

                    (isset($aProperty['explicitMethodForValue']))
                        ? $oDTDataTypeGeneratorProperty->set_explicitMethodForValue($aProperty['explicitMethodForValue'])
                        : false;
                    (isset($aProperty['listProperty']))
                        ? $oDTDataTypeGeneratorProperty->set_listProperty($aProperty['listProperty'])
                        : false;
                    (isset($aProperty['createStaticPropertyGetter']))
                        ? $oDTDataTypeGeneratorProperty->set_createStaticPropertyGetter($aProperty['createStaticPropertyGetter'])
                        : false;
                    (isset($aProperty['setValueInConstructor']))
                        ? $oDTDataTypeGeneratorProperty->set_setValueInConstructor($aProperty['setValueInConstructor'])
                        : false;
                    (isset($aProperty['forceCasting']))
                        ? $oDTDataTypeGeneratorProperty->set_forceCasting($aProperty['forceCasting'])
                        : false;

                    $oDTDataTypeGeneratorClass->add_DTProperty($oDTDataTypeGeneratorProperty);
                }
            }

            $oDTDataTypeGeneratorConfig->add_DTClass($oDTDataTypeGeneratorClass);
        }

        return $oDTDataTypeGeneratorConfig;
    }

    /**
     * @param DTConfig $oDTDataTypeGeneratorConfig
     * @return bool
     * @throws \ReflectionException
     */
    public function initConfigObject(DTConfig $oDTDataTypeGeneratorConfig)
    {
        $sCacheKey = __CLASS__ . '.' . md5(base64_encode(serialize($oDTDataTypeGeneratorConfig)));
        $bUnlinkDir = ('' !== $oDTDataTypeGeneratorConfig->get_unlinkDir())
            ? (boolean)$oDTDataTypeGeneratorConfig->get_unlinkDir()
            : false;

        if ($oDTDataTypeGeneratorConfig != \Cachix::getCache($sCacheKey))
        {
            // protect generating DT Classes
            Lock::create($sCacheKey);

            (true === $bUnlinkDir && file_exists($oDTDataTypeGeneratorConfig->get_dir()))
                ? $this->unlinkDataTypeClassDir($oDTDataTypeGeneratorConfig->get_dir())
                : false;

            $bSuccess = $this->iterateConfig($oDTDataTypeGeneratorConfig);

            if (false == $bSuccess)
            {
                return $bSuccess;
            }

            \Cachix::saveCache($sCacheKey, $oDTDataTypeGeneratorConfig);
        }

        return true;
    }

    /**
     * @param string $sDataTypeClassDir
     * @return bool
     */
    private function unlinkDataTypeClassDir($sDataTypeClassDir = '')
    {
        if (file_exists($sDataTypeClassDir))
        {
            $sCmd = 'rm -rf ' . $sDataTypeClassDir;
            $mResult = shell_exec($sCmd);

            return (boolean)$mResult;
        }

        return false;
    }

    /**
     * @param string $sDataTypeClassDir
     * @param bool   $bCreateDirIfnotExist | default=false
     * @return $this|null
     */
    private function setDataTypeClassDir($sDataTypeClassDir = '', $bCreateDirIfnotExist = false)
    {
        if (true === $bCreateDirIfnotExist)
        {
            if (false === file_exists($sDataTypeClassDir) && false === mkdir($sDataTypeClassDir, 0777, true))
            {
                return null;
            }
        }

        if (false === file_exists($sDataTypeClassDir) || false === is_dir($sDataTypeClassDir))
        {
            return null;
        }

        return $this;
    }

    /**
     * @param string $sClassname
     * @return $this|null
     */
    private function setClassName($sClassname = '')
    {
        if (empty($sClassname))
        {
            return null;
        }

        $this->sClassName = ucwords($sClassname);
        $this->sClassFileName = $this->sClassName . '.php';

        return $this;
    }

    /**
     * @param string $sClassFileName
     * @return $this|null
     */
    private function setClassFileName($sClassFileName = '')
    {
        if (empty($sClassFileName))
        {
            return null;
        }

        $this->sClassFileName = $sClassFileName;

        return $this;
    }

    /**
     * @param string $sClassNameSpace
     * @return $this|null
     */
    private function setClassNameSpace($sClassNameSpace = '')
    {
        if (empty($sClassNameSpace))
        {
            return null;
        }

        $this->sClassNamespace = $sClassNameSpace;

        return $this;
    }

    /**
     * @param string $sClassExtends
     * @return $this|null
     */
    private function setClassExtends($sClassExtends = '')
    {
        if (empty($sClassExtends))
        {
            return null;
        }

        $this->sClassExtends = $sClassExtends;

        return $this;
    }

    /**
     * @param string $sPropertyName
     * @param string $sVarType
     * @param null   $mValue
     * @param string $sVisibility
     * @return $this|null
     */
    private function setProperty($sPropertyName = '', $sVarType = 'string', $mValue = null, $sVisibility = 'protected')
    {
        if (0 == strlen($sPropertyName) || 0 == strlen($sVarType))
        {
            return null;
        }

        $aTmp = array();
        $aTmp['key'] = $sPropertyName;
        $aTmp['var'] = $sVarType;
        (null !== $mValue)
            ? $aTmp['value'] = $mValue
            : false;
        (false === empty($sVisibility))
            ? $aTmp['visibility'] = $sVisibility
            : false;

        $this->aProperty[] = $aTmp;

        return $this;
    }

    /**
     * @param DTConfig $oDTDataTypeGeneratorConfig
     * @return bool
     */
    private function iterateConfig(DTConfig $oDTDataTypeGeneratorConfig)
    {
        if ('' !== $oDTDataTypeGeneratorConfig->get_dir())
        {
            if (null === $this->setDataTypeClassDir($oDTDataTypeGeneratorConfig->get_dir(), true))
            {
                return false;
            }
        }

        $bSuccess = $this->createClass($oDTDataTypeGeneratorConfig);

        if (false === $bSuccess)
        {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    private function createDocHeader()
    {
        $sContent = '';
        $sContent .= "<?php\r\n\r\n";

        return $sContent;
    }

    /**
     * @param string $sNameSpace
     * @return string
     */
    private function createNamespace($sNameSpace = '')
    {
        $sContent = '';
        $sNameSpaceVar = preg_replace('/[^a-zA-Z_]+/', '', trim($sNameSpace));

        if (empty($sNameSpace))
        {
            return $sContent;
        }

        $sContent .= "/**\r\n * @name $" . $sNameSpaceVar . "\r\n */\r\nnamespace " . $sNameSpace . ";\r\n\r\n";

        return $sContent;
    }

    /**
     * @param DTConfig $oDTDataTypeGeneratorConfig
     * @return bool
     */
    private function createClass(DTConfig $oDTDataTypeGeneratorConfig)
    {
        foreach ($oDTDataTypeGeneratorConfig->get_class() as $oDTDataTypeGeneratorClass)
        {
            if (0 == strlen($oDTDataTypeGeneratorClass->get_name()))
            {
                return false;
            }

            (0 == strlen($oDTDataTypeGeneratorClass->get_file()))
                ? $oDTDataTypeGeneratorClass->set_file($oDTDataTypeGeneratorClass->get_name() . '.php')
                : false;

            $sClassFileAbs = $oDTDataTypeGeneratorConfig->get_dir() . '/' . $oDTDataTypeGeneratorClass->get_file();
            $sClassFileAbs = str_replace('//', '/', $sClassFileAbs);

            if (file_exists($sClassFileAbs))
            {
                unlink($sClassFileAbs);
            }

            (false === file_exists($sClassFileAbs))
                ? touch($sClassFileAbs)
                : false;

            $sContent = '';
            $sContent .= $this->createDocHeader();
            $sContent .= $this->createNamespace($oDTDataTypeGeneratorClass->get_namespace());
            $sContent .= "class " . $oDTDataTypeGeneratorClass->get_name();

            // extends
            (0 != strlen($oDTDataTypeGeneratorClass->get_extends()))
                ? $sContent .= ' extends ' . $oDTDataTypeGeneratorClass->get_extends()
                : false;

            $sContent .= "\r\n{\r\n";

            // hash constant
            $sContent .= $this->createConst(DTConstant::create()
                ->set_key('DTHASH')
                ->set_value("'" . md5(base64_encode(serialize($oDTDataTypeGeneratorClass->get_constant()) . serialize($oDTDataTypeGeneratorClass->get_property()))) . "'")
                ->set_visibility('public'));

            foreach ($oDTDataTypeGeneratorClass->get_constant() as $oConstant)
            {
                $sContent .= $this->createConst($oConstant);
            }

            foreach ($oDTDataTypeGeneratorClass->get_property() as $oProperty)
            {
                $sContent .= $this->createProperty($oProperty);
            }

            $sContent .= $this->createConstructor($oDTDataTypeGeneratorClass);
            $sContent .= $this->createStaticCreator($oDTDataTypeGeneratorClass->get_name());

            foreach ($oDTDataTypeGeneratorClass->get_property() as $oProperty)
            {
                $sContent .= $this->createSetter($oProperty, $oDTDataTypeGeneratorClass->get_name());
            }

            foreach ($oDTDataTypeGeneratorClass->get_property() as $oProperty)
            {
                $sContent .= $this->createGetter($oProperty, $oDTDataTypeGeneratorClass->get_name());
            }

            foreach ($oDTDataTypeGeneratorClass->get_property() as $oProperty)
            {
                $sContent .= $this->createExplicitMethodForValue($oProperty);
            }

            HELPER_METHODS:
            {

                // on property
                foreach ($oDTDataTypeGeneratorClass->get_property() as $oProperty)
                {
                    $sContent .= $this->createStaticPropertyGetter($oProperty);
                }

                // for class
                if (true === $oDTDataTypeGeneratorClass->get_createHelperMethods())
                {
                    $sContent .= $this->createMagics();
                    $sContent .= $this->createHelpfulPropertyGetter();
                    $sContent .= $this->createHelpfulConstantGetter();
                    $sContent .= $this->createHelpfulPropertySetter();
                    $sContent .= $this->createGetDataTypeConfigJSON($oDTDataTypeGeneratorClass);
                }
            }

            $sContent .= "}";

            $bSuccess = $this->writeInto($sClassFileAbs, $sContent);

            if (false === $bSuccess)
            {
                return false;
            }
        }

        return true;
    }

    /**
     * @param DTConstant $oDTDataTypeGeneratorConstant
     * @return string
     */
    private function createConst(DTConstant $oDTDataTypeGeneratorConstant)
    {
        if (0 == strlen($oDTDataTypeGeneratorConstant->get_key()) or is_null($oDTDataTypeGeneratorConstant->get_value()))
        {
            return '';
        }

        $sContent = '';
        $sContent .= "\t";
        (true === ($this->iPhpVersion >= 71))
            ? $sContent .= $oDTDataTypeGeneratorConstant->get_visibility() . ' '
            : false;
        $sContent .= 'const ' . $oDTDataTypeGeneratorConstant->get_key() . ' = ';

        $sContent .= ('boolean' === gettype($oDTDataTypeGeneratorConstant->get_value()))
            ? (true === $oDTDataTypeGeneratorConstant->get_value())
                ? 'true'
                : 'false'
            : $oDTDataTypeGeneratorConstant->get_value();

        $sContent .= ";\r\n\r\n";

        return $sContent;
    }

    /**
     * @param DTProperty $oProperty
     * @return string
     */
    private function createProperty(DTProperty $oProperty)
    {
        if (true !== $oProperty->get_listProperty())
        {
            return '';
        }

        $sContent = '';
        $sContent .= "\t/**\r\n\t * @var " . $oProperty->get_var() . "\r\n\t */\r\n";
        $sContent .= "\t" . $oProperty->get_visibility() . " ";
        (true === $oProperty->get_static())
            ? $sContent .= "static "
            : false;
        $sContent .= "$" . $oProperty->get_key();
        $sContent .= ';';
        $sContent .= "\r\n\r\n";

        return $sContent;
    }

    /**
     * @param DTClass $oDTDataTypeGeneratorClass
     * @return string
     */
    private function createConstructor(\MVC\DataType\DTClass $oDTDataTypeGeneratorClass)
    {
        $sContent = "\t/**\r\n\t * " . $oDTDataTypeGeneratorClass->get_name() . " constructor." . "\r\n\t * @param array " . '$aData' . "\r\n\t * @throws \ReflectionException " . "\r\n\t " . "*/\r\n\t";
        $sContent .= "public function __construct(array " . '$aData' . " = array())\r\n\t";
        $sContent .= "{\r\n";
        $sContent .= "\t\t\MVC\Event::RUN ('" . $oDTDataTypeGeneratorClass->get_name() . ".__construct.before', \MVC\DataType\DTArrayObject::create(" . '$aData' . ")->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));\r\n\r\n";

        if (false === empty($oDTDataTypeGeneratorClass->get_extends()))
        {
            $sContent .= "\t\t" . 'parent::__construct($aData);' . "\n\n";
        }

        foreach ($oDTDataTypeGeneratorClass->get_property() as $sKey => $oProperty)
        {
            if (false === $oProperty->get_setValueInConstructor())
            {
                continue;
            }

            if (true === $oProperty->get_static())
            {
                $sContent .= "\t\t" . 'self::$' . $oProperty->get_key() . ' = ';
            }
            else
            {
                $sContent .= "\t\t" . '$this->' . $oProperty->get_key() . ' = ';
            }

            // regular Types
            if (in_array($oProperty->get_var(), $this->aType))
            {
                if ('string' == strtolower($oProperty->get_var()))
                {
                    $sContent .= (false === empty($oProperty->get_value()))
                        ? '"' . $oProperty->get_value() . '"' . ";\r\n"
                        : "'';\r\n";
                }

                if ('int' == substr(strtolower($oProperty->get_var()), 0, 3))
                {
                    $sContent .= (int)$oProperty->get_value() . ";\r\n";
                }

                if ('array' == strtolower($oProperty->get_var()))
                {
                    $sContent .= (is_array($oProperty->get_value()))
                        ? preg_replace('!\s+!', '', str_replace("\n", '', Helper::VAREXPORT($oProperty->get_value(), true, false))) . ";\r\n"
                        : "array();\r\n";
                }

                if ('bool' == substr(strtolower($oProperty->get_var()), 0, 4))
                {
                    $sContent .= (true === $oProperty->get_value())
                        ? 'true;' . "\r\n"
                        : 'false;' . "\r\n";
                }

                if ('float' == strtolower($oProperty->get_var()))
                {
                    $sContent .= (true === is_null($oProperty->get_value()))
                        ? "0;\r\n"
                        : $oProperty->get_value() . ";\r\n";
                }

                if ('double' == strtolower($oProperty->get_var()))
                {
                    $sContent .= (true === is_null($oProperty->get_value()))
                        ? "0;\r\n"
                        : $oProperty->get_value() . ";\r\n";
                }
            }
            else
            {
                $sContent .= (true === is_null($oProperty->get_value()))
                    ? "null;\r\n"
                    : $oProperty->get_value() . ';' . "\r\n";
            }
        }

        $sContent .= "\r\n\t\tforeach (" . '$aData' . " as " . '$sKey' . " => " . '$mValue' . ")\r\n\t\t";
        $sContent .= "{\r\n\t\t\t" . '$sMethod' . " = 'set_' . " . '$sKey;' . "\r\n\r\n\t\t\t";
        $sContent .= "if (method_exists(" . '$this' . ", " . '$sMethod' . "))\r\n\t\t\t";
        $sContent .= "{\r\n\t\t\t\t" . '$this->$sMethod($mValue);' . "\r\n\t\t\t";
        $sContent .= "}\r\n\t\t}" . "\r\n\r\n";
        $sContent .= "\t\t\MVC\Event::RUN ('" . $oDTDataTypeGeneratorClass->get_name() . ".__construct.after', \MVC\DataType\DTArrayObject::create(" . '$aData' . "));\r\n";
        $sContent .= "\t}\r\n\r\n";


        return $sContent;
    }

    /**
     * @param string $sClassName
     * @return string
     */
    private function createStaticCreator($sClassName = '')
    {
        $sContent = "    /**
     * @param array " . '$aData' . "
     * @return " . $sClassName . "
     * @throws \ReflectionException
     */
    public static function create(array " . '$aData' . " = array())
    {
        \MVC\Event::RUN ('" . $sClassName . ".create.before', \MVC\DataType\DTArrayObject::create(" . '$aData' . ")->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));
        
        " . '$oObject' . " = new self(" . '$aData' . ");

        \MVC\Event::RUN ('" . $sClassName . ".create.after', \MVC\DataType\DTArrayObject::create()->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('" . $sClassName . "')->set_sValue(" . '$oObject' . ")));
        
        return " . '$oObject' . ";
    }\n\n";

        return $sContent;
    }

    /**
     * @param DTProperty $oProperty
     * @return string
     */
    private function createExplicitMethodForValue(DTProperty $oProperty)
    {
        if (true !== $oProperty->get_explicitMethodForValue())
        {
            return '';
        }

        $sContent = "\t/**
     * @param array " . '$aValue' . "
     * @return " . $oProperty->get_var() . "
     */
    " . $oProperty->get_visibility() . " " . ((true === $oProperty->get_static())
                ? 'static '
                : false) . "function " . $oProperty->get_key() . "(" . '$aValue = array()' . ")"; # \r\n\t{";

        ($this->iPhpVersion >= 70)
            ? $sContent .= ' : ' . $oProperty->get_var()
            : false;

        $sContent .= "\r\n\t{";

        // regular Types
        if (in_array($oProperty->get_var(), $this->aType))
        {
            $sContent .= "\r\n\t\t" . '$mVar' . " = ";

            if ('string' === strtolower($oProperty->get_var()))
            {
                $sContent .= '"' . (string)$oProperty->get_value() . '";' . "\r\n";
            }

            if ('int' === substr(strtolower($oProperty->get_var()), 0, 3))
            {
                $sContent .= (int)$oProperty->get_value() . ";\r\n";
            }

            if ('bool' === substr(strtolower($oProperty->get_var()), 0, 4))
            {
                ((true === $oProperty->get_value())
                    ? $sContent .= 'true;' . "\r\n"
                    : $sContent .= 'false;' . "\r\n");
            }

            if (null == substr(strtolower($oProperty->get_var()), 0, 3))
            {
                $sContent .= 'null;' . "\r\n";
            }
        }
        // object
        else
        {
            $sContent .= "\r\n\t\t" . '$mVar' . " = new " . $oProperty->get_var() . "(" . '$aValue' . ");\r\n";
        }

        $sContent .= "\r\n\t\treturn " . '$mVar;' . "\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @param DTProperty $oProperty
     * @return string
     */
    private function createStaticPropertyGetter(DTProperty $oProperty)
    {
        if (true !== $oProperty->get_createStaticPropertyGetter())
        {
            return '';
        }

        $sContent = '';
        $sContent .= "\t/**\r\n\t * @return string\r\n\t */\r\n\tpublic static function getPropertyName_" . $oProperty->get_key() . "()\r\n\t{
        return '" . $oProperty->get_key() . "';\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @return string
     */
    private function createMagics()
    {
        $sContent = '';
        $sContent .= "\t/**\r\n\t * @return false|string JSON\r\n\t */\r\n\tpublic function __toString()\r\n\t{
        return " . '$this->getPropertyJson();' . "\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @return string
     */
    private function createHelpfulPropertyGetter()
    {
        $sContent = '';
        $sContent .= "\t/**\r\n\t * @return false|string\r\n\t */\r\n\tpublic function getPropertyJson()\r\n\t{
        return json_encode(" . '$this->getPropertyArray());' . "\r\n\t}\r\n\r\n";

        $sContent .= "\t/**\r\n\t * @return array\r\n\t */\r\n\tpublic function getPropertyArray()\r\n\t{
        return " . 'get_object_vars($this);' . "\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @return string
     */
    private function createHelpfulConstantGetter()
    {
        $sContent = '';

        $sContent .= "\t/**\r\n\t * @return array\r\n\t * @throws \ReflectionException\r\n\t */\r\n\tpublic function getConstantArray()\r\n\t{\r\n\t\t";
        $sContent .= '$oReflectionClass = new \ReflectionClass($this);' . "\r\n\t\t";
        $sContent .= '$aConstant = $oReflectionClass->getConstants();' . "\r\n\r\n\t\t";
        $sContent .= "return " . '$aConstant;' . "\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @return string
     */
    private function createHelpfulPropertySetter()
    {
        $sContent = '';
        $sContent .= "\t/**\r\n\t * @return " . '$this' . "\r\n\t */\r\n\tpublic function flushProperties()\r\n\t{";
        $sContent .= "\r\n\t\tforeach (" . '$this->getPropertyArray() as $sKey => $aValue)' . "\r\n\t\t{\r\n\t\t\t";
        $sContent .= '$sMethod' . " = 'set_' . " . '$sKey;' . "\r\n\r\n\t\t\t";
        $sContent .= 'if (method_exists($this, $sMethod)) ' . "\r\n\t\t\t{";
        $sContent .= "\r\n\t\t\t\t" . '$this->$sMethod(\'\');' . "\r\n\t\t\t" . '}';
        $sContent .= "\r\n\t\t}\r\n\r\n\t\t" . 'return $this;' . "\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @param mixed $mObject
     * @return array
     */
    private function convertObjectToArray($mObject)
    {
        (is_object($mObject))
            ? $mObject = (array)$mObject
            : false;

        if (is_array($mObject))
        {
            $aNew = array();

            foreach ($mObject as $sKey => $mValue)
            {
                $sFirstChar = trim(substr(trim($sKey), 0, 1));
                (('*' === $sFirstChar))
                    ? $sKey = trim(substr(trim($sKey), 1))
                    : false;
                $aNew[$sKey] = $this->convertObjectToArray($mValue);
            }
        }
        else
        {
            $aNew = $mObject;
        }

        return $aNew;
    }

    /**
     * @param \MVC\DataType\DTClass $oDTDataTypeGeneratorClass
     * @return string
     */
    private function createGetDataTypeConfigJSON(\MVC\DataType\DTClass $oDTDataTypeGeneratorClass)
    {
        $sJson = json_encode($this->convertObjectToArray($oDTDataTypeGeneratorClass));
        $sJson = preg_replace('/\\\\{1}/', '\\\\\\', $sJson);
        $sContent = '';
        $sContent .= "\t/**\r\n\t * @return " . 'string JSON' . "\r\n\t */\r\n\tpublic function getDataTypeConfigJSON()\r\n\t{";
        $sContent .= "\r\n\t\t" . 'return ' . "'" . $sJson . "';" . "\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @param \MVC\DataType\DTProperty $oProperty
     * @param string                   $sClassName
     * @return string
     */
    private function createSetter(DTProperty $oProperty, $sClassName = '')
    {
        if (false === $oProperty->get_setter())
        {
            return '';
        }

        $sVar = trim(preg_replace("/[^[:alnum:][:space:]_\\\]/ui", '', $oProperty->get_var()));
        $sRight2 = substr($oProperty->get_var(), -2);
        $sContent = '';

        if ('[]' !== $sRight2)
        {
            $sContent .= "\t/**\r\n" . "\t * @param " . $sVar . ' $mValue ' . "\r\n" . "\t * @return " . '$this' . "\r\n" . "\t * @throws \ReflectionException\r\n" . "\t */" . "\r\n";
            $sContent .= "\tpublic function set_" . $oProperty->get_key() . '(';

            // place type for php7 and newer
            (70 <= $this->iPhpVersion && in_array($sVar, $this->aType))
                ? $sContent .= $sVar . ' '
                : false;

            $sContent .= '$mValue)' . "\r\n" . "\t{" . "\r\n\t\t\MVC\Event::RUN ('" . $sClassName . ".set_" . $oProperty->get_key() . ".before', \MVC\DataType\DTArrayObject::create(array('" . $oProperty->get_key() . "' => " . '$mValue' . "))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));\r\n";

            if (true === $oProperty->get_forceCasting())
            {
                $sContent .= "\r\n\t\t" . '(false === ($mValue instanceof ' . $sVar . ')) ? $mValue = ' . $sVar . '::create($mValue) : false;' . "\r\n";
            }

            $sContent .= "\r\n\t\t" . '$this->' . $oProperty->get_key() . ' = $mValue;' . "\r\n\r\n" . "\t\treturn " . '$this;' . "\r\n\t}\r\n\r\n";
        }
        // type is array
        else
        {
            $sContent .= "\t/**\r\n" . "\t * @param array " . ' $mValue ' . "\r\n" . "\t * @return " . '$this' . "\r\n" . "\t * @throws \ReflectionException\r\n" . "\t */" . "\r\n";
            $sContent .= "\tpublic function set_" . $oProperty->get_key() . '(';

            // place type for php7 and newer
            (70 <= $this->iPhpVersion)
                ? $sContent .= 'array '
                : false;

            $sContent .= '$aValue)' . "\r\n" . "\t{\r\n\t\t";

            // add ArrayType Instancer
            if (false === in_array(strtolower($sVar), $this->aType))
            {
                $sContent .= "\MVC\Event::RUN ('" . $sClassName . ".set_" . $oProperty->get_key() . ".before', \MVC\DataType\DTArrayObject::create(array('" . $oProperty->get_key() . "' => " . '$aValue' . "))->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));" . "\r\n";

                $sContent .= "\r\n\t\t" . 'foreach ($aValue as $mKey => $aData)
        {
            if (false === ($aData instanceof ' . ucwords($sVar) . '))
            {
                $aValue[$mKey] = new ' . ucwords($sVar) . '($aData);
            }
        }' . "\r\n";
            }

            $sContent .= "\r\n\t\t" . '$this->' . $oProperty->get_key() . ' = $aValue;' . "\r\n\r\n" . "\t\treturn " . '$this;' . "\r\n\t}\r\n\r\n";

            $sContent .= $this->createAddFunctionForArray($oProperty);
        }

        return $sContent;
    }

    /**
     * @param \MVC\DataType\DTProperty $oProperty
     * @param string                   $sClassName
     * @return string
     */
    private function createGetter(DTProperty $oProperty, $sClassName = '')
    {
        if (false === $oProperty->get_getter())
        {
            return '';
        }

        $sVar = trim(preg_replace("/[^[:alnum:][:space:]_\\\]/ui", ' ', $oProperty->get_var()));
        $sReturnType = trim(preg_replace("/[^[:alnum:][:space:]_\\\]/ui", ' ', $oProperty->get_var()));

        $sContent = '';
        $sContent .= "\t/**\r\n" . "\t * @return " . $oProperty->get_var() . "\r\n" . "\t * @throws \ReflectionException\r\n" . "\t */\r\n";
        $sContent .= "\tpublic function get_" . $oProperty->get_key() . '()';

        (70 <= $this->iPhpVersion && ($sReturnType === $oProperty->get_var()) && ($sVar !== 'mixed'))
            ? $sContent .= ' : ' . $sVar
            : false;

        $sContent .= "\r\n";
        $sContent .= "\t{\r\n" . "\t\t\MVC\Event::RUN ('" . $sClassName . ".get_" . $oProperty->get_key() . ".before', \MVC\DataType\DTArrayObject::create()" . "->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('" . $oProperty->get_key() . "')->set_sValue(" . '$this->' . $oProperty->get_key() . "))" . "->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('aBacktrace')->set_sValue(\MVC\Helper::PREPAREBACKTRACEARRAY(debug_backtrace()))));" . "\r\n" . "\r\n\t\t" . 'return $this->' . $oProperty->get_key() . ';' . "\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @param DTProperty $oProperty
     * @return string
     */
    private function createAddFunctionForArray(DTProperty $oProperty)
    {
        $sVar = trim(preg_replace("/[^[:alnum:][:space:]_\\\]/ui", ' ', $oProperty->get_var()));

        $sContent = '';
        $sContent .= "\t/**\r\n\t * @param " . $sVar . ' $mValue' . "\r\n";
        $sContent .= "\t * @return " . '$this' . "\r\n\t */\r\n";
        $sContent .= "\tpublic function add_" . $oProperty->get_key() . '(' . $sVar . ' $mValue)';
        $sContent .= "\r\n";
        $sContent .= "\t{\r\n\t\t" . '$this->' . $oProperty->get_key() . '[] = $mValue;';
        $sContent .= "\r\n";
        $sContent .= "\r\n\t\treturn " . '$this;';
        $sContent .= "\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @param string $sFile
     * @param string $sContent
     * @return bool
     */
    private function writeInto($sFile = '', $sContent = '')
    {
        return (boolean)file_put_contents($sFile, $sContent . PHP_EOL, FILE_APPEND);
    }
}
