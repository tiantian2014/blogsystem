<?php
session_start();
include "public/function.php";
if($_SESSION["username"]==false)
{
	$user = "Anonymous";
}
else
{
	$user = $_SESSION["username"];
}

	$content=$_POST["txt_content"];
	$datetime=date("Y-m-d H:i:s");
	$htxt_fileid=$_POST["htxt_fileid"];
	$INS="Insert Into comment (fileid,username,content,datetime) Values ('$htxt_fileid','$user','$content','$datetime')";
	$info=Sqlquery($INS);
	if($info)
	{
		echo "<script> alert('Publish comment success!');</script>";
		echo "<script> window.location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
	else
	{
		echo "<script> alert('Publish comment fail!');</script>";
		echo "<script> history.go(-1);</script>";
	}

?>
