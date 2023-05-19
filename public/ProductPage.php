
<?php
include("theconnection.php");

//$smt = $Conn->prepare('SELECT b.*,c.category_name FROM books as b,categories as c where b.category_id=c.category_id AND LOWER(b.title) like LOWER("%' . (!empty($_POST['search']) ? $_POST['search'] : '' ) . '%") OR LOWER(b.description) like LOWER("%' . (!empty($_POST['search']) ? $_POST['search'] : '' ) . '%")');

$smt = $Conn->prepare('SELECT b.*, c.category_name FROM books b JOIN categories c ON b.category_id = c.category_id WHERE LOWER(b.title) LIKE LOWER("%' . (!empty($_POST['search']) ? $_POST['search'] : '' ) . '%") OR LOWER(b.description) LIKE LOWER("%' . (!empty($_POST['search']) ? $_POST['search'] : '' ) . '%")');

$smt->execute();

//die($smt->debugDumpParams());

//$phrase = $smt->fetchAll();
//die(var_dump($phrase));
?>
<!DOCTYPE html>
<html>

<head>
	<title>The bookshop</title>
	<link rel="stylesheet" href="bookshop.css" />
	
</head>

<body>
<?php include 'header.php';?>


	<main>



		<h1>Product Page</h1>
		<?php
		$flag = 0;
		echo $smt->rowCount() . " records found.<br><hr><br>";
		while ($phrase = $smt->fetch()) {
			$flag++;

			echo '<article class="product">
			<div class="product-container">
			<!-- <img src="product.png" alt="product name"> -->
			<h1>'.$flag.'</h1>
			<section class="details">
				<h2><b>' . $phrase['title'] . '</b></h2>
				<h3>'.$phrase['category_name'].'</h3>
				<p>Auction created by <a href="#">authoerName</a></p>
				<p class="price">Buy Now: £'.$phrase['price'].'</p>
				<form action="cart.php" method="POST" class="button-container">
					<button type="submit" name="add_to_cart" value="" class="Add-to-cart-button">Add to Cart</button>
					<button type="submit" name="buy_now" value=""  class="Buy-Now-button">Buy Now</button>
				</form>

			</section>
			<section class="description">
				<p>Description: '.$phrase['description'].'</p>
			</section>

			<section class="reviews">
				<h2>Reviews of User.Name </h2>
				<ul>
					<li><strong>Ali said </strong> great ibuyer! Product as advertised and delivery was quick <em>29/09/2019</em></li>
					<li><strong>Dave said </strong> disappointing, product was slightly damaged and arrived slowly.<em>22/07/2019</em></li>
					<li><strong>Susan said </strong> great value but the delivery was slow <em>22/07/2019</em></li>

				</ul>

				<form>
					<label>Add your review</label> <textarea name="reviewtext"></textarea>

					<input type="submit" name="submit" value="Add Review" />
				</form>
			</section>
			</div>
		</article>
		<hr>';
		}
		if ($flag<=0) {
			echo "No record found";
		}
		?>
		<hr />

		<footer>
		<?php include 'footer.php';?>
		</footer>
	</main>
</body>
</html>