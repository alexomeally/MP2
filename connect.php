<?php
/* set the connections to the database */
$host     = 'localhost';
$username = 'root';
$passwd   = '';
$dbname   = 'doubletcloud';

/* build a bridge to the server */
$connection = mysqli_connect($host, $username, $passwd) or die('problems connecting');

/* connect to the database through that bridge */
mysqli_select_db($connection,$dbname) or die ('problems finding the database');
?>