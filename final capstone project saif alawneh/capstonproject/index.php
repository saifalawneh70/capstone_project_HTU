	<?php
	include_once('include/header.php');
	require ('include/connect_db.php');
	include_once('include/ooppublic.php');
	$obj1 = new bigclass();
	if(!isset($_SESSION['cart']))
	{
		$_SESSION['cart']=array();
	}
	if(isset($_GET['cart_id3']))
	{
		array_push($_SESSION['cart'], $_GET['cart_id3']);
		header("location:index.php");
	}
	?>
	<!-- End Header Area -->
	<!-- start banner Area -->
	<section class="banner-area relative" id="home">
		<div class="container-fluid">
			<div class="row fullscreen align-items-center justify-content-center">
				<div class="col-lg-6 col-md-12 d-flex align-self-end img-right no-padding">
					<img class="img-fluid" src="img/header-img.png" alt="">
				</div>
				<div class="banner-content col-lg-6 col-md-12">
					<h1 class="title-top"><span>Flat</span> 25%Off</h1>
					<h1 class="text-uppercase">
						It’s Happening <br>
						this Season!
					</h1>
					<button class="primary-btn text-uppercase"><a href="Grid_product.php?dicount=25">Purchase Now</a></button>
				</div>							
			</div>
		</div>
	</section>
	<!-- End banner Area -->	

	<!-- Start category Area -->
	<section class="category-area section-gap section-gap" id="catagory">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="menu-content pb-40">
					<div class="title text-center">
						<h1 class="mb-10">Shop for Different Categories</h1>
						<p>Who are in extremely love with eco friendly system.</p>
					</div>
				</div>
			</div>					
			<div class="row">
				<div class="col-lg-12 col-md-12 mb-10">
					<div class="row category-bottom">
						<?php
						$query="SELECT * FROM categories WHERE activation ='1'";
						$result=mysqli_query($connect,$query);
						while($category_info=mysqli_fetch_assoc($result)){
							echo "<div class='col-lg-4 col-md-4 mb-30'>";
							echo "<div class='content'>";
							echo "<a href='Grid_product.php?id={$category_info['cat_id']}'>";
							echo "<div class='content-overlay'></div>";
							echo "<img class='content-image img-fluid d-block mx-auto' src='images/Categories/{$category_info['cat_img']}' alt=''>";
							echo "<div class='content-details fadeIn-bottom'>";
							echo "<h3 class='content-title'>{$category_info['cat_name']}</h3>";
							echo "</div>";
							echo "</a>";
							echo "</div>";
							echo "</div>";
						}
						?>
					</div>						
				</div>
			</div>
		</div>	
	</section>
	<!-- End category Area -->

	<!-- Start men-product Area -->
	<section class="men-product-area section-gap relative" id="men">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="menu-content pb-40">
					<div class="title text-center">
						<h1 class="text-white mb-10">New realeased Products for ELECTRONICS</h1>
						<p class="text-white">Who are in extremely love with eco friendly system.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<?php
				$queryc12="SELECT * FROM categories WHERE cat_name ='ELECTRONICS' AND activation='1'";
				$ress12=mysqli_query($connect,$queryc12);
				$catee12=mysqli_fetch_assoc($ress12);
				$queryd11="SELECT * FROM products WHERE cat_id= {$catee12['cat_id']} AND activation='1' ORDER BY product_date DESC ";
				$ress11=mysqli_query($connect,$queryd11);
				$n1=0;
				while ($dates1=mysqli_fetch_assoc($ress11)){
					if ($n1<4) {
						$img_pro1=$obj1->product_image($dates1['product_id']);
						echo "<div class='col-lg-3 col-md-6  single-product'>";
						echo "<div class='content'>";
						echo "<div class='content-overlay'></div>";
						echo "<img class='content-image  d-block mx-auto' src='images/products/{$img_pro1['product_img']}' alt='' width='200' height='250'>";
						echo "<div class='content-details fadeIn-bottom'>";
						echo "<div class='bottom d-flex align-items-center justify-content-center'>";
						if ($dates1['quantity']>0) {
						echo "<a href='index.php?cart_id3={$dates1['product_id']}'><span class='lnr lnr-cart'></span></a>";
						}
						else
						{
							echo "<a><span class='lnr lnr-cart'></span></a>";
						}
						echo "<a href='images/products/{$img_pro1['product_img']}'><span class='lnr lnr-frame-expand'></span></a>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
						echo "<div class='price text-truncate' style='max-width:300px;'>";
						echo "<div class='price text-truncate' style ='height:70px; max-width:300px;'>";
						echo "<a href='single_page.php?pro_id={$dates1['product_id']}'> <h5 class='text-white'>{$dates1['product_name']}</h5> </a>";
						echo "<h5 class='text-white'>"."JOD  "."{$dates1['product_price']}</h5>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
						$n1++;
					}
					
				}
				?>							
			</div>
		</div>	
	</section>
	<!-- End men-product Area -->

	<!-- Start women-product Area -->
	<section class="women-product-area section-gap" id="women">
		<div class="container">
			<div class="countdown-content pb-40">
				<div class="title text-center">
					<h1 class="mb-10">New realeased Products for CLOTHES</h1>
					<p>Who are in extremely love with eco friendly system.</p>
				</div>
			</div>
			<div class="row">
				<?php
				$queryc="SELECT * FROM categories WHERE cat_name ='CLOTHES' AND activation='1'";
				$ress=mysqli_query($connect,$queryc);
				$catee=mysqli_fetch_assoc($ress);
				$queryd="SELECT * FROM products WHERE cat_id= {$catee['cat_id']} AND activation='1' ORDER BY product_date DESC ";
				$ress1=mysqli_query($connect,$queryd);
				$n=0;
				while ($dates=mysqli_fetch_assoc($ress1)){
					if ($n<4) {
						$img_pro=$obj1->product_image($dates['product_id']);
						echo "<div class='col-lg-3 col-md-6  single-product'>";
						echo "<div class='content'>";
						echo "<div class='content-overlay'></div>";
						echo "<img class='content-image  d-block mx-auto' src='images/products/{$img_pro['product_img']}' alt='' width='200' height='250'>";
						echo "<div class='content-details fadeIn-bottom'>";
						echo "<div class='bottom d-flex align-items-center justify-content-center'>";
						if ($dates['quantity']>0) {
						echo "<a href='index.php?cart_id3={$dates['product_id']}'><span class='lnr lnr-cart'></span></a>";	
						}
						else
						{
							echo "<a><span class='lnr lnr-cart'></span></a>";
						}
						echo "<a href='images/products/{$img_pro['product_img']}'><span class='lnr lnr-frame-expand'></span></a>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
						echo "<div class='price text-truncate' style='max-width:300px;'>";
						echo "<div>";
						echo "<h5><a href='single_page.php?pro_id={$dates['product_id']}'>{$dates['product_name']}</a></h5>";
						echo "<h5>"."JOD  "."{$dates['product_price']}</h5>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
						$n++;
					}
					
				}
				?>
			</div>
		</div>	
	</section>
	<!-- End women-product Area -->

	<!-- Start Count Down Area -->

	<!-- End Count Down Area -->

	<!-- Start related-product Area --> 
				<!-- End related-product Area -->

				<!-- start footer Area -->		
				<?php
				include_once('include/footer.php');
				?>