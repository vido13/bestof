<?php
include_once 'db.php';
include_once 'session.php';
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    die();
}

$username = $_POST["username"];
$email = $_POST["email"];
$pass1 = $_POST["pass"];
$pass2 = $_POST["pass2"];

if (!empty($username) && !empty($email) && !empty($pass1) && !empty($pass2)) {
    if ($pass1 != $pass2) {
        header("Location: signin.php?error=1");
        die();
    }
    
    $pass1 = sha1($pass1);
    $query = "SELECT * FROM users WHERE ((username='$username') OR (email='$email'));";
    $result = mysqli_query($link, $query);
    
    if (mysqli_num_rows($result) != 0) {
        header("Location: signin.php?error=2");
        die();
    }
    
    //zapis v žabo
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$pass1');";
    if (mysqli_query($link, $query)) {
        //vse je ok zapisal se je v bazo
        $query = "SELECT id FROM users WHERE ((username='$username') AND (email='$email'));";
        $result = mysqli_query($link, $query);
        $user_id = mysqli_fetch_array($result);
        $user_id = $user_id['id'];
        $query2 = "INSERT INTO user_logs (user_id, event) VALUES ('$user_id', 'User created');";

        if (mysqli_query($link, $query2)) {
            mail($email, 'User registered', "You successfuly registered on BestOF.");
            header("Location: index.php");
            die();
        } else {
            //napaka pri zapisu v log
            header("Location: signin.php?error=3");
        }
    } else {
        //napaka pri zapisu v bazo, verjetno tak email že obstaja
        header("Location: signin.php?error=4");
    }
} else {
    //neki je narobe
    header("Location: signin.php?error=5");
    die();
}
?>