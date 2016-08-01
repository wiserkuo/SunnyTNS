<?php
// Array with names
$function= $_REQUEST["f"];
$level = $_REQUEST["l"];
$account =  $_REQUEST["a"];
$num = $_REQUEST["n"];
$class =  $_REQUEST["c"];
$level = $_REQUEST["l"];
$material= $_REQUEST["m"];

$hint = "";
//connect mysql and fetch data
 $dbhost = 'localhost';
 $dbuser = 'root';
 $dbpass = '70187017';
 $dbname = 'test';
 $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
 mysql_query("SET NAMES 'utf8'");
 mysql_select_db($dbname);
 	if($function == '1'){//change level
 		$sql = "UPDATE `student_list` SET Level= {$level} WHERE Account='{$account}'";
 		$result = mysql_query($sql) or die('MySQL query error');  
		echo $hint =$account,",",$level;
	}
	else if($function == '2'){//get material
		$sql = "SELECT * FROM `class_teaching_material` WHERE Class = '{$class}' AND Number = {$num}";
 		$result = mysql_query($sql) or die('MySQL query error');  
 		$row = mysql_fetch_array($result);
		echo $hint =$row['Material'];
	}
	else if($function == '3'){//set material
		$sql = "UPDATE `class_teaching_material` SET `Material`='{$material}' WHERE `Class`='{$class}' AND `Number`={$num}";
 		$result = mysql_query($sql) or die('MySQL query error');  
 		$row = mysql_fetch_array($result);
		echo $hint =$material;
	}
?>