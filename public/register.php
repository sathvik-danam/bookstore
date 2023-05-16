<?php
 require_once("theconnection.php");

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bookshop.css">
    <title>Registration form</title>
</head>
<body>
    
    <div class="register-form">
        <h2>Register now</h2>
        <form method="POST">
        <div class="input-field">
           <input type="text" name="username" required placeholder="enter your name">
    </div>
    <div class="input-field">
       <input type="text" name="user_type" required placeholder="usertype?">
      </div>
    <div class="input-field">
        <input type="text" name="email" required placeholder="enter your email">
     </div>
    <div class="input-field">   
        <input type="text" name="password" required placeholder="enter your password">
     </div>

    <div class="input-field register-now">
        <input type="submit" name="submit" value="Register now">
</div>
        <p><a href="login.php">Already have an account?</a></p>
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