<?php
include_once 'header.php';
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    die();
}
?>

<!-- Main -->
<section id="main" class="wrapper">
    <div class="container">
        <header class="major">
            <h2>Login on BestOF</h2>
            <p>Already signed up? Log in to access your account!</p>

            <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                if ($error == 1) {
                    echo '<p class="alert">User wasn\'t found or it is registered with Facebook.</p>';
                }
                if ($error == 2) {
                    echo '<p class="alert">Please enter email and password for login.</p>';
                }
            }
            //preverjanje facebook napak
            if (isset($_GET['fb_error'])) {
                $error = $_GET['fb_error'];
                if ($error == 1) {
                    echo '<p class="alert">User wasn\'t registered correctly.</p>';
                }
                if ($error == 2) {
                    echo '<p class="alert">Facebook login wansn\'t successful..</p>';
                }
                if ($error == 3) {
                    echo '<p class="alert">Some Facebook data are missing.</p>';
                }
            }
            ?>

            <form method="post" action="login_check.php" >
                <div class="row uniform 50%">
                    <div class="12u 12u(4)">
                        <input type="email" name="email" placeholder="Email" />
                    </div>
                    <div class="12u 12u(4)">
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <div class="12u">
                        <ul class="actions">
                            <li><input type="submit" value="Login" /></li>
                        </ul>
                    </div>
                </div>
            </form>
        </header>
    </div>
</section>

<?php
include_once './footer.php';
?>