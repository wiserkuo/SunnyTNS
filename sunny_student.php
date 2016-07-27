<!DOCTYPE html>
<html>
<body>

<h1>Sunny Tennis Student System</h1>

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
    $sql = "SELECT * FROM `student_list` WHERE Account = \"{$account}\"";
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
 	   		echo "<br>親愛的學員 ",$row['Name']," ,歡迎來到陽光網球學員資訊中心";	

			$sql = "SELECT Class FROM `class_registered_list` WHERE Account = '{$account}' AND Status = 1";
			$result = mysql_query($sql) or die('MySQL query error');
    			$row = mysql_fetch_array($result);
    			$registered_class=$row['Class'];
    			echo "<br><br>您報名的課程 ",$registered_class;
                  
                  
			$sql = "SELECT * FROM `current_class_list` WHERE Class = '{$registered_class}'";
			$result = mysql_query($sql) or die('MySQL query error');
    			$row = mysql_fetch_array($result);
    			$court=$row['Court'];
    			$coach=$row['Coach'];
    			$level=$row['Level'];
    			echo "<br>場地： ",$court;
    			echo "<br>教練： ",$coach;
    			echo "<br>程度： ",$level;
    			echo "<br>課程內容簡介:";
    			for ($i = 1; $i <= 5; $i++) {
				$sql = "SELECT * FROM `class_teaching_material` WHERE Class = '{$registered_class}' AND Number = {$i}";
    				$result = mysql_query($sql) or die('MySQL query error');
    				$row = mysql_fetch_array($result);
    				echo "<br>第{$i}堂: ",$row['Material'];
    			} 
    			
    			$class=$registered_class; //*****************************
    			$sql = "SELECT * FROM `class_attending_record` WHERE Account = '{$account}'";
                  
			$result = mysql_query($sql) or die('MySQL query error');		
    			echo "<br><br>上課紀錄<br>";
    			echo '<table border="1">';
                  echo '<tr><th>課程</th><th>堂數</th><th>時間</th></tr>';
                  while($row = mysql_fetch_array($result)){
                  	echo '<tr>';	
                  	echo '<td>',$row['Class'],'</td><td>',$row['ClassNum'],'</td><td>',$row['Time'],'</td>';
                  	echo "</tr>";
                  }
    	            echo '</table>';    
    			
		}
    	 
	}
?> 



