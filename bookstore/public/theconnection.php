<?php
$host = "mysql";
$username = "student";
$password = "student";
$database = "assignment";
//$port = "3306";


try {
    $Conn = new PDO('mysql:dbname=' . $database . ';host=' . $host, $username, $password);
    // if ($Conn)
    //     echo "Connection Successful.";
} catch (PDOException $ex) {
    die($ex->getMessage());
}

?>