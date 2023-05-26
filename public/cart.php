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
    $_SESSION['cart'][] = ['book_id' => $_POST['book_id'], 'quantity' => '1'];
  } //else if (isset($_POST['buy_now']) || isset($_POST['cart_id'])) {  
  //include('cart.php');
  //die();
} else {

  $smt = $Conn->prepare('SELECT * FROM orders JOIN order_items ON orders.order_item_id = order_items.order_item_id JOIN books ON order_items.book_id = books.book_id;');

  $smt->execute();
?>
  <!DOCTYPE html>
  <html>

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
        text-align: right;
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
        /* Heres your symbol replacement */
        content: "X";
        color: #fff;
        /* The following positions my tick in the center, 
     * but you could just overlay the entire box
     * with a full after element with a background if you want to */
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        /*
     * If you want to fully change the check appearance, use the following:
     * content: " ";
     * width: 100%;
     * height: 100%;
     * background: blue;
     * top: 0;
     * left: 0;
     */
      }
    </style>
  </head>

  <body>
    <h1>Your Cart</h1>
    <div class="cart-container">
      <form action method="POST">
        <table>
          <thead>
            <tr>
              <th>Remove</th>
              <th>Item</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $flag = 0;
            $grand_total = 0;
            echo $smt->rowCount() . " records found.<br><hr><br>";
            while ($order = $smt->fetch()) {
              //  $_SESSION['cart']['0']['book_id', 'quantity']
              //  ...              ['1']['book_id', ]
              if (empty($_SESSION['cart']))
                $_SESSION['cart'] = array();
              //$_SESSION['cart']['0'] = ['book_id' => 1, 'quantity' => 1];
              //$_SESSION['cart']['1'] = ['book_id' => 1, 'quantity' => 1];
              foreach ($_SESSION['cart'] as $key => $cart) {
                //die(var_dump($order));
                $flag++;
                //$grand_total += $order['price'] * $order['order_quantity'];
                //die(var_dump($cart));
                $smt = $Conn->prepare('SELECT * FROM books JOIN order_items ON books.book_id = order_items.book_id WHERE `books`.`book_id` = ' . $cart['book_id'] . ';');

                $smt->execute();
                while ($book = $smt->fetch()) {
            ?>
                  <tr>
                    <td><input class="delete" type="checkbox" style="content: 'x';" name="cart_id" value="<?= $key; ?>"></td>
                    <td>Book Title: <?= $book['title']; ?></td>
                    <td>£<?= $book['order_item_price']; ?></td>
                    <td><?= $book['order_item_quantity']; ?></td>
                    <td>£<?= NULL; ?></td>
                  </tr>
            <?php
                }
              }
            } ?>
          </tbody>
          <tfoot>
            <tr>
              <td class="total" colspan="3">Total:</td>
              <td class="total">£<?= $grand_total ?></td>
            </tr>
          </tfoot>
        </table>
        <button type="submit" name="make_order" value="">Place Order</button>
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

  </html>
<?php } ?>