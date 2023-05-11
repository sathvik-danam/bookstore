<?php
 require_once("theconnection.php");
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
        <input type="text" name="password" required placeholder="enter your password">
        
        <input type="submit" value="register now">
        <p><a href="login.php">already have an accout?</a></p>
        </form> 
    </div>
    
<?php
if(isset($_POST['submit'])){
$stmt = $Conn->prepare('INSERT INTO usertable (username, user_type, email, password)
 VALUES (:username, :user_type, :email, :password)');
unset($_POST['submit']);
$stmt->execute($_POST);
}
?>
</body>
</html>