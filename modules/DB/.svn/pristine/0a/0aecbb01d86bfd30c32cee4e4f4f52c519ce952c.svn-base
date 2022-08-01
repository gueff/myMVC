<?php

$aConfig = array(
    'dir' => \MVC\Registry::get("MVC_MODULES") . '/DB/DataType/DB/',
    'unlinkDir' => true,
    'class' => array(
        0 => array(
            'name' => 'Table',
            'namespace' => 'DB\\DataType\\DB',
            'property' => array(
                0 => array(
                    'key' => 'sName',
                    'var' => 'string',
                ),
                1 => array(
                    'key' => 'aField',
                    'var' => 'Field[]',
                ),
            ),
        ),
        1 => array(
            'name' => 'Field',
            'namespace' => 'DB\\DataType\\DB',
            'constant' => array(
                0 => array(
                    'key' => 'CHARACTER_UTF8',
                    'value' => '"utf8"',
                ),
                1 => array(
                    'key' => 'COLLATE_UTF8_BIN',
                    'value' => '"utf8_bin"',
                ),
            ),
            'property' => array(
                0 => array(
                    'key' => 'sName',
                    'var' => 'string',
                ),
                1 => array(
                    'key' => 'iLength',
                    'var' => 'int',
                ),
                2 => array(
                    'key' => 'bIsChangeable',
                    'var' => 'bool',
                    'value' => true,
                ),
                3 => array(
                    'key' => 'oType',
                    'var' => '\\DB\\DataType\\SQL\\FieldTypeConcrete',
                ),
                4 => array(
                    'key' => 'sCharacter',
                    'var' => 'string',
                ),
                5 => array(
                    'key' => 'sCollate',
                    'var' => 'string',
                ),
                6 => array(
                    'key' => 'bNull',
                    'var' => 'bool',
                    'value' => true,
                ),
                7 => array(
                    'key' => 'sComment',
                    'var' => 'string',
                ),
            ),
        ),
        2 => array(
            'name' => 'Foreign',
            'file' => 'Foreign.php',
            'namespace' => 'DB\\DataType\\DB',
            'constant' => array(
                0 => array(
                    'key' => 'UPDATE_CASCADE',
                    'var' => 'string',
                    'value' => '" ON UPDATE CASCADE "',
                    'visibility' => 'public',
                ),
                1 => array(
                    'key' => 'UPDATE_SET_NULL',
                    'var' => 'string',
                    'value' => '" ON UPDATE SET NULL "',
                    'visibility' => 'public',
                ),
                2 => array(
                    'key' => 'UPDATE_NO_ACTION',
                    'var' => 'string',
                    'value' => '" ON UPDATE NO ACTION "',
                    'visibility' => 'public',
                ),
                3 => array(
                    'key' => 'UPDATE_RESTRICT',
                    'var' => 'string',
                    'value' => '" ON UPDATE RESTRICT "',
                    'visibility' => 'public',
                ),
                4 => array(
                    'key' => 'DELETE_CASCADE',
                    'var' => 'string',
                    'value' => '" ON DELETE CASCADE "',
                    'visibility' => 'public',
                ),
                5 => array(
                    'key' => 'DELETE_SET_NULL',
                    'var' => 'string',
                    'value' => '" ON DELETE SET NULL "',
                    'visibility' => 'public',
                ),
                6 => array(
                    'key' => 'DELETE_NO_ACTION',
                    'var' => 'string',
                    'value' => '" ON DELETE NO ACTION "',
                    'visibility' => 'public',
                ),
                7 => array(
                    'key' => 'DELETE_RESTRICT',
                    'var' => 'string',
                    'value' => '" ON DELETE RESTRICT "',
                    'visibility' => 'public',
                ),
            ),
            'property' => array(
                0 => array(
                    'key' => 'sForeignKey',
                    'var' => 'string',
                ),
                1 => array(
                    'key' => 'sForeignKeySQL',
                    'var' => 'string',
                    'value' => 'INT(11) NULL AFTER `id`',
                ),
                2 => array(
                    'key' => 'sReferenceTable',
                    'var' => 'string',
                ),
                3 => array(
                    'key' => 'sReferenceKey',
                    'var' => 'string',
                    'value' => 'id',
                ),
                4 => array(
                    'key' => 'sOnDelete',
                    'var' => 'string',
                    'value' => ' ON DELETE NO ACTION ',
                ),
                5 => array(
                    'key' => 'sOnUpdate',
                    'var' => 'string',
                    'value' => ' ON UPDATE NO ACTION ',
                ),
            ),
        ),
        3 => array(
            'name' => 'Constraint',
            'file' => 'Constraint.php',
            'namespace' => 'DB\\DataType\\DB',
            'property' => array(
                0 => array(
                    'key' => 'COLUMN_NAME',
                    'var' => 'string',
                ),
                1 => array(
                    'key' => 'CONSTRAINT_NAME',
                    'var' => 'string',
                ),
                2 => array(
                    'key' => 'REFERENCED_COLUMN_NAME',
                    'var' => 'string',
                ),
                3 => array(
                    'key' => 'REFERENCED_TABLE_NAME',
                    'var' => 'string',
                ),
            ),
        ),
        4 => array(
            'name' => 'TableDataType',
            'file' => 'TableDataType.php',
            'namespace' => 'DB\\DataType\\DB',
            'property' => array(
                0 => array(
                    'key' => 'id',
                    'var' => 'int',
                    'value' => 0,
                ),
                1 => array(
                    'key' => 'stampChange',
                    'var' => 'string',
                    'value' => '',
                ),
                2 => array(
                    'key' => 'stampCreate',
                    'var' => 'string',
                    'value' => '',
                ),
            ),
        ),
    ),
);