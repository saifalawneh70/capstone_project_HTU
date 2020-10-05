  <?php
  ob_start();
  include_once('include/header.php');
  include_once('include/ooppublic.php');
  require ('include/connect_db.php');
  $obj_customer= new bigclass();
  $obj1= new bigclass(); //obj1 using in footer file
  ?>
  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
            <div class="col-first">
                <h1>Welcome Login Page</h1>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!-- Start My Account -->
<div class="container">
   <div class="row">
    <div class="col-md-6">
     <div class="login-form">
      <h3 class="billing-title text-center">Login</h3>
      <p class="text-center mt-80 mb-40">Welcome back! Sign in to your account </p>
      <?php
      if(isset($_POST['singin']))
      {
        $username=$_POST['email'];
        $password=$_POST['password'];
        $customer_info=$obj_customer->login_function($username,$password);
        $num=$obj_customer->number_of_row_function($username,$password);
        if($num==1)
        {
            if (!empty($_POST['rememberme']))
            {
                $_SESSION['customeremail']=$username;
                $_SESSION['customerpassword']=$password;
            }
            $_SESSION['customer_id']=$customer_info['cust_id'];
            header('location:checkout.php');
        }
        else
        {
            $error="User not found";
        }
    }

    ?>
    <?php
    if (isset($error)) {
       echo "<div class='alert alert-danger' role='alert'>
       the user not found</div>";
   }

   ?>
   <form method="post">
    <input type="text" name="email" placeholder="Email*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Username or Email*'" required class="common-input mt-20" 
    value="<?php if(isset($_SESSION['customeremail']) && isset($_SESSION['customerpassword']))echo $_SESSION['customeremail'];
    ?>">
    <input type="password" name="password" placeholder="Password*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Password*'" required class="common-input mt-20" value="<?php if(isset($_SESSION['customeremail']) && isset($_SESSION['customerpassword']))echo $_SESSION['customerpassword'];
    ?>">

    <button name="singin" class="view-btn color-2 mt-20 w-100"><span>Login</span></button>

    <div class="mt-20 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <input type="checkbox" name="rememberme" class="pixel-checkbox" id="login-1">
            <label for="login-1">Remember me</label></div>
            <a href="forgetpasswordcustomer.php">Lost your password?</a>
        </div>
    </form>
</div>
</div>
<div class="col-md-6">
 <div class="register-form">
  <h3 class="billing-title text-center">Register</h3>
  <p class="text-center mt-40 mb-30">Create your very own account </p>
  <?php
  if(isset($_POST['submit1']))
  {
    $obj_customer->register_customer();
    header("location:login_customer.php");
  }
?>

<form method="post">
   <input type="text" name="cutomername" placeholder="Full name*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Full name*'" required class="common-input mt-20">
   <input type="email" name="cutomeremail" placeholder="Email address*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Email address*'" required class="common-input mt-20">
   <input type="text" name="cutomerphone" placeholder="Phone number*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Phone number*'" required class="common-input mt-20">
   <input type="password" name="cutomerpassword" placeholder="Password*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Password*'" required class="common-input mt-20"pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
   <button name="submit1" class="view-btn color-2 mt-20 w-100" ><span>Register</span></button>
</form>
</div>
</div>
</div>
</div>
<!-- End My Account -->


<!-- Start Most Search Product Area -->
<!-- End Most Search Product Area -->
<?php
include_once('include/footer.php');
?>