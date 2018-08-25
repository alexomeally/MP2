<?php
	//The cookie is not being used, it is commented for archiving only
	//$cookie_name = "UserID";
	//$cookie_userID = "-1";
	//setcookie($cookie_name, $cookie_userID, time() + (86400*30), "/"); //setcookie creates variable which is used anywhere, time + 86400*30 means that the cookie will expire in 30 days and the "/" means the variable can be used anywhere on the website
	session_start();
	if (isset($_POST['submit'])) {
		require ('connect.php');
		//go get raw data
		$username = $_POST['username'];
		$UPassword = md5($_POST['UPassword']);
		//plateitup
		$qry = 'SELECT UserID FROM Users WHERE (username = "'.$username.'" AND UPassword="'.$UPassword.'");';
		//execute it
		$answertable = mysqli_query($connection,$qry);
		$_SESSION['UserID']='-1';
		if (mysqli_num_rows($answertable)==0)	
		{
			
			//redirect back to login page with get statement in URL
			header('Location: login.php?Incorrect=1');
		}
		else
		{
			//set cookie
			list($_SESSION['UserID'])=mysqli_fetch_row($answertable);
			//redirect to index.php
			header('Location: index.php');
			
		}
	}

?>