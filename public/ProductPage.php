
<?php
include("theconnection.php");

$smt = $Conn->prepare('SELECT a.*,c.category_name FROM books as a,categories as c where a.category_id=c.category_id AND LOWER(a.title) like LOWER("%' . $_POST['search'] . '%") OR LOWER(a.description) like LOWER("%' . $_POST['search'] . '%")');
$smt->execute();

//$phrase = $smt->fetchAll();
//print_r($phrase);
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
				<p>book created by <a href="#">Author.Name</a></p>
				<p class="price">Price: £' . $phrase['price'] . '</p>
				<form class="button-container">
				<form action="#" class="button-container">
					<button type="submit" class="Add-to-cart-button">Add to Cart</button>
					<button type="submit" class="Buy-Now-button">Buy Now</button>
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