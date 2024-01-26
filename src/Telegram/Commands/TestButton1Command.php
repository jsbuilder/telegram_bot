<?php
namespace App\Telegram\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * This command can be triggered in two ways:
 * /start and /join due to the alias.
 */
class TestButton1Command extends Command
{

    protected string $name = 'test_button1';

    protected string $description = 'Test Button1';

    public function handle()
    {
        $config = $GLOBALS['config'];
        $message = $this->getUpdate()->getMessage();
        # This will update the chat status to "typing..."
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $this->replyWithMessage(
            [
                'text' => "мы имеем данные по вам\r\n"
                    . print_r($message, true)
                    . "\r\nВы нажали button1"
            ]
        );

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $config['mail']['host'];                //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $config['mail']['username'];            //SMTP username
            $mail->Password   = $config['mail']['password'];             //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('rfatuk@yandex.ru', 'Mailer');
            $mail->addAddress('jsbuilder@inbox.ru', 'Joe User');     //Add a recipient
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'WebHoook';
            $mail->Body    =  print_r($message, true);
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

            $this->replyWithMessage(
                [
                    'text' => "Message has been sent"
                ]
            );
        } catch (Exception $e) {
            $this->replyWithMessage(
                [
                    'text' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
                ]
            );
        }
    }
}
