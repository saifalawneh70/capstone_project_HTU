<?php   
ob_start();
    include_once('include/header.php');
    include_once('include/ooppublic.php');
    require ('include/connect_db.php');
    $obj1= new bigclass(); //obj1 using in footer file
    $obj5 = new bigclass();
    if (!isset($_SESSION['pre'])) {
        header("location:index.php");
    }
    if (!isset($_SESSION['customer_id'])) {
     header('location:login_customer.php');
   }
 ?>
    <!-- Start Banner Area -->
            <section class="banner-area organic-breadcrumb">
                <div class="container">
                    <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
                        <div class="col-first">
                            <h1>Order Confermation</h1>
                             <nav class="d-flex align-items-center justify-content-start">
                                <a href="index.php">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                <a href="confermation.php">Confermation</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Banner Area -->

		<!-- Start Checkout Area -->
		<div class="container">
			<p class="text-center">Thank you. Your order has been received.Your order will receive during four days </p>
            <p class="text-center">Your order will be delivered during four days</p>
			<div class="row mt-50">
				<div class="col-md-4">
					<h3 class="billing-title mt-20 pl-15">Order Info</h3>
					<?php
                    $order_info=$obj5->get_info_order();
                    echo "<table class='order-rable'>";
                    echo "<tr>";
                    echo "<td>Order number</td>";
                    echo "<td>{$order_info['order_id']}</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Date</td>";
                    echo "<td>{$order_info['order_date']}</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Total</td>";
                    echo "<td>JOD {$order_info['total']}</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Notes</td>";
                    echo "<td>{$order_info['Notes']}</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Payment method</td>";
                    echo "<td>CASH ON DELIVERY</td>";
                    echo "</tr>";
                    echo "</table>";
                    ?>
				</div>
				<div class="col-md-4">
					<h3 class="billing-title mt-20 pl-15">Billing Address</h3>
					<?php
                    $address_order_info=$obj5->get_info_address_order($order_info['address_id']);
                    echo "<table class='order-rable'>";
                    echo "<tr>";
                    echo "<td>Town</td>";
                    echo "<td>{$address_order_info['town']}</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>City</td>";
                    echo "<td>{$address_order_info['city']}</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Country</td>";
                    echo "<td>Jordan</td>";
                    echo "</tr>";
                    echo "</table>";
                    ?>
				</div>
				<div class="col-md-4">
					<h3 class="billing-title mt-20 pl-15">Customer Info</h3>
					<?php
                    $customer_info=$obj5->get_info_customer($order_info['cust_id']);
                    echo "<table class='order-rable'>";
                    echo "<tr>";
                    echo "<td>Name</td>";
                    echo "<td>{$customer_info['cust_name']}</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Email</td>";
                    echo "<td>{$customer_info['cust_email']}</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Phone</td>";
                    echo "<td>{$customer_info['cust_phone']}</td>";
                    echo "</tr>";
                    echo "</table>";
                    ?>
				</div>
			</div>
		</div>
		<!-- End Checkout Area -->
		<!-- Start Billing Details Form -->
		<div class="container">
			<div class="billing-form">
				<div class="row">
                    <div class="col-1"></div>
					<div class="col-10">
                  <div class="order-wrapper mt-50">
                    <h3 class="billing-title mb-10">Your Order</h3>
                    <div class="order-list">
                        <div class="list-row d-flex justify-content-between">
                            <div class='col-md-6 col-lg-8'>Product</div>
                            <div class='col-md-3 col-lg-2 text-center'>Quantity</div>
                            <div class='col-md-3 col-lg-2'>Total</div>
                        </div>
                        <?php
                        $query="SELECT * FROM order_products WHERE order_id={$order_info['order_id']}";
                        $result=mysqli_query($connect,$query);
                        $temp_array=array();
                        while ($all_products=mysqli_fetch_assoc($result)) {
                          $temp_array[]=$all_products['product_id'];
                        }
                        $quantity = array_count_values($temp_array);
                        $temp_array_after=array_unique($temp_array);
                        $subtotal=0;
                        foreach ($temp_array_after as $key => $value) {
                         $pro_info=$obj5->get_product_info($value);
                         echo " <div class='list-row d-flex justify-content-between'>";
                         echo "<div class='col-md-6 col-lg-8'>{$pro_info['product_name']}</div>";
                         $discount_price=$pro_info['discount']/100;
                         $price=$pro_info['product_price']-($discount_price*$pro_info['product_price']);
                         $total_price_product=$price*$quantity[$value];
                         echo "<div class='col-md-3 col-lg-2 text-center'>$quantity[$value]</div>";
                         echo "<div class='col-md-3 col-lg-2'>$total_price_product</div>";
                         echo "</div>";
                         $subtotal+=$total_price_product;
                         }
                         $total=$subtotal+10;
                          $_SESSION['totalorder']=$total;
                          echo "<div class='list-row d-flex justify-content-between'>
                            <h6>Subtotal</h6>
                            <div>$subtotal JOD</div>
                        </div>";
                        echo "<div class='list-row d-flex justify-content-between'>
                            <h6>Shipping</h6>
                            <div>delivery in jordan :10 JOD</div>
                        </div>
                        <div class='list-row d-flex justify-content-between'>
                            <h6>Total</h6>
                            <div class='total'>$total JOD </div>
                        </div>";
                         ?>
                        <div class="d-flex align-items-center mt-10">
                            <label for="check" class="bold-lable ml-5">Payment Payment : Cash on delivery</label>
                        </div>
                    </div>
                </div>
					</div>
                    <div class="col-1"></div>
				</div>
			</div>
		</div>
		<!-- End Billing Details Form -->

<?php
include_once('include/footer.php');
?>
