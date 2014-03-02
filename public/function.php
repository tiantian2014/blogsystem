<?php
	$conn = mysql_connect("localhost","root","") or die("Could not ect: " . mysql_error());
	function Sqlquery($sql)
	{
		global $conn;
		mysql_select_db("db_log", $conn) or die ('Can\'t use foo : ' . mysql_error());        
		$que = mysql_query($sql);
		if(!$que)
		{
			$mess = "SQL =$sql= error:".mysql_error($conn);
		}
		else
		{
			return $que;
		}
		
	}

	function regexpName($name)  
	{		
		if(!preg_match("/^[A-Za-z\d]{5,}/",$name))  
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function regexpPassword($password)  
	{
		if(!preg_match("/^[A-Za-z\d]{6,}/",$password)) 
		{
			return false;
		}
		else
		{
			return true;
		}

	}

	function regexpEmail($email)  
	{
		if(!preg_match("/^[a-z\d]+([\.\-_]?[a-z\d]+)*@[a-z\d]+([\.\-_]?[a-z\d]+)*\.[a-z]{2,}$/",$email))
		{
			return false;
		}
		else
		{
			return true;
		}
	}	

	function checkRegistered($name)
	{
		$userFound = false;
		$sql = "SELECT * FROM user WHERE regname='$name'";
		$que = Sqlquery($sql);
		if(mysql_num_rows($que)!=0)
		{
		   	$userFound = true;
		}		
		return $userFound;		
	}
	
	function addUser($dataArr)
	{
		$mess = "";
		$sql = "INSERT INTO user(regname,regpwd,regbirthday,regemail,regico,regsex,regintroduce,regrealname,level,facebook) 		       VALUES('$dataArr[regname]','$dataArr[regpwd]','$dataArr[regbirthday]','$dataArr[regemail]','$dataArr[regico]',,'$dataArr[regsex]','$dataArr[regintroduce]','$dataArr[regrealname]','$dataArr[level]','$dataArr[facebook]')";
		$result = Sqlquery($sql);
		if(!$result)
		{
			$mess = "Sorry,could not save the user!";
		}
		if($mess)
		{
			return $mess;
		}
	}
	
	function filterVal($val)
	{
		$val = mysql_real_escape_string($val);
		$val = htmlentities($val);		
		return($val);		
	}

	
	