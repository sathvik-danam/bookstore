<?php
    session_start();   
    require_once("logout.php");
    require_once("theconnection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Categories</title>
    <style>
        body{
        margin: 0;
        padding-inline: 10%;
        padding-top: 1%;
       }
        div.header{
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 60px;
            background-color: burlywood;
            text-transform: capitalize;
        }
        div.header button{
            background-color: white;
            font-size: 16px;
            font-weight: 500;
            padding: 8px 12px;
            border: 2px solid black;
            border-radius: 5px;

        }
        .grid-box{
            border: 1px solid black;
        }
        table{
            width:100%;
        }
        .heading{
            background-color: lavender;
            text-align: center;
        }
        td{
            padding: 0;
            text-align: center;
        }
        tr{
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

<div class="header">
    <h1>WELCOME, <?php echo $_SESSION['AdminUsername'];?> !</h1>

    <form action="" method="post">
        <button type="submit" name="Logout" id="Logout">LOGOUT</button>
    </form>
</div>
<div class="addcategories-form">
        <h2>ADD category</h2>
        <form method="POST" action="addCategory.php">
         
        <input type="text" name="category_name" required placeholder="name of the new category">
        <input type="text" name="description" required placeholder="description">
               
        <input type="submit" name="addcategory" value="ADD">
       
        </form> 
    </div>

    <table>
        <thead>
            <tr>
                <th class='grid-box heading'> ID </th>
                <th class='grid-box heading'> NAME </th>
                <th class='grid-box heading'> DES</th>
                <!-- <th class='grid-box heading'> DELETE </th> -->
                <th class='grid-box heading'> EDIT </th>
            </tr>
        </thead>

        <?php
        $smt = $Conn->prepare('SELECT * FROM categories');
        $smt->execute();

        while ($phrase = $smt->fetch()) {

            echo "<tr>";
            echo "<td class='grid-box'>" . $phrase['category_id'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['category_name'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['description'] . "</td>";
            echo '<td style="margin:20px">
            <form action="deleteCategory.php" method="POST">
            <input type="hidden" name="cid" value="'. $phrase["category_id"] .'">
            <input type="submit" name="delete" class="btn delete" value="DELETE">
            </form>
            </td>';
            echo '<td><a class="btn edit" href="editCategories.php?cid=' . $phrase["category_id"] .'">EDIT</a></td>';
            echo '</tr>';
        }
        if(isset($_GET['msg']))
        {
            echo "<br>";
            echo "<h4 style='color:tomato;'>".$_GET['msg']."</h4>";
        }
        ?>
    </table>
</body>
</html>