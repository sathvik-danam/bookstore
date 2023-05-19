<?php
include("theconnection.php");

?>
<!DOCTYPE html>
<html>

<head>
	<title>Bookshop cart page</title>
	<link rel="stylesheet" href="bookshop.css" />
</head>

<body>

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
        <tr>
          <td>Product 1</td>
          <td>$19.99</td>
          <td>2</td>
          <td>$39.98</td>
        </tr>
        <tr>
          <td>Product 2</td>
          <td>$29.99</td>
          <td>1</td>
          <td>$29.99</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td class="total" colspan="3">Total:</td>
          <td class="total">$69.97</td>
        </tr>
      </tfoot>
    </table>
    <a class="checkout-btn" href="#">Proceed to Checkout</a>
  </div>
</body>
</html>


<footer>
<?php include 'footer.php';?>
</footer>
	
</body>

</html>