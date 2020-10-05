<?php 
ob_start();
session_start(); 
$pre = $_SESSION['privilege'];
if (!in_array("cat", $pre)) {
header("location:index.php");
}
include_once('include/header.php');
include_once('include/oopadmin.php');
require('include/connect_db.php');
$obj_cat=new crud_categories();
//start cat
	//start insert catogery
if(isset($_POST['submit1']))
{
	$catname='"'.$_POST['CategoryName'].'"';
	$image=$_FILES['file']['name'];
	$tmp_name=$_FILES['file']['tmp_name'];
	$path='C:/xampp/htdocs/capstonproject/images/categories/';
	$image=time().$image;
	move_uploaded_file($tmp_name, $path.$image);
	$obj_cat->insert_category($catname,$image);
	header("location:crud_cat.php");
}
	//end insert catogery
	// start delete catogery
if(isset($_GET['id']))
{
	$obj_cat->disactive_category($_GET['id']);
	header("location:crud_cat.php");
}
	// end delete catogery
if(isset($_GET['idactive']))
{
	$obj_cat->active_category($_GET['idactive']);
	header("location:crud_cat.php");
}
	// start edit catogery
if(isset($_GET['id1'])){
	$categ=$obj_cat->get_info_category($_GET['id1']);
}
if(isset($_POST['submit2']))
{   
	$catname='"'.$_POST['CategoryName'].'"';
	if ($_FILES['file']['name']=='') {
		$image=$categ['cat_img'];
	}else{
		$image=$_FILES['file']['name'];
		$tmp_name=$_FILES['file']['tmp_name'];
		$path='C:/xampp/htdocs/capstonproject/images/categories/';
		$image=time().$image;
		move_uploaded_file($tmp_name, $path.$image);
	}
	$obj_cat->update_info_category($catname,$image,$_GET['id1']);
	header('location:crud_cat.php');
}
	//end edit category
if(isset($_POST['submit3']))
{  
	header('location:crud_cat.php');
}
//end cat

$obj_sub_cat= new crud_sub_categories();

//satart sub cat
//insert_SUB_cat
if (isset($_POST['subsubmit1'])) {
	$cat=$_POST['forSUB-Cat'];
	$obj_sub_cat->insert_sub_category($cat);
	header('Location:crud_cat.php');
}

if(isset($_GET['sub_cat_activation']))
{
	$sub_cat_to_activation=$obj_sub_cat->activation_sub_category1($_GET['sub_cat_activation']);
	if($sub_cat_to_activation['activation']==1){
		$obj_sub_cat->disactive_sub_category($_GET['sub_cat_activation']);
	}
	else
	{
		$obj_sub_cat->active_sub_category($_GET['sub_cat_activation']);	
	}
	header("location:crud_cat.php");
}



if(isset($_GET['edit_sub_cat']))
{
	$sub_cat_data_from_database=$obj_sub_cat->get_info_sub_cat($_GET['edit_sub_cat']);
}
if (isset($_POST['subsubmit2'])) {
	$obj_sub_cat->update_info_sub_cat($_GET['edit_sub_cat']);
	header("location:crud_cat.php");	

}
//end sub cat

