<?php

require_once("theconnection.php");

if (isset($_POST['Logout'])) {
    session_destroy();
    header("location: addBooks.php");
}

if (!isset($_SESSION['AdminUsername'])) {
    header("location: Userlogin.php");
}

if (isset($_POST['addbook'])) {

    $stmt = $Conn->prepare('INSERT INTO books (category_id, title, description, endDate)
        VALUES (:category_id, :title, :description, :endDate)');
    $stmt->execute(array(':category_id' => $_POST['dropdown'], ':title' => $_POST['title'], ':description' => $_POST['description'], ':endDate'  => $_POST['endDate']));

    $smt = $Conn->prepare('UPDATE `order_items` SET `order_item_price`="' . $price . '" WHERE `book_id`=' . $id . ';');
    $smt->execute();

    if ($stmt) {
        echo 'success';
    } else {
        echo 'Might be exustss';
    }
    // header("location: userpanel.php?msg=".$msg);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <style>
        body {
            margin: 0;
            padding-inline: 10%;
            padding-top: 1%;
        }

        div.header {
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 60px;
            background-color: burlywood;
            text-transform: capitalize;
        }

        div.header button {
            background-color: white;
            font-size: 16px;
            font-weight: 500;
            padding: 8px 12px;
            border: 2px solid black;
            border-radius: 5px;

        }

        .grid-box {
            border: 1px solid black;
        }

        table {
            width: 100%;
        }

        .heading {
            background-color: lavender;
            text-align: center;
        }

        td {
            padding: 0;
            text-align: center;
        }

        tr {
            font-size: 30px;
        }

        .edit {
            background-color: skyblue;
        }

        .delete {
            background-color: tomato;
        }

        .btn {
            text-decoration: none;
            color: black;
            border: 1px solid black;
            padding-inline: 3%;
            border-radius: 3%;
        }
    </style>

</head>

<body>
    <!-- this is header -->
    <div class="header">
        <h1>WELCOME User, <?php echo $_SESSION['AdminUsername']; ?> !</h1>

        <form action="" method="post">
            <button type="submit" name="Logout" id="Logout">LOGOUT</button>
        </form>
    </div>
    <!-- This is form for ADDING books -->
    <div class="addbooks-form">
        <h2>ADD book</h2>
        <form method="POST" action>

            <input type="text" name="title" required placeholder="title name">
            <select name="dropdown" id="dropdown">
                <option>choose option</option>
                <option value="1">Science fiction</option>
                <option value="2">Romance</option>
                <option value="3">Mystery</option>
                <option value="4">Film and television</option>
                <option value="5">Fashion and photography</option>
                <option value="6">Fantasy</option>
                <option value="7">Dystopian</option>
                <option value="8">Cook books</option>
            </select>
            <input type="text" name="description" required placeholder="description" />
            <input type="text" name="endDate" required placeholder="endDate" />
            <input type="text" name="price" required placeholder="0.00" />
            <input type="submit" name="addbook" value="ADD" />

        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th class='grid-box heading'> ID </th>
                <th class='grid-box heading'> CATEGORY </th>
                <th class='grid-box heading'> TITLE </th>
                <th class='grid-box heading'> DES</th>
                <th class='grid-box heading'> END DATE </th>
                <th class='grid-box heading'> PRICE </th>
                <th class='grid-box heading'> DELETE </th>
                <th class='grid-box heading'> EDIT </th>
            </tr>
        </thead>

        <?php

        $smt = $Conn->prepare('SELECT b.*,categories.category_name,order_items.* FROM books as b JOIN categories ON b.category_id = categories.category_id JOIN order_items ON b.book_id = order_items.book_id;');
        $smt->execute();
        // fetching all the values and assinging them to a variable 
        while ($phrase = $smt->fetch()) {
            //die(var_dump($phrase));
            echo "<tr>";
            echo "<td class='grid-box'>" . $phrase['book_id'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['category_name'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['title'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['description'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['endDate'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['order_item_price'] . "</td>";
            echo '<td style="margin:20px"><a class="btn delete" href="deleteProduct.php?cid=' . $phrase["book_id"] . '">DELETE</a></td>';
            echo '<td><a class="btn edit" href="editProduct.php?cid=' . $phrase["book_id"] . '">EDIT</a></td>';

            echo '</tr>';
        }
        if (isset($_GET['msg'])) {
            echo "<br>";
            echo "<h4 style='color:tomato;'>" . $_GET['msg'] . "</h4>";
        }


        ?>

</body>

</html>