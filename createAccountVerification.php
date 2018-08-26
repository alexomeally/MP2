<?php 
	session_start();
	$usernameSafe=True;
	$usernameUnique=True;
	$passwordSafe=True;
	$passwordDif=True;
	$EmailClean=True;
	$EmailUnique=True;
	$Fnamesafe=True;
	$SNamesafe=True;
	require('connect.php');
	//username is clean?
	$username= filter_var($_POST['Nusername'], FILTER_SANITIZE_EMAIL);
	if (($username!=$_POST['Nusername']) or (strlen($username)<8) or (strlen($username)>32)) 
	{
		$usernameSafe=False;
	}
	//username is unique?
	else
	{
		$qry='SELECT UserID FROM Users WHERE(username = "'.$username.'");';
		$answertable = mysqlu_query($connection, $qry);
	 	if (sqli_num_rows($answertable!=0))
		{
			//username is taken
			$usernameUnique= False;
		}
	}
	//Password1 is clean?
	$Password1= filter_var($_POST['NPassword1'], FILTER_SANITIZE_EMAIL);
	if (($Password1!=$_POST['NPassword1']) or (strlen($Password1)<8) or (strlen($Password1)>32)) 
	{
		$passwordSafe=False;
	}
	//Password2 is clean?
	$Password2= filter_var($_POST['NPassword2'], FILTER_SANITIZE_EMAIL);
	if (($Password2!=$_POST['NPassword2']) or (strlen($Password2)<8) or (strlen($Password2)>32)) 
	{
		$passwordSafe=False;
	}
	//Password1=Password2?
	if ($Password1!=$Password2)
	{
		$passwordDif=False;
	}
	//Email is clean?
	$Email= filter_var($_POST['NEmail'], FILTER_SANITIZE_EMAIL);
	if (($Email!=$_POST['NEmail'])) 
	{
		$EmailSafe=False;
	}
	//Email is unique?	
	else
	{
		$qry='SELECT Email FROM Users WHERE(Email = "'.$Email.'");';
	 	if (sqli_num_rows($answertable!=0))
		{
			//Email is taken
			$EmailUnique= False;
		}
	}
	//Fname is clean?
	$Fname= filter_var($_POST['NFName'], FILTER_SANITIZE_EMAIL);
	if (($Fname!=$_POST['NFName'])) 
	{
		$Fnamesafe=False;
	}
	//SName is clean?
	$Sname= filter_var($_POST['NSName'], FILTER_SANITIZE_EMAIL);
	if (($Sname!=$_POST['NSName'])) 
	{
		$Snamesafe=False;
	}
	//If true then create user
	if ($usernameSafe and $usernameUnique and $passwordSafe and $passwordDif and $EmailClean and $EmailUnique and $Fnamesafe and $SNamesafe)
	{
		$qry='INSERT INTO Users (Username, Password, FName, SName, Email, ProfPic) VALUES ("'.$username.'","'.(md5($Password1)).'","'.$FName.'","'.$SName.'","'.$Email.'","default.php")';
		$answertable = mysqli_query($connection,$qry);
		//find userID for them
		$qry='SELECT UserID FROM Users WHERE (Username="'.$Username.'");';
		$answertable = mysqli_query($connection,$qry);
		list($col1)=$answertable;
		$_SESSION['UserID']=$col1;
		Header('Location: index.php');
	}
	else
	{
		Header('Location: createAccount.php?US='.$usernameSafe.'&UQ='.$usernameUnique.'&PS='.$passwordSafe.'&PD='.$passwordDif.'&EC='.$EmailClean.'&EU='.$EmailUnique.'&FS='.$Fnamesafe.'&SS='.$SNamesafe);
	}



?>