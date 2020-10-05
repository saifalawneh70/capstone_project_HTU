<?php 
ob_start();
session_start();
$pre = $_SESSION['privilege'];
if (!in_array("vendor", $pre)) {
header("location:index.php");
} 
include_once('include/header.php');
include_once('include/oopadmin.php');
require('include/connect_db.php');
$obj_vendor= new crud_vendor();

if(isset($_POST['submit1']))
{
	$image=$_FILES['file']['name'];
	$tmp_name=$_FILES['file']['tmp_name'];
	$path='C:/xampp/htdocs/capstonproject/vendor/imagesvendor/';
	$image=time().$image;
	move_uploaded_file($tmp_name, $path.$image);
	$obj_vendor->insert_vendor($image);
	header('location:crud_vendor.php');
}
if (isset($_GET['aid'])) {
	$obj_vendor->active_vendor($_GET['aid']);
	header("location:crud_vendor.php");
}
if (isset($_GET['Did'])) {
	$obj_vendor->disactive_vendor($_GET['Did']);
	header("location:crud_vendor.php");
}
if (isset($_GET['id1'])) {
	$vend=$obj_vendor->get_info_vendor($_GET['id1']);
}
if(isset($_POST['submit2']))
{
	if ($_FILES['file']['name']=='') {
		$image=$vend['vendor_img'];
	}else{
		$image=$_FILES['file']['name'];
		$tmp_name=$_FILES['file']['tmp_name'];
	    $path='C:/xampp/htdocs/capstonproject/vendor/imagesvendor/';
		$image=time().$image;
		move_uploaded_file($tmp_name, $path.$image);
	}
	$obj_vendor->update_info_vendor($_GET['id1'],$image);
	header('location:crud_vendor.php'); 
}
if(isset($_POST['submit3']))
{
	header('location:crud_vendor.php');
}
?>
<section class="content">
	<div class="container-fluid">
		<div class="col-xs-12 col-sm-12">
			<div class="card">
				<div class="header">
					<h2>
						<?php
						if (isset($_GET['id1'])) {
							echo "EDIT VENDOR";
						}
						else
						{
							echo "ADD VENDER";
						}

						?>
						
					</h2>
				</div>
				<div class="body">
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="NameSurname" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input type="text" class="form-control" id="NameSurname" name="NameSurname" placeholder="Name Surname"
									value="<?php 
									if(isset($_GET['id1']))
									{echo $vend['vendor_name'];}
									?>"
									required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="Email" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input type="email" class="form-control" id="Email" name="Email" placeholder="Email"
									value="<?php 
									if(isset($_GET['id1']))
									{echo $vend['vendor_email'];}
									?>"
									required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="Vendorpassword" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input type="password" class="form-control" id="Password" name="password" placeholder="Password"

									value="<?php 
									if(isset($_GET['id1']))
									{echo $vend['vendor_password'];}
									?>" 
									pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
									title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
									required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="Phone" class="col-sm-2 control-label">Phone</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input type="tel" class="form-control" id="Phone" pattern="[0-9]{10}" name="Phone"
									value="<?php 
									if(isset($_GET['id1']))
									{echo $vend['vendor_phone'];}
									?>"
									placeholder="Phone" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="Dateengage" class="col-sm-2 control-label">Date engage</label>
							<div class="col-sm-10">
								<div class="form-line" id="bs_datepicker_container">
									<input type="date" name="dateengage" class="form-control" placeholder="Please choose a date..."
									value="<?php 
									if(isset($_GET['id1']))
									{echo $vend['date_engage'];}
									?>"
									required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="Category" class="col-sm-2 control-label">Category</label>
							<div class="row clearfix">
								<div class="col-sm-6">
									<select class="form-control show-tick" name="forCat" required>
										<?php
										if(isset($_GET['id1'])){
											$Que="SELECT cat_name FROM categories WHERE cat_id =".$vend['cat_id'];
											$name1=mysqli_query($connect,$Que);
											$name_cat=mysqli_fetch_assoc($name1);
										}
										echo "<option>".$name_cat['cat_name']."</option>";
										echo "<option value=''>select category</option>";
										$Query="SELECT * FROM categories WHERE activation ='1'";
										$res=mysqli_query($connect ,$Query);
										while ($r=mysqli_fetch_assoc($res)) {
											if ($r['cat_name']!=$name_cat['cat_name']) {
												echo "<option>".$r['cat_name']."</option>";
											}
										}
										?>

									</select>
								</div>
							</div>

						</div>
						
						<div class="form-group">
							<label for="image" class="col-sm-2 control-label">image</label>
							<div class="fallback">
								<input name="file" type="file" multiple
								<?php
								if(!isset($_GET['id1']))
								{
									echo "required";
								}
								?>
								/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<?php
								if (isset($_GET['id1'])) {
									echo " <input class='btn btn-primary waves-effect' type='submit' name='submit2' value='EDIT vendor'>";
									echo " <input class='btn btn-danger waves-effect' type='submit' name='submit3' value='Cancel EDIT'>";;
								}
								else
								{
									echo " <input class='btn btn-primary waves-effect' type='submit' name='submit1' value='Add vendor'> ";
								}

								?>
							</div>
						</div>
					</form>
				</div>
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
						Active Vendors
					</h2>
				</div>
				<div class="body">

					<div class="clearfix row">
						<?php

						$query_read = "SELECT * FROM vendors WHERE activation ='1'";
						$result= mysqli_query($connect, $query_read); 
						
						while ($vendor=mysqli_fetch_assoc($result)) {
							$que="SELECT *FROM categories WHERE cat_id = {$vendor['cat_id']} ";
							$res=mysqli_query($connect, $que);
							$cat=mysqli_fetch_assoc($res);
							echo "<div class='col-xs-12 col-sm-4'>";
							echo "<div class='card profile-card'>";
							echo "<div class='profile-header'>&nbsp;</div>";
							echo "<div class='profile-body'>";
							echo "<div class='image-area'>";
							echo " <img src='../vendor/imagesvendor/{$vendor['vendor_img']}' alt='AdminBSB - Profile Image' width='130px'; />";
							echo "</div>";
							echo "<div class='content-area'>";
							echo "<h3>{$vendor['vendor_name']}</h3>";
							echo "<p>Vendor</p>";
							echo "</div>";
							echo "</div>";
							echo "<div class='profile-footer'>";
							echo "<ul>
							<li>";
							echo "<span>Email</span>";
							echo " <span>{$vendor['vendor_email']}</span>";
							echo "</li>";
							echo "<li>";
							echo " <span>Category</span>";
							echo "<span>{$cat['cat_name']}</span>";
							echo "</li>";
							echo " <li>";
							echo "<span>Phone</span>";
							echo "<span>{$vendor['vendor_phone']}</span>";
							echo " </li>";
							echo "<li>";
							echo "<span>date engage</span>";
							echo "<span>{$vendor['date_engage']}</span>";
							echo " </li>";
							echo "</ul>";
							echo " <a href='crud_vendor.php?id1={$vendor['vendor_id']}' class='btn btn-warning'>Edit</a>";
							echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
							echo "<a href='crud_vendor.php?Did={$vendor['vendor_id']}' class='btn btn-danger'>Disactive</a>";
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
	<section class="content">
		<div class="container-fluid">
			<div class="col-xs-12 col-sm-12">
				<div class="card">
					<div class="header">
						<h2>
							Disactive Vendors
						</h2>
					</div>
					<div class="body">

						<div class="clearfix row">
							<?php

							$query_read = "SELECT * FROM vendors WHERE activation ='0'";
							$result= mysqli_query($connect, $query_read); 
							while ($vendor=mysqli_fetch_assoc($result)) {
								$que="SELECT *FROM categories WHERE cat_id = {$vendor['cat_id']} ";
								$res=mysqli_query($connect, $que);
								$cat=mysqli_fetch_assoc($res);
								echo "<div class='col-xs-12 col-sm-4'>";
								echo "<div class='card profile-card'>";
								echo "<div class='profile-header'>&nbsp;</div>";
								echo "<div class='profile-body'>";
								echo "<div class='image-area'>";
								echo " <img src='../vendor/imagesvendor/{$vendor['vendor_img']}' alt='AdminBSB - Profile Image' width='130px'; />";
								echo "</div>";
								echo "<div class='content-area'>";
								echo "<h3>{$vendor['vendor_name']}</h3>";
								echo "<p>Vendor</p>";
								echo "</div>";
								echo "</div>";
								echo "<div class='profile-footer'>";
								echo "<ul>
								<li>";
								echo "<span>Email</span>";
								echo " <span>{$vendor['vendor_email']}</span>";
								echo "</li>";
								echo "<li>";
								echo " <span>Category</span>";
								echo "<span>{$cat['cat_name']}</span>";
								echo "</li>";
								echo " <li>";
								echo "<span>Phone</span>";
								echo "<span>{$vendor['vendor_phone']}</span>";
								echo " </li>";
								echo "<li>";
								echo "<span>date engage</span>";
								echo "<span>{$vendor['date_engage']}</span>";
								echo " </li>";
								echo "</ul>";
								echo " <a href='crud_vendor.php?id1={$vendor['vendor_id']}' class='btn btn-warning'>Edit</a>";
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								echo "<a href='crud_vendor.php?aid={$vendor['vendor_id']}' class='btn btn-danger'>Active</a>";
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