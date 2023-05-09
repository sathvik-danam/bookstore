<?php

session_start();
Execute();

function Execute()
{
    require_once("theconnection.php");

    if (isset($_SESSION['AdminUsername'])) {
        // header("location: login.php");
    }

    if (isset($_SESSION['UserUsername'])) {
        // header("location: addAuction.php");
    }

    if (!isset($_POST['Submit'])) {
        return false;
    }

    if (!isset($_POST["Username"]) || !isset($_POST["Password"])) {
        echo '<script>alert("Username or password not provided.");</script>';
        return false;
    }

    $Query = $Conn->prepare("select username,password,user_type from usertable where username='" . $_POST["Username"] . "'");
    $password = $_POST["Password"];
    $Query->execute();
    $result = $Query->fetch(PDO::FETCH_ASSOC);

    if (is_array($result)) {
        if (password_verify($password, $result['password'])) {

            //echo '<script>alert("test");</script>';

            if ($result['user_type'] == 'admin') {
                $_SESSION['AdminUsername'] = $_POST["Username"];
                //$_SESSION['logged_User'] = $_POST["Username"];
                header("location: adminCategories.php");
                exit();
            } else {
                $_SESSION['UserUsername'] = $_POST["Username"];
                //$_SESSION['logged_User'] = $_POST["Username"];
                header("location: addAuction.php");
                exit();
            }
        } else {
            echo '<script>alert("Incorrect username or password");</script>';
            return false;
        }
    }

    if ($result == null || count($result) <= 0) {
        echo '<script>alert("Incorrect username or password");</script>';
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mycss.css">
    <title>Document</title>
</head>

<body>
    <div style="text-align: -webkit-center;">
        <div class="login-form">
            <h2>LOGIN PAGE</h2>
            <form method="POST">
                <!-- need to add action command, but remonved it temporarily -->
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
    </div>
</body>

</html>