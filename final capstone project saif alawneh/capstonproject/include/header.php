<?php
session_start();
ob_start();
require ('connect_db.php');
?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Shop</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/nice-select.css">
			<link rel="stylesheet" href="css/ion.rangeSlider.css" />
			<link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/main.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script type="text/javascript">
				$("document").ready(function(){ 
					window.onscroll = function() {scrollFunction()};
					function scrollFunction() {
						if (document.documentElement.scrollTop ==0) {
							$("#topbutton").css("display" , "none");
						} else if (document.documentElement.scrollTop >200) {
							$("#topbutton").css("display" , "block");
						}
					}
				});
			</script>
		</head>
		<style type="text/css">
			#topbutton {
				position:fixed;
				bottom: 10px;
				margin-left: 91%;
				font-size: 18px;
				color: #63625d;
				z-index: 500;
				padding: 25px;
				border-radius: 10px;
			}
		</style>

		<body>
			<i id="topbutton" style=" font-size: 50px; transform: rotate(-45deg);" class="fa fa-rocket" aria-hidden="true"></i>
			<!-- Start Header Area -->
			<header class="default-header">
				<div class="menutop-wrap">
					<div class="menu-top container">
						<div class="d-flex justify-content-between align-items-center">
							<ul class="list">
								<li id='top'><a href="tel:+12312-3-1209">+962-795163090</a></li>
								<li><a href="mailto:saifaldeenalawneh2000@gmail.com">saifaldeenalawneh2000@gmail.com</a></li>								
							</ul>
							<ul class="list">
								<li>
									<?php
									if (isset($_SESSION['customer_id'])) {
										echo "<a href='logout_coustomer.php'>logout</a>";
									}
									else
									{
										echo "<a href='login_customer.php'>login</a>";   
									}
									?>
								</li>
								<li><a href="cart_page.php"><i style="font-size: 20px;" class="fa fa-shopping-cart" aria-hidden="true">
									<?php

									if(isset($_SESSION['cart'])){
										$pro_count=count($_SESSION['cart']);
										echo "<small>$pro_count</small>";	
									}
									else
									{
										echo "<small>0</small>";
									}
									?>
								</i></a></li>
							</ul>
						</div>
					</div>					
				</div>
				<nav class="navbar navbar-expand-lg  navbar-light">
					<div class="container">
						<a class="navbar-brand" href="index.php">
							<img src="img/logo.png" alt="">
						</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
							<ul class="navbar-nav">
								<li><a href="index.php">Home</a></li>
								<li class="dropdown">
									<a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
										Categories
									</a>
									<div class="dropdown-menu">
										<?php
										$query="SELECT * FROM categories WHERE activation ='1'";
										$result=mysqli_query($connect,$query);
										while($category_info=mysqli_fetch_assoc($result)){
											echo "<a class='dropdown-item' href='Grid_product.php?id={$category_info['cat_id']}'>{$category_info['cat_name']}</a>";	
										}
										?>

									</div>
								</li>	
								<li><a href="Grid_product.php">Shop</a></li>
								<li><a href="#latest">latest</a></li>
								<li><a href="#aboutus">About US</a></li>
								<li><a href="#contactus">Contact US</a></li>									
							</ul>
						</div>						
					</div>
				</nav>
			</header>