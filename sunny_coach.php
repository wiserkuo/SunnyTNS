<!DOCTYPE html>
<html>
<body>

<h1>Sunny Tennis Coach System</h1>
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
<script>
function getMaterial(classname){
        var xmlhttp = new XMLHttpRequest();
        var index =document.getElementById("selectNum").selectedIndex+1;
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("meterialTextArea").value = xmlhttp.responseText;
                document.getElementById("m").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "get_material.php?n="+index+"&c="+classname, true);
        xmlhttp.send();
       // document.write("index="+index);
}
</script>
<script>
function setMaterial(classname,classcount){
        var xmlhttp = new XMLHttpRequest();
        var index =document.getElementById("selectNum").selectedIndex+1;
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById('material'+classcount+'_'+index).innerHTML = xmlhttp.responseText;
              //document.getElementById('material1_2').innerHTML = xmlhttp.responseText;

            }
        };
        //var m="material"+class_count+"_"+index;
       // document.write(m);
        //document.write("\"material"+class_count+"_"+index+"\"");
       //  document.write("\n"+ document.getElementById("meterialTextArea").value);
        xmlhttp.open("GET", "set_material.php?m="+document.getElementById("meterialTextArea").value+"&n="+index+"&c="+classname, true);
        xmlhttp.send();	
}
</script>
<?php
// <form action="">
// First name: <input type="text" id="txt1" onkeyup="showHint(this.value)">
// </form>

// <p>Suggestions: <span id="txtHint"></span></p>



// <form onsubmit="changeLevel()">
//   <fieldset>
//     <legend>編輯上課教材:</legend>
//     <select onchange="changeLevel()">;
//     	<option value=1 selected="true">第1堂</option>
//     </select><br><br>
//     <textarea name="message" rows="10" cols="30">The cat was playing in the garden.</textarea><br>
//     <input type="submit" value="提交">
//   </fieldset>
// </form>
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
    			
    			
    		      $class_count=0;
    			
                  $result = mysql_query($sql) or die('MySQL query error');
                  while($row = mysql_fetch_array($result)){	
                  	$class_count+=1;
      			//echo "<br>",$row['Class'];
    	//echo "<fieldset> <legend>課程內容簡介:</legend>";
    	$materials = array();
//$arrlength = count($cars);

//for($x = 0; $x < $arrlength; $x++) {
  //  echo $cars[$x];
 //   echo "<br>";
//}
     
     echo "<fieldset>
     <legend>{$row['Class']} 課程內容簡介:</legend>";
    				for ($i = 1; $i <= 5; $i++) {
					$sql = "SELECT * FROM `class_teaching_material` WHERE Class = '{$row['Class']}' AND Number = {$i}";
    					$result4 = mysql_query($sql) or die('MySQL query error');
    					$row4 = mysql_fetch_array($result4);
    					echo "<br>第{$i}堂: <span id=\"material"  ,  $class_count,"_",$i, "\">",$row4['Material'],"</span>";
    					echo "<br>\"material",$class_count,"_",$i,"\""; 
    					$materials[$i]=$row4['Material'];
    				} 
      		
  				// echo '
  				// <form onsubmit="setMaterial(1,\'',$row['Class'],'\')">
  				echo '<fieldset>
    				<legend>編輯課程內容:</legend>';
    				echo '<select id="selectNum" onchange="getMaterial(\'' , $row['Class'] , '\')">';
    				echo'	<option value=1 selected="true">第1堂</option>
    					<option value=2>第2堂</option>
    					<option value=3>第3堂</option>
    					<option value=4>第4堂</option>
    					<option value=5>第5堂</option>
    				</select><br>
    				<textarea id="meterialTextArea" name="message" rows="10" cols="30">',$materials[1],'</textarea><br>
                        <button type="button" onclick="setMaterial(\'' ,$row['Class'], '\','  ,$class_count,')">提交</button>
  				</fieldset>
				';
      			
      echo "</fieldset>";      			
      		
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
<p>Suggestions: <span id="m"></span></p>
</html> 