<?php
    if(isset($_POST['Logout']))
    {
        session_destroy();
        header("location: login.php");
    }

    if(!isset($_SESSION['AdminUsername']))
    {
        header("location: login.php");
    }
?>