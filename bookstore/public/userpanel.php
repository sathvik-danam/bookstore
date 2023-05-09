<?php
    session_start();
    
    if(isset($_POST['Logout']))
    {
        session_destroy();
        header("location: userpanel.php");
    }

    if(!isset($_SESSION['UserUsername']))
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
    <title>User Panel</title>
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
<!-- this is header -->
<div class="header">
    <h1>WELCOME User, <?php echo $_SESSION['UserUsername'];?> !</h1>

    <form action="" method="post">
        <button type="submit" name="Logout" id="Logout">LOGOUT</button>
    </form>
</div>
<!-- This is form for ADDING AUCTIONS -->
<div class="addauctions-form">
        <h2>ADD Auction</h2>
        <form method="POST" action="addAuction.php?addAuction">
         
            <input type="text" name="title" required placeholder="title name">
            <select name="dropdown" id="dropdown">
                <option>choose option</option>
                <option value="1">Home and garden</option>
                <option value="2">electronics</option>
                <option value="3">Fasion</option>
                <option value="4">Sports</option>
                <option value="5">Health</option>
                <option value="6">Toys</option>
                <option value="7">Motors</option>
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
            echo '<td><a class="btn edit" href="editAuction.php?cid=' . $phrase["auction_id"] .'">EDIT</a></td>';

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