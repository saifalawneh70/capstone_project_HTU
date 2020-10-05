<?php 
ob_start();
session_start(); 
$pre = $_SESSION['privilege'];
if (!in_array("orders", $pre)) {
header("location:index.php");
}
include_once('include/header.php');
include_once('include/oopadmin.php');
require('include/connect_db.php');
$obj_orders=new crud_orders();
$obj_customers=new crud_customer();
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
                                          $address_info1=$obj_orders->get_info_order_addresses($order_info1['address_id']);
                                          //end order addresses
                                          //start order product
                                          $query2="SELECT * FROM order_products WHERE order_id={$order_info1['order_id']}";
                                          $result2=mysqli_query($connect,$query2);
                                          $temp_array=array();
                                          while ($product_order_info=mysqli_fetch_assoc($result2)) {
                                                 $temp_array[]=$product_order_info['product_id'];
                                          }
                                          $quantity = array_count_values($temp_array);
                                          $temp_array_after=array_unique($temp_array);
                                          //end order product
                                          //start customer information
                                          $customer_info1=$obj_customers->get_info_customer($order_info1['cust_id']);
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
                                          <td>Jordan</td>
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
                                          </tr>
                                          <tr>
                                          <th>Products</th>
                                          <hr>
                                          <th></th>
                                          <th>Quantity</th>
                                          </tr>";
                                          foreach ($temp_array_after as $key => $value) {
                                          $pro_info=$obj_orders->product_info($value);
                                          echo "<tr>";
                                          echo "<td >{$pro_info['product_name']}</td>";
                                          echo "<td></td>";
                                          echo "<td>$quantity[$value]</td>";
                                          echo"</tr>";
                                          }
                                          echo "<tr>";
                                          echo "<td>Total</td>";
                                          echo "<td></td>";
                                          echo "<td>{$order_info1['total']}</td>";
                                          echo"</tr>";
                                          echo "<tr>";
                                          echo "<td>Notes</td>";
                                          echo "<td></td>";
                                          echo "<td>{$order_info1['Notes']}</td>";
                                          echo"</tr>";
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
                                   ?>
                            </div>
                     </div>
              </div>
       </div>
</section>

