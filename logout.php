<?php
include_once 'db.php';
include_once 'session.php';
$user_id = $_SESSION['user_id'];
mysqli_query($link, "INSERT INTO user_logs (user_id, event) VALUES ('$user_id', 'User logged out')");
session_destroy();
header('Location: index.php');
die();
?>
