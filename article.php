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
     		<table class="table1" width=700>    
 				<?php 
					 $sql="select count(*) from article";
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
					 $rs=Sqlquery("select * from article order by id asc limit $offset,$pagesize");
					 while ($result= mysql_fetch_array($rs))
					 {
				?>        	
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
        		<tr height=40>
        			<td colspan=3>&nbsp;&nbsp;Page:<?php echo $page;?>/<?php echo $page_count;?>&nbsp;&nbsp;page record:<?php echo $numrows;?> Item&nbsp;
            		</td>
            		<td colspan=3>
						<?php			 
							$pre_page=$page-1;
							$next_page=$page+1;		 
							if($page==1)
							{
								echo "Home&nbsp&nbspPrevious Page&nbsp&nbsp";
							}
							else
							{
								echo "<a href=article.php?page=1>Home</a>";
								echo "&nbsp&nbsp";
								echo "<a href=article.php?page=".$pre_page.">Previous Page</a>";
							}        
							if($page==$page_count)
							{
								echo "&nbsp&nbspNext Page&nbsp&nbspLast Page&nbsp&nbsp";
							}
							else
							{
							  echo "&nbsp&nbsp";
							  echo "<a href=article.php?page=".$next_page.">Next Page</a>"; 
							  echo "&nbsp&nbsp";
							  echo "<a href=article.php?page=".$page_count.">Last Page</a>";
							}
               			?> 
            		</td>
        		</tr> 
        		<tr height=40>
        			<td colspan=6 align="center"> 
                    <?php if ($_SESSION["username"] == $result['author'] || $_SESSION["username"] == 'admin')
					{
					?>
                    <a href="del_article.php?file_id=<?php echo $result['id'];?>"><img src="images/delete.png" width=60 height=50 alt="Delete Article" onClick="return fri_chk();" ></a> 
                    <?php
					}
					else
					{
					?> 
                     <a href="#"><img src="images/delete.png" width=60 height=50 alt="Delete Article" onClick="return fri();" ></a> 
                     <?php
					}
					?>
                    
            		</td>
        		</tr>
                <tr>
                	<td style="font-size: 16px; color:#00F" align="center" colspan=6>
                    <a href="comments.php?file_id=<?php echo $result['id']; ?>" style="text-decoration:none">See Relevant Comments</a>
                      <?php                      	
					  }
                      ?>
                    </td>
                </tr>
    		</table><br>        	 
            <form action="add_article.php" method="post">
            <table class="table1" width=700>
        <tr height=40>
        	<td colspan=2><h3>Add Blog Articles</h3></td>
        </tr>
        <tr height=40>
            <td align="right" width=132>Article Title</td>
            <td align="left"><input type="text" name="title" width=550 style="margin-left:5px;"></td>
        </tr>
        <tr>
            <td align="right">Text Edit</td>
            <td colspan="5"><img src="images/B.gif" width="21" height="20" onClick="bold()">&nbsp;<img src="images/I.gif" width="21" height="20" 

onClick="italicize()">&nbsp;<img src="images/U.gif" width="21" height="20" onClick="underline()">&nbsp;&nbsp;Font-size
                <select  name=size class="wenbenkuang" onChange="showsize(this.options[this.selectedIndex].value)">
                  <option value=1>1</option>
                  <option value=2>2</option>
                  <option value=3 selected>3</option>
                  <option value=4>4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                </select>
				&nbsp;&nbsp;Color
                <select onChange="showcolor(this.options[this.selectedIndex].value)" name="color" size="1" id="select">
                  <option selected>Default color</option>
                  <option style="color:#ff0000" value="#ff0000">Red</option>
                  <option style="color:#0000ff" value="#0000ff">Blue</option>
                  <option style="color:#ff00ff" value="#ff00ff">Pink</option>
                  <option style="color:#009900" value="#009900">Green</option>
                  <option style="color:#009999" value="#009999">TEAL</option>
                  <option style="color:#990099" value="#990099">PURPLE</option>
                  <option style="color:#990000" value="#990000">MAROON</option>
                  <option style="color:#000099" value="#000099">NAVY</option>
                  <option style="color:#999900" value="#999900">OLIVE</option>
                  <option style="color:#ff9900" value="#ff9900">LIMEGREEN</option>
                  <option style="color:#ff9966" value="#ff966">DARKSALMON</option>
                  <option style="color:#cc0066" value="#cc0066">MEDIUMVIOLETRED</option>
                </select>
                </td>
      		</tr>
     		<tr>
            	<td align="right" widht=100 height=120>Article Content</td>
            	<td><textarea name="file" cols="75" rows="20" id="file" style="border:0px;width:520px;"></textarea>
                </td>
      		</tr>
        	<tr height=40>
            	<td colspan=2 align="center">
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
