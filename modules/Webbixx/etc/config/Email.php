<?php

//-------------------------------------------------------------------------------------
// Module Email

$aConfig['MODULE_EMAIL_CONFIG'] = array(

    // Spooler Folder
    'sAbsolutePathToFolderSpooler' => realpath(__DIR__ . '/../../../') . '/Email/etc/data/spooler/',

    // Attachment Folder
    'sAbsolutePathToFolderAttachment' => realpath(__DIR__ . '/../../../') . '/Email/etc/data/attachment/',
    
    // Anzahl der gleichzeitig abzuarbeitenden E-Mails
    'iAmountToSpool' => 400,

    // max. Zeitspanne für erneute Zustellversuche (aus "retry" heraus)
    'iMaxSecondsOfRetry' => (60 * 60 * 24), // 24h

    'oCallback' => function(\Email\DataType\Email $oEmail) {

        /**
         * e-mail sending via SMTP
         * -----------------------
         * Just keep this activated for sending email via smtp.
         */
//        return \Email\Model\Smtp::sendViaPhpMailer($oEmail);

        /**
         * For Testing
         * -----------------------
         * This is for not delivering any mail.
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
    'sHost' => 'mail3.mediafinanz.de',
    'iPort' => 465, # ssl=465 | tls=587
    'sSecure' => 'ssl', # ssl | tls
    'bAuth' => true,
    'sUsername' => 'website@mediafinanz.de',
    'sPassword' => 'Ki(zhIj7Tt78gG%',
);
