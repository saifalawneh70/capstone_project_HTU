<?php
ob_start();
session_start(); 
$pre = $_SESSION['privilege'];
if (!in_array("admin", $pre)) {
header("location:index.php");
}
include_once('include/header.php');
include_once('include/oopadmin.php');
require('include/connect_db.php');
$obj_admin= new crud_admin();
if (isset($_POST['submit1'])) {
	$image=$_FILES['file']['name'];
	$tmp_name=$_FILES['file']['tmp_name'];
	$path='adimg/';
	$image=time().$image;
	move_uploaded_file($tmp_name, $path.$image);
	$obj_admin->insert_admin_info($image);
	$obj_admin->insert_admin_privilege();
	header("location:crud_admin.php");
}
if (isset($_GET['id'])) {
	$obj_admin->activation_admin($_GET['id']);
	header("location:crud_admin.php");
}
if (isset($_GET['id1'])) {
	$admin_information=$obj_admin->view_info_admin1($_GET['id1']);
}
if (isset($_POST['submit2'])) {
  if (!empty($_POST['privileges'])) {
  	  $obj_admin->delete_privilges($_GET['id1']);
  	  $obj_admin->insert_privilege_after_edit($_GET['id1']);
  }
  $image=$_FILES['file']['name'];
  if ($image!='') {
  	$path='adimg/';
  	$tmp_name=$_FILES['file']['tmp_name'];
  	$image=time().$image;
  	move_uploaded_file($tmp_name, $path.$image);
  }
  else{
  	$image=$admin_information['admin_img'];
  }
  $obj_admin->update_admin_info($_GET['id1'],$image); 
  header("location:crud_admin.php");
}
if (isset($_POST['submit3'])) {
header("location:crud_admin.php");
}
?>
<section class="content">
	<div class="container-fluid">
		<div class="col-xs-12 col-sm-12">
			<div class="card">
				<div class="header">
					<?php
					if (isset($_GET['id1'])) {
					 	echo "<h2>Edit Admin</h2>";
					 }else{
					 	echo "<h2>ADD Admin</h2>";
					 } 
					 ?>
				</div>
				<div class="body">
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="NameSurname" class="col-sm-2 control-label">Admin Name</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input type="text" class="form-control" id="adminName" name="adminname" placeholder="Admin Name" required value="<?php if(isset($_GET['id1'])){echo $admin_information['admin_name'];} ?>" 
									>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="NameSurname" class="col-sm-2 control-label">Admin Email</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input type="Email" class="form-control" id="adminemail" name="adminemail" placeholder="Admin Email" required value="<?php if(isset($_GET['id1'])){echo $admin_information['admin_email'];} ?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="NameSurname" class="col-sm-2 control-label">Admin Password</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input type="password" class="form-control" id="adminpassword" name="adminpassword" placeholder="Admin Password"
									pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
									title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
									required value="<?php if(isset($_GET['id1'])){echo $admin_information['admin_password'];} ?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="NameSurname" class="col-sm-2 control-label">Admin Phone</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input type="text" class="form-control" id="adminphone" name="adminphone" placeholder="Admin Phone" pattern="[0-9]{10}" required value="<?php if(isset($_GET['id1'])){echo $admin_information['admin_phone'];} ?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="NameSurname" class="col-sm-2 control-label">Admin privileges</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input type="checkbox" value="admin" id="basic_checkbox_6" name="privileges[]"/>
									<label for="basic_checkbox_6">Adminstation</label>
									<br>
									<input type="checkbox" value="cat" id="basic_checkbox_1" name="privileges[]"/>
									<label for="basic_checkbox_1">Category & Sub_cat</label>
									<br>
									<input type="checkbox" value="vendor" id="basic_checkbox_2" name="privileges[]"/>
									<label for="basic_checkbox_2">Vendors</label>
									<br>
									<input type="checkbox" value="product" id="basic_checkbox_3" name="privileges[]"/>
									<label for="basic_checkbox_3">Product</label>
									<br>
									<input type="checkbox" value="customer" id="basic_checkbox_4" name="privileges[]"/>
									<label for="basic_checkbox_4">Customers</label>
									<br>
									<input type="checkbox" value="orders" id="basic_checkbox_5" name="privileges[]"/>
									<label for="basic_checkbox_5">Orders</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="image" class="col-sm-2 control-label">Admin Image</label>
							<div class='col-sm-10'>
								<div class="fallback">
									<?php 
									if (isset($_GET['id1'])) {
										echo "<input name='file' type='file'/>";
									}else{
										echo "<input name='file' type='file' required/>";
									}
									?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<?php
								if(isset($_GET['id1'])){
									echo "<input class='btn btn-primary waves-effect' type='submit' name='submit2' value='Edit Admin'>";
									echo "&nbsp;&nbsp;&nbsp;<input class='btn btn-danger waves-effect' type='submit' name='submit3' value='Cancel Edit'>";
								}
								else
								{
									echo "<input class='btn btn-primary waves-effect' type='submit' name='submit1' value='Add Admin'>";   	
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
						All Admins
					</h2>
				</div>
				<div class="body">   
					<div class="clearfix row">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
								<thead >
									<tr>
										<th class="align-center">Admin Name</th>
										<th class="align-center">Admin email</th>
										<th class="align-center">Admin phone</th>
										<th class="align-center">Admin Image</th>
										<th class="align-center">Privilege</th>
										<th class="align-center">situation</th>
										<th class="align-center">ACTIVATION</th>
										<th class="align-center">EDIT</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query="SELECT * FROM admins";
									$result=mysqli_query($connect,$query);
									while($admin_info=mysqli_fetch_assoc($result)){
										echo "<tr>";
										echo "<td>{$admin_info['admin_name']}</td>";
										echo "<td>{$admin_info['admin_email']}</td>";
										echo "<td>{$admin_info['admin_phone']}</td>";
										echo "<td><a href='adimg/{$admin_info['admin_img']}']}'><img src='adimg/{$admin_info['admin_img']}' width=100px; class='img-circle'></a></td>";
										$query1="SELECT * FROM admin_privileges WHERE admin_id={$admin_info['admin_id']}";
										$result1=mysqli_query($connect,$query1);
										echo "<td>";
										echo "<ul>";
										while ($info_privilage=mysqli_fetch_assoc($result1)) {
											echo "<li>";
											echo $info_privilage['privilges'];
											echo "</li>";
										}
										echo "</ul>";
										echo"</td>";
										if ($admin_info['activation']==1) {
											echo "<td class='font-bold text-success'>ACTIVE</td>";	
										}
										else
										{
											echo "<td class='font-bold text-danger'>DISACTIVE</td>";	
										}
										echo "<td>";
										if ($admin_info['activation']==1) {
											echo "<a href='crud_admin.php?id={$admin_info['admin_id']}' class='btn btn-danger'>DISACTIVE</a>";	
										}
										else
										{
											echo "<a href='crud_admin.php?id={$admin_info['admin_id']}' class='btn btn-danger'>ACTIVE</a>";	
										}
										echo"</td>";
										echo "<td>";
										if ($admin_info['activation']==1) {
											echo "<a href='crud_admin.php?id1={$admin_info['admin_id']}' class='btn btn-warning'>Eidt</a>";	
										}
										else
										{
											echo "<a class='btn btn-warning' disabled='disabled'>Eidt</a>";	
										}
										echo"</td>";
										echo "<tr>";

									}

									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>