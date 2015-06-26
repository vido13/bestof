<?php
include_once 'db.php';
include_once 'session.php';

$user_id = $_POST['user_id'];
$list_id = $_POST['list'];
$value = $_POST['grade'];
$ct = $_POST['ct'];

mysqli_query($link, "INSERT INTO votes (value, user_id, list_id) VALUES ('$value', '$user_id', '$list_id')");
header('Location: list.php?list='.$list_id.'&ct='.$ct.'&value='.$value.'&vote=1');
die();
?>




