<?php
include_once 'header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    die();
}
$user_id = $_SESSION['user_id'];
$query = mysqli_query($link, "SELECT * FROM users WHERE id = $user_id");
$user = mysqli_fetch_array($query);

$facebook_id = $_SESSION['fb_id'];
if (!empty($facebook_id)) {
    header('Location: index.php');
    die();
}
?>

<!-- Main -->
<section id="main" class="wrapper">
    <div class="container">

        <header class="major">
            <h2><?php echo $user['username']; ?></h2>
            <p>Edit your profile settings</p>
            
            <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                if ($error == 1) {
                    echo '<h5>New passwords do not match.</h5>';
                }
                if ($error == 2) {
                    echo '<h5>Current password is incorrect.</h5>';
                }
                if ($error == 3) {
                    echo '<h5>Please enter all data.</h5>';
                }
            }
            if (isset($_GET['success'])) {
                $success = $_GET['success'];
                if ($success == 1) {
                    echo '<h5>Password was successfuly changed.</h5>';
                }
            }
            ?>
            
            <br /><hr />

            <form method="post" action="change_password.php" >
                <div class="row uniform 50%">
                    <div class="12u 12u(4)">
                        Old password:<br />
                        <input class="text" type="password" name="pass1" />
                    </div>
                    <div class="12u 12u(4)">
                        New password:<br />
                        <input class="text" type="password" name="pass2" />
                    </div>
                    <div class="12u 12u(4)">
                        New password again:<br />
                        <input class="text" type="password" name="pass3" />
                        <input class="text" type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
                    </div>
                    <div class="12u">
                        <ul class="actions">
                            <li><input type="submit" value="Change password" class="special" /></li>
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