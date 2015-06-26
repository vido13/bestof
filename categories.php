<?php
include_once 'header.php';
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    die();
}
?>

<!-- Main -->
<section id="main" class="wrapper">
    <div class="container">

        <header class="major">
            <h2>Categories</h2>
            <p>This are <strong>Best of</strong> categories. You can add listings to a specific category or add a new one.</p>
            <a href="createcat.php" class="button medium">Create new category</a><br />
            <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                if ($error == 1) {
                    echo '<h5>To create a category, you need to be an administrator.</h5>';
                }
                if ($error == 2) {
                    echo '<h5>Sorry, there was a problem uploading your file.</h5>';
                }
                if ($error == 3) {
                    echo '<h5>Sorry, there was a problem creating a category.</h5>';
                }
                if ($error == 4) {
                    echo '<h5>Please enter all data.</h5>';
                }
            }
            ?>
            <br /><hr />
            <div id="extra">
                <div class="container">
                    <div class="row no-collapse-1">
                        <?php
                        if (!empty($_SESSION['user_id'])) {
                            $u_id = $_SESSION['user_id'];
                            $query = "SELECT * FROM categories";
                            $result = mysqli_query($link, $query);
                            $count = mysqli_num_rows($result);

                            if ($count == 0) {
                                echo '<section class="4u">';
                                echo '<p>There are no categories created yet.</p>';
                                echo '</section>';
                            } else {
                                while ($category = mysqli_fetch_array($result)) {
                                    ?>
                                    <section class="4u">
                                        <a href="images/uploads/<?php echo $category['image']; ?>">
                                            <img class="image_featured" src="images/uploads/<?php echo $category['image']; ?>" alt="" title="<?php echo $category['name']; ?>">
                                        </a>
                                        <div class="box">
                                            <p><h4><a href="category.php?ct=<?php echo $category['id']; ?>" class="button">"<?php echo $category['name']; ?>"</a></h4></p>
                                            <p><?php echo '<h4>' . $category['description'] . '</h4>'; ?></p>
                                            <?php
                                            if ($_SESSION['admin'] != 0) {
                                                echo '<p><h6><a href="delete.php?ct='.$category['id'].'">[ Delete this category ]</a></h6></p>';
                                            }
                                            ?>
                                        </div>
                                        
                                    </section>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </header>
    </div>
</section>

<?php
include_once 'footer.php';
?>
