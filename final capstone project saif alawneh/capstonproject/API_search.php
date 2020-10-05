<?php
require ('include/connect_db.php');
include_once('include/ooppublic.php');
$obj1= new bigclass();
if(isset($_POST["value_search"]))
{   
	$query4='';

   if (isset($_GET['id'])) {
   	$query4="SELECT * FROM products WHERE product_name LIKE '%".$_POST["value_search"]."%' AND cat_id={$_GET['id']}";
   }
   elseif (isset($_GET['subid'])) {
   	$query4="SELECT * FROM products WHERE product_name LIKE '%".$_POST["value_search"]."%' AND sub_cat_id={$_GET['subid']}";
   }elseif (isset($_GET['dicount'])) {
   	$query4="SELECT * FROM products WHERE product_name LIKE '%".$_POST["value_search"]."%' AND discount >=25";
   }else {
   	$query4="SELECT * FROM products WHERE product_name LIKE '%".$_POST["value_search"]."%'";
   }
      $output='';
	  $result4=mysqli_query($connect,$query4);
	  if ($number_of_row4=mysqli_num_rows($result4)!=0) {
	  	while ($info4=mysqli_fetch_assoc($result4)) {
            $number6=$obj1->get_info_sub_category($info4['sub_cat_id']);
            $number7=$obj1->get_info_vendor($info4['vendor_id']);
            $number8=$obj1->get_info_category($info4['cat_id']);
            if ($info4['activation'] && $number6['activation'] && $number7['activation'] && $number8['activation']) {
	  		$img_pro=$obj1->product_image($info4['product_id']);
	  		$output .="<div class='col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product'>
	  		<div class='content'>
	  		<div class='content-overlay'></div>
	  		<img class='content-image  d-block mx-auto' src='images/products/{$img_pro['product_img']}' width='200' height='250' alt=''>
	  		<div class='content-details fadeIn-bottom'>
	  		<div class='bottom d-flex align-items-center justify-content-center'>
	  		";
	  		if ($info4['quantity']>0) {
	  			$output .="<a href='Grid_product.php?cart_id2={$info4['product_id']}'><span class='lnr lnr-cart'></span></a>";
	  		}
	  		else
	  		{
	  			$output .="<a><span class='lnr lnr-cart'></span></a>";
	  		}          
	  		$output .="<a href='images/products/{$img_pro['product_img']}'><span class='lnr lnr-frame-expand'></span></a>";
	  		$output .="</div></div></div>";
	  		$output .="<div class='price text-truncate' style='max-width:300px;'>
	  		<div style ='height:80px'>
	  		<h5><a href='single_page.php?pro_id={$info4['product_id']}'>{$info4['product_name']}</a></h5>";
	  		if ($info4['discount']==0) {
	  			$output .= "<h5>"."JOD"."{$info4['product_price']}</h5>";    
	  		}
	  		else
	  		{
	  			$price_product=$info4['product_price'];
	  			$discount_price=$info4['discount']/100;
	  			$after_discount=$price_product-($discount_price*$price_product);
	  			$output .= "<h5>JOD $after_discount <small style='text-decoration-line: line-through;'>JOD {$info4['product_price']}</small></h5>";   
	  		}
	  		$output .="</div></div></div>";
	  	}
	  }
	  	echo $output; 
	  }





















	}
	?>