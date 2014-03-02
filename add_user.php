<?php
session_start();
include "public/function.php";
$name=trim($_POST["username"]);
$psw=trim($_POST["psw"]);
$realname=$_POST["realname"];
$email=$_POST["email"];
$birth=$_POST["birthday"];
$gender=$_POST["gender"];
$psweb=$_POST["psweb"];
$intro=$_POST["intro"];
$facebook=$_POST["facebook"];
$filename=$_FILES["file"]["name"];
$INS="INSERT INTO user(regname,regpwd,regbirthday,regemail,regico,regsex,regintroduce,regrealname,logo,level,facebook) VALUES('$name','$psw','$birth','$email','$psweb','$gender','$intro','$realname','$filename','2','$facebook')";
$info=Sqlquery($INS);
if($info)
{
	echo "<script> alert('Add user success!');</script>";
	echo "<script> window.location.href='$_SERVER[HTTP_REFERER]';</script>";
}
else
{
	echo "<script> alert('Add user fail!');</script>";
	echo "<script> history.go(-1);</script>";
}
?>
