<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

//load mailer using composer
require 'vendor/autoload.php';

function sendEmail($to,$subject,$message){

    $mail = new PHPMailer(true);

    try{
        $mail-> isSMTP();
        $mail-> Host = 'smtp.gmail.com';// SMTP server
        $mail->SMTPAuth = true;
        $mail-> Username = 'amoskilonzo370@gmail.com';//smtp username
        $mail->Password = 'ckht zprw dnhb hxql';//smtp password
        $mail-> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail-> setFrom('amoskilonzo370@gmail.com');
        $mail->addAddress($to);

        $mail-> isHTML(true);
        $mail->Subject = $subject;
        $mail-> Body = $message;

        $mail-> send();

        return true;
    }catch(Exception $e){
        return false;
    }
}