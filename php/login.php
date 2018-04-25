<?php
session_start();
	$_SESSION["RegState"] = 0;
	require_once("config.php");
	//Fetch web data
	$Email = $_POST["Email"];
	$Password = md5($_POST["Password"]);
	
	
	$con = mysqli_connect(SERVER,USER,PASSWORD,DATABASE);
	if (!$con){
		die("Connection Failure " .mysqli_connect_error);
	}
	$query = "SELECT * FROM Lab3_Users Where Email='$Email' AND Password='$Password';";
	
	
	
	$result = mysqli_query($con, $query);
	$row_cnt= mysqli_num_rows($result);
	
	//$num = mysqli_insert_id($con);
	//echo "$row_cnt <br>";
	
	if($row_cnt != 1) {
		$_SESSION["Message"] = "Not Found! Please try Again!";
		header("location: ../login.php");
		exit();
	} else {
	$_SESSION["Email"] = $Email;
	$_SESSION['RegState'] = 4;
	//echo "$Email <br> $Password";
	header("location: ../index.php");
	exit();
	}
	
	
	?>