<?php        
include 'public/function.php';
$friend_id=$_GET['friend_id'];
$sql="delete from friend where id=".$friend_id;
$result=Sqlquery($sql);
if($result)
{
	echo "<script>alert('Your friend have already been deleted!');location='$_SERVER[HTTP_REFERER]';</script>";
}
else
{	
	echo "<script>alert('Delete Fail!');history.go(-1);</script>";
}	
?> 
