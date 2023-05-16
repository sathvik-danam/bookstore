<?php
require_once("theconnection.php");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bookshop.css" />
    <title>Edit Categories</title>


</head>

<body>

    <div class="editcategories-form">
        <h2>EDIT CATEGORY</h2>
        <?php 
        if(isset($_GET['cid'])){
            $id = $_GET['cid'];
            echo '<form action="?action=update&id='.$id.'" method="POST">';
        }
        ?>

            <input type="text" name="category_name" required placeholder="Update category name">
            <input type="text" name="description" required placeholder="update category description">

            <input type="submit" name="editcategory" value="UPDATE">

        </form>
    </div>

   
</body>
</html>

<?php

if(isset($_GET['action']) == "update")
{
    $id= $_GET['id'];
    $category_name = $_POST['category_name'];
    $description = $_POST['description'];

    $smt = $Conn->prepare("UPDATE categories SET `category_name`='$category_name', `description`='$description' WHERE `category_id`='$id'");
    $smt->execute();

    if($smt){
        echo 'Updated';
    }else{
        echo 'Failed';
    }
}



?>