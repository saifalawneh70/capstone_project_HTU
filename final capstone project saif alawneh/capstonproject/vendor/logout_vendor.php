<?php 
session_start();
unset($_SESSION['idvend']);
header("location:login_vendor.php");

 ?>