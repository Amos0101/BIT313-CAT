<?php
require 'db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Insert user into database
    $sql = "INSERT INTO users (name,email,username, password) VALUES (:name,:email,:username,:password)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute(['name' => $name,'email' => $email,'username' => $username, 'password' => $password]);
        echo "Registration successful.";
        header("Location: index.html"); // Redirect to login page
    } catch (PDOException $e) {
       echo "Error: " . $e->getMessage();
 }
}
?>
