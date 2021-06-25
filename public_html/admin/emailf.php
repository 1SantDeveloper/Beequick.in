<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

function emailf($to, $name, $sub,$msg,$altmsg){
    //Create a new PHPMailer instance
    $mail = new PHPMailer();
    //Set who the message is to be sent from
    $mail->setFrom('support@beequick.in', 'BeeQuick Courier');
    //Set an alternative reply-to address
    $mail->addReplyTo('support@beequick.in', 'BeeQuick Courier');
    //Set who the message is to be sent to
    $mail->addAddress($to, $name);
    //Set the subject line
    $mail->Subject = $sub;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML($msg);
    //Replace the plain text body with one created manually
    $mail->AltBody = $altmsg;
    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        return false;// $mail->ErrorInfo;
    } else {
        return true;
    }
}
?>