<?php
require_once("theconnection.php");
if (isset($_GET['cid'])) {
$smt = $Conn->prepare('SELECT * FROM books WHERE book_id=' . $_GET['cid']);
    $smt->execute();
    $phrase = $smt->fetch();
    // print_r($phrase);
} else {
    // Redirect ??
}

if (isset($_GET['action']) == "update") {
    $id = $_GET['cid'];
    $title_name = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['endDate'];
    $price = $_POST['price'];

    $smt = $Conn->prepare("UPDATE books SET `title`=:title_name, `description`=:description, `endDate`=:date, `price`=:price WHERE `book_id`=:id");
    $smt->execute(array(
        ':title_name' => $title_name,
        ':description' => $description,
        ':date' => $date,
        ':price' => $price,
        ':id' => $id
    ));
    

    if ($smt) {
        echo 'Updated';
    } else {
        echo 'Failed';
    }


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit books</title>


</head>

<body>
    <h1>THIS PAGE EDITS books</h1>
    <div class="editbooks-form">
        <h2>EDIT book</h2>
        <?php
        if (isset($_GET['cid'])) {
            $id = $_GET['cid'];
            echo '<form action="?action=update&cid=' . $id . '" method="POST">';
        }
        ?>

        <input type="text" name="title" required placeholder="Update title name" value="<?php echo $phrase['title']; ?>" />
        <input type="text" name="description" required placeholder="update book description" value="<?php echo $phrase['description']; ?>" />
        <input type="text" name="endDate" required placeholder="yyyy-mm-dd" value="<?= $phrase['endDate']; ?>" />
        <input type="text" name="price" required placeholder="0.00" value="<?= $phrase['price']; ?>" />
        <input type="submit" name="editbook" value="UPDATE" />

        </form>
    </div>


</body>

</html>