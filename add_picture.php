<?php
session_start();
include "public/function.php";
$tpmc=$_POST["name"];
$pic=$_POST["upload"];
$author=$_SESSION["username"];
$description=$_POST["description"]; 
$datetime=date("Y-m-d H:i:s");
$INS="Insert Into picture (pic,tpmc,author,description,uploadtime) Values ('$pic','$tpmc','$author','$description','uploadtime')";
$info=Sqlquery($INS);
if($info)
{
	echo "<script> alert('Publish Picture success!');</script>";
	echo "<script> window.location.href='$_SERVER[HTTP_REFERER]';</script>";
}
else
{
	echo "<script> alert('Publish Picture fail!');</script>";
	echo "<script> history.go(-1);</script>";
}
?>
