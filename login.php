<?php
	mysql_connect ("localhost", "root","");
	mysql_select_db("db_name") or die (mysql_error());
	session_start();
	if (isset($_POST['login']) && isset($_POST['password'])){

		$login = $_POST['login'];
		$password = md5(trim($_POST['password']));
     
    		$sql_query = "SELECT id, login FROM users WHERE user_login='$login' AND user_password='$password'";
    		$sql = mysql_query($sql_query) or die(mysql_error());
    		
		if (mysql_num_rows($sql) == 1) {

        		$row = mysql_fetch_assoc($sql); 
			$_SESSION['id'] = $row['id'];
			$_SESSION['login'] = $row['login'];
		
   		} else {
        
			header("Location: login.php"); 
    		}
	}

	if (isset($_SESSION['id'])) {

		echo htmlspecialchars($_SESSION['login'])." you are logged in";
	} else {
		$login = '';

		print <<<  html
				<form action="login.php" method="POST">
					login <input name="login" type="text"><br>
					password <input name="password" type="password"><br>
					<input name="submit" type="submit" value="log in">
				</form>
		   	   html;
	}
?>
