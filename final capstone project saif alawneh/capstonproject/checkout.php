    <?php
    ob_start();
    include_once('include/header.php');
    include_once('include/ooppublic.php');
    require ('include/connect_db.php');
    $obj1= new bigclass(); //obj1 using in footer file
    $obj4 = new bigclass();
    if (!isset($_SESSION['customer_id'])) {
     header('location:login_customer.php');
 }
 if (isset($_POST['submit'])) {
   $obj4->insert_into_address_order();
   $obj4->insert_into_order();
   $obj4->insert_into_order_products();
   $obj4->update_quantity_products();
   $_SESSION['pre']="pass to confermation page";
   unset($_SESSION['cart']);
   header("location:confermation.php");
}
if (isset($_POST['edit'])) {
   $name=$_POST['name'];
   $email=$_POST['email'];
   $phone=$_POST['Phone'];
   $password=$_POST['password'];
   $obj4->update_customer_information($_SESSION['customer_id'],$name,$email,$phone,$password);
   header('location:checkout.php');
}
?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
            <div class="col-first">
                <h1>Product Checkout</h1>
                <nav class="d-flex align-items-center justify-content-start">
                    <a href="index.php">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <a href="checkout.php">Product Checkout</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->
<!-- Start Checkout Area -->

<!-- End Checkout Area -->
<!-- Start Billing Details Form -->
<div class="container">
   
        <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                        <div class="details-tab-navigation d-flex justify-content-center mt-30">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li>
                                    <a class="nav-link " id="info_customer-tab" data-toggle="tab" href="#info_customer" role="tab" aria-controls="info_customer" aria-expanded="true">Your Information</a>
                                </li>
                                <li>
                                    <a class="nav-link" id="edit_information-tab" data-toggle="tab" href="#edit_information" role="tab" aria-controls="edit_information">Eidt Your Information</a>
                                </li>
                            </ul>
                        </div>
                        <?php
                        $customer_information=$obj4->get_info_customer($_SESSION['customer_id']);
                        ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade " id="info_customer" role="tabpanel" aria-labelledby="info_customer">
                                <h3 class="billing-title mt-20 pl-15">Your information</h3>
                                <table class="order-rable">
                                    <tr>
                                        <td>name</td>
                                        <td><?php echo "{$customer_information['cust_name']}"; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo "{$customer_information['cust_email']}"; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?php echo "{$customer_information['cust_phone']}"; ?></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="edit_information" role="tabpanel" aria-labelledby="edit_information">
                                <form method="post">
                                <input name="name" type="text" placeholder="name" onfocus="this.placeholder=''" onblur="this.placeholder = 'name'" required class="common-input" 
                                value="<?php echo "{$customer_information['cust_name']}"; ?>">
                                <input name="email" type="text" placeholder="email" onfocus="this.placeholder=''" onblur="this.placeholder = 'email'" required class="common-input" value="<?php echo "{$customer_information['cust_email']}"; ?>">
                                <input name="Phone" type="text" placeholder="phone" onfocus="this.placeholder=''" onblur="this.placeholder = 'phone'" required class="common-input" value="<?php echo "{$customer_information['cust_phone']}"; ?>">
                                 <input name="password" type="password" placeholder="password" onfocus="this.placeholder=''" onblur="this.placeholder = 'password'" required class="common-input" value="<?php echo "{$customer_information['cust_password']}"; ?>">
                                 <button class="view-btn color-2 w-100 mt-20" name="edit"><span>Edit your information</span></button>
                                 </form>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-2"></div>
              </div>  
            </div>

            <div class="col-lg-7 col-md-6">
             <form method="post" class="billing-form">
                <h3 class="billing-title mt-20 mb-10">Billing Details</h3>
                <div class="row">  
                    <div class="col-lg-12">
                        <div class="sorting">
                            <select name="cities" required>
                                <option value="">City</option>
                                <option value="Irbid">Irbid</option>
                                <option value="Ajloun">Ajloun</option>
                                <option value="Jerash">Jerash</option>
                                <option value="Mafraq">Mafraq</option>
                                <option value="Balqa">Balqa</option>
                                <option value="Amman">Amman</option>
                                <option value="Zarqa">Zarqa</option>
                                <option value="Madaba">Madaba</option>
                                <option value="Karak">Karak</option>
                                <option value="Tafilah">Tafilah</option>
                                <option value="Ma'an">Ma'an</option>
                                <option value="Aqaba">Aqaba</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input name="twons" type="text" placeholder="Town*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Town*'" required class="common-input">
                    </div>
                </div>
                <textarea name="notes" placeholder="Order Notes" onfocus="this.placeholder=''" onblur="this.placeholder = 'Order Notes'" required class="common-textarea"></textarea>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="order-wrapper mt-50">
                    <h3 class="billing-title mb-10">Your Order</h3>
                    <div class="order-list">
                        <div class="list-row d-flex justify-content-between">
                            <div class='col-md-7 col-lg-8'>Product</div>
                            <div class='col-md-3 col-lg-2'>Quantity</div>
                            <div class='col-md-2 col-lg-2'>Total</div>
                        </div>
                        <?php
                        $quantity = array_count_values($_SESSION['cart']);
                        $copy_array= $_SESSION['cart'];
                        $copy_array_after=array_unique($copy_array);
                        $subtotal=0;
                        foreach ($copy_array_after as $key => $value) {
                         $pro_info=$obj4->get_product_info($value);
                         echo " <div class='list-row d-flex justify-content-between'>";
                         echo "<div class='col-md-8 col-lg-8'>{$pro_info['product_name']}</div>";
                         $discount_price=$pro_info['discount']/100;
                         $price=$pro_info['product_price']-($discount_price*$pro_info['product_price']);
                         $total_price_product=$price*$quantity[$value];
                         echo "<div class='col-md-2 col-lg-2 text-center'>$quantity[$value]</div>";
                         echo "<div class='col-md-2 col-lg-2'>$total_price_product</div>";
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
                    <?php
                    if (count($_SESSION['cart'])>0) {
                     echo "<button class='view-btn color-2 w-100 mt-20' name='submit'><span>Order Confermation</span></button>";
                    }
                    ?>              
                    
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<!-- End Billing Details Form -->


<?php
include_once('include/footer.php');
?>
