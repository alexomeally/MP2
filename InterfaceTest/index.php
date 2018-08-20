<!DOCTYPE html>
<html>
<head>
	<title>MP3 PLAYER TEST</title>
</head>
<body>
<div> 
<table>
<tr>
<td>
<img src="Sir_Duke_Cover.jpg" width="200" height="200" alt = "Album Art">
</td>
</tr>
<tr>
<td>
<table>
	<tr>
		<td>
			<audio id = "player" controls><source src="Sir_Duke.mp3" type="audio/mp3" ></audio>
		</td>
	</tr>
	<tr>
		<td>  <button onclick="document.getElementById('player').play()">Play</button> 
  <button onclick="document.getElementById('player').pause()">Pause</button> 
  <button onclick="document.getElementById('player').volume += 0.1">Vol+ </button> 
  <button onclick="document.getElementById('player').volume -= 0.1">Vol- </button> </td></tr>
</table>
</td>
</tr>
</table>
</div>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>