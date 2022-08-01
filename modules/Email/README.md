 
# Requirements

- Linux
- php 7
- [myMVC > 1.1.1 (current; dev-master)](https://github.com/gueff/myMVC)
    - ZIP: https://github.com/gueff/myMVC/archive/master.zip
        
## Config

~~~php
$aConfig['MODULE_EMAIL_CONFIG'] = array(

    // Spooler Folder
    'sAbsolutePathToFolderSpooler' => $aConfig['MVC_MODULES'] . '/Email/etc/data/spooler/',

    // Attachment Folder
    'sAbsolutePathToFolderAttachment' => $aConfig['MVC_MODULES'] . '/Email/etc/data/attachment/',

    // Number of e-mails to be processed simultaneously
    'iAmountToSpool' => 50,

    // max. time span for new delivery attempts (from "retry")
    'iMaxSecondsOfRetry' => (60 * 60 * 24), // 24h

    // what to do on "send"
    'oCallback' => function(\Email\DataType\Email $oEmail) {

        // e-mail sending via SMTP
        return \Email\Model\Smtp::sendViaPhpMailer($oEmail);

        /**
         * This is for not delivering any mail:
         *------------------------------------- 
         * instead of sending via smtp, the subject of each individual e-mail
         * is written to "test.log"
         *
         * This is good for running tests with lots of email sweeps.
         * So the SMTP mail server is not loaded.
         *
         * Simply deactivate the upper "e-mail sending via SMTP" line (comment out).
         */
        \MVC\Log::write($oEmail, 'email.log');

        $oResponse = \MVC\DataType\DTArrayObject::create()
            ->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('bSuccess')->set_sValue(true))
            ->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('sMessage')->set_sValue("TEST\t" . ' *** Closure *** '))
            ->add_aKeyValue(\MVC\DataType\DTKeyValue::create()->set_sKey('oException')->set_sValue(new \Exception("TEST\t" . ' *** Closure *** ')));

        return $oResponse;
    },

    /**
     * SMTP account settings
     */
    'sHost' => '',
    'iPort' => 465, # ssl=465 | tls=587
    'sSecure' => 'ssl', # ssl | tls
    'bAuth' => true,
    'sUsername' => '',
    'sPassword' => '',
);
~~~

## Create and send an E-Mail

~~~php
$oModelEmail = new \Email\Model\Index(
    Config::create(
        Registry::get('MODULE_EMAIL_CONFIG')
    )
);

// create an email
$oEmail = \Email\DataType\Email::create()
    ->set_subject('Test')
    ->set_recipientMailAdresses(array('foo@example.com'))
    ->set_senderMail('bar@example.com')
    ->set_senderName('bar from example')
    ->set_text('Test Text')
    ->set_html('Test HTML')
;

// give it to spooler
$oModelEmail->saveToSpooler($oEmail);

// spool!
$oModelEmail->spool();
~~~

## Spool

- E-mail files from the `retry` folder are read and moved to either `new` or `fail`, depending on the 
whether the maximum time for retry attempts ($iMaxSecondsOfRetry) for retry mails has been reached or not.
- There is still time for new delivery attempts_: E-Mail files are moved to the folder `new`.
- There is **no** time left for new delivery attempts_: Email files are moved to the `fail` folder
- E-mail files from the `new` folder are read and sent.
- _successful_: E-mail files are moved to the `done` folder.
- _failed_: Email files are moved to the `retry` folder

The maximum time period for new delivery attempts is defined in the config (see above) with the key `iMaxSecondsOfRetry`.


## Installation

~~~bash
./install.sh
~~~


## Module Events

`email.model.index.saveToSpooler.done`
~~~
Event::RUN('email.model.index.saveToSpooler.done',
    DTArrayObject::create()
        ->add_aKeyValue(DTKeyValue::create()->set_sKey('sFilename')->set_sValue($sFilename))
        ->add_aKeyValue(DTKeyValue::create()->set_sKey('sData')->set_sValue($sData))
        ->add_aKeyValue(DTKeyValue::create()->set_sKey('bSuccess')->set_sValue($bSuccess))
);
~~~

`email.model.index.spool`
~~~
Event::RUN('email.model.index.spool',  
    DTArrayObject::create()
    ->add_aKeyValue(DTKeyValue::create()->set_sKey('oSendResponse')->set_sValue($oSendResponse)) // bSuccess, sMessage, oException
    ->add_aKeyValue(DTKeyValue::create()->set_sKey('oSpoolResponse')->set_sValue($oSpoolResponse))    
);
~~~

`email.model.index._handleRetries`
~~~
Event::RUN('email.model.index._handleRetries',
    DTArrayObject::create()
        ->add_aKeyValue(DTKeyValue::create()->set_sKey('sOldname')->set_sValue($sOldName))
        ->add_aKeyValue(DTKeyValue::create()->set_sKey('sNewname')->set_sValue($sNewName))
        ->add_aKeyValue(DTKeyValue::create()->set_sKey('bMoveSuccess')->set_sValue($bRename))
        ->add_aKeyValue(DTKeyValue::create()->set_sKey('aMessage')->set_sValue($aMsg))
);
~~~

`email.model.index.escalate`
~~~
\MVC\Event::RUN('email.model.index.escalate',
    DTArrayObject::create()
        ->add_aKeyValue(
            DTKeyValue::create()->set_sKey('sMailFileName')->set_sValue($sMailFileName)
        )
        ->add_aKeyValue(
            DTKeyValue::create()->set_sKey('sEscalatedFileName')->set_sValue($sEscalatedFileName)
        )					
);
~~~

`email.model.index.deleteEmailAttachment`
~~~
Event::RUN(
    'email.model.index.deleteEmailAttachment',
    DTArrayObject::create()
        ->add_aKeyValue(
            DTKeyValue::create()
                ->set_sKey('bUnlink')
                ->set_sValue($bUnlink)
        )
        ->add_aKeyValue(
            DTKeyValue::create()
                ->set_sKey('sFile')
                ->set_sValue($sAbsoluteFilePath)
        )
);
~~~

`email.model.index.deleteEmailFile`
~~~
Event::RUN(
    'email.model.index.deleteEmailFile',
    DTArrayObject::create()
        ->add_aKeyValue(
            DTKeyValue::create()
                ->set_sKey('bUnlink')
                ->set_sValue($bUnlink)
        )
        ->add_aKeyValue(
            DTKeyValue::create()
                ->set_sKey('sFile')
                ->set_sValue($sAbsoluteFilePath)
        )
);
~~~
