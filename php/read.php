<?php
	require_once("config.php");
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if(!con) {
	$_SESSION["RegState"]= -1;
	print "Connection Failed:" .mysqli_connect_error();
	exit();
	}
	$fd = fopen("bin/matrix11.log", "r") or die("Unable to open matrix11.log!");
	while (!feof($fd)) {
		$line = fgets($fd);
		if($line != "") {
			//echo $line."i<br>";
			$Array = preg_split('/[\s]+/', $line);
			//echo "$Array[0], $Array[1], $Array[2], $Array[3]<br>";
			$Datetime = date("Y-m-d h:i:s");
			//$query = "DELETE FROM Lab3_Logs;";
			$query = "Insert into Lab3_Logs (Timestamp, Size, ElapsedTime, MFLOPS, Permutation)"
			."values('$Datetime', '$Array[1]', '$Array[2]', '$Array[3]', '$Array[0]');";
			 
			$result = mysqli_query($con, $query);
			if(!$result) {
				$_SESSION["RegState"] = -2;
				$_SESSION["Message"] = "Insert failed".mysqli_error($con);
				print "Insert query failed ".mysqli_error($con);
				exit();
				
			}
			
			
		}
	}
	$_SESSION["RegState"]= 4;
	header("location: ../index.php");
	//print "Insertions done! <br>";
	exit();	
	
	?>