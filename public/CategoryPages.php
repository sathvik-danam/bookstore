<?php
include("theconnection.php");
if(isset($_GET['cid'])){
$cid = $_GET['cid']; 
$smt = $Conn->prepare('SELECT a.*,c.category_name FROM auctions as a,categories as c where a.category_id=c.category_id AND a.category_id='.$cid);
$smt->execute();

}
?>
<!DOCTYPE html>
<html>

<head>
	<title>ibuy Auctions</title>
	<link rel="stylesheet" href="bookshop.css" />
	<a href="login.php">Signup or login</a>
</head>

<body>
	<header>
	<h1><span class="i">B</span><span class="b">OO</span><span class="u">K</span><span class="y">SHOP</span></h1>

	</header>


	<main>



		<h1>YOU SELECTED Categories</h1>
		<?php

    if(isset($_GET['cid']))
    {
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
				<p>Author <a href="#">User.Name</a></p>
				<p class="price">Price: £123.45</p>
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
    }
    else
    {
        echo "Category not supplied.";
    }
    
?>
		
		<footer>
		<?php include 'footer.php';?>
		</footer>
	</main>
</body>

</html>