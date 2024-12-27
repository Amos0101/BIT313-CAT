<?php
require 'db.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);

    //INSERT USER INTO DATABASE
    $sql = "INSERT INTO users (name,email,username, password) VALUES (:name,:email,:username,:password)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute(['name' => $name,'email' => $email,'username' => $username, 'password' => $password]);
        echo'Registered successfully';
        header('Location: index.html');

    } catch (PDOException $e) {
        echo"Error" .$e->getMessage();
    }
}