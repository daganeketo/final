<?php
session_start();
require_once("config.php");
$Email = $_SESSION['$Email'];
$msg = $_SESSION['$msg'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

// Build thePHPMailer object:
$mail= new PHPMailer(true);
try { 
$mail->SMTPDebug = 2;// Wants to see all errors
$mail->IsSMTP();
$mail->Host="smtp.gmail.com";
$mail->SMTPAuth=true;
$mail->Username="cis105223053238@gmail.com";
$mail->Password = 'g+N3NmtkZWe]m8"M';
$mail->SMTPSecure = "ssl";
$mail->Port=465;
$mail->SMTPKeepAlive = true;
$mail->Mailer = "smtp";

$mail->setFrom("tuf95300@temple.edu", "Krishna Kafley");
$mail->addReplyTo("tuf95300@temple.edu","Krishna Kafley");
//$msg = "This is your message body Krishna Kafley";
$mail->addAddress($_SESSION["Email"]);
$mail->Subject = "Reset Password";
$mail->Body=$msg;
$mail->send();
print "Email sent ... <br>";
$_SESSION["RegState"] = 3;
$_SESSION["Message"] = "Please follow the link in your email to reset your password!";
header("location:../index.php");
exit();
} catch (phpmailerException $e) {
$_SESSION["Message"] = "Mailer error: ".$e->errorMessage();
$_SESSION["RegState"] = -4;
print "Mail send failed: ".$e->errorMessage;
}
header("location:../index.php");
exit();
?>