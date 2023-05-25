<?php
include("theconnection.php"); 

var_dump($_POST);

if (isset($_POST['make_order'])) {


    die('Order qwas made');
} elseif (isset($_POST['add_to_cart'])) {

    echo 'Added Book';

    $_SESSION['cart'][] = ['book_id' => $_POST['book_id'], 'quantity' => '1'];

}

?>


<?php
/*if (isset($_POST['add_to_cart'])) {

    echo 'Add To Cart';
} else if (isset($_POST['buy_now'])) {
    echo 'Buy Now';
}
*/
// 
$smt = $Conn->prepare('SELECT o.*,oi.* FROM orders as o JOIN order_items as oi ON o.order_item_id = oi.order_item_id;');

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
    
    th, td {
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
  </style>
</head>
<body>
  <h1>Your Cart</h1>
  <div class="cart-container">
    <form action method="POST">
    <table>
      <thead>
        <tr>
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
//while ($order = $smt->fetch()) {
//  $_SESSION['cart']['0']['book_id', 'quantity']
//  ...              ['1']['book_id', ]
//$_SESSION = array();
$_SESSION['cart']['0'] = ['book_id' => 1, 'quantity' => 1];
$_SESSION['cart']['1'] = ['book_id' => 1, 'quantity' => 1];
foreach ($_SESSION['cart'] as $key => $cart) {
    //die(var_dump($order));
    $flag++;
    //$grand_total += $order['price'] * $order['order_quantity'];
    //die(var_dump($cart));
?>
        <tr>
          <td>Book: <?= $cart['book_id']; ?></td>
          <td>£<?= NULL; ?></td>
          <td><?= $cart['quantity']; ?></td>
          <td>£<?= NULL; ?></td>
        </tr>
<?php } ?>
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
</body>
</html>
