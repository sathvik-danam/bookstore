<?php
require_once("theconnection.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //
  if (isset($_POST['cart_id'])) {
    unset($_SESSION['cart'][$_POST['cart_id']]);
    exit(header('Location: https://trailrun.v.je/cart.php'));
  }

  if (isset($_POST['add_to_cart'])) {
    echo 'Book was added to Cart';
    if (empty($_SESSION['cart'])) $_SESSION['cart'][] = ['book_id' => $_POST['book_id'], 'quantity' => '1', 'total' => ''];
    else
      foreach ($_SESSION['cart'] as $key => $cart) {
        if ($cart['book_id'] == $_POST['book_id'])
          $_SESSION['cart'][$key]['quantity'] += 1;
        else
          $_SESSION['cart'][] = ['book_id' => $_POST['book_id'], 'quantity' => '1'];
      }
  } //else if (isset($_POST['buy_now']) || isset($_POST['cart_id'])) {  
  //include('cart.php');
  //die();
} else {

  $smt = $Conn->prepare('SELECT * FROM books;');

  $smt->execute();
?>
  <!DOCTYPE html>
  <html>
  <?php include 'header.php'; ?>
  <link rel="stylesheet" href="bookshop.css" />

  <head>
    <title>Cart</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 20px;
      }

      h1 {
        color: #333;
        text-align: center;
        margin-bottom: 30px;
      }

      .cart-container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 40px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
      }

      th,
      td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ccc;
      }

      th {
        background-color: #f9f9f9;
        font-weight: bold;
      }

      .total {
        text-align: left;
        font-weight: bold;
      }

      .checkout-btn {
        display: block;
        width: 100%;
        padding: 10px;
        text-align: center;
        background-color: #4E6C50;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
      }

      .checkout-btn:hover {
        background-color: #395144;
      }

      input[type="checkbox"] {
        -webkit-appearance: initial;
        appearance: initial;
        background: gray;
        width: 20px;
        height: 20px;
        border: none;
        position: relative;
      }

      input[type="checkbox"]:checked {
        background: red;
      }

      input[type="checkbox"]:checked:after {

        content: "X";
        color: #fff;

        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);

      }
    </style>
  </head>

  <body>
    <h1>Your Cart</h1>
    <div class="cart-container">
      <form action="checkout.php" method="POST">
        <table>
          <thead>
            <tr>
              <th>Remove</th>
              <th>Title</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Shipping charges</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $flag = 0;
            $grand_total = 0;

            while ($order = $smt->fetch()) {

              if (empty($_SESSION['cart']))
                $_SESSION['cart'] = array();

              foreach ($_SESSION['cart'] as $key => $cart) {
                //die(var_dump($order));
                $flag++;
                //$grand_total += $order['price'] * $order['order_quantity'];
                //die(var_dump($cart));
                $smt = $Conn->prepare('SELECT * FROM books WHERE `books`.`book_id` = ' . $cart['book_id'] . ';');

                $smt->execute();
                while ($book = $smt->fetch()) {
                  $item_total = ($book['price'] * $cart['quantity']) + 2.30;
                  $grand_total += $item_total;
            ?>
                  <tr>
                    <td><input class="delete" type="checkbox" style="content: 'x';" name="cart_id" value="<?= $key; ?>"></td>
                    <td> <?= $book['title']; ?></td>
                    <td>£<?= $book['price']; ?></td>
                    <td><?= $cart['quantity']; ?></td>
                    <td>£ 2.30<?= NULL; ?></td>
                    <td>£<?= $item_total; ?></td>
                  </tr>
            <?php
                }
              }
            } ?>
          </tbody>
          <tfoot>
            <tr>
              <td class="total" colspan="3">Total:</td>
              <td></td>
              <td></td>
              <td class="total">£<?= $grand_total ?></td>
            </tr>
          </tfoot>
        </table>
        <button type="submit" name="make_order" value="" >checkout</button>
      </form>
      
    </div>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script>
      $('.delete').change(
        function() {
          //alert('this works');
          this.form.submit();
        });
    </script>
  </body>
  <footer>
    <?php include 'footer.php'; ?>
  </footer>

  </html>
<?php } ?>