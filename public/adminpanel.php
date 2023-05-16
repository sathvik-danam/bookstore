<?php
    session_start();
    
    if(isset($_POST['Logout']))
    {
        session_destroy();
        header("location: login.php");
    }

    if(!isset($_SESSION['AdminUsername']))
    {
        header("location: login.php");
    }
    require_once("theconnection.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel</title>
  <link rel="stylesheet" type="text/css" href="bookshop.css">
</head>
<body>
  <div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Users</a></li>
      <li><a href="adminCategories.php">Add Categories</a></li>
      <li><a href="addBooks.php">Add Products</a></li>
      <form action="" method="post">
        <button type="submit" name="Logout" id="Logout">LOGOUT</button>
    </form>
    </ul>
  </div>
</body>

</html>
<style>body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

.sidebar {
  background-color: #333;
  color: #fff;
  width: 200px;
  height: 100vh;
  padding: 20px;
}

.sidebar h2 {
  margin-top: 0;
  padding-bottom: 20px;
  border-bottom: 1px solid #fff;
}

.sidebar ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.sidebar li {
  margin-bottom: 10px;
}

.sidebar a {
  color: #fff;
  text-decoration: none;
}

.sidebar a:hover {
  text-decoration: underline;
}

.content {
  padding: 20px;
}

.content h1 {
  margin-top: 0;
}
</style>