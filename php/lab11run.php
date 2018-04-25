<?php
	header('Access-Control-Allow_Origin: *');
	session_start();
	$Size = $_GET["Size"];
	echo "<pre>";
	echo exec("cd bin; make SIZE=".$Size." 2>&1;./Lab11 2>&1", $output);
	var_dump($output);
	echo "</pre>";
?>
