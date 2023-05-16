<?php
require_once("theconnection.php");

if(isset($_GET['cid']))
{
    $id= $_GET['cid'];

    $smt = $Conn->prepare('DELETE FROM auctions WHERE auction_id='.$id);
    $smt->execute();
}

header("location: addProducts.php");

?>