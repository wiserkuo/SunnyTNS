<!DOCTYPE html>
<html>
<body>

<h1>coach list</h1>

<?php
    $account = $_POST["account"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    echo "<br>",$account,"  ",$password," ",$name;

    //connect mysql and fetch data
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '70187017';
    $dbname = 'test';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);
    
    $sql = "INSERT INTO `coach_list`(`Account`, `Name`, `Password`) VALUES ('{$account}','{$name}','{$password}')";
    echo "<br>",$sql;
    $result = mysql_query($sql) or die('MySQL query error');
    
    $sql ="Select * from `coach_list`";
    $result = mysql_query($sql) or die('MySQL query error');
    echo '<table border="1">';
    echo '<tr><th>Name</th><th>Account</th><th>Password</th></tr>';    
    while($row = mysql_fetch_array($result)){
    	echo '<tr>';	
      echo '<td>',$row['Name'],'</td><td>',$row['Account'],'</td><td>',$row['Password'],'</td>';
      echo "</tr>";
    }
    echo '</table>';  

?> 
</body>
</html> 