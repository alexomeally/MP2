<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>
<?php
$email = '`1234567890-=~!@#$%^&*()_+abcdefghijklmnopqrstuvwxyz[ ] \ {  } | ; > : " , . / < ? '."'";
echo $email;
echo '<br>';
$email = filter_var($email,FILTER_SANITIZE_EMAIL);

echo $email;
?>


<form method="GET" action="test.php">
	<input type="submit" name="submit">
	<input type="text" name="Steve">
	<input type="text" name="Bob">
</form>



</body>
</html>