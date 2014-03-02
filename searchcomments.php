<?php
session_start();
include 'public/function.php';
$page="";
if ($page=="") {$page=1;}; 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Relevant Comments</title>
<link href="CSS/text.css" type="text/css" rel="stylesheet" />
<script src="JS/function.js"></script>
<script src="JS/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
function fri_chk(){
	if(confirm("Do you really want to delete!"))
	{
		return true;
	}
	else
	{
		return false; 
	}
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
    	<div id="manage">
		<?php 
		$sql="select count(*) from comment";
        $rs=Sqlquery($sql);
        $myrow = mysql_fetch_array($rs);
        $numrows=$myrow[0];
        $pagesize=1;
        $page_count=$numrows%$pagesize=="0"?intval($numrows/$pagesize):(intval($numrows/ $pagesize)+1);
        if(isset($_GET['page']))
        {$page= $_GET["page"];}
        if($page<=0) $page=1;
        if($page>=$page_count) 
        {$page=$page_count;}
        $offset=$pagesize*($page-1);
        $rsl=Sqlquery("select * from comment order by id desc limit $offset,$pagesize");
		while ($result = mysql_fetch_array($rsl))
		{
         ?>
            <table class="table1" width=700>
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
                <tr height=40>
                    <td colspan=3>&nbsp;&nbsp;Page:<?php echo $page;?>/<?php echo $page_count;?>page record:<?php echo $numrows;?>Item&nbsp;</td>
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
							echo "<a href=searchpicture.php?page=1>Home</a>";
						  	echo "&nbsp&nbsp";
						  	echo "<a href=searchcomments.php?page=".$pre_page.">Previous Page</a>";
						} 
						if($page==$page_count)
						{
						    echo "&nbsp&nbspNext Page&nbsp&nbspLast Page&nbsp&nbsp";
						}
						else
						{
						  echo "&nbsp&nbsp";
						  echo "<a href=searchcomments.php?page=".$next_page.">Next Page</a>&nbsp;"; 
						  echo "&nbsp&nbsp";
						  echo "<a href=searchcomments.php?page=".$page_count.">Last Page</a>";
						}
                   ?>                         
                   </td>
               </tr>
           	   <?php      
		       }
        	   ?>
    		</table>
   		</div>
	</div>
	<div id="footer">
	<p>Copyright 2014 by CC. All Rights Reserved.<p>
	</div>
</body>
</html>