<?php
include_once 'db.php';
include_once 'session.php';
$user_id = $_SESSION['user_id'];

$name = $_POST['name'];
$description = $_POST['description'];
$pic = ($_FILES['photo']['name']);
$temp = explode(".", $_FILES["photo"]["name"]);
$newfilename = rand(1, 99999) . '.' . end($temp);

$target = "images/uploads/";
$target = $target . $newfilename;

//if (mysqli_connect_errno()) {
//echo "Failed to connect to MySQL: " . mysqli_connect_error();

if (!empty($name) && !empty($description) && !empty($pic)) {
    $query = "INSERT INTO categories (name, description, image, user_id) VALUES ('$name', '$description', '$newfilename', '$user_id')";
    
    if (mysqli_query($link, $query)) {
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            mysqli_query($link, "INSERT INTO user_logs (user_id, event) VALUES ('$user_id', 'User created a new category.')");
            mail($_SESSION['email'], 'User created new category', "You successfuly created a new category on BestOF.");
            header("Location: categories.php");
            die();
        } else {
            header('Location: categories.php?error=2');
            die();
        }
    } else {
        header('Location: categories.php?error=3');
        die();
    }
} else {
    header('Location: categories.php?error=4');
    die();
}
?>




