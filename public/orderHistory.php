<!DOCTYPE html>
<html>
<head>
  <title>Orders History</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
    }

    .cancel-button {
      background-color: red;
      color: white;
      padding: 6px 12px;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>Orders History</h1>

  <table>
    <tr>
      <th>Order ID</th>
      <th>Date</th>
      <th>Address</th>
      <th>Payment Method</th>
      <th>Total Amount</th>
      <th>Status</th>
      <th>Cancel Order</th>
    </tr>
    <tr>
      <td>12345</td>
      <td>May 24, 2023</td>
      <td>123 Main St, City, State, ZIP</td>
      <td>Credit Card</td>
      <td>$50.00</td>
      <td>Processing</td>
      <td><button class="cancel-button">Cancel</button></td>
    </tr>
    <tr>
      <td>67890</td>
      <td>May 22, 2023</td>
      <td>456 Elm St, City, State, ZIP</td>
      <td>PayPal</td>
      <td>$75.00</td>
      <td>Delivered</td>
      <td><button class="cancel-button">Cancel</button></td>
    </tr>
    <!-- Add more rows for each order -->
  </table>

</body>
</html>
