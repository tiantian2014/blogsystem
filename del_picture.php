<?php        
include 'public/function.php';
$picture_id=$_GET['picture_id'];
$sql="delete from picture where id=".$picture_id;
$result=Sqlquery($sql);
if($result)

{
	echo "<script>alert('Your Picture have already been deleted!');location='$_SERVER[HTTP_REFERER]';</script>";
}
else
{	
	echo "<script>alert('Delete Fail!');history.go(-1);</script>";
}	
?> 
