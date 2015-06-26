<?php
include 'session.php';
include 'db.php';

$name = $_POST['name'];
$surname = $_POST['last'];
$facebook_id = $_POST['id'];
$email = $_POST['email'];

if (!empty($name) && !empty($surname) && !empty($facebook_id) && !empty($email)) {
    $sql = mysqli_query($link, "SELECT * FROM users WHERE facebook_id = '$facebook_id'");
    if (mysqli_num_rows($sql) == 1) {
        $user = mysqli_fetch_array($sql);
        //prijava uporabnika
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['fb_id'] = $user['facebook_id'];
        $_SESSION['admin'] = $user['admin'];
        
        $user_id = $user['id'];
        mysqli_query($link, "INSERT INTO user_logs (user_id, event) VALUES ('$user_id', 'User is logged in with Facebook')");
        header("Location: index.php");
        die();
    } else {
        //če uporabnik ne obstaja ga registrira
        $surname = strtoupper($surname);
        $full_name = $name . ' ' . $surname;
        $insert = mysqli_query($link, "INSERT INTO users (username, email, facebook_id) VALUES ('$full_name', '$email', '$facebook_id')");
        if (!$insert) {
            header("Location: login.php?fb_error=1");
            die();
        }
        mail($email, 'User registered with Facebook', "You successfuly registered with Facebook on BestOF.");

        //uporabnika smo registrirali, sedaj ga lahko vpišemo
        $sql = mysqli_query($link, "SELECT * FROM users WHERE facebook_id = '$facebook_id'");
        if (mysqli_num_rows($sql) == 1) {
            $user = mysqli_fetch_array($sql);
            //prijava uporabnika
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['fb_id'] = $user['facebook_id'];
            $_SESSION['admin'] = $user['admin'];
            
            $user_id = $user['id'];
            mysqli_query($link, "INSERT INTO user_logs (user_id, event) VALUES ('$user_id', 'User is registered and logged in with Facebook')");
            
            header("Location: index.php");
            die();
        } else {
            header("Location: login.php?fb_error=2");
            die();
        }
    }
} else {
    //gre nazaj na login ker nima vseh podatkov
    header("Location: login.php?fb_error=3");
    die();
}

include('footer.php');
?>