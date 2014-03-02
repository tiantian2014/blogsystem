<?php      
include "public/function.php";
$news_id=$_GET['file_id'];
$sql="delete from news where id=".$news_id;
$result=Sqlquery($sql);
if($result)
{
	echo "<script>alert('News have already been deleted!');location='$_SERVER[HTTP_REFERER]';</script>";

}
else
{	
	echo "<script>alert('artical delete fail!');history.go(-1);</script>";
}	
?> 



