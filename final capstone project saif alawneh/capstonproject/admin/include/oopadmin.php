<?php
class Connections
{
	private $root='root';
	private $host='localhost';
	private $pass='';
	private $dbname='capstone_project';
	public function connection()
	{
		$d= $this->connect=mysqli_connect($this->host,$this->root,$this->pass,$this->dbname);
		return $d; 
	}
}

class crud_admin extends Connections
{     
	private $query;
	private $result;
	
	public function insert_admin_info($img)
	{ 
		$conn=parent::connection();
		$name=mysqli_real_escape_string($conn,$_POST['adminname']);
		$email=$_POST['adminemail'];
		$password=$_POST['adminpassword'];
		$phone=$_POST['adminphone'];
		$date=date('Y-m-d');
		$this->query = "INSERT INTO admins (admin_name , admin_password , admin_email , admin_phone , date_engage , activation , admin_img) VALUE ('$name' ,'$password' ,'$email' , '$phone' ,'$date', '1', '$img')";
		$this->result= mysqli_query($conn, $this->query);
	}

	public function insert_admin_privilege()
	{   
		$conn=parent::connection();
		$privilege=$_POST['privileges'];
		$this->query="SELECT Max(admin_id) AS maxid FROM admins";
		$this->result=mysqli_query($conn,$this->query);
		$x=mysqli_fetch_array($this->result);
		$y=$x['maxid'];
		foreach ($privilege as $key => $value) {
			$this->query = "INSERT INTO admin_privileges (admin_id , privilges) VALUE ('$y','$value')";
			$this->result= mysqli_query($conn, $this->query);
		}
		
	}
	public function activation_admin($id)
	{
		$conn=parent::connection();
		$this->query = "SELECT * FROM admins WHERE admin_id=$id";
		$this->result= mysqli_query($conn, $this->query);
		$admin1=mysqli_fetch_assoc($this->result);
		if ($admin1['activation']==1) {
			$this->query=" UPDATE admins SET activation = '0' WHERE admin_id=$id";
			$this->result= mysqli_query($conn, $this->query);
		}
		else
		{
			$this->query=" UPDATE admins SET activation = '1' WHERE admin_id=$id";
			$this->result= mysqli_query($conn, $this->query);	
		}
	}
	public function view_info_admin1($id)
	{
		$conn=parent::connection();
		$this->query = "SELECT * FROM admins WHERE admin_id=$id";
		$this->result= mysqli_query($conn, $this->query);
		return $admin1=mysqli_fetch_assoc($this->result);
	}
	public function delete_privilges($id){
		$conn=parent::connection();
		$this->query="DELETE FROM admin_privileges where admin_id=$id";
		$this->result=mysqli_query($conn, $this->query);
	}

	public function insert_privilege_after_edit($id)
	{   
		$conn=parent::connection();
		$privilege=$_POST['privileges'];
		foreach ($privilege as $key => $value) {
			$this->query = "INSERT INTO admin_privileges (admin_id , privilges) VALUE ('$id','$value')";
			$this->result= mysqli_query($conn, $this->query);
		}
	}


	public function update_admin_info($id ,$img)
	{   
		$conn=parent::connection();
		$name=mysqli_real_escape_string($conn,$_POST['adminname']);
		$email=$_POST['adminemail'];
		$password=$_POST['adminpassword'];
		$phone=$_POST['adminphone'];
		$this->query=" UPDATE admins SET admin_name = '$name' , admin_email ='$email' , admin_phone='$phone', admin_password='$password' , admin_img='$img'  WHERE admin_id=$id ";
		$this->result= mysqli_query($conn, $this->query);
	}


