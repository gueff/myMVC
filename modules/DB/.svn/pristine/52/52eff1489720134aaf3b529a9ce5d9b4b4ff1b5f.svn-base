<?php

// lade MVC bootstrap
require_once realpath(__DIR__ . '/../../') . '/application/config/util/bootstrap.php';

#-------------------------

\Cachix::init(\MVC\Registry::get('CACHIX_CONFIG'));

$sDir = '/' . basename(dirname(__FILE__)) . '/DataType';

$sDirDB = $sDir . '/DB/';
$sNamespaceDB = str_replace('/', '\\', substr($sDirDB, 1, -1));

$sDirSQL = $sDir . '/SQL/';
$sNamespaceSQL = str_replace('/', '\\', substr($sDirSQL, 1, -1));

#-------------------------

$aConfig['DATATYPE'] = array();

$aConfig['DATATYPE']['DB'] = array(

    'dir' => '{MVC_MODULES}' . $sDirDB,
    'unlinkDir' => true,
    'class' => array(

        array(
            'name' => 'Table',
            'namespace' => $sNamespaceDB,
            'property' => array(
                array('key' => 'sName', 'var' => 'string'),
                array('key' => 'aField', 'var' => 'Field[]'),
            )
        ),
        array(
            'name' => 'Field',
            'namespace' => $sNamespaceDB,
            'constant' => array(
                array('key' => 'CHARACTER_UTF8'     , 'value' => '"utf8"'),
                array('key' => 'COLLATE_UTF8_BIN', 'value' => '"utf8_bin"'),
            ),
            'property' => array(
                array(
                    'key' => 'sName',
                    'var' => 'string'
                ),
                array(
                    'key' => 'iLength',
                    'var' => 'int'
                ),
                array(
                    'key' => 'bIsChangeable',
                    'var' => 'bool',
                    'value' => true
                ),
                array(
                    'key' => 'oType',
                    'var' => '\DB\DataType\SQL\FieldTypeConcrete'
                ),
                array(
                    'key' => 'sCharacter',
                    'var' => 'string'
                ),
                array(
                    'key' => 'sCollate',
                    'var' => 'string'
                ),
                array(
                    'key' => 'bNull',
                    'var' => 'bool',
                    'value' => true
                ),
                array(
                    'key' => 'sComment',
                    'var' => 'string'
                ),
            )
        ),

        array(
            'name' => 'Foreign',
            'file' => 'Foreign.php',
            'namespace' => $sNamespaceDB,
            'constant' => array(
                array('key' => 'UPDATE_CASCADE'     , 'var' => 'string', 'value' => '" ON UPDATE CASCADE "'   , 'visibility' => 'public'),
                array('key' => 'UPDATE_SET_NULL'    , 'var' => 'string', 'value' => '" ON UPDATE SET NULL "'  , 'visibility' => 'public'),
                array('key' => 'UPDATE_NO_ACTION'   , 'var' => 'string', 'value' => '" ON UPDATE NO ACTION "' , 'visibility' => 'public'),
                array('key' => 'UPDATE_RESTRICT'    , 'var' => 'string', 'value' => '" ON UPDATE RESTRICT "'  , 'visibility' => 'public'),
                array('key' => 'DELETE_CASCADE'     , 'var' => 'string', 'value' => '" ON DELETE CASCADE "'   , 'visibility' => 'public'),
                array('key' => 'DELETE_SET_NULL'    , 'var' => 'string', 'value' => '" ON DELETE SET NULL "'  , 'visibility' => 'public'),
                array('key' => 'DELETE_NO_ACTION'   , 'var' => 'string', 'value' => '" ON DELETE NO ACTION "' , 'visibility' => 'public'),
                array('key' => 'DELETE_RESTRICT'    , 'var' => 'string', 'value' => '" ON DELETE RESTRICT "'  , 'visibility' => 'public'),
            ),
            'property' => array(
                array('key' => 'sForeignKey'        , 'var' => 'string'),
                array('key' => 'sForeignKeySQL'     , 'var' => 'string', 'value' => 'INT(11) NULL AFTER `id`'),
                array('key' => 'sReferenceTable'    , 'var' => 'string'),
                array('key' => 'sReferenceKey'      , 'var' => 'string', 'value' => 'id'),
                array('key' => 'sOnDelete'          , 'var' => 'string', 'value' => ' ON DELETE NO ACTION '),
                array('key' => 'sOnUpdate'          , 'var' => 'string', 'value' => ' ON UPDATE NO ACTION '),
//                array('key' => 'UPDATE_CASCADE'     , 'var' => 'string', 'value' => ' ON UPDATE CASCADE '   , 'visibility' => 'public'),
//                array('key' => 'UPDATE_SET_NULL'    , 'var' => 'string', 'value' => ' ON UPDATE SET NULL '  , 'visibility' => 'public'),
//                array('key' => 'UPDATE_NO_ACTION'   , 'var' => 'string', 'value' => ' ON UPDATE NO ACTION ' , 'visibility' => 'public'),
//                array('key' => 'UPDATE_RESTRICT'    , 'var' => 'string', 'value' => ' ON UPDATE RESTRICT '  , 'visibility' => 'public'),
//                array('key' => 'DELETE_CASCADE'     , 'var' => 'string', 'value' => ' ON DELETE CASCADE '   , 'visibility' => 'public'),
//                array('key' => 'DELETE_SET_NULL'    , 'var' => 'string', 'value' => ' ON DELETE SET NULL '  , 'visibility' => 'public'),
//                array('key' => 'DELETE_NO_ACTION'   , 'var' => 'string', 'value' => ' ON DELETE NO ACTION ' , 'visibility' => 'public'),
//                array('key' => 'DELETE_RESTRICT'    , 'var' => 'string', 'value' => ' ON DELETE RESTRICT '  , 'visibility' => 'public'),
            )
        ),
        array(
            'name' => 'Constraint',
            'file' => 'Constraint.php',
            'namespace' => $sNamespaceDB,
            'property' => array(
                array('key' => 'COLUMN_NAME'                , 'var' => 'string'),
                array('key' => 'CONSTRAINT_NAME'            , 'var' => 'string'),
                array('key' => 'REFERENCED_COLUMN_NAME'     , 'var' => 'string'),
                array('key' => 'REFERENCED_TABLE_NAME'      , 'var' => 'string'),
            )
        ),
//        array(
//            'name' => 'KeyValue',
//            'file' => 'KeyValue.php',
//            'namespace' => $sNamespaceDB,
//            'property' => array(
//                array('key' => 'sKey', 'var' => 'string'),
//                array('key' => 'sValue', 'var' => 'string'),
//                array('key' => 'sType', 'var' => 'string'),
//            )
//        ),
//        array(
//            'name' => 'ArrayObject',
//            'file' => 'ArrayObject.php',
//            'namespace' => $sNamespaceDB,
//            'property' => array(
//                array('key' => 'aKeyValue'      , 'var' => '\MVC\DataType\DTKeyValue[]', 'value' => 'array()'),
//            )
//        ),
        array(
            'name' => 'TableDataType',
            'file' => 'TableDataType.php',
            'namespace' => $sNamespaceDB,
            'property' => array(
                array('key' => 'id', 'var' => 'int', 'value' => 0), //, 'visibility' => 'public',),
                array('key' => 'stampChange', 'var' => 'string', 'value' => ''), //, 'visibility' => 'public',),
                array('key' => 'stampCreate', 'var' => 'string', 'value' => ''), //, 'visibility' => 'public',),
            )
        ),
    ),
);

