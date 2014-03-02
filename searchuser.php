<?php 
session_start(); 
include("public/function.php");
include "check_login.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Blog System</title>
<link href="CSS/text.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div id="top">
        <div id="top1">
        </div>
    </div>      
    <div id="navi">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="article.php">Articles Management</a></li>
                <li><a href="picture.php">Pictures Management</a></li>
                <li><a href="friend.php">Friends Management</a></li>
                <li><a href="news.php">News Management</a></li>
                <li>
                <?php
                  if($_SESSION['level']==1)
                  {
                   ?> 
                  <a href="searchuser.php" style="cursor:hand">User Management</a>
                  <?php  
                  }
				  ?>
                </li>
            </ul>       
    </div>    
<div id="middle2">
    <div class="welcome">
    	<h3>Welcome &nbsp;<?php echo $_SESSION['username']; ?></h3>
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
    	<a href="logout.php">Logout</a>
    </div>
</div> 
	
<div id="content">
	<div id="manage">
    <?php 
	$page="";
	if ($page=="") {$page=1;}; ?>
	<table class="table1">   
        <?php 			
			 $sql="select count(*) from user";
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
			 $rs=Sqlquery("select * from user order by id desc limit $offset,$pagesize");
			  while ($result = mysql_fetch_array($rs)){
		?>        	
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
        <tr height=40>
            <td colspan=8 align="center">
			&nbsp;&nbsp;Page:<?php echo $page;?>/<?php echo $page_count;?>&nbsp;&nbsp;page record:<?php echo $numrows;?> Item&nbsp;          
            <?php
			 }			 
			$pre_page=$page-1;
			$next_page=$page+1;			 
			if($page==1){
			  echo "Home&nbsp&nbspPrevious Page&nbsp&nbsp";
			}else{
			  echo "<a href=searchuser.php?page=1>Home</a>";
			  echo "&nbsp&nbsp";
			  echo "<a href=searchuser.php?page=".$pre_page.">Previous Page</a>";
			}
			 
			if($page==$page_count){
			  echo "&nbsp&nbspNext Page&nbsp&nbspLast Page&nbsp&nbsp";
			}else{
			  echo "&nbsp&nbsp";
			  echo "<a href=searchuser.php?page=".$next_page.">Next Page</a>"; 
			  echo "&nbsp&nbsp";
			  echo "<a href=searchuser.php?page=".$page_count.">Last Page</a>";
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
