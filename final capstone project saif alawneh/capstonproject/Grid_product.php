 <?php
 include_once('include/header.php');
 include_once('include/ooppublic.php');
 require ('include/connect_db.php');
 $obj1= new bigclass(); //using in this page and in footer file
 if(!isset($_SESSION['cart']))
 {
    $_SESSION['cart']=array();
}
if(isset($_GET['cart_id']))
{
 array_push($_SESSION['cart'], $_GET['cart_id']);
 header("location:Grid_product.php?id={$_GET['id']}");
}
if(isset($_GET['cart_id1']))
{
 array_push($_SESSION['cart'], $_GET['cart_id1']);
 header("location:Grid_product.php?subid={$_GET['subid']}");
}
if(isset($_GET['cart_id2']))
{
 array_push($_SESSION['cart'], $_GET['cart_id2']);
 header("location:Grid_product.php");
}
?>
<!-- End Header Area -->
<!-- Start Banner Area -->
<script>
$(document).ready(function(){
  function Data_retrieval(value_search)
  {
    $.ajax({
      url:"API_search.php?<?php if(isset($_GET['id'])){echo 'id='.$_GET['id'];}elseif(isset($_GET['subid'])){echo 'subid='.$_GET['subid'];}elseif(isset($_GET['dicount'])){echo 'dicount='.$_GET['dicount'];} ?>",
      method:"post",
      data:{value_search:value_search},
      success:function(data)
      {
        $('#show_div_result').show();
        $('#show_div_product').hide();
        $('#result_search').html(data);
        
      }
    });
  }
  function no_data()
  {
   $('#show_div_product').show();
   $('#show_div_result').hide();
  }

  $('#submit').keyup(function(){
    var search = $(this).val();
    if(search != '')
    {
      Data_retrieval(search);
    }
    else
    {
      no_data();
    }
  });

});
</script>
<section class="banner-area organic-breadcrumb">
  <div class="container">
     <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
        <div class="col-first">
           <h1>Shop Category page</h1>
           <nav class="d-flex align-items-center justify-content-start">
              <a href="index.php">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
              <?php
              if (isset($_GET['id'])) {
                 $category_info1=$obj1->get_info_category($_GET['id']);  
                 echo "<a href='Grid_product.php?id={$category_info1['cat_id']}'>{$category_info1['cat_name']}</a>";
             }elseif (isset($_GET['subid'])) {
                 $sub_name=$obj1->get_info_sub_category($_GET['subid']);
                 $category_info2=$obj1->get_info_category($sub_name['cat_id']);
                 echo "<a href='Grid_product.php?id={$category_info2['cat_id']}'>{$category_info2['cat_name']}<i class='fa fa-caret-right' aria-hidden='true'></i></a>";
                 echo "<a href='Grid_product.php?subid={$sub_name['sub_cat_id']}'>{$sub_name['sub_cat_name']}</a>";
             }else{
                 echo "<a href='Grid_product.php'>Shop</a>";
             }

             ?>
         </nav>
     </div>
 </div>
</div>
</section>
<!-- End Banner Area -->
<div class="container">
  <div class="row">
     <div class="col-xl-9 col-lg-8 col-md-7">
        <!-- Start Filter Bar -->
<div style="background-color: rgb(247, 85, 158); height: 60px;" class="d-flex flex-wrap align-items-center ">
  <label style="color: white;" class="col-sm-2 control-label">Search Bar</label>
<div class="col-xl-10 col-lg-10 col-md-10 ">
  <input class="single-input" type="text" id="submit" name="search" placeholder="Search">
