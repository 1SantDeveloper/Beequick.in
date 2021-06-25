<?php

/**
 * This example shows sending a message using PHP's mail() function.
 */

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Set who the message is to be sent from
$mail->setFrom('scn.arn@gmail.com', 'BeeQuick Courier');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@beequick.in', 'vieshesh Swami');
//Set who the message is to be sent to
$mail->addAddress('sachinarayans@gmail.com', 'Sachin Arayans');
//Set the subject line
$mail->Subject = 'Order Confirmation';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML("<h1>this is Your password</h1>");
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}