<?php
session_start();

require 'db.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    $new_password = $_POST['new_password'];
    
    //inputs validation
    if(empty($email) or empty($otp)or empty($new_password)){
        die('All fields are required');
    }
    //otp verification
    $query = "SELECT id FROM users WHERE email = :email AND otp_code = :otp";
    $stmt = $pdo-> prepare($query);
    $stmt->bindParam('otp', $otp, PDO::PARAM_INT);
    $stmt->execute(['email'=>$email,'otp'=>$otp]);
    $user = $stmt->fetch();

    if($user){
        //hash password

        $hashed = password_hash($new_password,PASSWORD_DEFAULT);

        //update password and clear otp
        $stmt = $pdo->prepare("UPDATE users SET password = :password, otp_code = NULL WHERE email = :email");
        $stmt->execute(['password' => $hashed, 'email' => $email]);

        echo "Password reset successfully.<a href='index.html'>Login here</a";
    }else{
        echo"invalid otp";
    }

}