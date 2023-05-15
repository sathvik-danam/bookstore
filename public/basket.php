<!-- basket page/session-->
<?php
session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["basket"])) {
	foreach($_SESSION["basket"] as $key => $value) {
		if($_POST["id"] == $key){
		unset($_SESSION["basket"][$key]);
		$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
		}
		if(empty($_SESSION["basket"]))
		unset($_SESSION["basket"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["basket"] as &$value){
    if($value['id'] === $_POST["id"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}
?>
<html>
<head>
<title>Danam</title>
<link rel="stylesheet" href="basket.css" />
</head>
<body>


<?php
if(!empty($_SESSION["basket"])) {
$count = count(array_keys($_SESSION["basket"]));
?>
<div class="cart_div">
<a href="cart.php">
<img src="cart-icon.png" /> Cart
<span><?php echo $count; ?></span></a>
</div>
<?php
}
?>


<?php
if(isset($_SESSION["basket"])){
    $totalPrice = 0;
?>	

<div class="b-row">
    <div class="basket">

      <!-- Title -->
      <div class="b-title">
        Your Basket
      </div>
	

<?php		
foreach ($_SESSION["basket"] as  $book){
?>
<!-- Product -->
<div class="b-item">
  <div class="b-img">
    <!-- Product image -->
    <div class="b-image">
      <img src="#" alt="" />
    </div>
  </div>
  <!-- Product  description -->
  <div class="b-description">
  <span><?php echo $book["title"]; ?></span>
    <span><?php echo $book["author"]; ?></span>
  </div>
 <!--quantity -->

</form>
  <!-- Product  price -->
  <div class="b-total-price"><?php echo "£" . $book["price"]; ?></div>
  <!--Remove product from basket -->
<form method='post' action=''>
<input type='hidden' name='id' value="<?php echo $book["id"]; ?>" />
<input type='hidden' name='action'class="b-deleteBtn" value="remove" />
<button type='submit' class='b-deleteBtn'>Remove Item</button>
</form>


</div>


	
<?php ?>
<?php
$totalPrice += ($book["price"]*$book["quantity"]);
}
?>
</div>
<!-- OrderSummary/checkout-->
<div class="b-order">
      <!-- Title -->
      <h1 class="order">Order Summary</h1>
      <div class="b-line1"></div>
      <!-- Number of items -->
      <h2 class="order">Items:<span class="order"><?php echo $count; ?></span></h2>
      <!-- Toatal amount-->
      <h2 class="order">Total:<span class="order"><?php echo "£".$totalPrice; ?></span> </h2>
      <!--Link to checkout -->
      <div class="b-line2"></div>
      <a href="#" class="b-checkoutBtn">CHECKOUT</a>
    </div>


</body>
</table>		
  <?php
}else{
	echo "<h3>Your basket is empty</h3>";
	}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>



</div>
</body>
</html>