	public function display_admin_info()
	{
		$conn=parent::connection();
		$this->query = "SELECT * FROM admins WHERE admin_id={$_SESSION['id']}";
		$this->result= mysqli_query($conn, $this->query);
		return $admin1=mysqli_fetch_assoc($this->result);
	}
	public function edit_admin_info($img)
	{ $conn=parent::connection();
		$names=$_POST['NameSurname'];
		$email=$_POST['Email'];
		$phone=$_POST['Phone'];
		$this->query=" UPDATE admins SET admin_name = '$names' , admin_email ='$email' , admin_phone='$phone', admin_img='$img' WHERE admin_id={$_SESSION['id']} ";
		$this->result= mysqli_query($conn, $this->query);
	}
	public function update_password($conpass)
	{   
		$conn=parent::connection();
		$this->query=" UPDATE admins SET admin_password = '$conpass' WHERE admin_id={$_SESSION['id']}";
		$this->result= mysqli_query($conn, $this->query);
	}
	public function login_function($username,$password)
	{   $conn=parent::connection();
		$this->query="SELECT * FROM admins WHERE admin_email='$username' AND admin_password='$password'";
		$this->result=mysqli_query($conn, $this->query);
		return $r1=mysqli_fetch_assoc($this->result);
	}
	public function number_of_row_function($username,$password)
	{   $conn=parent::connection();
		$this->query="SELECT * FROM admins WHERE admin_email='$username' AND admin_password='$password'";
		$this->result=mysqli_query($conn, $this->query);
		return $r1=mysqli_num_rows($this->result);
	}
	public function number_of_row_forget_password($email)
	{   $conn=parent::connection();
		$this->query="SELECT * FROM admins WHERE admin_email='$email' AND activation='1'";
		$this->result=mysqli_query($conn, $this->query);
		return $r1=mysqli_num_rows($this->result);
	}
	public function update_forget_password($email,$pass)
	{   $conn=parent::connection();
		$this->query="UPDATE admins SET admin_password = '$pass' WHERE admin_email='$email'";
		$this->result=mysqli_query($conn, $this->query);
	}

}

class crud_categories extends Connections
{   

	private $query;
	private $result;
	public function insert_category($name,$image)
	{
		$conn=parent::connection();
		$this->query=" INSERT INTO categories (cat_name , cat_img , activation ) VALUE ($name ,'$image' , '1')";
		$this->result= mysqli_query($conn, $this->query);
	}
	
	public function disactive_category($id)
	{
		$conn=parent::connection();
		$this->query=" UPDATE categories SET  activation = '0' WHERE cat_id=$id";
		$this->result= mysqli_query($conn, $this->query);
	}
	public function active_category($id)
	{
		$conn=parent::connection();
		$this->query=" UPDATE categories SET  activation = '1' WHERE cat_id=$id";
		$this->result= mysqli_query($conn, $this->query);
	}

	public function get_info_category($id)
	{
		$conn=parent::connection();
		$this->query="SELECT * from categories WHERE cat_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $categ1=mysqli_fetch_assoc($this->result);
	}
	public function update_info_category($catname1,$image1,$id)
	{
		$conn=parent::connection();
		$this->query=" UPDATE categories SET  cat_name = $catname1 , cat_img='$image1'  WHERE cat_id=$id";
		$this->result= mysqli_query($conn, $this->query);
	}
}

