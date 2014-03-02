<?php 
session_start(); 
include("public/function.php");
include "check_login.php";
$page="";
if ($page=="") {$page=1;}; 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Article Mangement</title>
<link href="CSS/text.css" type="text/css" rel="stylesheet" />
<script src="JS/function.js" type="text/javascript"></script>
<script>
function getPubPoint()
{
var taskmoney = document.getElementById('taskmoney');
}
</script>
</head>
<body>
    <div id="top">
        <div id="top1">
        </div>
    </div>      
    <div id="navi">
    <?php
	if($_SESSION['level']==1)
	{
		?>
		<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="article.php">Articles Management</a></li>
		<li><a href="picture.php">Pictures Management</a></li>
		<li><a href="friend.php">Friends Management</a></li>
		<li><a href="news.php">News Mangement</a></li>
		<li><a href="user.php" style="cursor:hand">User Management</a></li>
		</ul>
		<?php 
	}
	else
	{
		?> 
		<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="article.php">Articles Management</a></li>
		<li><a href="picture.php">Pictures Management</a></li>
		<li><a href="friend.php">Friends Management</a></li>
		<li><a href="news.php">News Mangement</a></li>
		</ul>
		<?php
	}
	?>
     </div>
     <div id="middle2">
     	<div class="welcome">
    		<h3>Welcome <?php echo $_SESSION["username"]; ?></h3>
    	</div>
		<div class="by">
        	<h3>Search</h3>
        </div>
        <div class="search">
            <form action="search.php" method="get">
            <select name="search">
            <option value="" selected="selected">Make a selection</option>
            <option value="user">User</option>	
            <option value="friend">Friend</option>
            <option value="article">Article</option>
            <option value="news">News</option>
            <option value="comment">Comment</option>
            <option value="picture">Picture</option>
            </select>
            Keywords<input type="text" name="keywords">
            <input type="image" src="images/search.png" alt="search" onclick=formsubmit()>
            </form>        
        </div>
  	 	<div class="logout">
        	<a href="<?php echo (!isset($_SESSION["username"])?'Regpro.php':'safe.php'); ?>"><?php echo (!isset($_SESSION["username"])?"Blog Register":"Log out"); ?></a>
    	</div>
	</div> 
    <div id="content">    
     <?php
	 if($_SESSION['level']==1)
	 { 
		 if($_GET)
	    {
			 $search=$_GET['search'];
			 $keywords=$_GET['keywords'];
			 if($search=="user")
			 {
				 $find=Sqlquery("select * from user where regname Like '%$keywords%' or regrealname Like '%$keywords'");
				 while($result=mysql_fetch_array($find))
				 {
					 if($keywords !== "")
					 {
					 ?>
                     <table width=700 class="table1">
                         <tr height=40>
                            <td align="right" width=73>User ID</td>
                            <td width=50><?php echo $result['id']; ?></td>
                            <td align="right" width=74>Username</td>
                            <td width=129><?php echo $result['regname']; ?></td>
                            <td align="right" width=87>Real Name</td>
                            <td width=151><?php echo $result['regrealname']; ?></td>
                            <td align="right" width=56>Gender</td>
                            <td width=44>
                            <?php 
                                if($result['regsex']==0){
                                    echo "Security";
                                }
                                if($result['regsex']==1){
                                    echo "Male";
                                }
                                if($result['regsex']==2){
                                    echo "Female";
                                }
                            ?> 
                            </td>
                        </tr>
                        <tr height=40>
                            <td align="right">Brithday</td>
                            <td colspan=2><?php echo $result['regbirthday']; ?></td>
                            <td align="right">Password</td>
                            <td colspan=4><?php echo $result['regpwd']; ?></td>
                        </tr>
                        <tr height=40>
                            <td colspan=3 align="right">Personal Website</td>
                            <td colspan=5><?php echo $result['regico']; ?></td>
                        </tr>
                        <tr height=40>
                            <td align="right">Email</td>
                            <td colspan=7><?php echo $result['regemail']; ?></td>
                        </tr>
                        <tr height=40>
                            <td align="right">Introduce</td>
                            <td colspan=7><?php echo $result['regintroduce']; ?></td>
                        </tr>
                        <tr height=40>
                            <td align="right">Facebook</td>
                            <td colspan=7><?php echo $result['facebook']; ?></td>
                        </tr>
                        </table>
                        <?php
					 }
					 else
					 {
						header('Location:searchuser.php'); 
					 }
				 }
			 }
			 
			 else if($search=="friend")
			 {
				 $find=Sqlquery("select * from friend where username like '%$keywords%' or name like '%$keywords%'");
				 while($result=mysql_fetch_array($find))
				 {
					 if($keywords !== "")
					 {
					 ?>
                     <table width=700 class="table1">
                     <tr height=40>
                        <td align="right" width=50>ID</td>
                        <td width=40><?php echo $result['id']; ?></td>
                        <td align="right" width=40>Name</td>
                        <td width=150><?php echo $result['name']; ?></td>
                        <td align="right" width=50>Gender</td>
                        <td width=40>
                            <?php 
                                if($result['sex']==0){
                                    echo "security";
                                }
                                if($result['sex']==1){
                                    echo "male";
                                }
                                if($result['sex']==2){
                                    echo "female";
                                }
                            ?>
                        </td>
                        <td align="right" width=50>Birthday</td>
                        <td width=120 ><?php echo $result['birth'];?></td>
                    </tr>
                    <tr height=40>
                        <td align="right">Address</td>
                        <td colspan=7><?php echo $result['address'];?></td>
                    </tr>
                    <tr height=40>
                        <td align="right">City</td>
                        <td width=80 colspan=2><?php echo $result['city'];?></td>
                        <td align="right">Postcode</td>
                        <td colspan=2><?php echo $result['postcode'];?></td>
                        <td align="right">Phone</td>
                        <td colspan=1><?php echo $result['tel'];?></td>
                    </tr>
                    <tr height=40>
                        <td align="right">Email</td>
                        <td colspan=7><?php echo $result['email'];?></td>
                    </tr>
                    <tr height=40>
                        <td align="right">Facebook</td>
                        <td colspan=7><?php echo $result['facebook'];?></td>
                    </tr>
                 </table>          
                     <?php
					 }
					 else
					 {
						 header('Location:searchfriend.php');
					 }
				 }
			 }
			 else if($search=="article")
			 {
				 $find=Sqlquery("select * from article where title like '%$keywords%'");
				 while($result=mysql_fetch_array($find))
				 {
					if($keywords !== "")
					{
					?>
                    <table width=700 class="table1">
                        <tr height=40>
                            <td align="right" width=100>Blog ID</td>
                            <td><?php echo $result['id']; ?></td>
                            <td align="right" width=100>Author</td>
                            <td><?php echo $result['author']; ?></td>
                            <td align="right" width=100>Time</td>
                            <td><?php echo $result['now']; ?></td>
                        </tr>
                        <tr height=40>
                            <td align="right" width=100>Article Title</td>
                            <td colspan="5"><?php echo $result['title']; ?></td>
                        </tr>
                        <tr>
                            <td align="right" widht=100 height=120>Article Content</td>
                            <td colspan="5"><?php echo $result['content']; ?></td>
                        </tr>           
                    </table>
                    <?php 
					}
					else
					{
						header('Location:searcharticle.php');	
					}
				 }
			 }
			 
			 else if($search=="comment")
			 {
				 $find=Sqlquery("select * from comment where content like '%$keywords%' or username like '%$keywords'");
				 while($result=mysql_fetch_array($find))
				 {
					if($keywords !== "")
					{
					?>
                    <table width=700 class="table1">
                        <tr height=40>
                            <td align="right" width=100>Comment Id</td>
                            <td><?php echo $result['id']; ?></td>
                            <td align="right" width=100>Comment User</td>
                            <td><?php echo $result['username']; ?></td>
                            <td align="right" width=100>Comment Time</td>
                            <td><?php echo $result['datetime']; ?></td>
                    	</tr>
                    	<tr>
                            <td align="right" width=120>Comment Content</td>
                            <td colspan="5"><?php echo $result['content']; ?></td>
                    	</tr>
                    </table>
                    <?php 
					}
					else
					{
						header('Location:searchcomments.php');	
					}
				 }
			 }
			 else if($search=="news")
			 {
				 $find=Sqlquery("select * from news where title like '%$keywords%' or author like '%$keywords'");
				 while($result=mysql_fetch_array($find))
				 {
					 if($keywords !== "")
					 {
					 ?>
                     <table width=700 class="table1">
                        <tr height=40>
                            <td align="right" width=60>ID</td>
                            <td width=40><?php echo $result['id']; ?></td>
                            <td align="right">Publish User</td>
                            <td><?php echo $result['author']; ?></td>
                            <td align="right" >Publish Time</td>
                            <td><?php echo $result['pub_time']; ?></td>
                        </tr>
                        <tr>
                            <td align="right" colspan=2>News Title</td>
                            <td colspan=4><?php echo $result['title'];?></td>
                        </tr>
                        <tr height=40>
                            <td align="right" colspan=2>News Content</td>
                            <td colspan=4><?php echo $result['content'];?></td>
                        </tr>
                     </table>                     
                     <?php
					 }
					 else
					 {
						header('Location:searchnews.php'); 
					 }
				 }
			 }
			 else if($search=="picture")
			 {
				 $find=Sqlquery("select * from picture where author like '%$keywords%' or tpmc like '%$keywords%'");
				 while($result=mysql_fetch_array($find))
				 {
					 if($keywords !== "")
					 {
					 ?>
                     <table width=700 class="table1">
                     	<tr height=40>
                    		<td align="right" width=100>Picture ID</td>
                            <td><?php echo $result['id']; ?></td>
                            <td align="right" width=100>Picture Name</td>
                            <td><?php echo $result['tpmc']; ?></td>
                            <td align="right" width=100>Author</td>
                            <td><?php echo $result['author']; ?></td>
                            <td align="right" width=100>Upload Time</td>
                            <td><?php echo $result['author']; ?></td>                   
                        </tr>
                		<tr height=40>
                            <td colspan=8 colspan=12><img src="images/<?php echo $result['pic']; ?>" width=780 height=500></td>
                        </tr>
                		<tr>
                            <td colspan=3 align="right">Picture Discription</td>
                            <td colspan=5><textarea><?php echo $result['description']; ?></textarea></td>
                		</tr>           
                     </table>                     
                     <?php
					 }
					 else
					 {
						header('Location:searchpicture.php'); 
					 }
				 }
			 }
	 	}
	 }
	 else
	 {
		 ?><script>
		 document.getElementByName("search").options[1].disabled=false;
		 </script><?php
		 if($_GET)
	 	 {    
			 $search=$_GET['search'];
			 $keywords=$_GET['keywords'];
			 $search=$_GET['search'];
			 if ($search =="user")
			 {
				 ?>
                 <script>
				 alert ("You are not administrtaor, so you can not brower user");
				 </script>              
                 <?php
			 }
			 else if($search == "friend")
			 {
				 $find=Sqlquery("select * from friend where username like '%$keywords%' or name like '%$keywords%'");
				 while($result=mysql_fetch_array($find))
				 {
					 if($keywords !== "")
					 {
					 ?>
                     <table width=700 class="table1">
                     <tr height=40>
                        <td align="right" width=50>ID</td>
                        <td width=40><?php echo $result['id']; ?></td>
                        <td align="right" width=40>Name</td>
                        <td width=150><?php echo $result['name']; ?></td>
                        <td align="right" width=50>Gender</td>
                        <td width=40>
                            <?php 
                                if($result['sex']==0){
                                    echo "security";
                                }
                                if($result['sex']==1){
                                    echo "male";
                                }
                                if($result['sex']==2){
                                    echo "female";
                                }
                            ?>
                        </td>
                        <td align="right" width=50>Birthday</td>
                        <td width=120 ><?php echo $result['birth'];?></td>
                    </tr>
                    <tr height=40>
                        <td align="right">Address</td>
                        <td colspan=7><?php echo $result['address'];?></td>
                    </tr>
                    <tr height=40>
                        <td align="right">City</td>
                        <td width=80 colspan=2><?php echo $result['city'];?></td>
                        <td align="right">Postcode</td>
                        <td colspan=2><?php echo $result['postcode'];?></td>
                        <td align="right">Phone</td>
                        <td colspan=1><?php echo $result['tel'];?></td>
                    </tr>
                    <tr height=40>
                        <td align="right">Email</td>
                        <td colspan=7><?php echo $result['email'];?></td>
                    </tr>
                    <tr height=40>
                        <td align="right">Facebook</td>
                        <td colspan=7><?php echo $result['facebook'];?></td>
                    </tr>
                 </table>          
                     <?php
					 }
					 else
					 {
						 header('Location:searchfriend.php');
					 }
				 }
			 }
			 
			 else if($search == "comment")
			 {
				 $find=Sqlquery("select * from comment where content like '%$keywords%' or username like '%$keywords'");
				 while($result=mysql_fetch_array($find))
				 {
					if($keywords !== "")
					{
					?>
                    <table width=700 class="table1">
                        <tr height=40>
                            <td align="right" width=100>Comment Id</td>
                            <td><?php echo $result['id']; ?></td>
                            <td align="right" width=100>Comment User</td>
                            <td><?php echo $result['username']; ?></td>
                            <td align="right" width=100>Comment Time</td>
                            <td><?php echo $result['datetime']; ?></td>
                    	</tr>
                    	<tr>
                            <td align="right" width=120>Comment Content</td>
                            <td colspan="5"><?php echo $result['content']; ?></td>
                    	</tr>
                    </table>
                    <?php 
					}
					else
					{
						header('Location:searchcomments.php');	
					}
				 }
			 }
			 else if($search == "news")
			 {
				 $find=Sqlquery("select * from news where title like '%$keywords%' or author like '%$keywords'");
				 while($result=mysql_fetch_array($find))
				 {
					 if($keywords !== "")
					 {
					 ?>
                     <table width=700 class="table1">
                        <tr height=40>
                            <td align="right" width=60>ID</td>
                            <td width=40><?php echo $result['id']; ?></td>
                            <td align="right">Publish User</td>
                            <td><?php echo $result['author']; ?></td>
                            <td align="right" >Publish Time</td>
                            <td><?php echo $result['pub_time']; ?></td>
                        </tr>
                        <tr>
                            <td align="right" colspan=2>News Title</td>
                            <td colspan=4><?php echo $result['title'];?></td>
                        </tr>
                        <tr height=40>
                            <td align="right" colspan=2>News Content</td>
                            <td colspan=4><?php echo $result['content'];?></td>
                        </tr>
                     </table>                     
                     <?php
					 }
					 else
					 {
						header('Location:searchnews.php'); 
					 }
				 }
			 }
			 else if($search == "picture")
			 {
				  $find=Sqlquery("select * from picture where author like '%$keywords%' or tpmc like '%$keywords%'");
				 while($result=mysql_fetch_array($find))
				 {
					 if($keywords !== "")
					 {
					 ?>
                     <table width=700 class="table1">
                     	<tr height=40>
                    		<td align="right" width=100>Picture ID</td>
                            <td><?php echo $result['id']; ?></td>
                            <td align="right" width=100>Picture Name</td>
                            <td><?php echo $result['tpmc']; ?></td>
                            <td align="right" width=100>Author</td>
                            <td><?php echo $result['author']; ?></td>
                            <td align="right" width=100>Upload Time</td>
                            <td><?php echo $result['author']; ?></td>                   
                        </tr>
                		<tr height=40>
                            <td colspan=8 colspan=12><img src="images/<?php echo $result['pic']; ?>" width=780 height=500></td>
                        </tr>
                		<tr>
                            <td colspan=3 align="right">Picture Discription</td>
                            <td colspan=5><textarea><?php echo $result['description']; ?></textarea></td>
                		</tr>           
                     </table>                     
                     <?php
					 }
					 else
					 {
						header('Location:searchpicture.php'); 
					 }
				 }
			 
	 	
			 }
	    }	 
	 }
 	?>  			
    </div>
    <div id="footer">
    <p>Copyright 2014 by CC. All Rights Reserved.<p>
    </div>
</body>
</html>
