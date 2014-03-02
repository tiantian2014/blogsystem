<?php      
include "public/function.php";
$user_id=$_GET['user_id'];
$sql1="select * from user where id=".$user_id;
$rs=Sqlquery($sql1);
while ($result1 = mysql_fetch_array($rs))
{
if($result1['level'] == 1)
{
	echo "<script>alert('Administrator can not be deleted');history.go(-1)</script>";
	exit();
}
else
{
$sql="delete from user where id=".$user_id;
    $result=Sqlquery($sql);
	if($result)
	{
		$sql1 = "delete from friend where friendname = '".$result1['regname']."'";
		$sql2 = "delete from article where author = '".$result1['regname']."'";
		$sql3 = "delete from news where author = '".$result1['regname']."'";
		$sql4 = "delete from picture where author = '".$result1['regname']."'";
		$result5 = Sqlquery($sql1);
		$result2 = Sqlquery($sql2);
		$result3 = Sqlquery($sql3);
		$result4 = Sqlquery($sql4);
			if($result5&&$result2&&$result3&&$result4)
				echo "<script>alert('This user has been deleted!');location='$_SERVER[HTTP_REFERER]';</script>";
			else
				echo "<script>alert('Delete fail');history.go(-1);</script>";
	}
	
	else
	{	
		echo "<script>alert('Delete fail!');history.go(-1);</script>";
	}	
}
}
?> 



