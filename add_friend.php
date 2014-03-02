<?php
session_start();
include "public/function.php";
$name=$_POST["name"];
$sex=$_POST["sex"];
$birth=$_POST["birth"];
$city=$_POST["city"]; 
$address=$_POST["address"];;
$postcode=$_POST["postcode"];
$email=$_POST["email"];
$tel=$_POST["tel"];
$username=$_POST["username"];
$facebook=$_POST["facebook"];
$INS="Insert Into friend (name,sex,birth,city,address,postcode,email,tel,username,facebook) Values ('$name','$sex','$birth','$city','$address','$postcode','$email','$tel','$username','$facebook')";
$info=Sqlquery($INS);
if($info)
{
	echo "<script> alert('Add friend success!');</script>";
	echo "<script> window.location.href='$_SERVER[HTTP_REFERER]';</script>";
}
else
{
	echo "<script> alert('Add friend fail!');</script>";
	echo "<script> history.go(-1);</script>";
}
?>
