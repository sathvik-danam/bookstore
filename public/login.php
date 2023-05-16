<?php

    session_start();
    Execute();
    
    function Execute()
    {
        require_once("theconnection.php");
     
        if(isset($_SESSION['AdminUsername']))
        {   
            header("location: adminCategories.php");
        }

        if(isset($_SESSION['UserUsername']))
        {   
            header("location: userpanel.php");
        }

        if (!isset($_POST['Submit'])) {
            return false;
        }

        if (!isset($_POST["Username"]) || !isset($_POST["Password"])) {
            echo '<script>alert("Username or password not provided.");</script>';
            return false;
        }

        $Query = $Conn->query("select * from usertable where username='" . $_POST["Username"] . "' AND password='" . $_POST["Password"] . "'");
        $result = $Query->fetch(PDO::FETCH_BOTH);
        
        if ($result == null || count($result) <= 0) {
            echo '<script>alert("Incorrect username or password");</script>';
            return false;
        }

        if($result['user_type'] == 'admin')
        {
            $_SESSION['AdminUsername'] = $_POST["Username"];
            header("location: adminCategories.php");
        }
        else
        {
            $_SESSION['UserUsername'] = $_POST["Username"];
            header("location: userpanel.php");   
        }
        
        return true;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bookshop.css">
    <title>Login Form</title>
</head>

<body>
    <div class="login-form">
        <h2>LOGIN PAGE</h2>
        <form method="POST">
            <div class="input-field">
                <input type="text" placeholder="Username" name="Username">
            </div>
            <div class="input-field">
                <input type="password" placeholder="Password" name="Password">
            </div>

            <button type="submit" name="Submit">Sign In</button>
            <a href="register.php">Sign up</a>
        </form>
    </div>
</body>

</html>
