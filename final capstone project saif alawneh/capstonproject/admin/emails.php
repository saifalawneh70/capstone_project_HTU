<?php
ob_start();
session_start(); 
include_once('include/oopadmin.php');
require('include/connect_db.php');
require_once 'phpmailer/PHPMailerAutoload.php';

$obj_admin=new crud_admin();
$result_number_rows=$obj_admin->number_of_row_forget_password($_SESSION['email_reciver']);
$alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
$new_password="";
if($result_number_rows==1){
	for ($i=0; $i <8 ; $i++) { 
		$x=rand(0,51);
		$new_password.=$alpha[$x].'';	
	}
	$obj_admin->update_forget_password($_SESSION['email_reciver'],$new_password);
	$_SESSION['process']="success";	

	$mail=new PHPMailer();
	$mail->isSMTP();
	$mail->SMTPAuth=true;
	$mail->SMTPSecure='ssl';
	$mail->Host='smtp.gmail.com';
	$mail->Port='465';
	$mail->isHTML();
	$mail->Username='saifaldeenalawneh2000@gmail.com';
	$mail->Password='alawneh3030';
	$mail->SetFrom='no-reply@howcode.org';
	$mail->Subject='RESET PASSWORD';
	$mail->Body='A Test Email';
	$subject = "Updated password";
	$mail->Body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title>

	</head>
	<body>";
	$mail->Body .="<div class='container'>
	<div class='row'>
	<div class='col-4'></div>
	<div style='text-align: center;'>
	<a href='https://imgbb.com/'><img src='https://i.ibb.co/7VVvTGP/logo.png' alt='logo' border='0'></a>
	<h3>Updated password</h3>
	<p>You recently requested password reset for account associated with this email.</p>
	<p>This is new password ،please log in and change your password</p>
	<p style='font-weight: bold;'>{$new_password}</p>
	<a href='https://imgbb.com/'><img src='https://i.ibb.co/7VVvTGP/logo.png' alt='logo' border='0'></a>
	</div>
	<div class='col-4'></div>
	</div>
	</div>";


	$mail->Body .= "</body></html>";
	echo $mail->Body;
	$mail->AddAddress($_SESSION['email_reciver']);
	if($mail->Send()){
		echo "Message accepted";
	}else{
		echo "Error: Message not accepted";
		print_r(error_get_last());
	}
}
else
{
	$_SESSION['fprocess']="error";	
}

unset($_SESSION['email_reciver']);
header("location:forgetpassword.php");

?>
