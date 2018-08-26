<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create an Account</title>
</head>
<body>
	<form method="POST" action="createAccountVerification.php">
		Username:
		<input type="text" name="NUsername" required>
		<?php 
			if(isset($_GET['US'])) 
			{
				if($_GET['US']=='False') 
					{
						echo(' Username does not fit parameters.');
					} 
			} 
			if(isset($_GET['UQ'])) 
			{
				if($_GET['UQ']=='False') 
					{
						echo(' Username is alreaday taken.');
					} 
			} ?>
		<br>
		Email:
		<input type="Email" name="NEmail" required>
		<br>
		Password:
		<input type="Password" name="NPassword" required>
		<?php 
			if(isset($_GET['PS'])) 
			{
				if($_GET['PS']=='False') 
					{
						echo(' Password does not fit parameters.');
					} 
			} 
		?>
		<br>
		Password:
		<input type="Password" name="NPassword2"  required>
		<?php 
		if(isset($_GET['PD'])) 
			{
				if($_GET['PD']=='False') 
					{
						echo(' Passwords are not the same.');
					} 
			} ?>
		<br>
		<br>
		First Name:
		<input type="text" name="NFName" required>
		<?php 
			if(isset($_GET['FS'])) 
			{
				if($_GET['FS']=='False') 
					{
						echo(' First Name does not fit parameters.');
					} 
			} ?>
		<br>
		Surname:
		<input type="text" name="NSName" required>
		<?php 
			if(isset($_GET['SS'])) 
			{
				if($_GET['SS']=='False') 
					{
						echo(' Surname does not fit parameters.');
					} 
			} ?>
		<br>
		<br>
		<input type="submit" name="CreateAccount">



	</form>


</body>
</html>