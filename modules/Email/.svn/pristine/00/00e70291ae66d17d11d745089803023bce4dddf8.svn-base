<?php

$aConfig = array(
    'dir' => \MVC\Registry::get("MVC_MODULES") . '/Email/DataType/',
    'unlinkDir' => false,
    'class' => array(
        array(
            'name' => 'Config',
            'file' => 'Config.php',
            'namespace' => 'Email\\DataType',
            'constant' => array(
            ),
            'property' => array(
                array('key' => 'sAbsolutePathToFolderSpooler',),
                array('key' => 'sAbsolutePathToFolderAttachment',),
                array('key' => 'aIgnoreFile', 'var' => 'array', 'value' => array('..', '.', '.ignoreMe')),
                array('key' => 'sFolderNew', 'value' => 'new'),
                array('key' => 'sFolderDone', 'value' => 'done'),
                array('key' => 'sFolderRetry', 'value' => 'retry'),
                array('key' => 'sFolderFail', 'value' => 'fail'),
                array('key' => 'iAmountToSpool', 'value' => 10, 'var' => 'int'),
                array('key' => 'iMaxSecondsOfRetry', 'value' => (60 * 60 * 2), 'var' => 'int'),
                array('key' => 'oCallback', 'value' => null),
            ),
        ),
        array(
            'name' => 'Email',
            'namespace' => 'Email\\DataType',
            'property' => array(
                array('key' => 'subject',),
                array(
                    'key' => 'recipientMailAdresses',
                    'var' => 'array',
                ),
                array('key' => 'text',),
                array('key' => 'html',),
                array('key' => 'senderMail',),
                array('key' => 'senderName',),
                array(
                    'key' => 'oAttachment',
                    'var' => '\\MVC\\DataType\\DTArrayObject',
                    'value' => '\MVC\DataType\DTArrayObject::create()',
                ),
            ),
        ),
        array(
            'name' => 'EmailAttachment',
            'namespace' => 'Email\\DataType',
            'property' => array(
                array('key' => 'name',),
                array('key' => 'content',),
                array('key' => 'file',),
            ),
        ),
    ),
);