</div> 
</div>
<!-- End Filter Bar -->
<!-- Start Best Seller -->


     <?php
     echo "<section id='show_div_product' class='lattest-product-area pb-40 category-list'>
     <div class='row' >";
     if (isset($_GET['id'])) {
        $query="SELECT * FROM products WHERE activation='1' AND cat_id={$_GET['id']}";
        $result=mysqli_query($connect,$query);
        while ($pro_info=mysqli_fetch_assoc($result)) {
           $img_pro=$obj1->product_image($pro_info['product_id']);
           echo "<div class='col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product'>";
           echo "<div class='content'>";
           echo "<div class='content-overlay'></div>";
           echo "<img class='content-image  d-block mx-auto' src='images/products/{$img_pro['product_img']}' width='200' height='250' alt=''>";
           echo "<div class='content-details fadeIn-bottom'>";
           echo "<div class='bottom d-flex align-items-center justify-content-center'>";
           if ($pro_info['quantity']>0) {
            echo "<a href='Grid_product.php?id={$_GET['id']}&cart_id={$pro_info['product_id']}'><span class='lnr lnr-cart'></span></a>";
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
           echo "<div style ='height:80px'>";
           echo "<h5><a href='single_page.php?pro_id={$pro_info['product_id']}'>{$pro_info['product_name']}</a></h5>";
        if ($pro_info['discount']==0) {
          echo "<h5>"."JOD"."{$pro_info['product_price']}</h5>";    
        }
        else
        {
         $price_product=$pro_info['product_price'];
         $discount_price=$pro_info['discount']/100;
         $after_discount=$price_product-($discount_price*$price_product);
         echo "<h5>JOD $after_discount <small style='text-decoration-line: line-through;'>JOD {$pro_info['product_price']}</small></h5>";   
        }
     echo "</div>";
     echo "</div>";
     echo "</div>";
 }
}else if (isset($_GET['subid'])) {                         
   $query="SELECT * FROM products WHERE activation='1' AND sub_cat_id={$_GET['subid']}";
   $result=mysqli_query($connect,$query);
   while ($pro_info=mysqli_fetch_assoc($result)) {
      $img_pro=$obj1->product_image($pro_info['product_id']);
      echo "<div class='col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product'>";
      echo "<div class='content'>";
      echo "<div class='content-overlay'></div>";
      echo "<img class='content-image  d-block mx-auto' src='images/products/{$img_pro['product_img']}' width='200' height='250' alt=''>";
      echo "<div class='content-details fadeIn-bottom'>";
      echo "<div class='bottom d-flex align-items-center justify-content-center'>";
      if ($pro_info['quantity']>0) {
        echo "<a href='Grid_product.php?subid={$_GET['subid']}&cart_id1={$pro_info['product_id']}'><span class='lnr lnr-cart'></span></a>";
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
      echo "<div style ='height:70px'>";
      echo "<h5><a href='single_page.php?pro_id={$pro_info['product_id']}'>{$pro_info['product_name']}</a></h5>";
      if ($pro_info['discount']==0) {
          echo "<h5>"."JOD"."{$pro_info['product_price']}</h5>";    
        }
        else
        {
         $price_product=$pro_info['product_price'];
         $discount_price=$pro_info['discount']/100;
         $after_discount=$price_product-($discount_price*$price_product);
         echo "<h5>JOD $after_discount <small style='text-decoration-line: line-through;'>JOD {$pro_info['product_price']}</small></h5>";   
        }
      echo "</div>";
      echo "</div>";

      echo "</div>";

  }
}
elseif (isset($_GET['dicount'])) {
   $query="SELECT * FROM products WHERE activation='1' AND discount>=25";
   $result=mysqli_query($connect,$query);
   while ($pro_info=mysqli_fetch_assoc($result)) {
      $category_info2=$obj1->get_info_category($pro_info['cat_id']);
      $sub_cat_info=$obj1->get_info_sub_category($pro_info['sub_cat_id']);
      $info_vendor1=$obj1->get_info_vendor($pro_info['vendor_id']);
      if ($category_info2['activation'] && $sub_cat_info['activation'] &&  $info_vendor1['activation']) {
        $img_pro=$obj1->product_image($pro_info['product_id']);
        echo "<div class='col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product'>";
        echo "<div class='content'>";
        echo "<div class='content-overlay'></div>";
        echo "<img class='content-image  d-block mx-auto' src='images/products/{$img_pro['product_img']}' alt='' width='200' height='250'>";
        echo "<div class='content-details fadeIn-bottom'>";
        echo "<div class='bottom d-flex align-items-center justify-content-center'>";
        if ($pro_info['quantity']>0) {
        echo "<a href='Grid_product.php?cart_id2={$pro_info['product_id']}'><span class='lnr lnr-cart'></span></a>";    
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
        echo "<div style ='height:70px'>";
        echo "<h5><a href='single_page.php?pro_id={$pro_info['product_id']}'>{$pro_info['product_name']}</a></h5>";
        if ($pro_info['discount']==0) {
          echo "<h5>"."JOD"."{$pro_info['product_price']}</h5>";    
        }
        else
        {
         $price_product=$pro_info['product_price'];
         $discount_price=$pro_info['discount']/100;
         $after_discount=$price_product-($discount_price*$price_product);
         echo "<h5>JOD $after_discount <small style='text-decoration-line: line-through;'>JOD {$pro_info['product_price']}</small></h5>";   
        }
        echo "</div>";
        echo "</div>";

        echo "</div>";
    }
}
}
else
{
   $query="SELECT * FROM products WHERE activation='1'";
   $result=mysqli_query($connect,$query);
   while ($pro_info=mysqli_fetch_assoc($result)) {
      $category_info2=$obj1->get_info_category($pro_info['cat_id']);
      $sub_cat_info=$obj1->get_info_sub_category($pro_info['sub_cat_id']);
      $info_vendor1=$obj1->get_info_vendor($pro_info['vendor_id']);
      if ($category_info2['activation'] && $sub_cat_info['activation'] &&  $info_vendor1['activation']) {
        $img_pro=$obj1->product_image($pro_info['product_id']);
        echo "<div class='col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product'>";
        echo "<div class='content'>";
        echo "<div class='content-overlay'></div>";
        echo "<img class='content-image  d-block mx-auto' src='images/products/{$img_pro['product_img']}' alt='' width='200' height='250'>";
        echo "<div class='content-details fadeIn-bottom'>";
        echo "<div class='bottom d-flex align-items-center justify-content-center'>";
        if ($pro_info['quantity']>0) {
        echo "<a href='Grid_product.php?cart_id2={$pro_info['product_id']}'><span class='lnr lnr-cart'></span></a>";    
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
        echo "<div style ='height:70px'>";
        echo "<h5><a href='single_page.php?pro_id={$pro_info['product_id']}'>{$pro_info['product_name']}</a></h5>";
        if ($pro_info['discount']==0) {
          echo "<h5>"."JOD"."{$pro_info['product_price']}</h5>";    
        }
        else
        {
         $price_product=$pro_info['product_price'];
         $discount_price=$pro_info['discount']/100;
         $after_discount=$price_product-($discount_price*$price_product);
         echo "<h5>JOD $after_discount <small style='text-decoration-line: line-through;'>JOD {$pro_info['product_price']}</small></h5>";   
        }
        echo "</div>";
        echo "</div>";

        echo "</div>";
    }
}
}
echo "
</div>
</section>";

echo "<section id='show_div_result' class='lattest-product-area pb-40 category-list'>
     <div class='row' id='result_search'>";
     echo "
</div>
</section>";
?>
<!-- End Best Seller -->
<!-- Start Filter Bar -->

<!-- End Filter Bar -->
</div>
<div class="col-xl-3 col-lg-4 col-md-5">
   <div class="sidebar-categories">
      <div class="head">Browse Categories</div>
      <ul class="main-categories">
         <?php
         $count=0;
         $query="SELECT * FROM categories WHERE activation='1'"; 
         $result=mysqli_query($connect,$query);
         while($category_browser=mysqli_fetch_assoc($result))
         {
            $query3="SELECT * FROM products WHERE cat_id={$category_browser['cat_id']}";
            $result3=mysqli_query($connect,$query3);
            while ($number=mysqli_fetch_assoc($result3)) {
               $number6=$obj1->get_info_sub_category($number['sub_cat_id']);
               $number7=$obj1->get_info_vendor($number['vendor_id']);
               if ($number['activation'] && $number6['activation'] && $number7['activation']) {
                  $count++;
              }
          }
          echo "<li class='main-nav-list'>
          <a data-toggle='collapse' href='#df{$category_browser['cat_id']}'>
          <span class='lnr lnr-arrow-right'></span>
          {$category_browser['cat_name']}
          <span class='number'>({$count})</span>
          </a>";
          echo "<ul class='collapse' id='df{$category_browser['cat_id']}'>";

          $count1=0;
          $query2="SELECT * FROM sub_cat WHERE activation='1' AND cat_id={$category_browser['cat_id']}"; 
          $result2=mysqli_query($connect,$query2);
          while($re=mysqli_fetch_assoc($result2)){
           $query4="SELECT * FROM products WHERE sub_cat_id={$re['sub_cat_id']} AND activation='1'";
           $result4=mysqli_query($connect,$query4);
           while ($number1=mysqli_fetch_assoc($result4)) {
              $number8=$obj1->get_info_vendor($number1['vendor_id']);
              if ($number8['activation']) {
                 $count1++;
             }
         }
         echo "
         <li class='main-nav-list child'>
         <a href='Grid_product.php?subid={$re['sub_cat_id']}' target='_self'>
         {$re['sub_cat_name']}
         <span class='number'>({$count1})</span>
         </a>
         </li>
         ";
         $count1=0;
     }
     echo "</ul>
     </li>";
     $count=0;
 }
 ?>        
</ul>
</div>
</div>
</div>
</div>


<!-- start footer Area -->      


<?php
include_once('include/footer.php');
?>