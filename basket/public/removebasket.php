<?php
session_start();

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  unset($_SESSION['basket'][$id]);
  header("location: basket.php");
}

;?>