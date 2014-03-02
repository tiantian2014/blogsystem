<?php       
session_start();  
include "public/function.php";
$comment_id=$_GET['comment_id'];
$sql="delete from comment where id=".$comment_id;
$result=Sqlquery($sql);
if($result)
{
	echo "<script>alert('Comment have already been deleted!');location='$_SERVER[HTTP_REFERER]';</script>";
}
else
{	
	echo "<script>alert('Delet Fail!');history.go(-1);</script>";
}	
?> 
