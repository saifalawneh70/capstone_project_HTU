<?php 
ob_start();
session_start();
$pre = $_SESSION['privilege'];
if (!in_array("customer", $pre)) {
header("location:index.php");
} 
include_once('include/header.php');
include_once('include/oopadmin.php');
require('include/connect_db.php');
$obj_customer=new crud_customer();
if(isset($_POST['submit1']))
{
    $obj_customer->insert_customer();
	header('location:crud_Customer.php');
}
if (isset($_GET['iddele'])) {
	$obj_customer->activation_customer($_GET['iddele']);
	header('location:crud_customer.php');
}
if (isset($_GET['ide'])) {
   $info_edit=$obj_customer->get_info_customer($_GET['ide']);
}
if (isset($_POST['submit2'])) {
$obj_customer->update_info_customer($_GET['ide']);
header('location:crud_customer.php');
}
if (isset($_POST['submit3'])) {
header('location:crud_customer.php');
}
?>


<section class="content">
	<div class="container-fluid">
		<div class="col-xs-12 col-sm-12">
			<div class="card">
				<div class="header">
					<h2>
						<?php
                         if (isset($_GET['ide'])) {
                         	echo "EDIT CUSTOMER";
                         }
                         else
                         {
                         	echo "ADD CUSTOMER";
                         }

						?>
					</h2>
				</div>
				<div class="body">
					<form class="form-horizontal" method="post">
						<div class="form-group">
							<label for="NameSurname" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input type="text" class="form-control" id="NameSurname" name="NameSurname" placeholder="Name Surname" 
                                     value="<?php if (isset($_GET['ide'])) {
                                     echo"{$info_edit['cust_name']}";}
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
                                    value="<?php if (isset($_GET['ide'])) {
                                     echo"{$info_edit['cust_email']}";}
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
                                    value="<?php if (isset($_GET['ide'])) {
                                     echo"{$info_edit['cust_password']}";}
                                     ?>" 
									 required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="Phone" class="col-sm-2 control-label">Phone</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input type="tel" class="form-control" id="Phone" name="Phone" placeholder="Phone"
                                     value="<?php if (isset($_GET['ide'])) {
                                     echo"{$info_edit['cust_phone']}";}
                                     ?>" 
									 required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<?php
                         if (isset($_GET['ide'])) {
                         	echo " <input class='btn btn-primary waves-effect' type='submit' name='submit2' value='EDIT Customer'>";
                         	echo " <input class='btn btn-danger waves-effect' type='submit' name='submit3' value='Cancel EDIT'>";;
                         }
                         else
                         {
                         	echo " <input class='btn btn-primary waves-effect' type='submit' name='submit1' value='Add Customer'> ";
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
									ALL CUSTOMER
								</h2>
							</div>
							<div class="body">

								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
										<thead >
											<tr >
												<th class="align-center">Customer Name</th>
												<th class="align-center">Customer email</th>
												<th class="align-center">Customer phone</th>
												<th class="align-center">situation</th>
												<th class="align-center">ACTIVATION</th>
												<th class="align-center">EDIT</th>
												
											</tr>
										</thead>
										<tbody>
											<?php
											$query="SELECT * FROM customers";
											$result=mysqli_query($connect,$query);
											while($customer_info=mysqli_fetch_assoc($result))
											{
												echo "<tr >";
												echo "<td>";
												echo $customer_info['cust_name'];
												echo "</td>";
												echo "<td>";
												echo $customer_info['cust_email'];
												echo "</td>";
												echo "<td>";
												echo $customer_info['cust_phone'];
												echo "</td>";
												
												if ($customer_info['activation']==1) {
													echo "<td class='font-bold text-success'>";
													echo "activate";
												    echo "</td>";
												}
												else
												{
													echo "<td class='font-bold text-danger'>";
													echo "disactive";
												    echo "</td>";	
												}
												
												echo "<td>";
												if ($customer_info['activation']==1) {
												echo "<a href='crud_customer.php?iddele={$customer_info['cust_id']}' class='btn btn-danger'>DISACTIVE</a>";	
												}
												else
												{
												echo "<a href='crud_customer.php?iddele={$customer_info['cust_id']}' class='btn btn-danger'>ACTIVE</a>";	
												}
												echo "</td>";
											    echo "<td>";
												if ($customer_info['activation']==1) {
												echo "<a href='crud_customer.php?ide={$customer_info['cust_id']}' class='btn btn-warning'>Eidt</a>";	
												}
												else
												{
												echo "<a class='btn btn-warning' disabled='disabled'>Eidt</a>";	
												}
												echo "</td>";
												echo "</tr>";
											}
											?>
										</tbody>
									</table>
								</div>

							</div>
						</div>
					</div>
				</section>
