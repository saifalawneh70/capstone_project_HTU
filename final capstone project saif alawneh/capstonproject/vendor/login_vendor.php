<?php
ob_start();
require('include/connect_db.php');
include_once('include/oop.php');
session_start(); 
if(isset($_POST['singin']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $obj_vendor=new crud_vendor();
    $r=$obj_vendor->login_vendor($username,$password);
    $num=$obj_vendor->number_of_row($username,$password);
    if($num==1)
        {   if (!empty($_POST['rememberme'])) {
         $_SESSION['vendor_email']=$username;
         $_SESSION['vendor_password']=$password;

     }
     $_SESSION['idvend']=$r['vendor_id'];
     header('location:index.php');
 }
 else
 {
    $error="User not found";
}
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="../admin/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../admin/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../admin/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../admin/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../admin/css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Singin<b>Vendor</b></a>
            <small>Welcome to singin page </small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg"></div>
                    <?php
                    if (isset($error)) {
                       echo "<div class='alert alert-danger' role='alert'>
                       the user not found</div>";
                   }
                   ?>
                   <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="username" placeholder="Username" 
                          value="<?php
                                     if(isset($_SESSION['vendor_email']) && isset($_SESSION['vendor_password']))
                                     echo $_SESSION['vendor_email'];
                                    ?>" 
                        required autofocus>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" placeholder="Password"
                          value="<?php
                                     if(isset($_SESSION['vendor_email']) && isset($_SESSION['vendor_password']))
                                     echo $_SESSION['vendor_password'];
                                    ?>" 
                         required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Remember Me</label>
                    </div>
                    <div class="col-xs-4">
                        <input type="submit" name="singin" class="btn btn-block bg-pink waves-effect"  value="SIGN IN">
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6 align-right">
                        <a href="forgettpasswordvendor.php">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="../admin/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../admin/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../admin/plugins/node-waves/waves.js"></script>

<!-- Validation Plugin Js -->
<script src="../admin/plugins/jquery-validation/jquery.validate.js"></script>

<!-- Custom Js -->
<script src="../admin/js/admin.js"></script>
<script src="../admin/js/pages/examples/sign-in.js"></script>
</body>

</html>