$aConfig['DATATYPE']['SQL'] = array(
    'dir' => '{MVC_MODULES}' . $sDirSQL,
    'unlinkDir' => true,
    'class' => array(array('name' => 'FieldTypeConcrete', 'namespace' => $sNamespaceSQL,),)
);

$aSqlType = array(
    'char' => 'string',
    'varchar' => 'string',
    'binary' => 'string',
    'varbinary' => 'string',
    'tinyblob' => 'string',
    'blob' => 'string',
    'mediumblob' => 'string',
    'longblob' => 'string',
    'tinytext' => 'string',
    'text' => 'string',
    'mediumtext' => 'string',
    'longtext' => 'string',
    'enum' => 'string',
    'set' => 'string',

    'date' => 'string',
    'time' => 'string',
    'datetime' => 'string',
    'timestamp' => 'string',
    'year' => 'string',

    'tinyint' => 'int',
    'smallint' => 'int',
    'mediumint' => 'int',
    'int' => 'int',
    'bigint' => 'int',
    'float' => 'float',
    'double' => 'double',

    'bit' => 'boolean',
    'boolean' => 'boolean',
    'bool' => 'boolean',

    'geometry' => 'string',
    'point' => 'string',
    'linestring' => 'string',
    'polygon' => 'string',
    'geometrycollection' => 'string',
    'multilinestring' => 'string',
    'multipoint' => 'string',
    'multipolygon' => 'string',

    'json' => 'string',
);

// Classes TypeXY
foreach ($aSqlType as $sKey => $sPhp)
{
    $aConfig['DATATYPE']['SQL']['class'][] = array('name' => 'Type' . ucwords($sKey), 'namespace' => $sNamespaceSQL, 'extends' => 'FieldTypeConcrete');
}

// Properties für Class FieldType
foreach ($aSqlType as $sKey => $sPhp)
{
    $aFieldTypeProperty[] = array(
        'key' => 'type' . ucwords($sKey),
        'var' => 'Type' . ucwords($sKey),
        'visibility' => 'public',
        'value' => 'new ' . 'Type' . ucwords($sKey) . '()',

        'static' => true,
        'setter' => false,
        'getter' => false,

        'explicitMethodForValue' => true, # strtoupper('Type_' . $sKey),
        'listProperty' => false,                // nicht als Property aufführen
        'createStaticPropertyGetter' => false,  // Helpermethoden erzeugen
        'setValueInConstructor' => false,       // Value in constructor setzen
    );
}

// Class FieldType
$aConfig['DATATYPE']['SQL']['class'][] = array(
    'name' => 'FieldType',
    'namespace' => $sNamespaceSQL,
    'property' => $aFieldTypeProperty,

    'createHelperMethods' => true,
);

#-------------------------

// save proper DataType config files
foreach ($aConfig['DATATYPE'] as $sKey => $aValue)
{
    $sConfigName = 'MODULE_' . basename(dirname(__FILE__)). '_DATATYPE_' . $sKey;
    $sConfig = \MVC\Helper::VAREXPORT($aConfig['DATATYPE'][$sKey], true, false);
    $sConfig = str_replace("'{MVC_MODULES}", '\MVC\Registry::get("MVC_MODULES")' . " . '" , $sConfig);
    $sConfig = "<?php\n\n" . '$aConfig = ' . $sConfig . ';';
    (false === file_exists('./etc/config')) ? mkdir('etc/config') : false;
    (false === file_exists('./etc/config/DataType')) ? mkdir('etc/config/DataType') : false;
    file_put_contents(
        './etc/config/DataType/' . $sConfigName . '.php',
        $sConfig
    );
}

// Generate DataType Classes
foreach (glob ('./etc/config/DataType/*.php') as $sFile)
{
    require_once $sFile;
    \MVC\Generator\DataType::create(56)->initConfigArray($aConfig);
}