<?php
	session_start();
	require_once("config.php");
	$con = mysqli_connect(SERVER,USER,PASSWORD,DATABASE);
	if(!$con){
		$_SESSION["RegState"] = -1;
		$_SESSION["Message"] = "Connection failure: ".mysqli_connect_error();
		exit();
	}
	
	$query = "Select LoopOrder, Size, ElapsedTime From PLogs;";
	$result = mysqli_query($con, $query);
	
	if($result->num_rows >0){
		while($row = $result->fetch_assoc()){
			echo'<tr>';
			echo "<td>".$row["LoopOrder"]."</td><td>".$row["Size"]."</td><td>".$row["ElapsedTime"]."</td>";
			echo'</tr>';
		}
	} else {
		echo "";
	}
	mysqli_close($con);
?>