<?php

include_once 'db.php';
include_once 'session.php';

if (!empty($_GET)) {
    if (!empty($_GET['ct'])) {
        if ($_SESSION['admin'] == 0) {
            header('Location: index.php');
            die();
        } else {
            $ct = (int) $_GET['ct'];
            mysqli_query($link, "DELETE FROM lists WHERE category_id = $ct");
            mysqli_query($link, "DELETE FROM categories WHERE id = $ct");
            header('Location: categories.php');
            die();
        }
    } else if (!empty($_GET['list'])) {
        $list = (int) $_GET['list'];
        $user_id = $_GET['user_id'];
        mysqli_query($link, "DELETE FROM votes WHERE list_id = $list AND user_id = $user_id");
        mysqli_query($link, "DELETE FROM lists WHERE id = $list AND user_id = $user_id");
        header('Location: categories.php');
        die();
    }
} else {
    header('Location: index.php');
    die();
}
?>