class crud_sub_categories extends Connections
{   
	private $query;
	private $result;
	public function insert_sub_category($c)
	{
		$conn=parent::connection();
		$Name='"'.$_POST['SUB-CategoryName'].'"';
		$this->query="SELECT * FROM categories WHERE cat_name='".$c."'";
		echo $this->query;
		$this->result=mysqli_query($conn,$this->query);
		$Y=mysqli_fetch_assoc($this->result);
		print_r($Y);
		$this->query="INSERT INTO sub_cat (cat_id, sub_cat_name, activation) VALUES ('{$Y['cat_id']}', $Name , '1')";
		$this->result=mysqli_query($conn,$this->query);
	}
	public function activation_sub_category1($id)
	{
		$conn=parent::connection();
		$this->query="SELECT * FROM sub_cat WHERE sub_cat_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $sub_cat_to_activation1=mysqli_fetch_assoc($this->result);
	}
	public function disactive_sub_category($id)
	{
		$conn=parent::connection();
		$this->query=" UPDATE sub_cat SET  activation = '0' WHERE sub_cat_id=$id";
		$this->result= mysqli_query($conn, $this->query);
	}
	public function active_sub_category($id)
	{
		$conn=parent::connection();
		$this->query=" UPDATE sub_cat SET  activation = '1' WHERE sub_cat_id=$id";
		$this->result= mysqli_query($conn, $this->query);
	}
	public function get_info_sub_cat($id)
	{
		$conn=parent::connection();
		$this->query="SELECT * FROM sub_cat WHERE sub_cat_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $sub_cat_data_from_database1=mysqli_fetch_assoc($this->result);
	}
	public function update_info_sub_cat($id)
	{
		$conn=parent::connection();
		$sub_cat_name='"'.$_POST['SUB-CategoryName'].'"';
		$cat=$_POST['forSUB-Cat'];
		$this->query="SELECT * FROM categories WHERE cat_name= '$cat' ";
		$this->result=mysqli_query($conn,$this->query);
		$Y=mysqli_fetch_assoc($this->result);
		$this->query=" UPDATE sub_cat SET  sub_cat_name = $sub_cat_name , cat_id='{$Y['cat_id']}' WHERE sub_cat_id=$id";
		$this->result= mysqli_query($conn, $this->query);
	}
}
class crud_vendor extends Connections
{  
	private $query;
	private $result;

	public function insert_vendor($img)
	{   
		$conn=parent::connection();
		$vender_name=$_POST['NameSurname'];
		$vendor_email=$_POST['Email'];
		$vendor_password=$_POST['password'];
		$phone=$_POST['Phone'];
		$vendor_date=$_POST['dateengage'];
		$cat=$_POST['forCat'];
		$this->query="SELECT *FROM categories WHERE cat_name = '$cat' ";
		$this->result=mysqli_query($conn ,$this->query);
		$resultcat=mysqli_fetch_assoc($this->result);
		$this->query="INSERT INTO vendors (vendor_name , vendor_email , vendor_password , vendor_phone ,date_engage , cat_id , vendor_img ,activation)  VALUE ('$vender_name','$vendor_email' , '$vendor_password','$phone','$vendor_date','{$resultcat['cat_id']}' ,'$img' , '1' ) ";
		$this->result=mysqli_query($conn, $this->query);
	}
	public function active_vendor($id)
	{   
		$conn=parent::connection();
		$this->query=" UPDATE vendors SET  activation = '1' WHERE vendor_id=$id";
		$this->result= mysqli_query($conn, $this->query);
	}
	public function disactive_vendor($id)
	{   
		$conn=parent::connection();
		$this->query=" UPDATE vendors SET  activation = '0' WHERE vendor_id=$id";
		$this->result= mysqli_query($conn, $this->query);
	}
	public function get_info_vendor($id)
	{
		$conn=parent::connection();   
		$this->query=" SELECT * FROM vendors WHERE vendor_id=$id";
		$this->result= mysqli_query($conn, $this->query);
		return $vend1=mysqli_fetch_assoc($this->result);
	}

	public function update_info_vendor($id,$img)
	{
		$conn=parent::connection();
		$vender_name=$_POST['NameSurname'];
		$vendor_email=$_POST['Email'];
		$vendor_password=$_POST['password'];
		$phone=$_POST['Phone'];
		$vendor_date=$_POST['dateengage'];
		$cat=$_POST['forCat'];
		$this->query="SELECT *FROM categories WHERE cat_name = '$cat' ";
		$this->result=mysqli_query($conn ,$this->query);
		$resultcat1=mysqli_fetch_assoc($this->result);
		$this->query=" UPDATE vendors SET vendor_name = '$vender_name' , vendor_email ='$vendor_email' , vendor_phone='$phone', vendor_password='$vendor_password' , vendor_img='$img' , date_engage='$vendor_date', cat_id='{$resultcat1['cat_id']}' WHERE vendor_id= $id ";
		$this->result= mysqli_query($conn, $this->query);
	}

}
class admin_product extends Connections
{     
	private $query;
	private $result;

