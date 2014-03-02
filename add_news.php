<?php
session_start();
include "public/function.php";
$user = $_SESSION["username"];
$title=$_POST["title"];
$content=$_POST["content"];
$date=date("Y-m-d");
$INS="Insert Into news (content,author,pub_time,title) Values ('$content','$user','$date','$title')";
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
