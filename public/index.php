<?php
include("theconnection.php");
// echo "<pre>";
// print_r($smt->fetchAll());
// die(); 
?>
<!DOCTYPE html>
<html>

<head>
	<title>Bookshop page</title>
	<link rel="stylesheet" href="bookshop.css" />
	<!-- <a href="login.php">Signup or login</a> -->
</head>

<body>
	<header>
	<nav role="navigation">
  <div id="menuToggle">

    <input type="checkbox" />

    <span></span>
    <span></span>
    <span></span>

    <ul id="menu">
	<a href="login.php"><li>Signup or login</li></a>
      <a href="#"><li>Cart</li></a>
      <a href="#"><li>Shop</li></a>
	  <a href="#"><li>Contact Us</li></a>
    </ul>
  </div>
</nav>
	<!-- <a href="login.php">Signup or login</a> -->
		<h1><span class="i">THE </span><span class="b">BOOK</span><span class="u"></span><span class="y">SHOP</span></h1>


	</header>



</div>
	
	<form method="post" action="ProductPage.php">
			<input type="text" name="search" placeholder="Search a product in auction (title or description)" />
			<input type="submit" name="submit" value="Search" />
		</form>

	<nav>
		<ul>
			<?php
			$smt = $Conn->prepare('SELECT * FROM categories'); 
			$smt->execute();

			while ($phrase = $smt->fetch()) {
				echo '<li><a class="categoryLink" href="CategoryPages.php?cid=' . $phrase["category_id"] . '">' . $phrase['category_name'] . '</a></li>';
			}
			?>
		</ul>
	</nav>
	<img src="banners/books.jpg" alt="Banner" />

	<main>

		<!-- <h1>Latest Listings / Search Results / Category listing</h1> -->
		<h1>New Releases</h1>
		
		<?php

		$smt = $Conn->prepare('select * from auctions order by auction_id DESC LIMIT 10');
		$smt->execute();
		echo $smt->rowCount() . ' records found.<br><hr><br><ul class="productList">';
		while ($phrase = $smt->fetch()) {
			echo '<li>
				<img src="product.png" alt="product name">
				<article>
					<h2>' . $phrase['title'] . '</h2>
					<h3>Product category</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales ornare purus, non laoreet dolor sagittis id. Vestibulum lobortis laoreet nibh, eu luctus purus volutpat sit amet. Proin nec iaculis nulla. Vivamus nec tempus quam, sed dapibus massa. Etiam metus nunc, cursus vitae ex nec, scelerisque dapibus eros. Donec ac diam a ipsum accumsan aliquet non quis orci. Etiam in sapien non erat dapibus rhoncus porta at lorem. Suspendisse est urna, egestas ut purus quis, facilisis porta tellus. Pellentesque luctus dolor ut quam luctus, nec porttitor risus dictum. Aliquam sed arcu vehicula, tempor velit consectetur, feugiat mauris. Sed non pellentesque quam. Integer in tempus enim.</p>

					<p class="price">Price: £123.45</p>
					<a href="#" class="more auctionLink">More &gt;&gt;</a>
				</article>
			</li>';
		}
		?>
		</ul>
		<hr />

		<footer>
		<?php include 'footer.php';?>
		</footer>
	</main>
</body>

</html>