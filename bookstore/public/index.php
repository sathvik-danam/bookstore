<?php
include("theconnection.php");
// echo "<pre>";
// print_r($smt->fetchAll());
// die(); 
?>
<!DOCTYPE html>
<html>

<head>
	<title>ibuy Auctions</title>
	<link rel="stylesheet" href="ibuy.css" />
	<a href="login.php">Signup or login</a>
</head>

<body>
	<header>
		<h1><span class="i">i</span><span class="b">b</span><span class="u">u</span><span class="y">y</span></h1>

		<form method="post" action="AuctionPage.php">
			<input type="text" name="search" placeholder="Search a product in auction (title or description)" />
			<input type="submit" name="submit" value="Search" />
		</form>
	</header>

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
	<img src="banners/1.jpg" alt="Banner" />

	<main>

		<!-- <h1>Latest Listings / Search Results / Category listing</h1> -->
		<h1>Latest Listings</h1>
		
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

					<p class="price">Current bid: £123.45</p>
					<a href="#" class="more auctionLink">More &gt;&gt;</a>
				</article>
			</li>';
		}
		?>
		</ul>
		<hr />

		<footer>
			&copy; ibuy 2019
		</footer>
	</main>
</body>

</html>