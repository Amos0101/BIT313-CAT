<?php
require 'db.php';

session_start();

if($_SERVER['REQUEST_METHOD']==='POST'){

    $username = $_POST['username'];
    $password = $_POST['password'];

    //check if the user is registered
    $sql = "SELECT * FROM users WHERE username =:username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username'=>$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //password verification
    if($user and password_verify($password,$user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username']= $user['username'];
        header('Location:homepage.html'); 
    }else
        echo'Invalid username or password';
}