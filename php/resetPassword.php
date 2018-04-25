
<?php
	session_start();
	$_SESSION["RegState"]=0;
	require_once("config.php");
	$Email = $_SESSION["Email"];
	$Password1 = $_POST["Password1"];
	$Password2 = $_POST["Password2"];
	
	//print"$Email, $Password1, $Password2";
	
	if(strcmp($Password1,$Password2) == 0){
	$Password=md5($Password1);
	
	$con = mysqli_connect(SERVER,USER,PASSWORD,DATABASE);
	if (!$con){
		die("Connection Failure " .mysqli_connect_error);
	}
	
	$query = "UPDATE Lab3_Users SET Password='$Password' WHERE Email='$Email';";
	$result = mysqli_query($con, $query);
	//$row_cnt = mysqli_num_rows($result);
	if(!$result){
		$_SESSION["Message"] = "User Password Update Failure: ".mysqli_error($con);
		header("location: ../login.php");
		exit();
	} else {	$_SESSION["Message"] = "Password Successfully updated! Please Sign-in using your email and password!";
	header("location: ../login.php");
	exit;
	}
	} else {
		print "Entries did not match please try again! <br>";
		$_SESSION["RegState"] = -5;
		header("location: ../login.php");
		exit();
		
	}
	?>
	
