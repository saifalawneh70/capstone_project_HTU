<?php 
ob_start();
session_start(); 
$pre = $_SESSION['privilege'];
if (!in_array("product", $pre)) {
header("location:index.php");
}
include_once('include/header.php');
include_once('include/oopadmin.php');
require('include/connect_db.php');
$obj_pro= new admin_product();
if(isset($_GET['actid']))
{
 $obj_pro->delete_product($_GET['actid']);
}
?>
<section class="content">
		<div class="container-fluid">
			<div class="col-xs-12 col-sm-12">
				<div class="card">
					<div class="header">
						<h2>
							ALL PRODUCTS
						</h2>
					</div>
					<div class="body">

						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
								<thead >
									<tr>
										<th>Product Name</th>
										<th>category</th>
										<th>SUB-category</th>
										<th>Images</th>
										<th>Description</th>
										<th>Product price</th>
										<th>Quantity</th>
										<th>Product date</th>
										<th>Discount</th>
										<th>Rating</th>
										<th>Rating count</th>
										<th>situation</th>
										<th>Vendor name</th>
										<th>ACTIVATION</th>

									</tr>
								</thead>
								<tbody>
									<?php
									$count=0;
									$query="SELECT * FROM  products";
									$result=mysqli_query($connect,$query);
									while ($info_product=mysqli_fetch_assoc($result)) {
										$info_sub_cat=$obj_pro->get_sub_cat_info($info_product['sub_cat_id']);
										$cat_info=$obj_pro->get_cat_info($info_product['cat_id']);
										$vender_info=$obj_pro->get_vendor_info($info_product['vendor_id']);
										echo "<tr>";
										echo "<td>";
										echo "{$info_product['product_name']}";
										echo "</td>";
										echo "<td>";
										echo "{$cat_info['cat_name']}";
										if($cat_info['activation']==1)
											{  echo "<br>";
										echo "<small>";
										echo "(ACTIVE)";
										echo "</small>";
									}
									else
									{
										echo "<br>";
										echo "<small>";
										echo "(DISACTIVE)";
										echo "</small>";	
									}
									echo "</td>";
									echo "<td>";
									echo "{$info_sub_cat['sub_cat_name']}";
									if($info_sub_cat['activation']==1)
										{  echo "<br>";
									echo "<small>";
									echo "(ACTIVE)";
									echo "</small>";
								}
								else
								{
									echo "<br>";
									echo "<small>";
									echo "(DISACTIVE)";
									echo "</small>";	
								}
								echo "</td>";

								echo "<td>";
								$query2="SELECT * FROM product_images WHERE product_id={$info_product['product_id']}";
								$result2=mysqli_query($connect,$query2);
								while ($images_product=mysqli_fetch_assoc($result2)) {
                                    echo "<a href='../images/products/{$images_product['product_img']}'>";
								    echo "<img src='../images/products/{$images_product['product_img']}' width=100 class='img-circle'>";
								    echo "</a>";
									echo "<br>";
								}
								echo "</td>";
								echo "<td>";
								echo "<button type='button' class='btn btn-default waves-effect m-r-20' data-toggle='modal' data-target='#defaultModal".$count."'>Click Here</button>";
								echo "</td>";
								echo "<td>";
								echo "{$info_product['product_price']}";
								echo "</td>";
								echo "<td>";
								echo "{$info_product['quantity']}";
								echo "</td>";
								echo "<td>";
								echo "{$info_product['product_date']}";
								echo "</td>";
								echo "<td>";
								echo "{$info_product['discount']}";
								echo "</td>";
								echo "<td>";
								echo "{$info_product['rating']}";
								echo "</td>";
								echo "<td>";
								echo "{$info_product['rating_count']}";
								echo "</td>";
								
								if ($cat_info['activation']==1) {
									if ($info_sub_cat['activation']==1) {
										if ($info_product['activation']==1) {
											echo "<td class='font-bold text-success'>";
									        echo "ACTIVE"; 
									        echo "</td>";
										}  
										else
										{
											echo "<td class='font-bold text-danger'>";
									        echo "DISACTIVE"; 
									        echo "</td>";
										}

									}
									else
									{
									    echo "<td class='font-bold text-danger'>";
									    echo "DISACTIVE"; 
									    echo "</td>";
									}
								}
								else
								{   
									echo "<td class='font-bold text-danger'>";
									echo "DISACTIVE"; 
									echo "</td>";
								}
								echo "<td>";
								echo "{$vender_info['vendor_name']}";
								echo "</td>";
								echo "<td>";
								if ($cat_info['activation']==1) {
									if ($info_sub_cat['activation']==1) {
										if ($info_product['activation']==1) {
											echo "<a href='admin_product.php?actid={$info_product['product_id']}' class='btn btn-danger'>DISACTIVE</a>"; 
										}  
										else
										{
											echo "<a href='admin_product.php?actid={$info_product['product_id']}' class='btn btn-danger'>ACTIVE</a>";
										}
									}
									else
									{
										echo "<a class='btn btn-danger' disabled='disabled'>DISACTIVE</a>"; 
									}
								}
								else
								{
									echo "<a disabled='disabled' class='btn btn-danger'>DISACTIVE</a>"; 
								}
								echo "</td>";
							echo "</tr>";
						    //model_desc
							echo " <div class='modal fade' id='defaultModal".$count."' tabindex='-1' role='dialog'>
                                <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                <div class='modal-header'>
                                <h4 class='modal-title' id='defaultModalLabel'>Description </h4>
                                </div>
                                <div class='modal-body'>";
                            echo "{$info_product['product_desc']}";
                            echo "</div>
                                  <div class='modal-footer'>
                                  <button type='button' class='btn btn-link waves-effect' data-dismiss='modal'>CLOSE</button>
                                  </div>
                                  </div>
                                  </div>
                                  </div>";
							$count++;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</section>