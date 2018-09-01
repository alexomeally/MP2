<?php
	session_start();
	require('connect.php');



	//username
	$username= filter_var($_POST['NUsername'], FILTER_SANITIZE_EMAIL);
	if (!(($username!=$_POST['NUsername']) or (strlen($username)<8) or (strlen($username)>32))) 
	{
		//Username is safe
		$qry='SELECT UserID FROM users WHERE(username = "'.$username.'");';
		$answertable = mysqli_query($connection, $qry);
	 	if (mysqli_num_rows($answertable)=='0')
		{
			//username is unique
			//update username
			$qry='UPDATE users SET Username = "'.$username.'" WHERE UserID = '.$_SESSION['UserID'];
			mysqli_query($connection,$qry);
		}
	}
	//Email
	$Email= filter_var($_POST['NEmail'], FILTER_SANITIZE_EMAIL);
	if (!(($Email!=$_POST['NEmail']) or (strlen($Email)<8) or (strlen($Email)>32))) 
	{
		//Email is safe
		$qry='SELECT UserID FROM users WHERE(Email = "'.$Email.'");';
		$answertable = mysqli_query($connection, $qry);
	 	if (mysqli_num_rows($answertable)=='0')
		{
			//Email is unique
			//update Email
			$qry='UPDATE users SET Email = "'.$Email.'" WHERE UserID = '.$_SESSION['UserID'];
			mysqli_query($connection,$qry);
		}
	}
	$passwordSafe='1';
	$passwordDif='1';
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
	//set
	if ($passwordSafe+$passwordDif=='2')
	{
		$qry='UPDATE users SET UPassword = "'.(md5($Password1)).'" WHERE UserID = '.$_SESSION['UserID'];
		mysqli_query($connection,$qry);
	}

	//FName
	$FName= filter_var($_POST['NFName'], FILTER_SANITIZE_EMAIL);
	if (!($FName!=$_POST['NFName'])) 
	{
		//FName is safe
		//update FName
		$qry='UPDATE users SET FName = "'.$FName.'" WHERE UserID = '.$_SESSION['UserID'];
		mysqli_query($connection,$qry);
	}
	

	//SName
	$SName= filter_var($_POST['NSName'], FILTER_SANITIZE_EMAIL);
	if (!($SName!=$_POST['NSName']))
	{
		//SName is safe
		//update SName
		$qry='UPDATE users SET SName = "'.$SName.'" WHERE UserID = '.$_SESSION['UserID'];
		mysqli_query($connection,$qry);
	}
	//Profile Picture
	if (!(is_null($_POST['NProfPic'])))
	{
		$ProfPic='images/'.basename($_POST['NProfPic']).'.png';
		$qry='UPDATE users SET ProfPic = "'.$ProfPic.'" WHERE UserID = '.$_SESSION['UserID'];
	}


	//artistname
	if (isset($_POST['NartistName']))
	{
		//artistName
		$artistName= filter_var($_POST['NartistName'], FILTER_SANITIZE_SPECIAL_CHARS);
		if (!(($artistName!=$_POST['NartistName']) or (strlen($artistName)>64))) 
		{
			//artistName is safe
			//update artistName
			$qry='UPDATE artists SET Artistname = "'.$artistName.'" WHERE UserID = '.$_SESSION['UserID'];
			mysqli_query($connection,$qry);
		}
	}
	//country
	if (isset($_POST['NCountry']))
	{
		$Country=$_POST['NCountry'];
		//update Country
		$qry='UPDATE artists SET Country = "'.$Country.'" WHERE UserID = '.$_SESSION['UserID'];
		mysqli_query($connection,$qry);
	}
	//facebook
	if (isset($_POST['NFacebook']))
	{
		if(filter_var($_POST['NFacebook'], FILTER_VALIDATE_URL))
		{
			//link is safe
			$qry='UPDATE artists SET Facebook = "'.$_POST['NFacebook'].'" WHERE UserID = '.$_SESSION['UserID'];
			mysqli_query($connection,$qry);
		}
	}
	//Instagram
	if (isset($_POST['NInstagram']))
	{
		if(filter_var($_POST['NInstagram'], FILTER_VALIDATE_URL))
		{
			//link is safe
			$qry='UPDATE artists SET Instagram = "'.$_POST['NInstagram'].'" WHERE UserID = '.$_SESSION['UserID'];
			mysqli_query($connection,$qry);
		}
	}
	//Twitter
	if (isset($_POST['NTwitter']))
	{
		if(filter_var($_POST['NTwitter'], FILTER_VALIDATE_URL))
		{
			//link is safe
			$qry='UPDATE artists SET Twitter = "'.$_POST['NTwitter'].'" WHERE UserID = '.$_SESSION['UserID'];
			mysqli_query($connection,$qry);
		}
	}
	//Website
	if (isset($_POST['NWebsite']))
	{
		if(filter_var($_POST['NWebsite'], FILTER_VALIDATE_URL))
		{
			//link is safe
			$qry='UPDATE artists SET Website = "'.$_POST['NWebsite'].'" WHERE UserID = '.$_SESSION['UserID'];
			mysqli_query($connection,$qry);
		}
	}

	//Cover Picture
	if (isset($_POST['NCovPic']))
	{
		if (!(is_null($_POST['NProfPic'])))
		{
			$CovPic='images/'.basename($_POST['NProfPic']).'.png';
			$qry='UPDATE users SET ProfPic = "'.$ProfPic.'" WHERE UserID = '.$_SESSION['UserID'];
		}	
	}


	//Bio
	if (isset($_POST['NBio']))
	{
		if(filter_var($_POST['NBio'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW))
		{
			//link is safe
			$qry='UPDATE artists SET Bio = "'.$_POST['NBio'].'" WHERE UserID = '.$_SESSION['UserID'];
			mysqli_query($connection,$qry);
		}
	}
	//become an artist
	if (isset($_POST['becomeArtist']))
	{
		if($_POST['becomeArtist']=='Yes')
		{
			//has been clicked
			$qry='INSERT INTO artists (UserID, Artistname, Country, CovPic) VALUES ("'.$_SESSION['UserID'].'", "'.$FName.' '.$SName.'", "None", "defaultcov.png");';
			mysqli_query($connection, $qry);

		}
	}




	header('Location: myAccount.php');
?>