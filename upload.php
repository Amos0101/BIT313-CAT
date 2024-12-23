<?php
    require 'db.php'; // Include database connection
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle file upload
        $file = $_FILES['file'];
        $uploadDir = 'C:\Users\kilonzo\Desktop';                                                                               
        $filePath = $uploadDir . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Insert file details into database
        $sql = "INSERT INTO uploads (user_id, file_path) VALUES (:user_id,
        :file_path)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $_SESSION['user_id'], 'file_path' =>
        $filePath]);
        echo "File uploaded successfully.";
        } else {
        echo "File upload failed.";
        }
    }
?>
