<?php 
session_start(); 
include("public/function.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Show News</title>
<body>
<table width=500>
        
        <?php 
            $sql=Sqlquery("select * from news where id =".$_GET['id']);
            $result=mysql_fetch_array($sql);
       ?> 
    
        <tr height=40>
            <td><?php echo $result['author']; ?></td>
            <td align="right"><?php echo $result['pub_time']; ?></td>            
        </tr>
        <tr>
        	<td colspan=2 align="center">
            <?php echo $result['title']; ?>
            </td>
        </tr>
        <tr>
            <td colspan=3><?php echo $result['content']; ?></td>
        </tr>
      </table>
</body>
</head>
