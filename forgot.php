<?php

session_start();
require'db.php';
require 'mailer.php';


if($_SERVER['REQUEST_METHOD']==='POST'){
    $email = $_POST['email'];

    if(empty($email))
        die('enter email');

        $query = "SELECT id FROM users WHERE email =:email";

    $stmt = $pdo-> prepare($query);
    $stmt-> execute(['email'=>$email]);
    $user = $stmt->fetch();

    if($user){
        $otp = rand(100000,999999);
        
        $query2 = "UPDATE users SET otp_code = :otp WHERE email = :email";
        $stmt = $pdo-> prepare($query2);

        $stmt->execute(['otp'=>$otp,'email'=>$email]);
        $subject = 'password reset otp';
        $message = "your otp for password reset is: $otp";

        if(sendEmail($email,$subject,$message)){
            echo'otp send to your email';

            header('location: reset.html');
        }else{
            echo'failed to send otp';

        }
        
    }else{
        echo'email not registered';
    }

}