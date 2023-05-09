<?php
require_once("theconnection.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $user_type = $_POST['user_type'];
    $email = $_POST['email'];
    //$password = $_POST['password'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $Conn->prepare('INSERT INTO usertable (username, user_type, email, password) VALUES (:username, :user_type, :email, :password)');
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':user_type', $user_type);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration form</title>
</head>
<body>
    <div class="userlogin-form">
        <h2>Register now</h2>
        <form method="POST">
            <input type="text" name="username" required placeholder="enter your name">
            <input type="text" name="user_type" required placeholder="usertype?">
            <input type="text" name="email" required placeholder="enter your email">
            <input type="password" name="password" required placeholder="enter your password">
            <input type="submit" value="register now">
            <p><a href="adminlogin.php">already have an accout?</a></p>
        </form> 
    </div>
</body>
</html>
