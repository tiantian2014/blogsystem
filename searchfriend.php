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
        <li><a href="searchfriend.php">Friends Management</a></li>
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
        <li><a href="searchfriend.php">Friends Management</a></li>
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
     <a href="<?php echo (!isset($_SESSION["username"])?'Regpro.php':'safe.php'); ?>"><?php echo (!isset($_SESSION["username"])?"Blog Register":"Log out"); ?></a>
    </div>
</div> 
	
<div id="content">
	<div id="manage">
    <?php $page="";
	if ($page=="") {$page=1;}; ?>
	<table class="table1" width=700>
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
						echo "<a href=searchfriend.php?page=1&friend_id=".$result['id'].">Home</a>";
						echo "&nbsp&nbsp";
						echo "<a href=searchfriend.php?page=".$pre_page."&friend_id=".$result['id'].">Previous Page</a>";
					} 
					if($page==$page_count)
					{
						echo "&nbsp&nbspNext Page&nbsp&nbspLast Page&nbsp&nbsp";
					}
					else
					{
						echo "&nbsp&nbsp";
						echo "<a href=searchfriend.php?page=".$next_page."&friend_id=".$result['id'].">Next Page</a>&nbsp;"; 
						echo "&nbsp&nbsp";
						echo "<a href=searchfriend.php?page=".$page_count."&friend_id=".$result['id'].">Last Page</a>";
					}
					}
					?> 
				</td>
			</tr>
		</table>
    </div>
</div>
<div id="footer">
<p>Copyright 2014 by CC. All Rights Reserved.<p>
</div>
</body>
</html>
