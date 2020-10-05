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
class crud_vendor extends Connections
{     
	private $query;
	private $result;
	public function display_info_vendor()
	{
		$conn=parent::connection();
		$this->query = "SELECT * FROM vendors WHERE vendor_id={$_SESSION['idvend']}";
		$this->result= mysqli_query($conn, $this->query);
		return $vendor=mysqli_fetch_assoc($this->result);
	}
	public function login_vendor($username,$password)
	{
		$conn=parent::connection();
		$this->query="SELECT * FROM vendors WHERE vendor_email='$username' AND vendor_password='$password' AND activation='1'";
		$this->result= mysqli_query($conn, $this->query);
		return $vendor=mysqli_fetch_assoc($this->result);
	}
	public function number_of_row($username,$password)
	{
		$conn=parent::connection();
		
		$this->query="SELECT * FROM vendors WHERE vendor_email='$username' AND vendor_password='$password' AND activation='1'";
		$this->result= mysqli_query($conn, $this->query);
		return $vendor=mysqli_num_rows($this->result);
	}
	public function categories_id(){
		$conn=parent::connection();
		$x=$this->display_info_vendor();
		$this->query="SELECT * FROM categories WHERE cat_id={$x['cat_id']}";
		$this->result=mysqli_query($conn,$this->query);
		return $vendor_cat=mysqli_fetch_assoc($this->result);
	} 
	public function Edit_info_vendor($img)
	{
		$conn=parent::connection();
		$names=$_POST['NameSurname'];
		$email=$_POST['Email'];
		$phone=$_POST['Phone'];
		$this->query=" UPDATE vendors SET vendor_name = '$names' , vendor_email ='$email' , vendor_phone='$phone', vendor_img='$img' WHERE vendor_id={$_SESSION['idvend']} ";
		$this->result= mysqli_query($conn, $this->query);
	}
	public function change_password_vendor($connpass)
	{  $conn=parent::connection();
		$this->query=" UPDATE vendors SET vendor_password = '$connpass' WHERE vendor_id={$_SESSION['idvend']}";
		$this->result= mysqli_query($conn, $this->query);
	}
	public function number_of_row_forget_password($email)
	{   $conn=parent::connection();
		$this->query="SELECT * FROM vendors WHERE vendor_email='$email' AND activation='1'";
		$this->result=mysqli_query($conn, $this->query);
		return $r1=mysqli_num_rows($this->result);
	}
	public function update_forget_password($email,$pass)
	{   $conn=parent::connection();
		$this->query="UPDATE vendors SET vendor_password = '$pass' WHERE vendor_email='$email'";
		$this->result=mysqli_query($conn, $this->query);
	}

}

class crud_product extends Connections
{     
	private $query;
	private $result;

	public function display_info_cat($id)
	{   $conn=parent::connection();
		$this->query="SELECT * FROM categories WHERE cat_id = $id";
		$this->result=mysqli_query($conn,$this->query);
		return $cat_info1=mysqli_fetch_assoc($this->result);
	}
	public function add_product($id)
	{   $conn=parent::connection();
		$product_name=mysqli_real_escape_string($conn,$_POST['PorductName']);
		$product_desc=mysqli_real_escape_string($conn,$_POST['Description']);
		$product_price=$_POST['Price'];
		$product_quantity=$_POST['quantity'];
		$product_date=$_POST['date'];
		$product_discount=$_POST['Discount'];
		$sub_category=$_POST['forSUB-Cat'];
		$this->query='SELECT * FROM sub_cat WHERE sub_cat_name = "'.$sub_category.'" AND cat_id='.$id;
		$this->result=mysqli_query($conn,$this->query);
		$sub_cat_info1=mysqli_fetch_assoc($this->result);
		$this->query="INSERT INTO products (product_name, product_desc,product_price,quantity,product_date,discount,rating , rating_count , activation ,vendor_id,cat_id,sub_cat_id) VALUE ('$product_name','$product_desc','$product_price','$product_quantity','$product_date' ,'$product_discount','0','0','1','{$_SESSION['idvend']}','$id','{$sub_cat_info1['sub_cat_id']}' )";
		$this->result=mysqli_query($conn,$this->query);
	}
	public function Del_img($id){
		$conn=parent::connection();
		$this->query="DELETE FROM product_images where product_id=".$id;
		$this->result=mysqli_query($conn,$this->query);
	}
	public function add_images($images)
	{   $conn=parent::connection();
		$this->query="SELECT Max(product_id) AS maxid FROM products";
		$this->result=mysqli_query($conn,$this->query);
		$x=mysqli_fetch_array($this->result);
		$y=$x['maxid'];
		$this->query="INSERT INTO product_images (product_img, product_id)  VALUE ('$images' ,$y)";
		$this->result=mysqli_query($conn,$this->query);
	}
	public function add_image( $id , $imgname){
		$conn=parent::connection();
		$this->query="INSERT INTO product_images (product_img, product_id)  VALUE ('$imgname' ,$id)";
		$this->result=mysqli_query($conn,$this->query);
	}
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

	public function get_info_product($id){
		$conn=parent::connection();
		$this->query="SELECT * FROM products WHERE product_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $edit_info1=mysqli_fetch_assoc($this->result);
	}

	public function edit_product($id)
	{$conn=parent::connection();
		$product_name=mysqli_real_escape_string($conn,$_POST['PorductName']);
		$product_desc=mysqli_real_escape_string($conn,$_POST['Description']);
		$product_price=$_POST['Price'];
		$product_quantity=$_POST['quantity'];
		$product_date=$_POST['date'];
		$product_discount=$_POST['Discount'];
		$sub_category=$_POST['forSUB-Cat'];
		$this->query=" UPDATE products SET  product_name ='$product_name' , product_desc='$product_desc',product_price='$product_price' ,quantity='$product_quantity' , product_date='$product_date',discount='$product_discount', sub_cat_id=$sub_category  WHERE product_id=".$id;

		$this->result= mysqli_query($conn, $this->query);
	}
	public function select_tag_sub_cat($id)
	{
		$conn=parent::connection();
		$this->query="SELECT * FROM sub_cat WHERE sub_cat_id=".$id;
		$this->result=mysqli_query($conn,$this->query);
		return $sub=mysqli_fetch_assoc($this->result);
	}
}
class crud_order extends Connections
{   

    private $query;
	private $result;
		
	public function get_info_vendor($id){
		$conn=parent::connection();
		$this->query="SELECT * FROM vendors WHERE vendor_id=".$id;
		$this->result=mysqli_query($conn,$this->query);
		return $ven=mysqli_fetch_assoc($this->result);
	}
	public function get_info_costmer($id)
	{
		$conn=parent::connection();
		$this->query="SELECT * FROM customers WHERE cust_id=".$id;
		$this->result=mysqli_query($conn,$this->query);
		return $cust=mysqli_fetch_assoc($this->result);
	}
	public function get_info_order_address($id)
	{
		$conn=parent::connection();
		$this->query="SELECT * FROM order_addresses WHERE address_id=".$id;
		$this->result=mysqli_query($conn,$this->query);
		return $add=mysqli_fetch_assoc($this->result);
	}
}

?>