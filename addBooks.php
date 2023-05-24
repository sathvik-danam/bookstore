<?php
    session_start();
    
    if(isset($_POST['Logout']))
    {
        session_destroy();
        header("location: addBooks.php");
    }

    if(!isset($_SESSION['AdminUsername']))
    {
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
    <link rel="stylesheet" href="bookshop.css">
    <title>User Panel</title>
    
 </head>
<body>
<!-- this is header -->
<div class="header">
    <h1>WELCOME User, <?php echo $_SESSION['AdminUsername'];?> !</h1>

    <form action="" method="post">
        <button type="submit" name="Logout" id="Logout">LOGOUT</button>
    </form>
</div>
<!-- This is form for ADDING books -->
<div class="addbooks-form">
        <h2>ADD book</h2>
        <form method="POST" action="addProduct.php?addbook">
         
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
            <input type="text" name="description" required placeholder="description">
            <input type="text" name="endDate" required placeholder="endDate">
                
            <input type="submit" name="addbook" value="ADD">
        
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
       
        $smt = $Conn->prepare('SELECT a.*,c.category_name FROM books as a, categories as c where a.category_id=c.category_id');
        $smt->execute();
// fetching all the values and assinging them to a variable 
        while ($phrase = $smt->fetch()) {
            echo "<tr>";
            echo "<td class='grid-box'>" . $phrase['book_id'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['category_name'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['title'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['description'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['endDate'] . "</td>";

            echo '<td style="margin:20px"><a class="btn delete" href="deleteProduct.php?cid=' . $phrase["book_id"] . '">DELETE</a></td>';
            echo '<td><a class="btn edit" href="editProduct.php?cid=' . $phrase["book_id"] .'">EDIT</a></td>';

            echo '</tr>';
        }
        if(isset($_GET['msg']))
        {
            echo "<br>";
            echo "<h4 style='color:tomato;'>".$_GET['msg']."</h4>";
        }

     
        ?>

</body>

</html>


    

 </head>
<body>
<!-- this is header -->
<div class="header">
    <h1>WELCOME User, <?php echo $_SESSION['AdminUsername'];?> !</h1>

    <form action="" method="post">
        <button type="submit" name="Logout" id="Logout">LOGOUT</button>
    </form>
</div>
<!-- This is form for ADDING books -->
<div class="addbooks-form">
        <h2>ADD book</h2>
        <form method="POST" action="addProduct.php?addbook">
         
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
            <input type="text" name="description" required placeholder="description">
            <input type="text" name="endDate" required placeholder="endDate">
                
            <input type="submit" name="addbook" value="ADD">
        
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
       
        $smt = $Conn->prepare('SELECT a.*,c.category_name FROM books as a, categories as c where a.category_id=c.category_id');
        $smt->execute();
// fetching all the values and assinging them to a variable 
        while ($phrase = $smt->fetch()) {
            echo "<tr>";
            echo "<td class='grid-box'>" . $phrase['book_id'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['category_name'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['title'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['description'] . "</td>";
            echo "<td class='grid-box'>" . $phrase['endDate'] . "</td>";

            echo '<td style="margin:20px"><a class="btn delete" href="deleteProduct.php?cid=' . $phrase["book_id"] . '">DELETE</a></td>';
            echo '<td><a class="btn edit" href="editProduct.php?cid=' . $phrase["book_id"] .'">EDIT</a></td>';

            echo '</tr>';
        }
        if(isset($_GET['msg']))
        {
            echo "<br>";
            echo "<h4 style='color:tomato;'>".$_GET['msg']."</h4>";
        }

     
        ?>

</body>

</html>