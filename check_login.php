<?php
if($_SESSION['username']=="")
{
	echo "<script>alert('Sorry, this website need register to verify your identity!');window.location.href='index.php';</script>";
	exit();
}
?>
