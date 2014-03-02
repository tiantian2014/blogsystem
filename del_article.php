<?php      
include "public/function.php";
$file_id=$_GET['file_id'];
$sql="delete from article where id=".$file_id;
$result=Sqlquery($sql);
if($result)
{
	$sql1 = "delete from comment where fileid = ".$file_id;
	$rst1 = Sqlquery($sql1);
	if($rst1)
		echo "<script>alert('Blog artical and related comments have already been deleted!');location='$_SERVER[HTTP_REFERER]';</script>";
	else
		echo "<script>alert('First Delete fail!');history.go(-1);</script>";
}
else
{	
	echo "<script>alert('artical delete fail!');history.go(-1);</script>";
}	
?> 



