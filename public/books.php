<?php
//all books
session_start();
require_once("theconnection.php");


$stmt = $pdo->query('SELECT * FROM product ');
while($row = $stmt->fetch()){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='id' value=".$row['id']." />
			  
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>£".$row['price']."</div>
			  <div class='author'>".$row['author']."</div>
              <a href=".'product.php?id='. $row['id'] ."> view </a>
			  </form>
		   	  </div>";
        }
?>


</body>
</html>