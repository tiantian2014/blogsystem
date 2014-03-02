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
<title>Friend Management</title>
<link href="CSS/text.css" type="text/css" rel="stylesheet" />
<script src="JS/function.js" type="text/javascript"></script>
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
        <h3>Search By</h3>
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
     <a href="<?php echo (!isset($_SESSION["username"])?'index.php':'safe.php'); ?>"><?php echo (!isset($_SESSION["username"])?"Blog Register":"Log out"); ?></a>
    </div>
</div> 
	
<div id="content">
	<div id="manage">
    <?php $page="";
	if ($page=="") {$page=1;}; ?>
	<table class="table1" width=700>
        <tr align="left" height=40>
        	<td colspan=8><h2>Browse My Friends</h2></td>
        </tr>
          <?php
			 $sql="select count(*) from friend";
			 $rs=Sqlquery($sql);
			 $myrow = mysql_fetch_array($rs);
			 $numrows=$myrow[0];
			 $pagesize=1;
			 $page_count=$numrows%$pagesize=="0"?intval($numrows/$pagesize):(intval($numrows/ $pagesize)+1);
			 if(isset($_GET['page']))
			 {$page= $_GET["page"];}
			 if($page<=0) $page=1;
			 if($page>=$page_count) $page=$page_count;
			 $offset=$pagesize*($page-1);
			 $rs=Sqlquery("select * from friend order by id asc limit $offset,$pagesize");
			 while ($result=mysql_fetch_array($rs))
			 {
			 ?> 
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
            <td colspan=3><?php echo $result['address'];?></td>
            <td align="right" colspan=2>Who's friend</td>
            <td colspan=2><?php echo $result['friendname'];?></td>
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
        <tr height=40>
 			<td colspan=8 align="center">	
            <?php if ($_SESSION["username"] == $result['friendname'] || $_SESSION["username"] == 'admin')
					{
					?>
                    <a href="del_friend.php?file_id=<?php echo $result['id'];?>"><img src="images/delete.png" width=60 height=50 alt="Delete Article" onClick="return fri_chk();" ></a> 
                    <?php
					}
					else
					{
					?> 
                     <a href="#"><img src="images/delete.png" width=60 height=50 alt="Delete Friend" onClick="return fri();" ></a> 
                     <?php
					}
					?>			
        </tr>
        <tr>
       		<td colspan=4>
                Page：<?php echo $page;?>/<?php echo $page_count;?>
                Page record：<?php echo $numrows;?> 
                Item&nbsp;
            </td>
            <td colspan=4>
                <?php			 
					$pre_page=$page-1;
					$next_page=$page+1;	 
					if($page==1)
					{
						echo "Home&nbsp&nbspPrevious Page&nbsp&nbsp";
					}
					else
					{							    
						echo "<a href=friend.php?page=1&friend_id=".$result['id'].">Home</a>";
						echo "&nbsp&nbsp";
						echo "<a href=friend.php?page=".$pre_page."&friend_id=".$result['id'].">Previous Page</a>";
					} 
					if($page==$page_count)
					{
						echo "&nbsp&nbspNext Page&nbsp&nbspLast Page&nbsp&nbsp";
					}
					else
					{
						echo "&nbsp&nbsp";
						echo "<a href=friend.php?page=".$next_page."&friend_id=".$result['id'].">Next Page</a>&nbsp;"; 
						echo "&nbsp&nbsp";
						echo "<a href=friend.php?page=".$page_count."&friend_id=".$result['id'].">Last Page</a>";
					}
					}
					?> 
				</td>
			</tr>
		</table><br>
        <form action="add_friend.php" method="post">
        <table class="table1" width=700>
            <tr align="left" height=40>
                <td colspan=8><h2>Add Friend</h2></td>
            </tr>
            <tr height=40>
                <td align="right" width=80>Real Name</td>
                <td><input type="text" name="name"></td>
                <td align="right" width=80>Username</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td align="right" >Birthday</td>
                <td ><input type="text" name="birth"></td>
                <td align="right" >Gender</td>
                <td>
                    <select name="sex">
                    <option name="security" value="0">Security</option>
                    <option name="male" value="1">Male</option>
                    <option name="female" value="2">Female</option>
                    </select>
                </td>              
            </tr>
            <tr height=40>
                <td align="right">Address</td>
                <td><input type="text" name="address"></td>
                <td align="right">Phone</td>
                <td><input type="text" name="tel"></td>
            </tr>
            <tr height=40>            
                <td align="right">City</td>
                <td><input type="text" name="city"></td>
                <td align="right">Postcode</td>
                <td><input type="text" name="postcode"></td>
            </tr>
            <tr height=40>
                <td align="right">Email</td>
                <td><input type="text" name="email"></td>
                <td align="right">Facebook</td>
                <td><input type="facebook" name="facebook"></td>
            </tr>
            <tr height=40>
                <td colspan=4 align="center">
                <input type="submit" name="submit" value="Submit">
                <input type="reset" name="reset" value="Reset">
                </td>
            </tr>       
		</table>  
        </form>     
    </div>
</div>
<div id="footer">
<p>Copyright 2014 by CC. All Rights Reserved.<p>
</div>
</body>
</html>
