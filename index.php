<?php
include_once 'header.php';

if (!empty($_SESSION['user_id'])) {
    $u_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id=$u_id;";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_array($result);
    ?>
    <!-- Banner -->
    <section id="banner">
        <div class="container">
            <header class="major">
                <h2>Welcome, <?php echo $user['username']; ?>!</h2>
                <br /><p>View and edit your profile:</p>
                <p><a href="profile.php" class="button medium">Profile</a></p>
                <p>Browse through categories:</p>
                <p><a href="categories.php" class="button medium">Categories</a></p>
            </header>
        </div>
    </section>

    <?php
} else {
    ?>
    <!-- Banner -->
    <section id="banner">
        <div class="container">
            <header class="major">
                <h2>Welcome to Best of!</h2>
                <p>Sign in to get the best experience!</p>
                <p><a href="signin.php" class="button medium">Sign in</a></p>
                <p>Already an user? Log in to your account!</p>
                <p><a href="login.php" class="button medium">Log in</a><br/><br/>
                    <?php
                    include 'fb_login.php';
                    ?>
                    
                </p>
            </header>
        </div>
    </section>

    <?php
}
include_once 'footer.php';
?>

