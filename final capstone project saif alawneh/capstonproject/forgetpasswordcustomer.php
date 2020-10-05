<?php
include_once('include/header.php');
include_once('include/ooppublic.php');
require ('include/connect_db.php');
$obj1= new bigclass(); //using in this page and in footer file
if(isset($_POST['submit1']))
{   
	$_SESSION['email_custmor1']=$_POST['email'];
	header('location:custemails.php');
}
if(isset($_POST['submit2']))
{   
	header('location:login_customer.php');
}
?>
<div style="height: 50px;"></div>
<div class="container">
	<div class="row">
		<div class="col-3"></div>
		<div class="col-6">
			<div class="register-form">
				<h3 class="billing-title text-center">Forget Password</h3>
				<p class="text-center mt-40 mb-30">Enter your email address that you used to register. We'll send you an email with your a new password.</p>
				<form method="post">
                    <?php
                    if (isset($_SESSION['processcust'])) {
                       echo "<div class='alert alert-success' role='alert'>
                       success,Please Check your inbox</div>";
                       unset($_SESSION['processcust']);
                   }
                   if (isset($_SESSION['fprocesscust']))
                   {
                       echo "<div class='alert alert-danger' role='alert'>
                       Wrong,Please Try Again,your email incorrect</div>";
                       unset($_SESSION['fprocesscust']);
                   }
                   ?>
					<input name="email" type="email" placeholder="Email address*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Email address*'" required class="common-input mt-20">
					<button name="submit1" class="view-btn color-2 mt-20 w-100"><span>Reset Password</span></button>
					<a href="login_customer.php" name="submit2" class="view-btn color-2 mt-20 w-100"><span>Login page</span></a>
				</form>

				
			</div>
		</div>
		<div class="col-3"></div>

	</div>
</div>
<?php
include_once('include/footer.php');
?>