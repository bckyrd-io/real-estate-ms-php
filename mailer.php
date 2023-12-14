<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;               //Enable verbose debug output
    $mail->isSMTP();                                     //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                            //Enable SMTP authentication
    $mail->Username   = 'bckyrd.io@gmail.com';           //SMTP username
    $mail->Password   = 'xjtw lmvt eybc wxmi';           //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                             //TCP port to connect to; use 465 for `PHPMailer::ENCRYPTION_SMTPS`

    //Recipients
    $mail->setFrom('bckyrd.io@gmail.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addReplyTo('bckyrd.io@gmail.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
