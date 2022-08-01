<?php
/**
 * Smtp.php
 *
 * @module Email
 * @package Email\Model
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace Email\Model;

use Email\DataType\Email;
use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;
use MVC\Event;
use MVC\Registry;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Smtp
{
    /**
     * @param \Email\DataType\Email $oEmail
     *
     * @return \MVC\DataType\DTArrayObject
     * @throws \ReflectionException
     */
    public static function sendViaPhpMailer(Email $oEmail)
    {
        $bSuccess = false;
        $sMessage = __METHOD__;
        $oException = null;

        try {

            $oPHPMailer = new PHPMailer(true);

            // Specify the SMTP settings.
            $oPHPMailer->isSMTP();
            $oPHPMailer->Username   = Registry::get('MODULE_EMAIL_CONFIG')['sUsername'];
            $oPHPMailer->Password   = Registry::get('MODULE_EMAIL_CONFIG')['sPassword'];
            $oPHPMailer->Host       = Registry::get('MODULE_EMAIL_CONFIG')['sHost'];
            $oPHPMailer->Port       = Registry::get('MODULE_EMAIL_CONFIG')['iPort'];
            $oPHPMailer->SMTPAuth   = Registry::get('MODULE_EMAIL_CONFIG')['bAuth'];
            $oPHPMailer->SMTPSecure = Registry::get('MODULE_EMAIL_CONFIG')['sSecure'];

            // Specify the content of the message.
            $oPHPMailer->setFrom(
                $oEmail->get_senderMail(),
                $oEmail->get_senderName()
            );
            $oPHPMailer->Subject    = $oEmail->get_subject();
            $oPHPMailer->isHTML(true);
            $oPHPMailer->Body       = $oEmail->get_html();
            $oPHPMailer->AltBody    = $oEmail->get_text();

            // Recipients
            /** @var string $sEmailRecipient */
            foreach ($oEmail->get_recipientMailAdresses() as $sEmailRecipient)
            {
                $oPHPMailer->addAddress($sEmailRecipient);
            }

            // Attachments
            /** @var array $aDTArrayObject */
            foreach ($oEmail->get_oAttachment() as $aDTArrayObject)
            {
                /** @var array $aDTKeyValue */
                foreach ($aDTArrayObject as $aDTKeyValue)
                {
                    $oDTKeyValue = DTKeyValue::create($aDTKeyValue);

                    $oPHPMailer->addAttachment(
                        $oDTKeyValue->get_sValue()['file'],
                        $oDTKeyValue->get_sValue()['name']
                    );
                }
            }

            $oPHPMailer->CharSet = 'UTF-8';
            $bSuccess = $oPHPMailer->Send();
            $sMessage = json_encode($bSuccess);

        } catch (phpmailerException $oException) {

            $bSuccess = false;
            $sMessage = $oException->getMessage();

            Event::RUN ('mvc.error',
                DTArrayObject::create()
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('bSuccess')->set_sValue(false))
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sNextStatus')->set_sValue('retry'))
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($oException->getMessage()))
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('oException')->set_sValue($oException))
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('oEmail')->set_sValue($oEmail))
            );

        } catch (Exception $oException) {

            $bSuccess = false;
            $sMessage = $oException->getMessage();

            Event::RUN ('mvc.error',
                DTArrayObject::create()
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('bSuccess')->set_sValue(false))
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sNextStatus')->set_sValue('retry'))
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($oException->getMessage()))
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('oException')->set_sValue($oException))
                    ->add_aKeyValue(DTKeyValue::create()->set_sKey('oEmail')->set_sValue($oEmail))
            );
        }

        $oResponse = DTArrayObject::create()
            ->add_aKeyValue(DTKeyValue::create()->set_sKey('bSuccess')->set_sValue($bSuccess))
            ->add_aKeyValue(DTKeyValue::create()->set_sKey('sNextStatus')->set_sValue(((true === $bSuccess) ? 'done' : 'retry')))
            ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($sMessage))
            ->add_aKeyValue(DTKeyValue::create()->set_sKey('oEmail')->set_sValue($oEmail))
            ->add_aKeyValue(DTKeyValue::create()->set_sKey('oException')->set_sValue($oException))
        ;

        return $oResponse;
    }
}
