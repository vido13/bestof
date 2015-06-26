<?php
include_once 'db.php';
include_once 'session.php';
$user_id = $_POST['user_id'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$pass3 = $_POST['pass3'];

if (!empty($user_id) && !empty($pass1) && !empty($pass2) && !empty($pass3)) {
    $query = mysqli_query($link, "SELECT * FROM users WHERE id = $user_id");
    $user = mysqli_fetch_array($query);
    
    $pass1 = sha1($pass1);
    if ($pass1 == $user['password']) {
        if ($pass2 == $pass3) {
            $pass2 = sha1($pass2);
            mysqli_query($link, "UPDATE users SET password = '$pass2' WHERE id = $user_id");
            mail($user['email'], 'Password changed', "Password was successfuly changed.");
            header('Location: profile.php?success=1');
            die();
        } else {
            header('Location: profile.php?error=1');
            die();
        }
    } else {
        header('Location: profile.php?error=2');
        die();
    }
} else {
    header('Location: profile.php?error=3');
    die();
}
?>




