<?php 
session_start(); 
include("public/function.php");
$bool = false;
$page="";
if ($page=="") {$page=1;}; 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Blog System</title>
<link type="text/css" href="CSS/text.css" rel="stylesheet"/>
<script src="JS/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#slideit").click(function(){
		$("#top2").slideDown("slow");
	
	});	
	$("#closeit").click(function(){
		$("#top2").slideUp("slow");	
		
	});
	$("#toggle a").click(function () {
		$("#toggle a").toggle();
	});		
});

$(document).ready(function(){
	$("#slide").click(function(){
		$("#top3").slideDown("slow");
	
	});	
	$("#close").click(function(){
		$("#top3").slideUp("slow");	
	});
	$("#toggleit a").click(function () {
		$("#toggleit a").toggle();
	});		
});
</script>
</head>
<body>
<div id="top">
    <div id="top1">
    </div>
    <div id="top2">
        <div class="topbox">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <label for="username">
				Username:<br>
                  <input type="text" name="username" id="username" value="" /><br>
                </label>
                <label for="userpass">Password: <br>
                  <input type="password" name="userpsw" id="userpsw" value="" />
                </label>
                <p>
                  <input type="submit" name="sub_dl" id="userlogin" value="Login" />

                  
                  <input type="reset" name="userreset" id="userreset" value="Reset" /> </p>
            </form>
        </div>
        <div class="photo">
        </div>
    </div>
    <div id="top3">
        <div class="topboxre">
            <h2>register</h2>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <table>
                    <tr align="left">
                        <td colspan="3">Must Input</td>
                        <td></td>
                        <td colspan="2">Select Input</td>
                    </tr>
                    <tr>
                        <td width=20></td>
                        <td align="right">Username:</td>
                        <td><input type="text" name="username"><span style="color:red" >*</span></td>
                        <td></td>
                        <td align="right">Gender:</td>
                        <td><select name="gender"><option value="1">Female</option><option value="1">Male</option></select>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right">Real Name:</td>
                        <td><input type="text" name="realname"><span style="color:red" >*</span></td>
                        <td></td>
                        <td align="right">Personal Website:</td>
                        <td><input type="text" name="psweb"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right">Password:</td>
                        <td><input type="password" name="psw"><span style="color:red" >*</span></td>
                        <td></td>
                        <td align="right">Introduce Yourself:</td>
                        <td><textarea name="intro" rows="5" ></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right">Confirm Password:</td>
                        <td><input type="password" name="conpsw"><span style="color:red" >*</span></td>
                        <td></td>
                        <td align="right">Picture:</td>
                        <td rowspan="3"><input type="file" name="file" id="file"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right">Email:</td>
                        <td><input type="text" name="email"><span style="color:red" >*</span></td>
						<td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td></td>
                        <td align="right">Confirm Email:</td>
                        <td><input type="text" name="conemail"><span style="color:red" >*</span></td>
						<td></td>
                        <td></td>
                        <td></td>
                    </tr> 
                    <tr>
                        <td width="50"></td>
                        <td align="right">Birthday:</td>
                        <td align="left"><input type="date" name="birthday" placeholer="yyy-mm-dd"><span style="color:red" >*</span></td>
                        <td></td>
                        <td align="right">Facebook:</td>
                        <td><input type="text" name="facebook"></td>
                    </tr>               
                 </table><br>
                 <input style="margin-left: 350px;" type="submit" value="Submit">
                 <input type="reset" value="Reset">
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
						$mess= "Invalid file";			
					}		
			}
			?>
         </div>       
    </div>
</div>
<div id="click">
    <div id="login">
        <ul>
        	<li id="toggle"><a id="slideit" href="#top2">Login Here<a id="closeit" style="display: none;" href="#top2">Close Panel</a>
        	</li>
        <ul>
    </div>
    <div id="register">
        <ul>
            <li id="toggleit"><a id="slide" href="#register">register Here<a id="close" style="display: none;" href="#register">Close Panel</a>
            </li>
        <ul>
    </div>
</div>
<div id="navi">
	<div class="hobl">
    	<ul>
       		<li><a href="index.php">Home</a></li>
            <li><a href="file.php">My Blogs</a></li>
        </ul>
    </div>
</div>
<div id="middle">
	<div id="margin"> 
    </div>
	<div id="pho">
            <div id="weather">
            	<div style="width:500px; height:300px;">
                    <object type="application/x-shockwave-flash" data="http://swf.yowindow.com/yowidget3.swf" width="500" height="300">
                        <param name="movie" value="http://swf.yowindow.com/yowidget3.swf"/>
                        <param name="allowfullscreen" value="true"/>
                        <param name="wmode" value="opaque"/>
                        <param name="bgcolor" value="#FFFFFF"/>
                        <param name="flashvars" 
                        value="location_id=6077243&amp;location_name=Montr%C3%A9al&amp;time_format=12&amp;unit_system=metric&amp;background=#FFFFFF&amp;copyright_bar=false"
                    />
                        <a href="http://WeatherScreenSaver.com?client=widget&amp;link=copyright"
                        style="width:500px;height:300px;display: block;text-indent: -50000px;font-size: 0px;background:#DDF url(http://yowindow.com/img/logo.png) no-repeat scroll 50% 50%;"
                        >Free Weather Widget</a>
                    </object>
                </div>
            </div>
        <div id="blogmanage">
         <img src="images/blogmanage.png"><br>
         <img src="images/manage.png" width="300" height="60">
        </div> 
  </div>
