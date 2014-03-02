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
<title>Picture Mangement</title>
<link href="CSS/text.css" type="text/css" rel="stylesheet" />
<script src="JS/function.js"></script>
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
        	<a href="<?php echo (!isset($_SESSION["username"])?'index.php':'safe.php'); ?>"><?php echo (!isset($_SESSION["username"])?"Blog 

Register":"Log out"); ?></a>
    	</div>
	</div> 
    <div id="content">
    	<div id="manage">
     		<table class="table1" width=800>    
 				<?php 
					 $sql="select count(*) from picture";
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
					 $rs=Sqlquery("select * from picture order by id asc limit $offset,$pagesize");
					 while ($result= mysql_fetch_array($rs))
					 {
				?>        	
        		<tr height=40>
                    <td align="right" width=100>Picture ID</td>
                    <td><?php echo $result['id']; ?></td>
                    <td align="right" width=100>Picture Name</td>
                    <td><?php echo $result['tpmc']; ?></td>
                    <td align="right" width=100>Author</td>
                    <td><?php echo $result['author']; ?></td>
                    <td align="right" width=100>Upload Time</td>
                    <td><?php echo $result['uploadtime']; ?></td>                   
                </tr>
                <tr height=40>
                    <td colspan=8 colspan=12><img src="images/<?php echo $result['pic']; ?>" width=780 height=500></td>
                </tr>
                <tr>
                    <td colspan=3 align="right">Picture Discription</td>
                    <td colspan=5><textarea><?php echo $result['description']; ?></textarea></td>
                </tr>           
        		<tr height=40>
        			<td colspan=4>&nbsp;&nbsp;Page:<?php echo $page;?>/<?php echo $page_count;?>&nbsp;&nbsp;page record:<?php echo $numrows;?> Item&nbsp;
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
								echo "<a href=picture.php?page=1>Home</a>";
								echo "&nbsp&nbsp";
								echo "<a href=picture.php?page=".$pre_page.">Previous Page</a>";
							}        
							if($page==$page_count)
							{
								echo "&nbsp&nbspNext Page&nbsp&nbspLast Page&nbsp&nbsp";
							}
							else
							{
							  echo "&nbsp&nbsp";
							  echo "<a href=picture.php?page=".$next_page.">Next Page</a>"; 
							  echo "&nbsp&nbsp";
							  echo "<a href=picture.php?page=".$page_count.">Last Page</a>";
							}
               			?> 
            		</td>
        		</tr> 
        		<tr height=40>
        			<td colspan=8 align="center">
                    <?php if ($_SESSION["username"] == $result['author'] || $_SESSION["username"] == 'admin')
					{
					?>
                    <a href="del_picture.php?file_id=<?php echo $result['id'];?>"><img src="images/delete.png" width=60 height=50 alt="Delete Article" onClick="return fri_chk();" ></a> 
                    <?php
					}
					else
					{
					?> 
                     <a href="#"><img src="images/delete.png" width=60 height=50 alt="Delete Picture" onClick="return fri();" ></a> 
                     <?php
					} 
					 }
					?>

            		</td>
        		</tr>
                
    		</table><br>        	 
            <form action="add_picture.php" method="post">
            <table width=800 height=285 class="table1">
                <tr height=40>
                    <td colspan=8><h3>Add Picture</h3></td>
                </tr>
                <tr height=40>
                    <td align="right" width=250>Picture Name</td>
                    <td width="223"><input type="text" name="name"></td>
                    <td align="right" width=350>Picture Upload</td>
                    <td width="511"><input type="file" name="upload"></td>    
                </tr>
                <tr>
                    <td align="right" colspan=2>Picture Discription</td>
                    <td colspan=2><textarea name="description"></textarea>
                    </td>
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
