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
                  <a href="user.php" style="cursor:hand">User Management</a>
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
    	<a href="<?php echo (!isset($_SESSION["username"])?'index.php':'safe.php'); ?>"><?php echo (!isset($_SESSION["username"])?"Blog Register":"Log out"); ?></a>
    </div>
</div> 	
<div id="content">
	<div id="manage">
    <?php 
	$page="";
	if ($page=="") {$page=1;}; ?>
	<table class="table1" >   
        <tr align="left" height=40>
        	<td colspan=8><h2>Browse user's info</h2></td>
        </tr>
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
            <td align="right" width=60 rowspan=3>Image</td>
            <td rowspan=3><img src="images/<?php echo $result['logo']; ?>" width=100 height=100 ></td>
        </tr>
        <tr>   
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
            <td><?php echo $result['regbirthday']; ?></td>
            <td align="right">Password</td>
            <td><?php echo $result['regpwd']; ?></td>
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
            <?php 
				if ($_SESSION['level']=1)
				{
			?>
			<a href="del_user.php?user_id=<?php echo $result['id'];?>"><img src="images/delete.png" width=60 height=50 alt="Delete user"></a>
			<?php
				}
			?>
		   </td>
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
			  echo "<a href=user.php?page=1>Home</a>";
			  echo "&nbsp&nbsp";
			  echo "<a href=user.php?page=".$pre_page.">Previous Page</a>";
			}
			 
			if($page==$page_count){
			  echo "&nbsp&nbspNext Page&nbsp&nbspLast Page&nbsp&nbsp";
			}else{
			  echo "&nbsp&nbsp";
			  echo "<a href=user.php?page=".$next_page.">Next Page</a>"; 
			  echo "&nbsp&nbsp";
			  echo "<a href=user.php?page=".$page_count.">Last Page</a>";
			}
			?>       
            </td>
       </tr>
    </table><br>
    <form action="user.php" method="post" enctype="multipart/form-data">
        <table class="table1" width=700>
            <tr align="left" height=40>
                <td colspan=6><h2>Add User</h2></td>
            </tr>
    		<tr>
                <td align="right">Username:</td>
                <td><input type="text" name="username"></td>
                <td align="right">Gender:</td>
                <td><select name="gender"><option value="1">Female</option><option value="1">Male</option><option value="1">Security</option></select>
            </tr>
                    <tr>
                        <td align="right">Real Name:</td>
                        <td><input type="text" name="realname"></td>
                        <td align="right">Birthday:</td>
                        <td align="left"><input type="date" name="birthday" placeholer="yyy-mm-dd"></td>
                       
                    </tr>
                    <tr>
                        <td align="right">Password:</td>
                        <td><input type="password" name="psw"></td>
                        <td align="right">Introduce Yourself:</td>
                        <td><textarea name="intro" rows="5" ></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Email:</td>
                        <td><input type="text" name="email"></td>
                        <td align="right">Picture:</td>
                        <td><input type="file" name="file" id="file"></td>
                    </tr>
                    <tr>
                         <td align="right">Personal Website:</td>
                        <td><input type="text" name="psweb"></td>
                        <td align="right">Facebook:</td>
                        <td><input type="text" name="facebook"></td>
                    </tr> 
                    <tr height=40>
                <td colspan=4 align="center">
                <input type="submit" name="submit" value="Submit">
                <input type="reset" name="reset" value="Reset">
                </td>
            </tr>                   
		</table> 
        </form>  
        <?php 
			if($_FILES)
				{
					$allowedExts = array("gif", "jpeg", "jpg", "png");
					$temp = explode(".", $_FILES["file"]["name"]);
					$extension = end($temp);
					if ((($_FILES['file']['type'] == "image/gif")
					|| ($_FILES['file']['type'] == "image/jpeg")
					|| ($_FILES['file']['type'] == "image/jpg")
					|| ($_FILES['file']['type'] == "image/pjpeg")
					|| ($_FILES['file']['type'] == "image/x-png")
					|| ($_FILES['file']['type'] == "image/png"))
					&& ($_FILES['file']['size'] < 35000)
					&& in_array($extension, $allowedExts))
					{
						if ($_FILES['file']['error'] > 0)
						{
						?>
							<script language="javascript">
								alert("'Return Code: ' . <?php echo $_FILES['file']['error']; ?>";)
							</script>
						<?php
						}
						else
						{
							$filename=$_FILES['file']['name'] ;
						}
					}
					else
					{
			
						echo "Invalid file";
			
					}		
			}
			if($_POST)
			{
				$name=$_POST["username"];
				$psw=$_POST["psw"];
				$realname=$_POST["realname"];
				$email=$_POST["email"];
				$birth=$_POST["birthday"];
				$gender=$_POST["gender"];
				$psweb=$_POST["psweb"];
				$intro=$_POST["intro"];
				$facebook=$_POST["facebook"];
				$filename=$_FILES["file"]["name"];
				$INS="INSERT INTO user(regname,regpwd,regbirthday,regemail,regico,regsex,regintroduce,regrealname,logo,level,facebook) VALUES('$name','$psw','$birth','$email','$psweb','$gender','$intro','$realname','$filename','2','$facebook')";
				$info=Sqlquery($INS);
				if($info)
				{
					echo "<script> alert('Add user success!');</script>";
					echo "<script> window.location.href='$_SERVER[HTTP_REFERER]';</script>";
				}
				else
				{
					echo "<script> alert('Add user fail!');</script>";
					echo "<script> history.go(-1);</script>";
				}
			}
			?> 
               
    </div>
</div>
<div id="footer">
<p>Copyright 2014 by CC. All Rights Reserved.<p>
</div>
</body>
</html>
