<?php
session_start();

if (isset($_POST['Logout'])) {
    session_destroy();
    header("location: login.php");
}

if (!isset($_SESSION['UserUsername'])) {
    header("location: login.php");
}
require_once("theconnection.php");

if (isset($_GET['cid'])) {
    $smt = $Conn->prepare('SELECT * FROM auctions where auction_id=' . $_GET['cid']);
    $smt->execute();
    $phrase = $smt->fetch();
    print_r($phrase);
} else {
    header("location: addAuction.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Auctions</title>


</head>

<body>
    <h1>THIS PAGE EDITS AUCTIONS</h1>
    <div class="editauctions-form">
        <h2>EDIT AUCTION</h2>
        <?php
        if (isset($_GET['cid'])) {
            $id = $_GET['cid'];
            echo '<form action="?action=update&cid=' . $id . '" method="POST">';
        } else {

            echo "No id provided";
        }
        ?>

        <input type="text" name="title" required placeholder="Update title name" value="<?php echo $phrase['title'];   ?>" />
        <input type="text" name="description" required placeholder="update auction description" value="<?php echo $phrase['description']; ?>" />
        <input type="text" name="description" required placeholder="update auction description" value="<?php echo $phrase['category_id']; ?>" />
        

        <input type="text" name="endDate" required placeholder="update end date" value="<?php echo $phrase['endDate']; ?>" />


        <input type="submit" name="editauction" value="UPDATE" />

        </form>
    </div>


</body>

</html>

<?php

if (isset($_GET['action']) == "update") {
    $id = $_GET['cid'];
    $title_name = $_POST['title'];
    $description = $_POST['description'];
    
    $endDate = $_POST['endDate'];

    $smt = $Conn->prepare("UPDATE auctions SET `title`='$title_name', `description`='$description',
    `endDate`='$endDate' WHERE `auction_id`='$id' ");
    $smt->execute();

    if ($smt) {
        echo 'Updated';
    } else {
        echo 'Failed';
    }
}
?>