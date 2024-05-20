<?php

$email = $_POST['email'];
$sujet = $_POST['sujet'];
$message = $_POST['message'];

$messages = '<b>email :</b> '.$email.' <br> <b>sujet :</b> '. $email.' <br> <b>message :/<b> '.$message ;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMAILER/src/Exception.php';
require 'PHPMAILER/src/PHPMailer.php';
require 'PHPMAILER/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'findesnuisible@gmail.com';                     //SMTP username
    $mail->Password   = 'vxrj yhyp tebt jnqa';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Arcadia');
    $mail->addAddress('mennad.boutaleb@outlook.fr');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = $messages;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    header('location:../index.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}