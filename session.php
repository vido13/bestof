<?php
session_start();

//preverimo, če ima uporabnik pravico dostopa do strani
/* if (!isset($_SESSION['user_id']) && $_SERVER['REQUEST_URI'] != '/BestOfNeki/login.php' && $_SERVER['REQUEST_URI'] != '/BestOfNeki/signin.php' && $_SERVER['REQUEST_URI'] != '/BestOfNeki/index.php') {
    header("Location: login.php");
    die();
} */
?>