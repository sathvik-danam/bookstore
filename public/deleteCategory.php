<?php
require_once("theconnection.php");

if(isset($_GET['cid']))
{
    $id= $_GET['cid'];

    $smt = $Conn->prepare('DELETE FROM categories WHERE category_id='.$id);
    $smt->execute();
}

header("location: adminCategories.php");

?>