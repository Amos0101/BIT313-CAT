<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $otp = trim($_POST['otp']);
    $new_password = $_POST['new_password'];

    // Validate inputs
    if (empty($email) || empty($otp) || empty($new_password)) {
        die("All fields are required.");
    }

    // Verify OTP
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email AND otp_code = :otp");
    $stmt->execute(['email' => $email, 'otp' => $otp]);
    $user = $stmt->fetch();

    if ($user) {
        // Hash new password
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password and clear OTP
        $stmt = $pdo->prepare("UPDATE users SET password = :password, otp_code = NULL WHERE email = :email");
        $stmt->execute(['password' => $hashedPassword, 'email' => $email]);

        echo "Password reset successfully.<a href='index.html'>Login here</a> "; 
        

    } else {
        echo "Invalid OTP.";
    }
}
?>
