<?php session_start();
	if (!isset($_SESSION['UserID'])) 
	{ 
		$_SESSION['UserID']='-1'; //sets the UserID to -1 if there is no current UserID
	}?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
<?php
	if(!(isset($_SESSION['UserID'])) or ($_SESSION['UserID'] == '-1')) 
	{ 
		echo ('<h3>Login</h3>
	<form name = "adderer" method="POST" action="loginRedirect.php">
		<table>
			<tr>
				<td>
					<h4>Name</h4>
				</td>
				<td>
					<input type="text" name="username" autofocus=1 value="">	
				</td>
			</tr>
			<tr>
				<td>
					<h4>Password</h4>
				</td>
				<td>
					<input type="Password" name="UPassword">
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="submit" value="Login">
				</td>
				<td>');
		if (isset($_GET['Incorrect'])) 
		{
			if ($_GET['Incorrect']==1)
			{
				echo('Incorrect Username or Password');
			}
		}
		
		echo ('
				</td>
			</tr>
		</table>

	</form>');
	}
	else
	{
		echo '<p> You are already logged in

	<form method="POST" action="loginRedirect.php">
		<input type="submit" name="logout" value="Log Out">
	</form>

		';
	} ?>
	<br><br><br>
	<form action="index.php">
		<input type="submit" name="Index" value="Index">
	</form>

</body>
</html>