<?php
include_once 'header.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    die();
}
$user_id = $_SESSION['user_id'];
$ct_id = $_GET['ct'];

$query = "SELECT * FROM categories WHERE id = $ct_id";
$result = mysqli_query($link, $query);
$category = mysqli_fetch_array($result);
?>

<!-- Main -->
<section id="main" class="wrapper">
    <div class="container">
        <header class="major">
            <p>This is the <strong><?php echo $category['name']; ?></strong> category. Browse through listings and add your own.</p>
            <a href="createlist.php?ct=<?php echo $ct_id; ?>" class="button medium">Add new listings</a>
            <a href="print_pdf.php?ct=<?php echo $ct_id; ?>" class="button medium">Print PDF</a>
            <a href="delete.php?ct=<?php echo $ct_id; ?>" class="button medium">Delete</a>
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
                            $query2 = "SELECT * FROM lists WHERE category_id = $ct_id";
                            $result2 = mysqli_query($link, $query2);
                            $count = mysqli_num_rows($result2);

                            if ($count == 0) {
                                echo '<section class="4u">';
                                echo '<p>There are no lists entered yet.</p>';
                                echo '</section>';
                            } else {
                                while ($list = mysqli_fetch_array($result2)) {
                                    ?>
                                    <section class="4u">
                                        <a href="images/uploads/listings/<?php echo $list['image']; ?>">
                                            <img class="image_featured" src="images/uploads/listings/<?php echo $list['image']; ?>" alt="" title="<?php echo $list['title']; ?>">
                                        </a>
                                        <div class="box">
                                            <p><h4><a href="list.php?list=<?php echo $list['id']; ?>&ct=<?php echo $ct_id; ?>" class="button">"<?php echo $list['title']; ?>"</a></h4></p>
                                            <p><?php echo '<h4>' . $list['description'] . '</h4>'; ?></p>
                                            <?php
                                            if ($_SESSION['admin'] != 0) {
                                                echo '<p><h6><a href="delete.php?list=' . $list['id'] . '">[ Delete this category ]</a></h6></p>';
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