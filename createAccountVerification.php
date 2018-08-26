<?php 
	session_start();
	$usernameSafe='1';
	$usernameUnique='1';
	$passwordSafe='1';
	$passwordDif='1';
	$EmailClean='1';
	$EmailUnique='1';
	$Fnamesafe='1';
	$SNamesafe='1';
	require('connect.php');
	//username is clean?
	$username= filter_var($_POST['NUsername'], FILTER_SANITIZE_EMAIL);
	if (($username!=$_POST['NUsername']) or (strlen($username)<8) or (strlen($username)>32)) 
	{
		$usernameSafe='0';
	}
	//username is unique?
	else
	{
		$qry='SELECT UserID FROM Users WHERE(username = "'.$username.'");';
		$answertable = mysqli_query($connection, $qry);
	 	if (mysqli_num_rows($answertable)!=0)
		{
			//username is taken
			$usernameUnique= '0';
		}
	}
	//Password1 is clean?
	$Password1= filter_var($_POST['NPassword'], FILTER_SANITIZE_EMAIL);
	if (($Password1!=$_POST['NPassword']) or (strlen($Password1)<8) or (strlen($Password1)>32)) 
	{
		$passwordSafe='0';
	}
	//Password2 is clean?
	$Password2= filter_var($_POST['NPassword2'], FILTER_SANITIZE_EMAIL);
	if (($Password2!=$_POST['NPassword2']) or (strlen($Password2)<8) or (strlen($Password2)>32)) 
	{
		$passwordSafe='0';
	}
	//Password1=Password2?
	if ($Password1!=$Password2)
	{
		$passwordDif='0';
	}
	//Email is clean?
	$Email= filter_var($_POST['NEmail'], FILTER_SANITIZE_EMAIL);
	if (($Email!=$_POST['NEmail'])) 
	{
		$EmailSafe='0';
	}
	//Email is unique?	
	else
	{
		$qry='SELECT Email FROM Users WHERE(Email = "'.$Email.'");';
	 	if (mysqli_num_rows($answertable)!=0)
		{
			//Email is taken
			$EmailUnique= '0';
		}
	}
	//Fname is clean?
	$Fname= filter_var($_POST['NFName'], FILTER_SANITIZE_EMAIL);
	if (($Fname!=$_POST['NFName'])) 
	{
		$Fnamesafe='0';
	}
	//SName is clean?
	$Sname= filter_var($_POST['NSName'], FILTER_SANITIZE_EMAIL);
	if (($Sname!=$_POST['NSName'])) 
	{
		$Snamesafe='0';
	}
	//If '1' then create user
	if (($usernameSafe + $usernameUnique + $passwordSafe + $passwordDif + $EmailClean + $EmailUnique + $Fnamesafe + $SNamesafe) == 8)
	{
		$qry='INSERT INTO Users(Username, Password, FName, SName, Email, ProfPic) VALUES ("'.$username.'","'.(md5($Password1)).'","'.$Fname.'","'.$Sname.'","'.$Email.'","default.png")';
		$answertable=mysqli_query($connection,$qry);
		//find userID for them
		$qry='SELECT UserID FROM Users WHERE (Username = "'.$username.'");';
		$answertable = (mysqli_query($connection,$qry));
		$test = mysqli_num_rows($answertable);
		list($col1)= mysqli_fetch_row($answertable);
		$_SESSION['UserID']=$col1;


		//create mymusic playlist

		//create link between mymusic and userID


		//go to index page
		Header('Location: index.php');
	}
	else
	{
		Header('Location: createAccount.php?US='.$usernameSafe.'&UQ='.$usernameUnique.'&PS='.$passwordSafe.'&PD='.$passwordDif.'&EC='.$EmailClean.'&EU='.$EmailUnique.'&FS='.$Fnamesafe.'&SS='.$SNamesafe);
	}



?>