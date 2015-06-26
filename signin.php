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
            <h2>Registration</h2>
            <p>Create an account to get the best experience on BestOF</p>
            
            <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                if ($error == 1) {
                    echo '<p class="alert">Entered passwords do not match.</p>';
                }
                if ($error == 2) {
                    echo '<p class="alert">Username or email already exists in the database.</p>';
                }
                if ($error == 3) {
                    echo '<p class="alert">Log query failed.</p>';
                }
                if ($error == 4) {
                    echo '<p class="alert">User registration failed.</p>';
                }
                if ($error == 5) {
                    echo '<p class="alert">Please enter all data.</p>';
                }
            }
            ?>
            
            <form method="post" action="user_insert.php">
                <div class="row uniform 50%">
                    <div class="12u 12u(4)">
                        <input class="text" type="text" name="username" placeholder="Username" />
                    </div>
                    <div class="12u 12u(4)">
                        <input class="text" type="text" name="email" placeholder="Email" />
                    </div>
                    <div class="12u 12u(4)">
                        <input type="password" name="pass" placeholder="Password" />
                    </div>
                    <div class="12u 12u(4)">
                        <input type="password" name="pass2" placeholder="Repeat password" />
                    </div>
                    <div class="12u">
                        <ul class="actions">
                            <li><input type="submit" value="Register" /></li>
                        </ul>
                    </div>
                </div>
            </form>
        </header>
    </div>
</section>

<?php
include_once 'footer.php';
?>