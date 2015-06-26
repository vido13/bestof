<?php

include_once './session.php';
include_once './db.php';

$name = $_POST['name'];
$twitter_id = $_POST['id'];

if (!empty($name) && !empty($twitter_id)) {//preveri �e so vsi podatki
    $sql = "SELECT * FROM users WHERE twitter_id='$twitter_id'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) == 1) { //preveri �e uporabnik �e obstaja
        //že obstaja
        $user = mysqli_fetch_array($result);
        //v sejo shranim id, da vem, da je zdaj ta uporabnik prijavljen
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['twitter_id'] = $user['twitter_id'];
        $_SESSION['admin'] = $user['admin'];

        $user_id = $user['id'];
        mysqli_query($link, "INSERT INTO user_logs (user_id, event) VALUES ('$user_id', 'User is logged in with Twitter')");
        
        header("Location: index.php");
        die();
    } else {//�e uporabnik ne obstaja ga registrira ********************************************************
        //pri twitter uporabniku ne bom uporabil aktivacijski link zato bom postavil activated na "1"
        $insert = "INSERT INTO users (username, email, twitter_id) VALUES ('$name', '$email', '$twitter_id')";

        if (!mysqli_query($link, $insert)) {
            //�e je kak�na napaka, ga preusmerimo nazaj na login
            header("Location: login.php");
            die();
        }
        
        //vse je vredu, uporabnika lahko vpi�emo
        $sql2 = "SELECT * FROM users WHERE twitter_id='$twitter_id'";
        $result2 = mysqli_query($link, $sql2);

        if (mysqli_num_rows($result2) == 1) { //preveri �e uporabnik �e obstaja
            $user = mysqli_fetch_array($result2);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['twitter_id'] = $user['twitter_id'];
            $_SESSION['admin'] = $user['admin'];

            $user_id = $user['id'];
            mysqli_query($link, "INSERT INTO user_logs (user_id, event) VALUES ('$user_id', 'User is registered and logged in with Twitter')");
            header("Location: index.php");
            die();
        } else {
            header("Location: login.php");
            die();
        }
    }//******************************************register ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^ ^
} else {//gre nazaj na login ker nima vseh podatkov
    header("Location: login.php");
    die();
}
?>