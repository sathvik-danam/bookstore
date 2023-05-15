<!--single product/ start of basket session-->
<?php
session_start();
require_once("theconnection.php");
$status="";
if (isset($_POST['id']) && $_POST['id']!=""){
$id= $_POST['id'];

$stmt = $pdo->query('SELECT * FROM book WHERE id = ' . $id);


$row = $stmt->fetch(PDO::FETCH_ASSOC);
$name = $row['title'];
$id = $row['id'];
$price = $row['price'];
$author = $row['author'];


$basketArray = array(
	$id=>array(
	'title'=>$title,
	'id'=>$id,
	'price'=>$price,
	'author'=>$author,
	'quantity'=>1)
);

if(empty($_SESSION["basket"])) {
	$_SESSION["basket"] = $basketArray;
	$status = "<div class='box'>Book added to basket!</div>";
}else{
	$array_keys = array_keys($_SESSION["basket"]);
	if(in_array($id,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Book is already in your basket!</div>";	
	} else {
	$_SESSION["basket"] = array_merge($_SESSION["basket"],$basketArray);
	$status = "<div class='box'>Book  added to basket!</div>";
	}

	}
}
?>
<html>
<head>

<link rel='stylesheet' href='css/style.css'/>
</head>
<body>
<div style="width:700px; margin:50 auto;">



<?php
if(!empty($_SESSION["basket"])) {
$count = count(array_keys($_SESSION["basket"]));
?>
<div class="cart_div">
<a href="cart.php"><img src="cart-icon.png" /> Cart<span><?php echo $count; ?></span></a>
</div>


<?php


?>
<?php
}

if (isset($_GET['id'])) {
$stmt = $pdo->prepare("SELECT * FROM book WHERE id = :id");
$values = [
    'id' => $_GET['id']
];
 $stmt->execute($values);
 $row = $stmt->fetch();

echo "<div class='product_wrapper'>
<form method='post' action=''>
<input type='hidden' name='id' value=".$row['id']." />

<div class='name'>".$row['title']."</div>
   <div class='price'>£".$row['price']."</div>
<div class='author'>".$row['author']."</div>
<button type='submit' class='buy'>Buy Now</button>
</form>

   </div>";


}

    ?>
    













