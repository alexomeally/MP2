<?php
	session_start();

	if (!isset($_SESSION['UserID'])) 
	{
		Header('Location: index.php');
	}
	elseif ($_SESSION['UserID']=='-1') 
	{
		Header('Location: index.php');
	}

	require('Connect.php');

	$qry='SELECT Username, Email, FName, SName, Profpic FROM users WHERE (UserID ="'.$_SESSION['UserID'].'");';
	$answertable=mysqli_fetch_row(mysqli_query($connection, $qry));

	$qry='SELECT UserID FROM artists WHERE(UserID="'.$_SESSION['UserID'].'");';
	$temp=mysqli_num_rows(mysqli_query($connection, $qry));
	if ($temp == '1')
	{
		$artistTrue=True;
		$qry='SELECT Artistname, Country, CovPic, Facebook, Instagram, Twitter, Website, Bio FROM artists WHERE(UserID= "'.$_SESSION['UserID'].'");';
		$artisttable= mysqli_fetch_row(mysqli_query($connection, $qry));
	}

	?>
<!DOCTYPE html>
<html>
<head>
	<title>myAccount</title>
</head>
<body>
	<form action="index.php">
		<input type="submit" name="Index" value="Index">
	</form>
	<p>
		UserID=
		<?php echo($_SESSION['UserID']); ?>
	</p>
	If any information you insert is too short, too long or contains wrong characters, your data will not be updated
	<br>
	<form method="POST" action="updateAccount.php">
		<input type="submit" value="Update Info">
		<br>
		<br>
		Username: <input type="text" name="NUsername" value= <?php echo('"'.$answertable[0].'"');?> ><br>
		Email: <input type="Email" name="NEmail" value= <?php echo('"'.$answertable[1].'"');?> ><br>
		Password: <input type="password" name="NPassword"><br>
		Confirm: <input type="password" name="NPassword2"><br>
		First Name: <input type="text" name="NFName" value=<?php echo('"'.$answertable[2].'"');?> ><br>
		Surname: <input type="text" name= "NSName" value= <?php echo('"'.$answertable[3].'"');?> ><br>
		Profile Picture: <input type="file" name="NProfPic" accept="img/*"><br>		

		<?php
			if (isset($artistTrue))
			{
				if ($artistTrue)
				{
					echo ('I am an artist<br>');
					echo (
						'Artist Name: <input type="text" name="NartistName" value="'.$artisttable['0'].'"><br>'.
						'Country: <select name="NCountry">
							<option value="Australia"');
							if('Australia'==$artisttable['1']){echo('selected');}
							echo('>Australia</option>
							<option value="England"');
							if('England'==$artisttable['1']){echo('selected');}
							echo('>England</option>
							<option value="United States of America"');
							if('United States of America'==$artisttable['1']){echo('selected');}
							echo('>United States of America</option>

							<option value="None"');
							if('None'==$artisttable['1']){echo('selected');}
							echo('>None</option>
						</select><br>'.
						'Cover Photo: <input type="file" name="NCovPic" accept="image/*"><br>'.
						'Facebook: <input type="text" name="NFacebook" value="'.$artisttable['3'].'"><br>'.
						'Instagram: <input type="text" name="NInstagram" value="'.$artisttable['4'].'"><br>'.
						'Twitter: <input type="text" name="NTwitter" value="'.$artisttable['5'].'"><br>'.
						'Website: <input type="text" name="NWebsite" value="'.$artisttable['6'].'"><br>'.
						'Bio: <textarea name="NBio"rows="16" cols="32">'.$artisttable['7'].'</textarea><br>'
					);
				}				
			}
			else
			{
				echo (
					'<input type="checkbox" name="becomeArtist" value="Yes"> Become an Artist'
				);
			}
		?>

		

	</form>

	<form action="deleteAccount.php">
		<input type="submit" name="delete" value="Delete Account">
	</form>
</body>
</html>