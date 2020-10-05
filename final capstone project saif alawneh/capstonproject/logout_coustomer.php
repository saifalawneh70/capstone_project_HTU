<?php 
session_start();
unset($_SESSION['customer_id']);
unset($_SESSION['cart']);
unset($_SESSION['pre']);
header("location:index.php");
?>