<?php
	require_once( __DIR__ . '/facebook-php-sdk-v4-5.0.0/src/Facebook/autoload.php' );
      session_start();
 # login-callback.php
	$fb = new Facebook\Facebook([
		'app_id' => '879101435534758',
  		'app_secret' => '922b0258158303fbd3aba6effbfd3cc1',
  		'default_graph_version' => 'v2.4',
	]);
	$helper = $fb->getRedirectLoginHelper();
	try {
  		$accessToken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
  	// When Graph returns an error
  		echo 'Graph returned an error: ' . $e->getMessage();
  		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
  	// When validation fails or other local issues
  		echo 'Facebook SDK returned an error: ' . $e->getMessage();
  		exit;
	}
	if (isset($accessToken)) {
  	// Logged in!
  		$_SESSION['facebook_access_token'] = (string) $accessToken;

  	// Now you can redirect to another page and use the
	// access token from $_SESSION['facebook_access_token']
  		echo "<br>accessToken = {$accessToken}";
	}
  
	try {
  		// Returns a `Facebook\FacebookResponse` object
  		$response = $fb->get('/me?fields=id,name,last_name,first_name,location,hometown,email,gender,about,locale', "{$accessToken}");
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
  		echo 'Graph returned an error: ' . $e->getMessage();
  		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
  		echo 'Facebook SDK returned an error: ' . $e->getMessage();
  		exit;
	}

	$user = $response->getGraphUser();

      echo '<br>Name: ' . $user['name'];
      echo '<br>First Name: ' . $user['first_name'];      
      echo '<br>Last Name: ' . $user['last_name'];
      echo '<br>ID: ' . $user['id'];
      echo '<br>Location: ' . $user['location'];
      echo '<br>Home Town: ' . $user['hometown'];
      echo '<br>E-mail: ' . $user['email'];
      echo '<br>Gender: ' . $user['gender'];      
      echo '<br>About: ' . $user['about'];     
      echo '<br>Locale: ' . $user['locale'];
      $account=$user['email'];
      $name=$user['name'];
      
      
      //connect mysql and fetch data
      $dbhost = 'localhost';
      $dbuser = 'root';
      $dbpass = '70187017';
      $dbname = 'test';
      $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
      mysql_query("SET NAMES 'utf8'");
      mysql_select_db($dbname);
      $sql = "SELECT * FROM `student_list` WHERE Account = \"{$account}\"";
      //$sql = "INSERT INTO student_list (Account, Name, Password) VALUES ('novakdjokovicca', 'Novak Djokovic', 'isbetterthananyone')";
      $result = mysql_query($sql) or die('MySQL query error');
      if(mysql_num_rows($result)== 0){
	    echo "<br>您經由Facebook登入!這是您首次登入將為您創建帳號";
	    //$sql = "SELECT * FROM `student_list` WHERE Account = \"{$account}\"";
          $sql = "INSERT INTO student_list (Account, Name, Password) VALUES ('{$account}', '{$name}', '{$accessToken}')";
          $result = mysql_query($sql) or die('MySQL query error');
          echo "<br>請重新更新網頁再登入一次";
      } 
      else {
		echo "<br>您經由Facebook登入!您已加入陽光網球學員系統";
		$row = mysql_fetch_array($result);
		echo "<br>親愛的學員 ",$row['Name']," ,歡迎來到陽光網球學員資訊中心";	

		$sql = "SELECT Class FROM `class_registered_list` WHERE Account = '{$account}' AND Status = 1";
		$result = mysql_query($sql) or die('MySQL query error');
		$row = mysql_fetch_array($result);
		if(mysql_num_rows($result)== 0){
			echo "<br>您尚未報名任何課程";
		}
		else{
			$registered_class=$row['Class'];
			echo "<br><br>您報名的課程 ",$registered_class;
	    		$sql = "SELECT * FROM `current_class_list` WHERE Class = '{$registered_class}'";
	    		$result = mysql_query($sql) or die('MySQL query error');
    	    		$row = mysql_fetch_array($result);
    	    		$court=$row['Court'];
    	    		$coach=$row['Coach'];
    	    		$level=$row['Level'];
    	    		echo "<br>場地： ",$court;
			echo "<br>教練： ",$coach;
    			echo "<br>程度： ",$level;
    			echo "<br>課程內容簡介:";
    			for ($i = 1; $i <= 5; $i++) {
				$sql = "SELECT * FROM `class_teaching_material` WHERE Class = '{$registered_class}' AND Number = {$i}";
    				$result = mysql_query($sql) or die('MySQL query error');
    				$row = mysql_fetch_array($result);
    				echo "<br>第{$i}堂: ",$row['Material'];
    			} 
    			
    			$class=$registered_class; //*****************************
    			$sql = "SELECT * FROM `class_attending_record` WHERE Account = '{$account}' ORDER BY ClassNum";
                  
			$result = mysql_query($sql) or die('MySQL query error');	
			if(mysql_num_rows($result)== 0){
				echo "<br>您尚未有任何上課紀錄";
			}
			else{
    				echo "<br><br>上課紀錄<br>";
    				echo '<table border="1">';
                  	echo '<tr><th>課程</th><th>堂數</th><th>時間</th></tr>';
                  	while($row = mysql_fetch_array($result)){
                  		echo '<tr>';	
                  		echo '<td>',$row['Class'],'</td><td>',$row['ClassNum'],'</td><td>',$row['Time'],'</td>';
                  		echo "</tr>";
                  	}
    	            	echo '</table>';
			}
			
			$sql = "SELECT * FROM `class_message` WHERE Account = '{$account}' ORDER BY ClassNum";
                  
			$result = mysql_query($sql) or die('MySQL query error');	
			if(mysql_num_rows($result)== 0){
				echo "<br>您尚未有任何上課互動資訊";
			}
			else{
    				echo "<br><br>上課心得<br>";
    				echo '<table border="1">';
                  	echo '<tr><th>課程</th><th>堂數</th><th>心得</th></tr>';
                  	while($row = mysql_fetch_array($result)){
                  		echo '<tr>';	
                  		echo '<td>',$row['Class'],'</td><td>',$row['ClassNum'],'</td><td>',$row['Message'],'</td>';
                  		echo "</tr>";
                  	}
    	            	echo '</table>';
			}
		}   
      }

?> 
</body>
</html> 