</div>
<div id="content">
	<div id="width">
        <div id="left">
    <table class="table1">
    	<tr height=40>
        	<td colspan=6 width=100><h3>Browse all articles</h3></td>
        </tr>
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
			 $rs=Sqlquery("select * from article order by id desc limit $offset,$pagesize");
			  while ($result = mysql_fetch_array($rs)){
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
        	<td colspan=3>&nbsp;&nbsp;Page:<?php echo $page;?>/<?php echo $page_count;?>&nbsp;&nbsp;page record:<?php echo $numrows;?> Item&nbsp;</td>
            <td colspan=3>
            
            <?php
			 }			 
			$pre_page=$page-1;
			$next_page=$page+1;			 
			if($page==1){
			  echo "Home&nbsp&nbspPrevious Page&nbsp&nbsp";
			}else{
			  echo "<a href=file_more.php?page=1>Home</a>";
			  echo "&nbsp&nbsp";
			  echo "<a href=file_more.php?page=".$pre_page.">Previous Page</a>";
			}
			 
			if($page==$page_count){
			  echo "&nbsp&nbspNext Page&nbsp&nbspLast Page&nbsp&nbsp";
			}else{
			  echo "&nbsp&nbsp";
			  echo "<a href=file_more.php?page=".$next_page.">Next Page</a>"; 
			  echo "&nbsp&nbsp";
			  echo "<a href=file_more.php?page=".$page_count.">Last Page</a>";
			}
			?>       
            </td>
        </tr>
    </table><br>    
    </div>
    <div id="right">
        <iframe width="360" height="300" src="//www.youtube.com/embed/oYo3-MmUphg" frameborder="0" allowfullscreen></iframe><br>
            <h3>My Heart Will Go On------Celine Dion</h3>
            <marquee onMouseOver=this.stop()
					onMouseOut=this.start() 
					scrollamount=2 scrolldelay=7 direction=up>
						<p>
                        Every night in my dreams<br>
                        I see you, I feel you<br>
                        That is how I know you go on.<br>
                        Far across the distance<br>
                        and spaces between us<br>
                        You have come to show you go on.<br>
                        
                        Near, far, wherever you are<br>
                        I believe that the heart does go on<br>
                        Once more, you opened the door<br>
                        And you're here in my heart,<br>
                        and my heart will go on and on.<br>
                        
                        Love can touch us one time<br>
                        and last for a lifetime<br>
                        And never let go till we've gone.<br>
                        Love was when I loved you,<br>
                        one true time I hold you,<br>
                        In my life we'll always go on.<br>
                        
                        Near, far, wherever you are<br>
                        I believe that the heart does go on<br>
                        Once more, you opened the door<br>
                        And you're here in my heart,<br>
                        and my heart will go on and on.<br>
                        
                        You're here, there's nothing I fear<br>
                        And I know that my heart will go on.<br>
                        We'll stay, forever this way<br>
                        You are safe in my heart<br>
                        and my heart will go on and on.<br>
                        
                        The End.
                        </p>
                  </marquee>
        </div>
    </div>
</div>
<div id="footer">
	<p>Copyright 2014 by CC. All Rights Reserved.<p>
</div>
</body>
</html>
<?php
if ($_POST)
{
	$name=trim($_POST["username"]);
	$psw=trim($_POST["psw"]);
	$conpsw=trim($_POST["conpsw"]);
	$name=strtolower($name);
	$realname=$_POST["realname"];
	$email=$_POST["email"];
	$conemail=$_POST["conemail"];
	$birth=$_POST["birthday"];
	$gender=$_POST["gender"];
	$psweb=$_POST["psweb"];
	$intro=$_POST["intro"];
	$facebook=$_POST["facebook"];
	$filename=$_FILES["file"]["name"];
	if(!strlen($name) || !strlen($psw) || !strlen($conpsw))
	{
		$mess = "Please check if some box is empty,every box need to enter data";
	}
	elseif (!regexpName($name))
	{
		$mess = "Name,pease enter characters or digits, at lease 6 charaters";
	}
	elseif (!regexpPassword($psw)) 
	{
		$mess = "Password,12~20 charaters,contain at least one uppercase letter, one lowercase letter, one digit, and one of these special characters: space ! @ # $ % * ( )?";
	}
	elseif(!regexpEmail($email))
	{
		$mess = "Email,is not a valid email";
	}
	elseif ($psw!=$conpsw)
	{
		$mess = "Verify two times password not the same";
	}
	elseif ($email!=$conemail)
	{
		$mess ="Verify two times email not the same";
	}
	else
	{				
		$userFound = checkRegistered($name);
		if($userFound==true)
		{				
			$mess = "Sorry,your name has been registered,please use another name";
		}
		else
		{									
			$name = filterVal($name);	
			$email = filterVal($email);		
			$psw = filterVal($psw);		
			$mess="";
			$sql="INSERT INTO user(regname,regpwd,regbirthday,regemail,regico,regsex,regintroduce,regrealname,logo,level,facebook) VALUES('$name','$psw','$birth','$email','$psweb','$gender','$intro','$realname','$filename','2','$facebook')";
			$result = Sqlquery($sql);
			if(!$result)
			{
				$mess = "Sorry,could not save the user!";
			}		 			
			if(strlen($mess)==0)  
			{              
				$mess = "Register successful ! Please back for login now";
                $registerSucess = true;				
			}
		}
	}
}	
?>
<script>
alert(" <?php echo $mess;?>;")
</script>

