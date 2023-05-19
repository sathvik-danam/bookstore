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
</head>

<body>
	<?php include 'header.php'; ?>
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

		$smt = $Conn->prepare('select * from books order by book_id DESC LIMIT 10');
		$smt->execute();
		echo $smt->rowCount() . ' records found.<br><hr><br><ul class="productList">';
		while ($phrase = $smt->fetch()) {
			echo '<li>
				<img src="product.png" alt="product name">
				<article>
					<h2>' . $phrase['title'] . '</h2>					
					<p>' . $phrase['description'] . '</p>
					<p class="price">Price: £' . $phrase['price'] . '</p>
					<a href="ProductPage.php?pid=' . $phrase['book_id'] . '" class="more bookLink">More &gt;&gt;</a>
				</article>
			</li>';
		}
		?>
		</ul>
		<hr />

		<footer>
			<?php include 'footer.php'; ?>
		</footer>
	</main>
</body>

</html>