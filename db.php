<?php
// Database connection details
$host = 'localhost';
$db = 'final_login';
$user = 'root';
$pass = '';
try {
 // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>