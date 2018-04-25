<?php

	session_start();
	$_SESSION["RegState"] = 0;
	require_once("config.php");
	$Email = $_POST["Email"];
	
	$con = mysqli_connect(SERVER,USER,PASSWORD,DATABASE);
	if (!$con){
		die("Connection Failure " .mysqli_connect_error);
	}
	$Acode = rand();
	$query = "Update Lab3_Users Set Acode='$Acode' Where Email='$Email';";
	$result = mysqli_query($con, $query);
	
	$query1 = "SELECT * FROM Lab3_Users WHERE Email='$Email';";
	$result1 = mysqli_query($con, $query1);
	$row_cnt= mysqli_num_rows($result1);
	
	if($row_cnt != 1){
		$_SESSION["RegState"] = -2;
		$_SESSION["Message"] = "No such email registered!".mysqli_connect_error();
		header("location:../index.php");
		exit();
	} else{
	
	//Prepare email to authenticate
	$msg = "Please click the following link to reset your email: ".
	"http://cis-linux2.temple.edu/~tuf95300/lab3/php/authenticate.php?Email=$Email&Acode=$Acode";
	
	//$to = $Email;
	//$Subject = "Reset Password";
	//$headers = "From: Krishna Kafley" . "\r\n" .
		//"CC:";
		
	//mail($to,$Subject,$msg,$headers);
	
	
	/*$query1 = "Update Users set Status = 1 where Email='$Email';";
	$result1 = mysqli_query($con, $query1);
	if(!$result1){
		$_SESSION["Message"] = "User status update failure: ".mysqli_error($con);
	} else $_SESSION["Message"] = "Please CLICK the link in your email to Reset Password!";
	*/
	$_SESSION['$msg'] = $msg;
	$_SESSION['RegState'] = 1;
	//$_SESSION["Message"] = "Please CLICK the link in your email to Reset Password!";
	$_SESSION['Email'] = $Email;
	header("location: mailer.php");
	exit();
	}
?>