	public function delete_product($id){
		$conn=parent::connection();
		$this->query="SELECT * FROM products WHERE product_id=".$id;
		$this->result=mysqli_query($conn,$this->query);
		$info_product1=mysqli_fetch_assoc($this->result);
		if ($info_product1['activation']==1) {
			$this->query="UPDATE products SET activation ='0' WHERE product_id=".$id;
			$this->result=mysqli_query($conn,$this->query); 
		}
		else
		{
			$this->query="UPDATE products SET activation ='1' WHERE product_id=".$id;
			$this->result=mysqli_query($conn,$this->query); 
		}
	}
	public function get_sub_cat_info($id)
	{   $conn=parent::connection();
		$this->query="SELECT * FROM sub_cat WHERE sub_cat_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $info_sub_cat1=mysqli_fetch_assoc($this->result);
	}
	public function get_cat_info($id)
	{   $conn=parent::connection();
		$this->query="SELECT * FROM categories WHERE cat_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $cat_info1=mysqli_fetch_assoc($this->result);
	}
	public function get_vendor_info($id)
	{   $conn=parent::connection();
		$this->query="SELECT * FROM vendors WHERE vendor_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $vender_info1=mysqli_fetch_assoc($this->result);
	}
}


class crud_customer extends Connections
{
	
	private $query;
	private $result;
	public function insert_customer()
	{
		$conn=parent::connection();
		$name=mysqli_real_escape_string($conn,$_POST['NameSurname']);
		$email=$_POST['Email'];
		$password=$_POST['password'];
		$phone=$_POST['Phone'];
		$this->query="INSERT INTO customers (cust_name , cust_email, cust_password , cust_phone,activation ) VALUE ('$name','$email','$password','$phone','1')";
		$this->result=mysqli_query($conn ,$this->query);
	}
	
	public function activation_customer($id)
	{   
		$conn=parent::connection();
		$this->query="SELECT * FROM customers WHERE cust_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		$act=mysqli_fetch_assoc($this->result);
		if ($act['activation']==1) {
			$this->query=" UPDATE customers SET activation='0' WHERE cust_id=$id";
			$this->result=mysqli_query($conn,$this->query);
		}
		else
		{
			$this->query=" UPDATE customers SET activation='1' WHERE cust_id=$id";
			$this->result=mysqli_query($conn,$this->query);	
		}

	}

	public function get_info_customer($id)
	{ 
		$conn=parent::connection();
		$this->query="SELECT * FROM customers WHERE cust_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $info_edit1=mysqli_fetch_assoc($this->result);
	}

	public function update_info_customer($id)
	{   $conn=parent::connection();
		$name=mysqli_real_escape_string($conn,$_POST['NameSurname']);
		$email=$_POST['Email'];
		$password=$_POST['password'];
		$phone=$_POST['Phone'];
		$this->query=" UPDATE customers SET  cust_name = '$name' , cust_email='$email' , cust_password='$password',cust_phone='$phone' WHERE cust_id=$id";
		$this->result=mysqli_query($conn,$this->query);
	}

}

class crud_orders extends Connections
{   
	private $query;
	private $result;

	public function get_info_order_addresses($id)
	{   
		$conn=parent::connection();
		$this->query="SELECT * FROM order_addresses WHERE address_id=$id";
        $this->result=mysqli_query($conn,$this->query);
        return $address_info=mysqli_fetch_assoc($this->result);
	}
	public function product_info($id)
	{   
		$conn=parent::connection();
		$this->query="SELECT * FROM products WHERE product_id=$id";
        $this->result=mysqli_query($conn,$this->query);
        return $pro_info1=mysqli_fetch_assoc($this->result);
	}

}

?>