<?php
// Array with names

$level = $_REQUEST["l"];
$account =  $_REQUEST["a"];
$hint = "";
//connect mysql and fetch data
 $dbhost = 'localhost';
 $dbuser = 'root';
 $dbpass = '70187017';
 $dbname = 'test';
 $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
 mysql_query("SET NAMES 'utf8'");
 mysql_select_db($dbname);
 $sql = "UPDATE `student_list` SET Level= {$level} WHERE Account='{$account}'";
 //$sql = "UPDATE `student_list` SET Level= {$level} WHERE Account= 'wiserkuo@gmail.com'";
 $result = mysql_query($sql) or die('MySQL query error');  
// if ($q !== "") {
//     $q = strtolower($q);
//     $len=strlen($q);
//     foreach($a as $name) {
//         if (stristr($q, substr($name, 0, $len))) {
//             if ($hint === "") {
//                 $hint = $name;
//             } else {
//                 $hint .= ", $name";
//             }
//         }
//     }
// }

// Output "no suggestion" if no hint was found or output correct values 
echo $hint =$account,",",$level;
?>