<?php
session_start();

if (isset($_POST['Logout'])) {
    session_destroy();
    header("location: addAuction.php");
}

if (!isset($_SESSION['UserUsername'])) {
    header("location: Userlogin.php");
}
require_once("theconnection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    
    
    <form action="index.php" method="post">
        <input type='submit' name='submit' value='Index' />
    </form>
    
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
        <h1>WELCOME User, <?php echo $_SESSION['UserUsername']; ?> !</h1>

        <form action="" method="post">
            <button type="submit" name="Logout" id="Logout">LOGOUT</button>
        </form>
    </div>
    <!-- This is form for ADDING AUCTIONS -->
    <div class="addauctions-form">
        <h2>ADD Auction</h2>

        <?php
        if (isset($_POST['addauction'])) {

            $stmt = $Conn->prepare('INSERT INTO auctions (category_id, title, description, endDate) VALUES (:category_id, :title, :description, :endDate)');
            $stmt->execute(array(
                'category_id' => $_POST['dropdown'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'endDate' => $_POST['endDate']
            ));

            if ($stmt) {
                echo 'success';
            } else {
                echo 'Might be exustss';
            }
        }
        ?>

        <form method="POST">
            <input type="text" name="title" required placeholder="title name">
            <label for="category">Select a category:</label>
            <select name="dropdown" id="dropdown">
                <?php
                // Retrieve the categories from the database
                $smt = $Conn->prepare('SELECT category_name, category_id FROM categories;');
                $smt->execute();
                // Fetch the result into an array
                $categories = $smt->fetchAll();
                // create an empty array
                $existingCategories = array();
                // Generate the options for the dropdown menu
                foreach ($categories as $category) {
                    if (!in_array($category['category_name'], $existingCategories)) {
                        echo "<option value='" . $category['category_id'] . "'>" . $category['category_name'] . "</option>";
                        $existingCategories[] = $category['category_name'];
                    }
                }
                ?>
            </select>

            </select>
            <input type="text" name="description" required placeholder="description">
            <input type="text" name="endDate" required placeholder="endDate">
            <input type="submit" name="addauction" value="ADD">
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
                <th class='grid-box heading'> DELETE </th>
                <th class='grid-box heading'> EDIT </th>
            </tr>
        </thead>

        <?php

        $smt = $Conn->prepare('SELECT a.*,c.category_name FROM auctions as a, categories as c where a.category_id=c.category_id');
        $smt->execute();
        // fetching all the values and assinging them to a variable 
        while ($phrase = $smt->fetch()) {
            echo "<tr>";
            echo "<td class='grid-box'>" . $phrase['auction_id'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['category_name'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['title'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['description'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['endDate'] . "</td>";

            echo '<td style="margin:20px"><a class="btn delete" href="deleteAuction.php?cid=' . $phrase["auction_id"] . '">DELETE</a></td>';
            echo '<td><a class="btn edit" href="editAuction.php?cid=' . $phrase["auction_id"] . '">EDIT</a></td>';

            echo '</tr>';
        }
        if (isset($_GET['msg'])) {
            echo "<br>";
            echo "<h4 style='color:tomato;'>" . $_GET['msg'] . "</h4>";
        }


        ?>

</body>

</html>