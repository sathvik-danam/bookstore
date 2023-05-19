<?php var_dump($_POST) ?>


<?php
if (isset($_POST['add_to_cart'])) {

    echo 'Add To Cart';
} else if (isset($_POST['buy_now'])) {
    echo 'Buy Now';
}
