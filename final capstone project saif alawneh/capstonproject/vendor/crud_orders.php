<?php 
ob_start();
session_start(); 
include_once('include/headervendor.php');
include_once('include/oop.php');
require('include/connect_db.php');
$obj_orders=new crud_order();
$obj_pro=new crud_product();
?>
<section class="content">
       <div class="container-fluid">
              <div class="col-xs-12 col-sm-12">
                     <div class="card">
                            <div class="header">
                                   <h2>
                                          ALL Orders
                                   </h2>
                            </div>
                            <div class="body">

                                   <div class="clearfix row">
                                         <?php 
                                         //start order info
                                         $query="SELECT * FROM orders WHERE Situation='1'";
                                         $result=mysqli_query($connect,$query);
                                         $count=0;
                                         while ($order_info1=mysqli_fetch_assoc($result)) {
                                          //start order addresses
                                          $address_info1=$obj_orders->get_info_order_address($order_info1['address_id']);
                                          //end order addresses
                                          //start order product
                                          $query2="SELECT * FROM order_products WHERE order_id={$order_info1['order_id']}";
                                          $result2=mysqli_query($connect,$query2);
                                          $temp_array=array();
                                          while ($product_order_info=mysqli_fetch_assoc($result2)) {
                                                 $product_info=$obj_pro->get_info_product($product_order_info['product_id']);
                                                 if ($product_info['vendor_id']==$_SESSION['idvend']) {
                                                        $temp_array[]=$product_order_info['product_id'];
                                                 }
                                          }
                                          if (!empty($temp_array)) {
                                                 $quantity = array_count_values($temp_array);
                                                 $temp_array_after=array_unique($temp_array);
                                                        //end order product
                                                        //start customer information
                                                 $customer_info1=$obj_orders->get_info_costmer($order_info1['cust_id']);
                                                        //end customer information
                                                 echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>";
                                                 echo "<div class='card'>";
                                                 echo "<div class='body'>";
                                                 echo "<table class='table responsive' >";
                                                 echo "<tr>";
                                                 echo "<td>order id</td>";
                                                 echo "<td></td>";
                                                 echo "<td>{$order_info1['order_id']}</td>";
                                                 echo "</tr>";
                                                 echo "<tr>";
                                                 echo "<td>customer name</td>";
                                                 echo "<td></td>";
                                                 echo "<td>{$customer_info1['cust_name']}</td>";
                                                 echo "</tr>";
                                                 echo "<tr>";
                                                 echo "<td>order_date</td>";
                                                 echo "<td></td>";
                                                 echo "<td>{$order_info1['order_date']}</td>";
                                                 echo "</tr>";
                                                 echo "<tr>";
                                                 echo "<td></td>";
                                                 echo "<td></td>";
                                                 echo "<td><button type='button' class='btn btn-default waves-effect m-r-20' data-toggle='modal' data-target='#defaultModal".$count."'>More information</button></td>";
                                                 echo "</tr>";
                                                 echo "</table>";
                                                 echo " <div class='modal fade' id='defaultModal".$count."' tabindex='-1' role='dialog'>
                                                 <div class='modal-dialog' role='document'>
                                                 <div class='modal-content'>
                                                 <div class='modal-header'>
                                                 <h4 class='modal-title' id='defaultModalLabel'>More information </h4>
                                                 </div>
                                                 <div class='modal-body'>";
                                                 echo"<table class='table responsive'>
                                                 <tr>
                                                 <td>Country</td>
                                                 <td></td>
                                                 <td>Jodran</td>
                                                 </tr>
                                                 <tr>
                                                 <td>City</td>
                                                 <td></td>
                                                 <td> {$address_info1['city']} </td>
                                                 </tr>
                                                 <tr>
                                                 <td>Town</td>
                                                 <td></td>
                                                 <td> {$address_info1['town']} </td>
                                                 </tr>";
                                                 echo "<tr>";
                                                 echo "<td>Notes</td>";
                                                 echo "<td></td>";
                                                 echo "<td>{$order_info1['Notes']}</td>";
                                                 echo"</tr>";

                                                 echo "<tr>
                                                 <th>Products</th>
                                                 <hr>
                                                 <th></th>
                                                 <th>Quantity</th>
                                                 </tr>";

                                                 foreach ($temp_array_after as $key => $value) {
                                                        $query4="SELECT * FROM products WHERE product_id={$value}";
                                                        $result4=mysqli_query($connect,$query4);
                                                        $pro_info=mysqli_fetch_assoc($result4);
                                                        echo "<tr>";
                                                        echo "<td >{$pro_info['product_name']}</td>";
                                                        echo "<td></td>";
                                                        echo "<td>$quantity[$value]</td>";
                                                        echo"</tr>";
                                                 }
                                                 echo "</table>
                                                 </div>
                                                 <div class='modal-footer'>
                                                 <button type='button' class='btn btn-link waves-effect' data-dismiss='modal'>CLOSE</button>
                                                 </div>
                                                 </div>
                                                 </div>
                                                 </div>";
                                                 $count++;
                                                 echo "</div>";
                                                 echo "</div>";
                                                 echo "</div>";
                                          }                                          
                                   }
                                   ?>
                            </div>
                     </div>
              </div>
       </div>
</section>

