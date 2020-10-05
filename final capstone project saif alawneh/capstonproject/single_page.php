<?php
ob_start();
include_once('include/header.php');
include_once('include/ooppublic.php');
require ('include/connect_db.php');
$obj1= new bigclass(); //obj1 using in footer file
$obj2 = new bigclass();
if (!isset($_GET['pro_id'])) {
  header("location:Grid_product.php");
}
if(!isset($_SESSION['cart']))
{
  $_SESSION['cart']=array();
}
if(isset($_POST['addtocart']))
{
 array_push($_SESSION['cart'], $_GET['pro_id']);
 header("location:single_page.php?pro_id={$_GET['pro_id']}");
}
if(isset($_POST['submit1']))
{
  $name=mysqli_real_escape_string($connect,$_POST['username']);
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $comment=mysqli_real_escape_string($connect,$_POST['comment']);
  $querycomment="INSERT INTO comment_users (name,email,phone,comment,product_id) VALUE ('$name' , '$email' ,'$phone','$comment',{$_GET['pro_id']})";
  $result=mysqli_query($connect,$querycomment);
  header("location:single_page.php?pro_id={$_GET['pro_id']}");
}
?>
<!-- End Header Area -->

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
  <div class="container">
    <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
      <div class="col-first col-lg-12">
        <h1>Single Product Page</h1>
        <nav class="d-flex align-items-center justify-content-start">
          <a href="index.php">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
          <?php   
          $product_info1=$obj2->get_product_info($_GET['pro_id']);
          $sub_name=$obj2->get_info_sub_category($product_info1['sub_cat_id']);
          $category_info1=$obj2->get_info_category($product_info1['cat_id']);  
                    /*echo "<a href='Grid_product.php?id={$category_info1['cat_id']}'>{$category_info1['cat_name']}<i class='fa fa-caret-right' aria-hidden='true'></i></a>";
                    echo "<a href='Grid_product.php?subid={$sub_name['sub_cat_id']}'>{$sub_name['sub_cat_name']}<i class='fa fa-caret-right' aria-hidden='true'></i></a>";*/
                    echo "<a href='single_page.php?pro_id={$product_info1['product_id']}'>{$product_info1['product_name']}</a>";
                    ?>
                  </nav>
                </div>
              </div>
            </div>
          </section>
          <!-- End Banner Area -->
          <!-- Start Product Details -->
          <div class="container">
            <div class="product-quick-view">
              <div class="row ">
                <div class="col-lg-6">
                  <?php
                  $product_info=$obj2->get_product_info($_GET['pro_id']);
                  echo "<div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>";
                  echo "<div class='carousel-inner'>";
                  $I=1;
                  $query1="SELECT * FROM product_images WHERE product_id={$_GET['pro_id']}";
                  $result1=mysqli_query($connect,$query1);
                  while ($image=mysqli_fetch_assoc($result1)) {
                    if ($I==1) {

                      echo "<div class='carousel-item active'>
                      <img class='d-block w-100' src='images/products/{$image['product_img']}' width='300px' height='455px' alt='First slide'>
                      </div>";      
                    }else{
                      echo "<div class='carousel-item'>
                      <img class='d-block w-100' src='images/products/{$image['product_img']}' width='300px' height='455px' alt='Second slide'>
                      </div>";
                    }
                    $I++;
                  }
                  echo "<a class='carousel-control-prev' href='#carouselExampleControls' role='butto' data-slide='prev'>
                  <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                  <span class='sr-only'>Previous</span>
                  </a>
                  <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
                  <span class='carousel-control-next-icon' aria-hidden='true'></span>
                  <span class='sr-only'>Next</span>
                  </a>";
                  echo"</div>
                  </div>";

                  ?>
                </div>
                <div class="col-lg-6">
                  <div class="quick-view-content">
                    <div class="top">
                      <h3 class="head"><?php echo "{$product_info['product_name']}"; ?></h3>
                      <?php

                      ?>
                      <div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span>
                        <span class="ml-10">

                          <?php 
                          if ($product_info['discount']==0) {
                            echo "JOD {$product_info['product_price']}";    
                          }
                          else
                          {
                           $price_product=$product_info['product_price'];
                           $discount_price=$product_info['discount']/100;
                           $after_discount=$price_product-($discount_price*$price_product);
                           echo "JOD $after_discount";   
                         }

                         ?>   
                       </span></div>
                       <div class="category">Category: <span>
                        <?php
                        $x=$obj2->get_info_category($product_info['cat_id']);
                        echo "{$x['cat_name']}";?>
                      </span></div>
                      <div class="available">Availibility: <span>
                        <?php
                        if($product_info['quantity']>0)
                          {echo "In Stock";}
                        else
                          {echo "Out Stock";}

                        ?>

                      </span></div>
                      <div class="available">BY: <span>
                        <?php
                        $z=$obj2->get_info_vendor($product_info['vendor_id']);
                        echo $z['vendor_name'];
                        ?>

                      </span></div>
                    </div>
                    <div>
                      <div class="d-flex mt-20">
                        <form method="post">
                          <button type='submit' name='addtocart' value='5' class='view-btn color-2'
                          <?php
                          if ($product_info['quantity']==0) {
                            echo "disabled";
                          }
                          ?> ><span>Add to Cart</span></button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="container">
            <div class="details-tab-navigation d-flex justify-content-center mt-30">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li>
                  <a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-expanded="true">Description</a>
                </li>
                <li>
                  <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments">Comments</a>
                </li>

              </ul>
            </div>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description">
                <div class="description">
                 <?php echo "{$product_info['product_desc']}"; ?>
               </div>
             </div>
             <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments">
              <div class="review-wrapper">
                <div class="row">
                  <div class="col-xl-6">
                    <div class="total-comment">

                      <?php
                      $queryview="SELECT * FROM comment_users WHERE product_id={$_GET['pro_id']}";
                      $resultview=mysqli_query($connect,$queryview);
                      while($comment_info=mysqli_fetch_assoc($resultview))
                      {
                       echo "<div class='single-comment'>";
                       echo "<div class='user-details d-flex align-items-center flex-wrap'>";
                       echo "<div class='user-name order-3 order-sm-2'>";
                       echo "<h5>{$comment_info['name']}</h5>";
                       echo "</div>";
                       echo "</div>";
                       echo "<p class='user-comment'>";
                       echo "{$comment_info['comment']}";
                       echo "</p>";
                       echo "</div>";
                     }
                     ?>




                   </div>
                 </div>
                 <div class="col-xl-6">
                  <div class="add-review">
                    <h3>Post a comment</h3>
                    <form method="post" class="main-form">
                      <input type="text" name="username" placeholder="Your Full name" onfocus="this.placeholder=''" onblur="this.placeholder = 'Your Full name'" required class="common-input">

                      <input type="email" name="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" placeholder="Email Address" onfocus="this.placeholder=''"  onblur="this.placeholder = 'Email Address'" required class="common-input">

                      <input type="text" name="phone" placeholder="Phone Number" onfocus="this.placeholder=''" onblur="this.placeholder = 'Phone Number'" required class="common-input">

                      <textarea name="comment" placeholder="Messege" onfocus="this.placeholder=''" onblur="this.placeholder = 'Messege'" required class="common-textarea"></textarea>

                      <input class=" view-btn color-2" type="submit" name="submit1" value="Submit now">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Product Details -->

      <!-- start footer Area -->      

      <?php
      include_once('include/footer.php');
      ?>