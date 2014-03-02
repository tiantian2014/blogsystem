<?php
session_start();
include("public/function.php");
if ($_POST)
{
	$name=trim($_POST["username"]);
	$password=trim($_POST["userpsw"]);
	$name = strtolower($name);
	if (!strlen($name) || !strlen($password)) 
			{
				$mess = "Please enter Name and Password";
			}
			elseif(!regexpName($name)) 
			{
				$mess = "Name,please enter characters or digits, at lease 6 charaters";
			}
			elseif (!regexpPassword($password)) 
			{
				$mess = "Password is not a valid password";
			}		
	        else
			{
				$sql=Sqlquery("select * from user where regname='".$name."' and regpwd='".$password."'");
				$result=mysql_fetch_array($sql);
				if($result!="")
				{
				$_SESSION["level"]=$result["level"];
				$_SESSION["username"]=$name;
				
				?>
				<script language="javascript">
					alert("Login Success");window.location.href="article.php";
				</script>
				<?php
				}
				else
				{
				?>
				<script language="javascript">
			    alert("Sorry, username or password not correct, please try again!");window.location.href="index.php";
				</script>
				<?php
				}
			}
}
				?>	
			
