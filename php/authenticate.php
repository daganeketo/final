<?php
	session_start();
	$_SESSION["RegState"] = 0;
	require_once("config.php");
	//Fetch web data
	$Email = $_GET["Email"];
	$Acode = $_GET["Acode"];
	
	//print"$Email";
	
	$con = mysqli_connect(SERVER,USER,PASSWORD,DATABASE);
	if (!$con){
		die("Connection Failure " .mysqli_connect_error);
	}
	$query = "SELECT * FROM Lab3_Users Where Email='$Email' AND Acode='$Acode';";
	
	$result = mysqli_query($con, $query);
	$row_cnt= mysqli_num_rows($result);
	
	if($row_cnt != 1) {
		
		die("Record does not exit");
	} else {
		$_SESSION['RegState'] = 2;
		$_SESSION['Email'] = $Email;
		header("location: ../resetPassword.html");
		exit();
	}
	?>