<?php
    session_start();
    
    if(isset($_POST['Logout']))
    {
        session_destroy();
        header("location: login.php");
    }

    if(!isset($_SESSION['AdminUsername']))
    {
        header("location: login.php");
    }
    require_once("theconnection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bookshop.css" />
    <title>Admin Panel</title>
    <head>
  
    <style>
        body {
            background-color: #f6f5f4;
            max-width: 100vw;
            overflow-x: hidden;
        }
        
        .header {
            margin-top: 1vw;
            display: grid;
            align-items: center;
            padding-top: 1vw;
            padding-bottom: 1vw;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }
        
        .header h1 {
            text-align: center;
            font-size: 5em;
            color: white;
            background: #4E6C50;
        }
        
        .addcategories-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        
        .addcategories-form h2 {
            font-size: 2em;
            margin-bottom: 10px;
            color: #333;
        }
        
        .addcategories-form input[type="text"],
        .addcategories-form input[type="submit"] {
            width: 300px;
            padding: 10px;
            font-size: 1.2em;
            border-radius: 5px;
            border: 2px solid #ccc;
            margin-bottom: 10px;
            transition: all 0.3s ease-in-out;
        }
        
        .addcategories-form input[type="text"]:focus {
            border-color: #617A55;
            outline: none;
        }
        
        .addcategories-form input[type="submit"] {
            background-color: #AA8B56;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        
        th,
        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #AA8B56;
            color: white;
        }
        
        tr:hover {
            background-color: #f2f2f2;
        }
        
        .grid-box {
            width: 20%;
        }
        
        .btn {
            display: inline-block;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            background-color: white;
            transition: background-color 0.3s ease-in-out;
        }
        
        .btn.delete {
            background-color: #395144;
        }
        
        .btn.edit {
            background-color:  #395144 ;
        }
        
        .btn:hover {
            background-color: white;
        }
        
        .msg {
            margin-top: 20px;
            color:red;
            font-weight: bold;
        }
    </style>

 </head>
<body>

<div class="header">
    <h1>Welcome, <?php echo $_SESSION['AdminUsername'];?> !</h1>

    <form action="" method="post">
        <button type="submit" name="Logout" id="Logout">LOGOUT</button>
    </form>
</div>
<div class="addcategories-form">
        <h2>ADD CATEGORY:</h2>
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
                <th class='grid-box heading'> DELETE </th>
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

            echo '<td style="margin:20px"><a class="btn delete" href="deleteCategory.php?cid=' . $phrase["category_id"] . '">DELETE</a></td>';
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
<footer>
		<?php include 'footer.php';?>
		</footer>
</html>