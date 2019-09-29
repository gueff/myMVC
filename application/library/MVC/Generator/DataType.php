<?php

namespace MVC\Generator;

use MVC\DataType\DTDataTypeGeneratorClass;
use MVC\DataType\DTDataTypeGeneratorConfig;
use MVC\DataType\DTDataTypeGeneratorConstant;
use MVC\DataType\DTDataTypeGeneratorProperty;
use MVC\Registry;

class DataType
{
    /**
     * @var int
     */
    protected $iPhpVersion = 70;

    /**
     * DataType constructor.
     * @param int $iPhpVersion (e.g. 70: "php7.0", 56: "php5.6",...)
     */
    public function __construct($iPhpVersion = 0)
    {
        \Cachix::init(Registry::get('CACHIX_CONFIG'));
        $this->iPhpVersion = (0 === $iPhpVersion) ?
            substr(preg_replace("/[^\d]+/", '', phpversion()), 0, 2) :
            (int) $iPhpVersion
        ;
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
     */
    public function initConfigArray(array $aConfig = array())
    {
        $oDTDataTypeGeneratorConfig = $this->buildDTDataTypeGeneratorConfigObject($aConfig);
        $this->initConfigObject($oDTDataTypeGeneratorConfig);
    }

    /**
     * @param array $aConfig
     * @return DTDataTypeGeneratorConfig
     */
    protected function buildDTDataTypeGeneratorConfigObject(array $aConfig = array())
    {
        // Config
        $oDTDataTypeGeneratorConfig = DTDataTypeGeneratorConfig::create();
        $oDTDataTypeGeneratorConfig->set_dir($aConfig['dir']);
        $oDTDataTypeGeneratorConfig->set_unlinkDir($aConfig['unlinkDir']);

        // Class
        foreach ($aConfig['class'] as $aDTClass)
        {
            $oDTDataTypeGeneratorClass = DTDataTypeGeneratorClass::create();
            $oDTDataTypeGeneratorClass->set_name($aDTClass['name']);
            $oDTDataTypeGeneratorClass->set_file($aDTClass['file']);
            (isset($aDTClass['namespace'])) ? $oDTDataTypeGeneratorClass->set_namespace($aDTClass['namespace']) : false;
            (isset($aDTClass['extends'])) ? $oDTDataTypeGeneratorClass->set_extends($aDTClass['extends']) : false;

            // Constant
            if (isset($aDTClass['constant']) && !empty($aDTClass['constant']))
            {
                foreach ($aDTClass['constant'] as $aConstant)
                {
                    $oDTDataTypeGeneratorConstant = DTDataTypeGeneratorConstant::create();
                    (isset($aConstant['key'])) ? $oDTDataTypeGeneratorConstant->set_key($aConstant['key']) : false;
                    (isset($aConstant['value'])) ? $oDTDataTypeGeneratorConstant->set_value($aConstant['value']) : false;
                    (isset($aConstant['visibility'])) ? $oDTDataTypeGeneratorConstant->set_visibility($aConstant['visibility']) : false;
                    $oDTDataTypeGeneratorClass->add_DTConstant($oDTDataTypeGeneratorConstant);
                }
            }

            // Property
            if (isset($aDTClass['property']) && !empty($aDTClass['property']))
            {
                foreach ($aDTClass['property'] as $aProperty)
                {
                    $oDTDataTypeGeneratorProperty = DTDataTypeGeneratorProperty::create();
                    (isset($aProperty['key'])) ? $oDTDataTypeGeneratorProperty->set_key($aProperty['key']) : false;
                    (isset($aProperty['value'])) ? $oDTDataTypeGeneratorProperty->set_value($aProperty['value']) : false;
                    (isset($aProperty['var'])) ? $oDTDataTypeGeneratorProperty->set_var($aProperty['var']) : false;
                    (isset($aProperty['visibility'])) ? $oDTDataTypeGeneratorProperty->set_visibility($aProperty['visibility']) : false;
                    $oDTDataTypeGeneratorClass->add_DTProperty($oDTDataTypeGeneratorProperty);
                }
            }

            $oDTDataTypeGeneratorConfig->add_DTClass($oDTDataTypeGeneratorClass);
        }

        return $oDTDataTypeGeneratorConfig;
    }

    /**
     * @param DTDataTypeGeneratorConfig $oDTDataTypeGeneratorConfig
     * @return null
     */
    public function initConfigObject(DTDataTypeGeneratorConfig $oDTDataTypeGeneratorConfig)
    {
        $sCacheKey = __CLASS__ . '.' . md5(serialize($oDTDataTypeGeneratorConfig));
        $bUnlinkDir = ('' !== $oDTDataTypeGeneratorConfig->get_unlinkDir()) ? (boolean) $oDTDataTypeGeneratorConfig->get_unlinkDir() : false;

        if ($oDTDataTypeGeneratorConfig !== \Cachix::getCache($sCacheKey))
        {
            \Cachix::autoDeleteCache(__CLASS__, 0);
            (true === $bUnlinkDir && file_exists($oDTDataTypeGeneratorConfig->get_dir())) ?
                $this->unlinkDataTypeClassDir($oDTDataTypeGeneratorConfig->get_dir()) :
                false
            ;
            $bSuccess = $this->iterateConfig($oDTDataTypeGeneratorConfig);

            if (false == $bSuccess)
            {
                return null;
            }

            \Cachix::saveCache(
                $sCacheKey,
                $oDTDataTypeGeneratorConfig
            );
        }
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

            return (boolean) $mResult;
        }

        return false;
    }

