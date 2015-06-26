<?php
include_once 'db.php';
include_once 'session.php';

$ct_id = $_GET['ct'];
$u_id = $_SESSION['user_id'];

$title = $_POST['name'];
$description = $_POST['description'];
$pic = ($_FILES['photo']['name']);
$temp = explode(".", $_FILES["photo"]["name"]);
$newfilename = rand(1, 99999) . '.' . end($temp);

$target = "images/uploads/listings/";
$target = $target . $newfilename;

//if (mysqli_connect_errno()) {
//echo "Failed to connect to MySQL: " . mysqli_connect_error();

if (!empty($title) && !empty($description) && !empty($pic)) {
    $query = "INSERT INTO lists (title, description, image, user_id, category_id) VALUES ('$title', '$description', '$newfilename', '$u_id', '$ct_id')";
    if (mysqli_query($link, $query)) {
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            $user_id = $_SESSION['user_id'];
            mysqli_query($link, "INSERT INTO user_logs (user_id, event) VALUES ('$user_id', 'User created new listing')");
            mail($_SESSION['email'], 'User created new listing', "You successfuly created a new listing on BestOF.");
            header("Location: category.php?ct=$ct_id");
            die();
        } else {
            header("Location: createlist.php?error=1&ct=$ct_id");
            die();
        }
    } else {
        header("Location: createlist.php?error=2&ct=$ct_id");
        die();
    }
} else {
    header("Location: createlist.php?error=3&ct=$ct_id");
    die();
}
?>
