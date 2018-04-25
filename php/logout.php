<?php
	session_start();
	session_destroy();
	unset($_SESSION["RegState"]);
	unset($_SESSION["Message"]);
	header("location: ../index.php");
?>