<?php session_start();
	if (!isset($_SESSION['UserID'])) 
	{ 
		$_SESSION['UserID']='-1'; //sets the UserID to -1 if there is no current UserID
	}?>
<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
</head>
<body>
	This is the index
	You have probably succeeded in coding if you reach here
	Nevermind there is still 99 more errors to remove
	<p> UserID=
	<?php echo ($_SESSION['UserID']);?>
	</p>

	<form action="login.php">
		<input type="submit" name="submit" value="returnToLogin">
	</form>
</body>
</html>