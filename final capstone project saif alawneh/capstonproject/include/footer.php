<section class="related-product-area section-gap" id="latest">
		<div class="container">
			<div class="related-content">
				<div class="title text-center">
					<h1 class="mb-10">New Related Products</h1>
					<p>Who are in extremely love with eco friendly system.</p>
				</div>
			</div>					
			<div class="row">
				<?php
				$query="SELECT * FROM products WHERE activation='1' ORDER BY product_date DESC";
				$result=mysqli_query($connect,$query);
				$counter=0;
				while ($pro_info=mysqli_fetch_assoc($result)) {
					$category_info2=$obj1->get_info_category($pro_info['cat_id']);
					$sub_cat_info=$obj1->get_info_sub_category($pro_info['sub_cat_id']);
					$info_vendor1=$obj1->get_info_vendor($pro_info['vendor_id']);
					if ($category_info2['activation'] && $sub_cat_info['activation'] &&  $info_vendor1['activation']) {
						if ($counter<12) {
						$img_pro=$obj1->product_image($pro_info['product_id']);
						echo "<div class='col-lg-3 col-md-4 col-sm-6 mb-20'>"; 
                        echo "<div class='single-related-product d-flex'>";
                        echo "<a href='images/products/{$img_pro['product_img']}'><img src='images/products/{$img_pro['product_img']}' width='70px'
                        height='70px' alt=''></a>";
                        echo "<div class='price text-truncate' style='max-width:150px;'>";
                        echo "<a href='single_page.php?pro_id={$pro_info['product_id']}' class='title'>{$pro_info['product_name']}</a>";
                        echo "<div class='price'><span class='lnr lnr-tag'></span>JOD {$pro_info['product_price']}</div>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
						$counter++;
						}
					}
					}

						?>																		
					</div>
				</section>
	

<footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div id='aboutus' class="col-lg-3  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>About Us</h6>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.
								</p>
							</div>
						</div>
						<div class="col-lg-3  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Contact US</h6>
								<p>Stay update with our latest</p>
								<div class="" id="mc_embed_signup">
                                 <p class="mb-2">Email : saifalawneh2000@gmail.com</p>
                                 <p class="mb-2">Phone : +962 79516-3090</p>
                                 <p class="mb-2">Location :<a style="text-decoration : none; color: #777777" href="https://goo.gl/maps/2ZhQysb4vm93JL2N9">Bulding 23, King Hussein Business Park, King Abdullah II St 242, Amman</a></p>
								</div>
								</div>
						</div>						
						<div class="col-lg-3  col-md-6 col-sm-6">
							<div class="single-footer-widget mail-chimp">
								<h6 class="mb-20">Instragram Feed</h6>
								<ul class="instafeed d-flex flex-wrap">
									<li><img src="img/i1.jpg" alt=""></li>
									<li><img src="img/i2.jpg" alt=""></li>
									<li><img src="img/i3.jpg" alt=""></li>
									<li><img src="img/i4.jpg" alt=""></li>
									<li><img src="img/i5.jpg" alt=""></li>
									<li><img src="img/i6.jpg" alt=""></li>
									<li><img src="img/i7.jpg" alt=""></li>
									<li><img src="img/i8.jpg" alt=""></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Follow Us</h6>
								<p>Let us be social</p>
								<div class="footer-social d-flex align-items-center">
									<a href="https://www.facebook.com/saifaldeen.alawneh.75"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-instagram"></i></a>
									<a href=" https://wa.me/+962795163090?text=I'm%20interested%20in%20to%20be%20contact%20with%20you.."><i class="fa fa-whatsapp"></i></a>
									<a href="https://accounts.snapchat.com/accounts/snapcodes"><i class="fa fa-snapchat"></i></a>
								</div>
							</div>
						</div>							
					</div>
					<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">

						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						<p class="footer-text m-0">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</div>
				</div>
			</footer>	
			<!-- End footer Area -->		

			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.nice-select.min.js"></script>
			<script src="js/jquery.sticky.js"></script>
			<script src="js/ion.rangeSlider.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>
            <script src="js/owl.carousel.min.js"></script>			
			<script src="js/main.js"></script>	
             
               
               

		</body>
	</html>