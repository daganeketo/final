<?php
header('Access-Control-Allow-Origin: *');
session_start();
echo "<pre>";exec("cd bin; cat mat1-ijk.log;", $output2);
var_dump($output2);
echo "</pre>";
echo "<pre>";
exec("cd bin; cat mat1-ikj.log;", $output3);
var_dump($output3);
echo "</pre>";
echo "<pre>";
exec("cd bin; cat mat1-jik.log;", $output4);
var_dump($output4);
echo "</pre>";
echo "<pre>";
exec("cd bin; cat mat1-jki.log;", $output5);
var_dump($output5);
echo "</pre>";
echo "<pre>";
exec("cd bin; cat mat1-kij.log;", $output6);
var_dump($output6);
echo "</pre>";
exec("cd bin; cat mat1-kji.log;", $output7);
echo "<pre>";
var_dump($output7);
echo "</pre>";
?>