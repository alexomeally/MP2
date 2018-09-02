<?php
	session_start();
	require('connect.php');
	if(isset($_SESSION['UserID']))
	{
		if ($_SESSION['UserID'] == '-1') 
		{
			#not logged in
			Header('Location: login.php');
		}
	}
	else
	{
		//not logged in
		Header('Location: login.php');
	}

	//therefore is logged in
	//delete followers of created playlists
	$qry='DELETE FROM playlistfollowers WHERE PlaylistID in (SELECT PlaylistID FROM playlists WHERE UserID= "'.$_SESSION['UserID'].'");';
	mysqli_query($connection,$qry);

	//delete mysmusic playlist link
	$qry='DELETE FROM mymusic WHERE PlaylistID in (SELECT PlaylistID FROM playlists WHERE UserID= "'.$_SESSION['UserID'].'");';
	mysqli_query($connection,$qry);

	//delete playlist tracks
	$qry='DELETE FROM playlisttracks WHERE PlaylistID in (SELECT PlaylistID FROM playlists WHERE UserID= "'.$_SESSION['UserID'].'");';
	mysqli_query($connection,$qry);

	//delete playlists
	$qry='DELETE FROM playlists WHERE UserID= "'.$_SESSION['UserID'].'";';
	mysqli_query($connection,$qry);	

	//delete posts
	$qry='DELETE FROM posts WHERE UserID= "'.$_SESSION['UserID'].'";';
	mysqli_query($connection,$qry);	

	//delete listens
	$qry='DELETE FROM listens WHERE UserID= "'.$_SESSION['UserID'].'";';
	mysqli_query($connection,$qry);	

	//delete likedsongs
	$qry='DELETE FROM likedsongs WHERE UserID= "'.$_SESSION['UserID'].'";';
	mysqli_query($connection,$qry);	

	//delete followers
	$qry='DELETE FROM userfollowers WHERE Followed ="'.$_SESSION['UserID'].'";';
	mysqli_query($connection, $qry);

	//delete following
	$qry='DELETE FROM userfollowers WHERE Follower ="'.$_SESSION['UserID'].'";';
	mysqli_query($connection, $qry);

	//is the user an artist?
	$qry='SELECT UserID FROM artists WHERE UserID ="'.$_SESSION['UserID'].'";';
	if (list($_SESSION['UserID'])==mysqli_fetch_row(mysqli_query($connection, $qry)))
	{
		//user is an artist

		//delete link between tracks in your albums
		$qry='DELETE FROM albumtracks WHERE AlbumID in (SELECT AlbumID FROM albums WHERE UserID= "'.$_SESSION['UserID'].'");';
		mysqli_query($connection,$qry);	

		//delete albums
		$qry='DELETE FROM albums WHERE UserID= "'.$_SESSION['UserID'].'";';
		mysqli_query($connection,$qry);	

		//delete their tracks from playlists
		$qry='DELETE FROM playlisttracks WHERE TrackID in '

		//delete tracks where they are the only artist
		$qry='DELETE FROM tracks WHERE TrackID in (SELECT TrackID FROM trackartists WHERE );';
		mysqli_query($connection,$qry);	
	}




		Header('Location: login.php');
?>