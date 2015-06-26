<?php
 $username = 'root';
$password = '';
$server = 'localhost';
$db_name = 'bestof'; 


$link = mysqli_connect($server, $username, $password, $db_name);
mysqli_query($link, "SET NAMES 'utf8'");
?>