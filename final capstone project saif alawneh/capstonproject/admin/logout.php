<?php 
session_start();
unset($_SESSION['id']);
unset($_SESSION['privilege']);
header("location:login.php");
 ?>