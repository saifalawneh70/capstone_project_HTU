<?php
session_start();
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
class bigclass extends Connections
{

	private $query;
	private $result;
	
	public function get_info_category($id)
	{
		$conn=parent::connection();
		$this->query="SELECT * FROM categories WHERE cat_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $category_info=mysqli_fetch_assoc($this->result);
	}
	public function get_info_sub_category($id)
	{
		$conn=parent::connection();
		$this->query="SELECT * FROM sub_cat WHERE  sub_cat_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $sub_category_info=mysqli_fetch_assoc($this->result);
	}

	public function get_info_vendor($id)
	{
		$conn=parent::connection();
		$this->query="SELECT * FROM vendors WHERE vendor_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $vendor_info=mysqli_fetch_assoc($this->result);
	}
	public function product_image($id)
	{
		$conn=parent::connection();
		$this->query="SELECT * FROM product_images WHERE product_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $product_info=mysqli_fetch_assoc($this->result);
	}
	public function get_product_info($id)
	{
		$conn=parent::connection();
		$this->query="SELECT * FROM products WHERE product_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $product_info=mysqli_fetch_assoc($this->result);
	}

	public function register_customer()
	{   
		$conn=parent::connection();
		$name=mysqli_real_escape_string($conn,$_POST['cutomername']);
		$email=$_POST['cutomeremail'];
		$phone=$_POST['cutomerphone'];
		$password=$_POST['cutomerpassword'];
		$this->query="INSERT INTO customers (cust_name , cust_email , cust_password ,cust_phone , activation) VALUE ('$name', '$email' , '$password' , '$phone' , '1' )";
		$this->result=mysqli_query($conn,$this->query);
	}
	public function login_function($username,$password)
	{   $conn=parent::connection();
		$this->query="SELECT * FROM customers WHERE cust_email='$username' AND cust_password='$password' AND activation='1'";
		$this->result=mysqli_query($conn, $this->query);
		return $result=mysqli_fetch_assoc($this->result);
	}
	public function number_of_row_function($username,$password)
	{   $conn=parent::connection();
		$this->query="SELECT * FROM customers WHERE cust_email='$username' AND cust_password='$password' AND activation='1'";
		$this->result=mysqli_query($conn, $this->query);
		return $r1=mysqli_num_rows($this->result);
	}
	public function insert_into_address_order()
	{
		$conn=parent::connection();
		$cit=$_POST['cities'];
		$twons=mysqli_real_escape_string($conn,$_POST['twons']);
		$this->query="INSERT INTO order_addresses (city , town) VALUE ('$cit','$twons')";
		$this->result=mysqli_query($conn, $this->query);
	}
	public function insert_into_order()
	{
		$conn=parent::connection();
		$notes=mysqli_real_escape_string($conn,$_POST['notes']);
		$this->query="SELECT Max(address_id) AS maxid FROM order_addresses";
		$this->result=mysqli_query($conn,$this->query);
		$x=mysqli_fetch_assoc($this->result);
		$y=$x['maxid'];
		$customer_ids=$_SESSION['customer_id'];
		$total_price=$_SESSION['totalorder'];
		$date=date('Y-m-d');
		$this->query="INSERT INTO orders (cust_id , address_id , order_date , total ,Notes ,Situation) VALUE ('$customer_ids', $y , '$date' ,'$total_price','$notes', '1')";
		echo $this->query;
		$this->result=mysqli_query($conn, $this->query);
	}
	
	public function insert_into_order_products()
	{
		$conn=parent::connection();

		$this->query="SELECT Max(order_id) AS maxid FROM orders";
		$this->result=mysqli_query($conn,$this->query);
		$x=mysqli_fetch_assoc($this->result);
		$order_ids=$x['maxid'];
        //$quantity = array_count_values($_SESSION['cart']);
		foreach ($_SESSION['cart'] as $key => $value) {
			$pro_info=$this->get_product_info($value);
			$discount_price=$pro_info['discount']/100;
			$price=$pro_info['product_price']-($discount_price*$pro_info['product_price']);
			$this->query="INSERT INTO order_products (order_id , product_id , product_price) VALUE ('$order_ids',{$pro_info['product_id']} ,$price )";
			echo $this->query;
			$this->result=mysqli_query($conn, $this->query);	
		}

	}

	public function update_quantity_products()
	{
		$conn=parent::connection();
		$quantity = array_count_values($_SESSION['cart']);
		$copy_array= array();
		foreach ($_SESSION['cart'] as $key => $value)
		{
			$copy_array[]=$value;
		}
		$copy_array_after=array_unique($copy_array);	
		foreach ($copy_array_after as $key => $value) {
			$pro_info=$this->get_product_info($value);
			$x=$pro_info['quantity']-$quantity[$value];
			$this->query="UPDATE products SET quantity=$x WHERE product_id=$value";
			$this->result=mysqli_query($conn, $this->query);   
		}    
	}

	public function get_info_order()
	{
		$conn=parent::connection();
		$this->query="SELECT Max(order_id) AS maxid FROM orders";
		$this->result=mysqli_query($conn,$this->query);
		$x=mysqli_fetch_array($this->result);
		$order_ids=$x['maxid'];
		$this->query="SELECT * FROM orders WHERE order_id=$order_ids";
		$this->result=mysqli_query($conn,$this->query);
		return $order_info1=mysqli_fetch_assoc($this->result);
	}

	public function get_info_address_order($id)
	{
		$conn=parent::connection();
		$this->query="SELECT * FROM order_addresses WHERE address_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $address_order_info1=mysqli_fetch_assoc($this->result);
	}
	public function get_info_customer($id)
	{
		$conn=parent::connection();
		$this->query="SELECT * FROM customers WHERE cust_id=$id";
		$this->result=mysqli_query($conn,$this->query);
		return $customer_info1=mysqli_fetch_assoc($this->result);
	}
    public function number_of_row_forget_password_customer($email)
	{   $conn=parent::connection();
		$this->query="SELECT * FROM customers WHERE cust_email='$email' AND activation='1'";
		$this->result=mysqli_query($conn, $this->query);
		return $r1=mysqli_num_rows($this->result);
	}
	public function forget_password($email)
	{   $conn=parent::connection();
		$this->query="SELECT * FROM customers WHERE cust_email='$email' AND activation='1'";
		$this->result=mysqli_query($conn,$this->query);
		return $r=mysqli_fetch_assoc($this->result);
	}
    public function update_forget_password($email,$pass)
	{   $conn=parent::connection();
		$this->query="UPDATE customers SET cust_password = '$pass' WHERE cust_email='$email'";
		$this->result=mysqli_query($conn, $this->query);
	}
	public function update_customer_information($id,$name,$email,$phone,$password)
	{   $conn=parent::connection();
		$this->query="UPDATE customers SET cust_name = '$name' ,cust_email='$email' , cust_phone='$phone' ,cust_password='$password' WHERE cust_id=$id";
		$this->result=mysqli_query($conn, $this->query);
	}
}



?>