<?php
session_start();
require 'db.php';
require 'send_email.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    // Validate email
    if (empty($email)) {
        die("Email is required.");
    }

    // Check if user exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        // Generate OTP
        $otp = rand(100000, 999999);

        // Store OTP in the database
        $stmt = $pdo->prepare("UPDATE users SET otp_code = :otp WHERE email = :email");
        $stmt->execute(['otp' => $otp, 'email' => $email]);

        // Send OTP via email
        $subject = "Password Reset OTP";
        $message = "Your OTP for password reset is: $otp";
        if (sendEmail($email, $subject, $message)) {
            echo "OTP sent to your email.";
            header('Location: reset.html');

        } else {
            echo "Failed to send OTP.";
        }
    } else {
        echo "Email not registered.";
    }
}
?>
