<?php
ob_start();
include_once('include/header.php');
include_once('include/ooppublic.php');
require ('include/connect_db.php');
$obj1= new bigclass();
$obj3 = new bigclass();

if (isset($_POST['removeproduct']))
{  
    $remove_id=$_POST['removeproduct'];
    unset($_SESSION['cart'][$remove_id]);
    header("location:cart_page.php");
}
if (isset($_POST['checkoutbtn']))
{  
     if (isset($_SESSION['customer_id'])) {
         header('location:checkout.php');
     }
     else
     {
        header('location:login_customer.php');
     }
}
?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
            <div class="col-first">
                <h1>Shopping Cart</h1>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->
<!-- Start Cart Area -->
<div class="container">
    <div class="row">
        <?php
        if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0 ){   
            echo "<div class='table-responsive text-center'>
            <table class='table'>";
            echo "<thead>
            <tr>
            <td>Product</td>
            <td></td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Total</td>
            <td>Remove product</td>
            </tr>
            </thead>";
            echo"<form method='post'>";
            echo"<tbody>";
            $price_product=0;
            $discount_price=0;
            $subtotal=0;
            $total=0;
            $count=0;
            $quantity1 = array_count_values($_SESSION['cart']);
            $copy_array1=$_SESSION['cart'];
            $n=array_unique($copy_array1);
            foreach ($n as $key => $value) {
            $pro_info=$obj3->get_product_info($value);
            $pro_img=$obj3->product_image($pro_info['product_id']);
            echo "<tr>";
            echo "<td>";
            echo "<img src='images/products/{$pro_img['product_img']}' width='100px' class='img-fluid' >";
            echo "</td>";
            echo "<td>";
            echo "<h6 class='price text-truncate' style='max-width:500px;'><a href='single_page.php?pro_id={$pro_info['product_id']}'>{$pro_info['product_name']}</a></h6>";
            echo "</td>";
            echo "<td>";
            $price_product=$pro_info['product_price'];
            $discount_price=$pro_info['discount']/100;
            $price_with_dicount=$price_product-($discount_price*$price_product);
            if ($pro_info['discount']==0) {
                 echo "<div class='price'>{$pro_info['product_price']} JOD</div>";    
             }
             else
             {
              echo "<div class='price'>$price_with_dicount JOD  &nbsp;<small style='text-decoration-line: line-through;'>{$pro_info['product_price']}JOD</small></div>";  
          }
          echo "</td>";
          if ($quantity1[$value]<=$pro_info['quantity']) {
          echo "<td>$quantity1[$value]</td>";
          $count++;  
          }
          else
          {
           echo "<td>$quantity1[$value]<br><span style='color:red;'>available for you {$pro_info['quantity']} items</span></td>"; 
          }

          $total_of_product=$quantity1[$value]*$price_with_dicount;
          $subtotal+=$total_of_product;
          echo "<td>$total_of_product</td>";
          echo "<td>";
          echo "<div class='total'>";
          echo "<button type ='submit' class='genric-btn primary circle' name='removeproduct' value='$key'>Remover single item</button>";
          echo "</div>";
          echo "</td>";
          echo "</div>";
          echo "</tr>";
      }
      echo "<tr>";
      echo "<td></td>";
      echo "<td></td>";
      echo "<td></td>";
      echo "<td>
      <div class='title text-uppercase'>Subtotal</div>";
      echo "</td>"; 
      if (count($_SESSION['cart'])>0) {
        $total=$subtotal+10;
    }
    echo "<td>
    <div class='subtotal'>$subtotal JOD </div>
    </td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td> <div class='title text-uppercase'>Total </div></td>";
    echo "<td>$total JOD</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
      if ($count==count($n)) {
       echo "<td><button name ='checkoutbtn' class='genric-btn primary e-large'>Checkout</button></td>";
      }
      else
      {
       echo "<td><button name ='checkoutbtn1' class='genric-btn primary e-large' disabled>Checkout</button></td>"; 
      }
    echo "</tr>";
    echo "</tbody>";
    echo "</form>";
    echo "</table>
    </div>";
}
else
{   
    echo "<div class='container'>"; 
    echo "<div class='row'>"; 
    echo "<div class='col-md-5'></div>";
    echo "<div class='col-md-3'><a href='index.php' class='text-center genric-btn primary e-large'>Shopping  Now</a></div>";
     echo "<div class='col-md-4'></div>";
     echo "</div>";
     echo "</div>";
}
?>
</div>
</div>


<!-- start footer Area -->      
<?php
include_once('include/footer.php');
?>