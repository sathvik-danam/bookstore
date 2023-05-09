<?php
require_once("logout.php");

require_once("theconnection.php");

if(isset($_POST['delete']))
{
    $id= $_POST['cid'];

    $smt = $Conn->prepare('DELETE FROM categories WHERE category_id='.$id);
    $smt->execute();
}

header("location: adminCategories.php");



?>