    /**
     * @param string $sDataTypeClassDir
     * @param bool $bCreateDirIfnotExist | default=false
     * @return $this|null
     */
    private function setDataTypeClassDir($sDataTypeClassDir = '', $bCreateDirIfnotExist = false)
    {
        if (true === $bCreateDirIfnotExist)
        {
            if (false === file_exists($sDataTypeClassDir) && false === mkdir($sDataTypeClassDir))
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
     * @param null $mValue
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
        (null !== $mValue) ? $aTmp['value'] = $mValue : false;
        (false === empty($sVisibility)) ? $aTmp['visibility'] = $sVisibility : false;

        $this->aProperty[] = $aTmp;

        return $this;
    }

    /**
     * @param DTDataTypeGeneratorConfig $oDTDataTypeGeneratorConfig
     * @return bool
     */
    private function iterateConfig(DTDataTypeGeneratorConfig $oDTDataTypeGeneratorConfig)
    {
        if ('' !== $oDTDataTypeGeneratorConfig->get_dir())
        {
            if (null === $this->setDataTypeClassDir($oDTDataTypeGeneratorConfig->get_dir(),true))
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
        $sContent.= "<?php\r\n\r\n";

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

        $sContent.= "/**\r\n * @name $" . $sNameSpaceVar . "\r\n */\r\nnamespace " . $sNameSpace . ";\r\n\r\n";

        return $sContent;
    }

    /**
     * @param DTDataTypeGeneratorConfig $oDTDataTypeGeneratorConfig
     * @return bool
     */
    private function createClass(DTDataTypeGeneratorConfig $oDTDataTypeGeneratorConfig)
    {
        foreach ($oDTDataTypeGeneratorConfig->get_class() as $oDTDataTypeGeneratorClass)
        {
            if (0 == strlen($oDTDataTypeGeneratorClass->get_name()) || empty($oDTDataTypeGeneratorClass->get_property()))
            {
                return false;
            }

            (0 == strlen($oDTDataTypeGeneratorClass->get_file())) ? $oDTDataTypeGeneratorClass->set_file($oDTDataTypeGeneratorClass->get_name() . '.php') : false;

            $sClassFileAbs = $oDTDataTypeGeneratorConfig->get_dir() . '/' . $oDTDataTypeGeneratorClass->get_file();
            $sClassFileAbs = str_replace('//', '/', $sClassFileAbs);

            if (file_exists($sClassFileAbs))
            {
                unlink($sClassFileAbs);
            }

            (false === file_exists($sClassFileAbs)) ? touch($sClassFileAbs) : false;

            $sContent = '';
            $sContent.= $this->createDocHeader();
            $sContent.= $this->createNamespace($oDTDataTypeGeneratorClass->get_namespace());
            $sContent.= "class " . $oDTDataTypeGeneratorClass->get_name();

            // extends
            (0 != strlen($oDTDataTypeGeneratorClass->get_extends())) ? $sContent.= ' extends ' . $oDTDataTypeGeneratorClass->get_extends() : false;

            $sContent.= "\r\n{\r\n";

            // hash constant
            $sContent.= $this->createConst(
                DTDataTypeGeneratorConstant::create()
                    ->set_key('DTHASH')
                    ->set_value("'" . md5(base64_encode(serialize($oDTDataTypeGeneratorClass->get_property()))) . "'")
                    ->set_visibility('public')
            );

            foreach ($oDTDataTypeGeneratorClass->get_constant() as $oConstant)
            {
                $sContent.= $this->createConst($oConstant);
            }

            foreach ($oDTDataTypeGeneratorClass->get_property() as $oProperty)
            {
                $sContent.= $this->createProperty($oProperty);
            }

            $sContent.= $this->createConstructor($oDTDataTypeGeneratorClass->get_name());
            $sContent.= $this->createStaticCreator($oDTDataTypeGeneratorClass->get_name());

            foreach ($oDTDataTypeGeneratorClass->get_property() as $oProperty)
            {
                $sContent.= $this->createSetter($oProperty);
            }

            foreach ($oDTDataTypeGeneratorClass->get_property() as $oProperty)
            {
                $sContent.= $this->createGetter($oProperty);
            }

            foreach ($oDTDataTypeGeneratorClass->get_property() as $oProperty)
            {
                $sContent.= $this->createStaticPropertyGetter($oProperty);
            }

            $sContent.= $this->createMagics();
            $sContent.= $this->createHelpfulPropertyGetter();
            $sContent.= $this->createHelpfulPropertySetter();
            $sContent.= "}";

            $bSuccess = $this->writeInto(
                $sClassFileAbs,
                $sContent
            );

            if (false === $bSuccess)
            {
                return false;
            }
        }

        return true;
    }

    /**
     * @param DTDataTypeGeneratorConstant $oDTDataTypeGeneratorConstant
     * @return string
     */
    private function createConst(DTDataTypeGeneratorConstant $oDTDataTypeGeneratorConstant)
    {
        if (0 == strlen($oDTDataTypeGeneratorConstant->get_key()) OR is_null($oDTDataTypeGeneratorConstant->get_value()))
        {
            return '';
        }

        $sContent = '';
        $sContent.= "\t";
        (true === ($this->iPhpVersion >= 71)) ? $sContent.= $oDTDataTypeGeneratorConstant->get_visibility() . ' ' : false;
        $sContent.= 'const ' . $oDTDataTypeGeneratorConstant->get_key() . ' = ';

        $sContent.= ('boolean' === gettype($oDTDataTypeGeneratorConstant->get_value())) ?
            (true === $oDTDataTypeGeneratorConstant->get_value()) ? 'true' : 'false'
            : $oDTDataTypeGeneratorConstant->get_value();

        $sContent.= ";\r\n\r\n";

        return $sContent;
    }

    /**
     * @param DTDataTypeGeneratorProperty $oProperty
     * @return string
     */
    private function createProperty(DTDataTypeGeneratorProperty $oProperty)
    {
        $sContent = '';
        $sContent.= "\t/**\r\n\t * @var " . $oProperty->get_var() . "\r\n\t */\r\n";
        $sContent.= "\t" . $oProperty->get_visibility() . " $" . $oProperty->get_key();

        if (null !== $oProperty->get_value())
        {
            $sContent.= ' = ';

            if ('string' == strtolower($oProperty->get_var()))
            {
                $sContent.= '"' . $oProperty->get_value() . '"';
            }
            else
            {
                $sContent.= $oProperty->get_value();
            }
        }
        elseif ('string' == strtolower($oProperty->get_var()))
        {
            $sContent.= " = ''";
        }
        elseif ('int' == substr(strtolower($oProperty->get_var()), 0, 3))
        {
            $sContent.= " = 0";
        }
        elseif ('array' == strtolower($oProperty->get_var()))
        {
            $sContent.= " = array()";
        }

        $sContent.= ';';
        $sContent.= "\r\n\r\n";

        return $sContent;
    }

    /**
     * @param string $sClassName
     * @return string
     */
    private function createConstructor($sClassName = '')
    {
        $sContent = "    /**
     * " . $sClassName . " constructor.
     * @param array " . '$aData' . "
     */
    public function __construct(array " . '$aData' . " = array())
    {
        foreach (" . '$aData' . " as " . '$sKey' . " => " . '$mValue' . ")
        {
            " . '$sMethod' . " = 'set_' . " . '$sKey' . ";

            if (method_exists(" . '$this' . ", " . '$sMethod' . "))
            {
                " . '$this->$sMethod($mValue)' . ";
            }
        }
    }\n\n";

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
     */
    public static function create(array " . '$aData' . " = array())
    {
        " . '$oObject' . " = new self(" . '$aData' . ");

        return " . '$oObject' . ";
    }\n\n";

        return $sContent;
    }

    /**
     * @param DTDataTypeGeneratorProperty $oProperty
     * @return string
     */
    private function createStaticPropertyGetter(DTDataTypeGeneratorProperty $oProperty)
    {
        $sContent = '';
        $sContent.= "\t/**\r\n\t * @return string\r\n\t */\r\n\tpublic static function getPropertyName_" . $oProperty->get_key() . "()\r\n\t{
        return '" . $oProperty->get_key() . "';\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @return string
     */
    private function createMagics()
    {
        $sContent = '';
        $sContent.= "\t/**\r\n\t * @return false|string JSON\r\n\t */\r\n\tpublic function __toString()\r\n\t{
        return " . '$this->getPropertyJson();' . "\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @return string
     */
    private function createHelpfulPropertyGetter()
    {
        $sContent = '';
        $sContent.= "\t/**\r\n\t * @return false|string\r\n\t */\r\n\tpublic function getPropertyJson()\r\n\t{
        return json_encode(" . '$this->getPropertyArray());' . "\r\n\t}\r\n\r\n";

        $sContent.= "\t/**\r\n\t * @return array\r\n\t */\r\n\tpublic function getPropertyArray()\r\n\t{
        return " . 'get_object_vars($this);' . "\r\n\t}\r\n\r\n";

        return $sContent;

    }

    /**
     * @return string
     */
    private function createHelpfulPropertySetter()
    {
        $sContent = '';
        $sContent.= "\t/**\r\n\t * @return " . '$this' . "\r\n\t */\r\n\tpublic function flushProperties()\r\n\t{";
        $sContent.= "\r\n\t\tforeach (" . '$this->getPropertyArray() as $sKey => $aValue)' . "\r\n\t\t{\r\n\t\t\t";
        $sContent.= '$sMethod' . " = 'set_' . " . '$sKey;' . "\r\n\r\n\t\t\t";
        $sContent.= 'if (method_exists($this, $sMethod)) ' . "\r\n\t\t\t{";
        $sContent.= "\r\n\t\t\t\t" . '$this->$sMethod(\'\');' . "\r\n\t\t\t" . '}';
        $sContent.= "\r\n\t\t}\r\n\r\n\t\t" . 'return $this;' . "\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @param DTDataTypeGeneratorProperty $oProperty
     * @return string
     */
    private function createSetter(DTDataTypeGeneratorProperty $oProperty)
    {
        $sContent = '';
        $sContent.= "\t/**\r\n\t * @param " . $oProperty->get_var() . ' $mValue ' . "\r\n\t * @return " . '$this' . "\r\n\t */\r\n";
        $sContent.= "\tpublic function set_" . $oProperty->get_key() . '(';

        // place type for php7 and newer
        (70 <= $this->iPhpVersion) ? $sContent.= $oProperty->get_var() . ' ' : false;

        $sContent.= '$mValue)' . "\r\n";
        $sContent.= "\t{\r\n\t\t" . '$this->' . $oProperty->get_key() . ' = $mValue;' . "\r\n\r\n\t\treturn " . '$this;' . "\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @param DTDataTypeGeneratorProperty $oProperty
     * @return string
     */
    private function createGetter(DTDataTypeGeneratorProperty $oProperty)
    {
        $sContent = '';
        $sContent.= "\t/**\r\n\t * @return " . $oProperty->get_var() . "\r\n\t */\r\n";
        $sContent.= "\tpublic function get_" . $oProperty->get_key() . '()';
        (70 <= $this->iPhpVersion) ? $sContent.= ' : ' . $oProperty->get_var() : false;
        $sContent.= "\r\n";
        $sContent.= "\t{\r\n\t\t" . 'return $this->' . $oProperty->get_key() . ';' . "\r\n\t}\r\n\r\n";

        return $sContent;
    }

    /**
     * @param string $sFile
     * @param string $sContent
     * @return bool
     */
    private function writeInto($sFile = '', $sContent = '')
    {
        return (boolean) file_put_contents(
            $sFile,
            $sContent . PHP_EOL,
            FILE_APPEND
        );
    }
}
