<?php
session_start();
include "public/function.php";
$user=$_SESSION["username"];
$title=$_POST["title"];
$file=$_POST["file"];
$date=date("Y-m-d");
$INS="Insert Into article (content,author,now,title) Values ('$file','$user','$date','$title')";
$info=Sqlquery($INS);
if($info)
{
	echo "<script> alert('Publish article success!');</script>";
	echo "<script> window.location.href='$_SERVER[HTTP_REFERER]';</script>";
}
else
{
	echo "<script> alert('Publish article fail!');</script>";
	echo "<script> history.go(-1);</script>";
}
?>
