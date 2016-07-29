<html>
<body>
<p>學員登入
<form action="sunny_student.php" method="post">
Account: <input type="text" name="account"><br>
Password: <input type="text" name="password"><br>
<input type="submit">
</form>
<?php
	require_once( __DIR__ . '/facebook-php-sdk-v4-5.0.0/src/Facebook/autoload.php' );
      session_start();
	$fb = new Facebook\Facebook([
		'app_id' => '879101435534758',
  		'app_secret' => '922b0258158303fbd3aba6effbfd3cc1',
  		'default_graph_version' => 'v2.4',
	]);

	$helper = $fb->getRedirectLoginHelper();
	$permissions = ['email', 'user_likes']; // optional
	$loginUrl = $helper->getLoginUrl('http://wiser.synology.me/sunny_student.php', $permissions);

	echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
?> 
</p><br><br>


<p>教練登入
<form action="sunny_coach.php" method="post">
Account: <input type="text" name="account" value="ricklin@gmail.com"><br>
Password: <input type="text" name="password" value="0987654321"><br>
<input type="submit">
</form>
</p>


</body>
</html>
