<!DOCTYPE html>
<html>
<body>

<h1>Sunny Tennis Coach System</h1>



<form action="">
First name: <input type="text" id="txt1" onkeyup="showHint(this.value)">
</form>

<p>Suggestions: <span id="txtHint"></span></p>

<script>
function showHint(str) {
  var xhttp;
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("txtHint").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "gethint.php?q="+str, true);
  xhttp.send();
}
</script>

<script>
function changeLevel(level,account) {
    //if (level.length == 0) { 
    //    document.getElementById("txtHint").innerHTML = "";
    //    return;
    //} else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHin").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "change_level.php?l="+level+"&a="+account, true);
        xmlhttp.send();
    //}
}
</script>
<?php
    $account = $_POST["account"];
    $password = $_POST["password"];
    //echo "account=",$account; 
    //echo "<br>";
    //echo "password=",$password; 
    

    //connect mysql and fetch data
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '70187017';
    $dbname = 'test';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);
    $sql = "SELECT * FROM `coach_list` WHERE Account = \"{$account}\"";
    //$sql = "INSERT INTO student_list (Account, Name, Password) VALUES ('novakdjokovicca', 'Novak Djokovic', 'isbetterthananyone')";
    $result = mysql_query($sql) or die('MySQL query error');
    if(mysql_num_rows($result)== 0){
	 echo "<br>There is no such account.";
    } 
    else{
    	 	$row = mysql_fetch_array($result);
 	 	if($row['Password']!=$password){
 	   		echo "<br>Password is incorrect";
		}	
 		else{
 			$name=$row['Name'];
 	   		echo "<br>",$name," 教練 ,歡迎來到陽光網球教練控制台";	
			
			$sql = "SELECT * FROM `current_class_list` WHERE Coach = '{$name}'";
			echo "<br>目前課程列表";
			$result = mysql_query($sql) or die('MySQL query error');    	
    			echo '<table border="1">';
			echo '<tr><th>Class</th><th>Level</th><th>Court</th><th>Time</th><th>StartDate</th></tr>';    
    			while($row = mysql_fetch_array($result)){
    				echo '<tr>';	
      			echo '<td>',$row['Class'],'</td><td>',$row['Level'],'</td><td>',$row['Court'],'</td><td>',$row['Time'],'</td><td>',$row['StartDate'],'</td>';
      			echo "</tr>";
    			}
    			echo '</table>';
    			
    			
    			
    			
                  $result = mysql_query($sql) or die('MySQL query error');
                  while($row = mysql_fetch_array($result)){	
      			echo "<br>",$row['Class'];
      			
      			echo "<br>課程內容簡介:";
    				for ($i = 1; $i <= 5; $i++) {
					$sql = "SELECT * FROM `class_teaching_material` WHERE Class = '{$row['Class']}' AND Number = {$i}";
    					$result4 = mysql_query($sql) or die('MySQL query error');
    					$row4 = mysql_fetch_array($result4);
    					echo "<br>第{$i}堂: ",$row4['Material'];
    				} 
      			
      			$sql = "SELECT * FROM `class_registered_list` WHERE Class = '{$row['Class']}'";
      			$result2 = mysql_query($sql) or die('MySQL query error');
                        echo "<br>學員列表";
      			echo '<table border="1">';
			      echo '<tr><th>Name</th><th>Level</th><th>Region</th></tr>';  
      			while($row2 = mysql_fetch_array($result2)){	
      				$sql = "SELECT * FROM `student_list` WHERE Account = '{$row2['Account']}'";
      				$result3 = mysql_query($sql) or die('MySQL query error');
      				$row3 = mysql_fetch_array($result3);
      				echo '<tr>';
      				// echo '<td>',$row3['Name'],'</td><td>',$row3['Level'],'</td><td>',$row3['Region'],'</td>';
      				echo '<td>',$row3['Name'],'</td><td>';
      			      //Level : coach can change student's Level using selection list , AJAX call change_level.php and response
      			      $level=$row3['Level'];
      			      $account=$row2['Account'];
 
      				echo '<select onchange="changeLevel(this.options[this.selectedIndex].value,\'',$account,'\')">';
      				for($i=1;$i <=5;$i+=0.5){
 						echo '<option value=',$i;
 						if($level == $i){
 							echo ' selected="true"';
 						}
 						echo '>NTRP',$i;
 						echo '</option>';
      				}
					echo '</select>';
      				
      				echo '</td><td>',$row3['Region'],'</td>';
      				echo '</tr>';
      			}
      			echo '</table>';

      			echo "<br>學員上課紀錄";
      			echo '<table border="1">';
			      echo '<tr><th>堂數</th><th>時間</th><th>參與學員</th></tr>'; 
      			for($i= 1; $i<=5; $i++){
      			      $sql = "SELECT * FROM `class_attending_record` WHERE Class = '{$row['Class']}' AND ClassNum = {$i}";
      			      $result5 = mysql_query($sql) or die('MySQL query error');
      			      $row5 =  mysql_fetch_array($result5);
      			      $time=$row5['Time'];
      			      echo '<tr>';
      				echo '<td>',$i,'</td><td>',$time,'</td><td>';
      			      $result5 = mysql_query($sql) or die('MySQL query error');
      			      while($row5 =  mysql_fetch_array($result5)){
      			      	$sql = "SELECT * FROM `student_list` WHERE Account = '{$row5['Account']}'";
      					$result6 = mysql_query($sql) or die('MySQL query error');
      					$row6 = mysql_fetch_array($result6);
      			      	echo $row6['Name'],",";
      			      }
      			      echo '</td></tr>';
      			      
      		      }
      		      echo '</table>';
    			}
		}
    	 
	}
?> 

</body>
<p>Suggestions: <span id="txtHin"></span></p>
</html> 