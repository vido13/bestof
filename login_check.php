<?php
include_once 'db.php';
include_once 'session.php';
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    die();
}

$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($email) && !empty($password)) {
    //vse je ok
    $password = sha1($password);
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_array($result);
    //preveri, če takšen user obstaja
    if (mysqli_num_rows($result) == 1) {
        //uporabnik obstaja
        $user_id = $user['id'];
        mysqli_query($link, "INSERT INTO user_logs (user_id, event) VALUES ('$user_id', 'User is logged in')");

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['admin'] = $user['admin'];

        header("Location: index.php");
        die();
    } else {
        header('Location: login.php?error=1');
        die();
    }
} else {
    header('Location: login.php?error=2');
    die();
}
?>