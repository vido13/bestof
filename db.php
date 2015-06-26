<?php
 $username = 'root';
$password = '';
$server = 'localhost';
$db_name = 'bestof'; 
/*
$username = 'u248967365_vido';
$password = 'vido66';
$server = 'mysql.hostinger.co.uk';
$db_name = 'u248967365_vido';*/

$link = mysqli_connect($server, $username, $password, $db_name);
mysqli_query($link, "SET NAMES 'utf8'");
?>