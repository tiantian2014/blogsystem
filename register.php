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
  <div class="hobl">
    	<ul>
       		<li><a href="index.html">Home</a></li>
            <li><a href="#">My Blogs</a></li>
        </ul>
    </div>
</div>
<div id="middle2">

</div> 
	
<div id="content">
    <div id="top3">
        <div class="topboxre">
            <h2>register</h2>
            <form action="register.php" method="post" enctype="multipart/form-data">
                <table width=700>
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
	
	
//2.validate the data
	if(!strlen($name) || !strlen($psw) || !strlen($conpsw))   //if some box is empty
	{
		$mess = "Please check if some box is empty,every box need to enter data";
	}
	elseif (!regexpName($name))     //check every box use regular expressions 
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
	elseif ($psw!=$conpsw)   //password must be the same as the VerifyPassword
	{
		$mess = "Verify two times password not the same";
	}
	elseif ($email!=$conemail)
	{
		$mess ="Verify two times email not the same";
	}
	else
	{				
		//check if the name has been registered
		$userFound = checkRegistered($name);
		if($userFound==true)
		{				
			$mess = "Sorry,your name has been registered,please use another name";
		}
		else
		{									
		//3.Hash the password 
		//a.generate salt
			$name = filterVal($name);	
			$email = filterVal($email);		
			$psw = filterVal($psw);		
			
				//b.hash the password
			//4.Store name,hashed password,and salt in db		
								
			//write the datas to file
		
			$mess="";
			$sql="INSERT INTO user(regname,regpwd,regbirthday,regemail,regico,regsex,regintroduce,regrealname,logo,level,facebook) VALUES('$name','$psw','$birth','$email','$psweb','$gender','$intro','$realname','$filename','2','$facebook')";
			$result = Sqlquery($sql);
		if(!$result)
		{
			$mess = "Sorry,could not save the user!";
		}
		 	
			
			if(strlen($mess)==0)  //if save data successful
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

