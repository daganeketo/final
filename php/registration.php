<?php

if(isset($_POST["g-recaptcha-response"]) && ($_POST["g-recaptcha-response"])){
	$secretkey = "6LedN0wUAAAAABxDuFDKXb2GcIB5tHzK9sBgupBw";
	$ip = $_SERVER["REMOTE_ADDR"];
	$captcha = $_POST["g-recaptcha-response"];
	
	$resp =file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");
	
	$array = json_decode($resp, TRUE);
	if($array["success"]){
	
	session_start();
	$_SESSION["RegState"] = 0;
	require_once("config.php");
	$Email = $_POST["Email"];
	$First = $_POST["FirstName"];
	$Last = $_POST["LastName"];
	$Password1 = $_POST["Password1"];
	$Password2 = $_POST["Password2"];
	
	if(strcmp($Password1,$Password2) == 0){
		$Password = md5($Password1);

	$con = mysqli_connect(SERVER,USER,PASSWORD,DATABASE);
	if (!$con){
		die("Connection Failure " .mysqli_connect_error);
	}
	//create a query
	//$Acode = rand();
	$Rdatetime = date("Y-m-d h:i:s");
	//print"Database Connected!! <br>";
	$query = "INSERT into Lab3_Users (FirstName, LastName, Email, Password, Rdatetime) values ('$First','$Last','$Email','$Password','$Rdatetime');";
	$result = mysqli_query($con, $query);
	if(!$result) {
		$_SESSION["Message"] = "Insert Failed!".mysqli_connect_error();
		header("location:../index.php");
		exit();
	}
	
	$_SESSION["RegState"] = 1;
	$_SESSION["Message"]= "Please Log-in with your email and password!";
	header("location: ../index.php");
	exit();
	
	} else {
	
		//print"Passwords did not match";
		
		$_SESSION["RegState"] = -1;
		$_SESSION["Message"]= "Passwords did not match! Please try again";
		header("location: ../index.php");
		exit();
	}
	} else {
		$_SESSION['Message'] = "Wrong Captcha try again";
		header("location: ../index.php");
		exit();
	} 
	} else {
		session_start();
		$_SESSION['RegState'] = 0;
		$_SESSION['Message'] = "Wrong Captcha. Try Again!";
		header("location: ../index.php");
		exit();
	}
?>