?>
<section class="content">
	<div class="container-fluid">
		<div class="col-xs-12 col-sm-12">
			<div class="card">
				<div class="header">
					<h2>
						<?php
						if(isset($_GET['id1']))
						{
							echo "EDIT Category";			
						}
						else
						{
							echo "ADD Category";
						}
						?>
					</h2>
				</div>
				<div class="body">
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="NameSurname" class="col-sm-2 control-label">Category Name</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input type="text" class="form-control" id="CategoryName" name="CategoryName" placeholder="Category Name"
									value="<?php 
									if(isset($_GET['id1']))
									{echo $categ['cat_name'];}
									?>"
									required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<?php
							if(isset($_GET['id1']))
							{  
								echo "<label for='NameSurname' class='col-sm-2 control-label'>Previous Image</label>";
								echo "<div class='col-sm-10'>";
								echo "<a href='adimg/{$categ['cat_img']}'>
								<img src='../images/categories/{$categ['cat_img']}' width='200px' height='200px'>
								</a>";
								echo "</div>";
							}
							?>
						</div>
						<div class="form-group">
							<label for="image" class="col-sm-2 control-label">Category Image</label>
							<div class='col-sm-10'>
								<div class="fallback">
									<input name="file" type="file" multiple />
								</div>
							</div>
							
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<?php
								if(isset($_GET['id1'])){
									echo "<input class='btn btn-primary waves-effect' type='submit' name='submit2' value='Edit Category'>";
									echo "&nbsp;&nbsp;&nbsp;<input class='btn btn-danger waves-effect' type='submit' name='submit3' value='Cancel Edit'>";
								}
								else
								{
									echo "<input class='btn btn-primary waves-effect' type='submit' name='submit1' value='Add Category'>";   	
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
						<?php
						if(isset($_GET['id1']))
						{
							echo "EDIT SUB-Category";			
						}
						else
						{
							echo "ADD SUB-Category";
						}
						?>
					</h2>
				</div>
				<div class="body">
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="Category" class="col-sm-2 control-label">Category</label>
							<div class="row clearfix">
								<div class="col-sm-6">
									<select class="form-control show-tick" name="forSUB-Cat" required>
										<?php
										if(isset($_GET['edit_sub_cat'])){
											$Que="SELECT * FROM sub_cat WHERE sub_cat_id = {$_GET['edit_sub_cat']}";
											$name1=mysqli_query($connect,$Que);
											$name_cat=mysqli_fetch_assoc($name1);
											$Que="SELECT * FROm Categories WHERE cat_id={$name_cat['cat_id']}";
											$name1=mysqli_query($connect,$Que);
											$name_cat=mysqli_fetch_assoc($name1);
											echo "<option>".$name_cat['cat_name']."</option>";
										}
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
							<label for="NameSurname" class="col-sm-2 control-label">SUB-Category Name</label>
							<div class="col-sm-10">
								<div class="form-line">
									<input type="text" class="form-control" id="SUB-CategoryName" name="SUB-CategoryName" placeholder="SUB-Category Name"
									value="<?php 
									if(isset($_GET['edit_sub_cat']))
									{echo $sub_cat_data_from_database['sub_cat_name'];}
									?>"
									required>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<?php
								if(isset($_GET['edit_sub_cat'])){
									echo "<input class='btn btn-primary waves-effect' type='submit' name='subsubmit2' value='Edit SUB Category'>";
									echo "&nbsp;&nbsp;&nbsp;<input class='btn btn-danger waves-effect' type='submit' name='submit3' value='Cancel Eidt'>";
								}
								else
								{
									echo "<input class='btn btn-primary waves-effect' type='submit' name='subsubmit1' value='Add SUB Category'>";   	
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
						ALL CATEGORIES
					</h2>
				</div>
				<div class="body">

					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead >
								<tr >
									<th class="align-center">Category Name</th>
									<th class="align-center">Category Image</th>
									<th class="align-center">Situation</th>
									<th class="align-center">ACTIVATION</th>
									<th class="align-center">EDIT</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
								$query_read = "SELECT * FROM categories ";
								$result= mysqli_query($connect, $query_read); 
								while ($categorie=mysqli_fetch_assoc($result)) {
									echo "<tr>";
									echo "<td>";
									echo "{$categorie['cat_name']}";
									echo "</td>";
									echo "<td class='text-center'>";
									echo "<a href='../images/categories/{$categorie['cat_img']}'>";
									echo "<img src='../images/categories/{$categorie['cat_img']}' width='100px'; height='100px'; class='img-circle'>";
									echo "</a>";
									echo "</td>";
									if ($categorie['activation']==1) {
										echo "<td class='font-bold text-success'>active</td>";
									}
									else
									{
										echo "<td class='font-bold text-danger'>disactive</td>";	
									}
									echo "<td>";
									if ($categorie['activation']==1){
										echo "<a href='crud_cat.php?id={$categorie["cat_id"]}' class='btn btn-danger'>DISACTIVE</a>";
									}
									else
									{
										echo "<a href='crud_cat.php?idactive={$categorie["cat_id"]}' class='btn btn-danger'>ACTIVE</a>";
									}
									echo "</td>";
									echo "<td>";
									if ($categorie['activation']==1){
										echo "<a href='crud_cat.php?id1={$categorie["cat_id"]}' class='btn btn-warning'>Edit</a>";

									}
									else
									{
										echo "<a  class='btn btn-warning' disabled='disabled'>Edit</a>";
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




	<section class="content">
		<div class="container-fluid">
			<div class="col-xs-12 col-sm-12">
				<div class="card">
					<div class="header">
						<h2>
							ALL SUB-CATEGORIES
						</h2>
					</div>
					<div class="body">

						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
								<thead >
									<tr >
										<th class="align-center">cat Name</th>
										<th class="align-center">SUB-cat Name</th>
										<th class="align-center">situation</th>
										<th class="align-center">ACTIVATION</th>
										<th class="align-center">EDIT</th>
										
									</tr>
								</thead>
								<tbody>
									<?php
									$sub_cat_query="SELECT * FROM sub_cat";
									$sub_cat_result=mysqli_query($connect ,$sub_cat_query);
									while ($all_sub_cat=mysqli_fetch_assoc($sub_cat_result)) {
										$query_select1="SELECT * from categories WHERE cat_id={$all_sub_cat['cat_id']}";
										$result=mysqli_query($connect,$query_select1);
										$categ1=mysqli_fetch_assoc($result);
										echo "<tr>";
										echo "<td>";
										echo "{$categ1['cat_name']}";
										echo "</td>";
										echo "<td>";
										echo "{$all_sub_cat['sub_cat_name']}";
										echo "</td>";
										if ($all_sub_cat['activation']==1 && $categ1['activation']==1 ) {
											echo "<td class='font-bold text-success'>active</td>";
										}
										else
										{
											echo "<td class='font-bold text-danger'>disactive</td>";	
										}
										echo "<td>";
										if ($categ1['activation']==1){
											if ($all_sub_cat['activation']==1){


												echo "<a href='crud_cat.php?sub_cat_activation={$all_sub_cat['sub_cat_id']}' class='btn btn-danger'>DISACTIVE</a>";	
											}
											else
											{
												echo "<a href='crud_cat.php?sub_cat_activation={$all_sub_cat['sub_cat_id']}' class='btn btn-danger'>ACTIVE</a>";
											}
										}
										else
										{
											if ($all_sub_cat['activation']==1){


												echo "<a class='btn btn-danger' disabled='disabled'>DISACTIVE</a>";	
											}
											else
											{
												echo "<a class='btn btn-danger' disabled='disabled'>ACTIVE</a>";
											}
										}
										echo "</td>";
										echo "<td>";
										if ($all_sub_cat['activation']==1 && $categ1['activation']==1){
											echo "<a href='crud_cat.php?edit_sub_cat={$all_sub_cat['sub_cat_id']}' class='btn btn-warning'>Edit</a>";

										}
										else
										{
											echo "<a  class='btn btn-warning' disabled='disabled'>Edit</a>";
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

