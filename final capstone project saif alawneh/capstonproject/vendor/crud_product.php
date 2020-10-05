<?php 
ob_start();
session_start(); 
include_once('include/headervendor.php');
include('include/oop.php');
require('include/connect_db.php');
$obj_vendor= new crud_vendor();
$vendor_cat=$obj_vendor->display_info_vendor();
$obj_cat= new crud_product();

$cat_info=$obj_cat->display_info_cat($vendor_cat['cat_id']);

if (isset($_POST['submit1'])) {
    $obj_cat->add_product($cat_info['cat_id']);
	foreach ($_FILES['product_images']['name'] as $key => $value) {
		$tmp_name=$_FILES['product_images']['tmp_name'][$key];
		$single_image=time().$_FILES['product_images']['name'][$key];
		$path='C:/xampp/htdocs/capstonproject/images/products/';
		move_uploaded_file($tmp_name, $path.$single_image);
		$obj_cat->add_images($single_image);
	}
	header("location:crud_product.php");
}
if (isset($_GET['actid'])) {
	$obj_cat->delete_product($_GET['actid']);
	header('location:crud_product.php');
}
if (isset($_GET['editid'])) {
	$edit_info=$obj_cat->get_info_product($_GET['editid']);
}
if (isset($_POST['submit2'])) {
	$obj_cat->edit_product($_GET['editid']);
	if ($_FILES['product_images']['name'][0]!='') {
		$obj_cat->Del_img($_GET['editid']);
		foreach ($_FILES['product_images']['name'] as $key => $value) {
			$tmp_name=$_FILES['product_images']['tmp_name'][$key];
			$single_image=time().$_FILES['product_images']['name'][$key];
			$path='C:/xampp/htdocs/capstonproject/images/products/';
			move_uploaded_file($tmp_name, $path.$single_image);
			$obj_cat->add_image($_GET['editid'],$single_image);
		}	
	}
header('location:crud_product.php');
}
if (isset($_POST['submit3'])) {
header('location:crud_product.php');	
}
?>
<section class="content">
	<div class="container-fluid">
		<div class="col-xs-12 col-sm-12">
			<div class="card">
				<div class="header">
					<h2>
						<?php
						 if ($cat_info['activation']==0){
						 	echo "THE Form IS DISACTIVE , CATEGORY IS DISACTIVE BY ADMIN";
						 }
						 else
						 {
                        if (isset($_GET['editid'])) {
                        	echo "EDIT PRODUCT";
                        }
                        else
                        	echo "ADD PRODUCTS";
						}
						?>
						
					</h2>
				</div>
				<div class="body">
					<form class="form-horizontal " method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="PorductName" class="col-sm-2 control-label">Porduct Name</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input id="PorductName" name="PorductName" type="text" class="form-control"  placeholder="PorductName"
                                     value="<?php
                                     if (isset($_GET['editid']))
                                     {echo"{$edit_info['product_name']}";}  
                                     ?>" 
									 required>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="Vendorpassword" class="col-sm-2 control-label">Category</label>
							<div class="col-sm-6">
								<div class="">
									<input type="text" class="form-control" id="Category" name="Category" placeholder="Category" disabled="disabled" value="<?php
									echo $cat_info['cat_name'];
									?>
									">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">SUB-Category</label>
							<div class="row clearfix">
								<div class="col-sm-6">
									<select class="form-control show-tick" name="forSUB-Cat" required>
										<?php if (isset($_GET['editid'])) {
											$query="SELECT * FROM sub_cat WHERE sub_cat_id=".$edit_info['sub_cat_id'];
											$result=mysqli_query($connect,$query);
											$SUB=mysqli_fetch_assoc($result);
											echo "<option value='{$edit_info['sub_cat_id']}'>{$SUB['sub_cat_name']}</option>";
										} ?>
										<option value="">-- select SUB-CATEGORY --</option>
										<?php
										$query="SELECT * FROM sub_cat WHERE cat_id={$cat_info['cat_id']} AND activation='1'";
										$result=mysqli_query($connect,$query);
										while($sub_cat_info=mysqli_fetch_assoc($result)){
											echo "<option>{$sub_cat_info['sub_cat_name']}</option>";
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="Description" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-10">
								<div class="form-line">
									<textarea rows="4" name="Description" class="form-control no-resize"placeholder="Please write product Description"  
									required><?php
                                     if (isset($_GET['editid']))
                                     {
                                     	echo"{$edit_info['product_desc']}";
                                     }  
                                     ?></textarea>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="Price" class="col-sm-2 control-label">Product Price</label>
							<div class="col-sm-10">
								<div class="form-line" id="bs_datepicker_container">
									<input type="text" class="form-control" id="Price" name="Price" placeholder="Price" 
                                     value="<?php if (isset($_GET['editid'])){
                                     	echo"{$edit_info['product_price']}";}?>"
									required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="quantity" class="col-sm-2 control-label">Quantity</label>
							<div class="col-sm-10">
								<div class="form-line" id="bs_datepicker_container">
									<input type="text" class="form-control" id="quantity" name="quantity" placeholder="quantity"
                                    value="<?php if (isset($_GET['editid']))
                                     {echo"{$edit_info['quantity']}";}?>"
									 required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="Date" class="col-sm-2 control-label">Date</label>
							<div class="col-sm-10">
								<div class="form-line" id="bs_datepicker_container">
									<input type="date" name="date" class="form-control" placeholder="Please choose a date..."
									value="<?php if (isset($_GET['editid'])){
                                     	echo $edit_info['product_date'];}?>" 
                                     	required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="Discount" class="col-sm-2 control-label">Discount</label>
							<div class="col-sm-10">
								<div class="form-line" id="bs_datepicker_container">
									<input type="text" class="form-control" id="Discount" name="Discount" placeholder="Discount"
                                    value="<?php if (isset($_GET['editid']))
                                    {echo"{$edit_info['discount']}";}?>"
									required>
								</div>
							</div>
						</div>


						<div class="form-group ">
							<label for="image" class="col-sm-2 control-label">image</label>
							<div class="col-sm-10">
								<div class="fallback">
									<input type="file" name="product_images[]" multiple="multiple"
                                    <?php
                                     if (!isset($_GET['editid'])) {
                                        echo "required";
                                     }
                                    ?>
									/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<?php
                        if (isset($_GET['editid'])) 
                        {
                        	echo "<input class='btn btn-primary waves-effect' type='submit' name='submit2' value='EDIT Porduct'>";
                        	echo "&nbsp;&nbsp;&nbsp;<input class='btn btn-danger waves-effect' type='submit' name='submit3' value='Cancel EDIT'>";
                        }
                        else
                        	{   
                             if ($cat_info['activation']==0){
                             echo "<input class='btn btn-primary waves-effect' type='submit' name='submit1' value='Add Porduct' disabled='disabled'>";
                                }
								else{
                        		echo "<input class='btn btn-primary waves-effect' type='submit' name='submit1' value='Add Porduct'>";
                        	}
                        	}
						?>
							</div>
						</div>
					</form>                              
				</div>
			</div>
		</div>
	</section>
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
										<th>EDIT</th>

									</tr>
								</thead>
								<tbody>
									<?php
									$query="SELECT * FROM  products WHERE vendor_id={$_SESSION['idvend']}";
									$result=mysqli_query($connect,$query);
									$count=0;
									$count1=1;
									while ($info_product=mysqli_fetch_assoc($result)) {
										$query1="SELECT * FROM sub_cat WHERE sub_cat_id={$info_product['sub_cat_id']}";
										$result1=mysqli_query($connect,$query1);
										$info_sub_cat=mysqli_fetch_assoc($result1);
										$query2="SELECT * FROM product_images WHERE product_id={$info_product['product_id']}";
										$result2=mysqli_query($connect,$query2);
										echo "<tr>";
										echo "<td>";
										echo "{$info_product['product_name']}";
										echo "</td>";
										echo "<td>";
										echo "{$cat_info['cat_name']}";
										if($cat_info['activation']==1)
											{  echo "<br>";
										echo "<small class='font-bold text-success'>";
										echo "(ACTIVE)";
										echo "</small>";
									}
									else
									{
										echo "<br>";
										echo "<small class='font-bold text-danger'>";
										echo "(DISACTIVE)";
										echo "</small>";	
									}
									echo "</td>";
									echo "<td>";
									echo "{$info_sub_cat['sub_cat_name']}";
									if($info_sub_cat['activation']==1)
										{  echo "<br>";
									echo "<small class='font-bold text-success'>";
									echo "(ACTIVE)";
									echo "</small>";
								}
								else
								{
									echo "<br>";
									echo "<small class='font-bold text-danger'>";
									echo "(DISACTIVE)";
									echo "</small>";	
								}
								echo "</td>";

								echo "<td>";
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
								echo "{$vendor_cat['vendor_name']}";
								echo "</td>";
								echo "<td>";
								if ($cat_info['activation']==1) {
									if ($info_sub_cat['activation']==1) {
										if ($info_product['activation']==1) {
											echo "<a href='crud_product.php?actid={$info_product['product_id']}' class='btn btn-danger'>DISACTIVE</a>"; 
										}  
										else
										{
											echo "<a href='crud_product.php?actid={$info_product['product_id']}' class='btn btn-danger'>ACTIVE</a>";
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
								echo "<td>";
								if ($cat_info['activation']==1) {
									if ($info_sub_cat['activation']) {            
										if ($info_product['activation']==1)
										{
											echo "<a href='crud_product.php?editid={$info_product['product_id']}' class='btn btn-warning'>Edit</a>";
										}
										else
											{echo "<a class='btn btn-warning' disabled='disabled'>Edit</a>";
									}

								}
								else
								{
									echo "<a class='btn btn-warning' disabled='disabled'>Edit</a>";
								}
							}
							else
							{
								echo "<a class='btn btn-warning' disabled='disabled'>Edit</a>"; 
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
							$count1++;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</section>

