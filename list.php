<?php
include 'header.php';
if (empty($_GET['list'])) {
    header('Location: categories.php');
    die();
}
$ct_id = (int) $_GET['ct'];
$list_id = (int) $_GET['list'];
$query = mysqli_query($link, "SELECT * FROM lists WHERE id = $list_id");
$list = mysqli_fetch_array($query);
$query2 = mysqli_query($link, "SELECT * FROM categories WHERE id = $ct_id");
$category = mysqli_fetch_array($query2);
$user_id = $_SESSION['user_id'];
?>

<!-- Main -->
<section id="main" class="wrapper">
    <div class="container">
        
        <header class="major">
            <h2><?php echo $list['title']; ?></h2>
            <p><h6><a href="category.php?ct=<?php echo $category['id']; ?>">Back to <?php echo $category['name']; ?> category</a> | <a href="list_pdf.php?list=<?php echo $list_id; ?>">Print PDF</a> | <a href="delete.php?user_id=<?php echo $user_id?>&list=<?php echo $list_id; ?>">Delete</a></h6></p>            
        </header>

        <a href="images/uploads/listings/<?php echo $list['image']; ?>" class="image fit bordered"><img src="images/uploads/listings/<?php echo $list['image']; ?>" alt="" /></a>
        <?php
        $query3 = mysqli_query($link, "SELECT AVG(value) as `average` FROM votes WHERE list_id = '$list_id'");
        $result3 = mysqli_fetch_array($query3);
        ?>
        <p>Overal rating: <?php echo number_format($result3['average'], 1); ?></p>
        
        <?php
        if (!empty($_GET['vote'])) {
            if ($_GET['vote'] == 1) {
                $value = $_GET['value'];
                echo '<p>You vote this listing with '.$value.'.</p>';
            }
        }
        ?>
        
        <form action="vote.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
            <input type="hidden" name="list" value="<?php echo $list_id; ?>" />
            <input type="hidden" name="ct" value="<?php echo $ct_id; ?>" />
            <div class="12u">
                <div class="select-wrapper">
                    <select name="grade">
                        <option value="0">VOTI FOR THIS LISTING</option>
                        <option value="1">1 - Bad</option>
                        <option value="2">2 - Not good</option>
                        <option value="3">3 - Normal</option>
                        <option value="4">4 - Good</option>
                        <option value="5">5 - Very good</option>
                    </select>
                </div>
            </div><br />
            <div class="12u">
                <ul class="actions">
                    <li><input type="submit" value="VOTE" class="special" /></li>
                </ul>
            </div>
        </form><hr />

        <p><?php echo $list['description']; ?></p>

    </div>
</section>

<?php
include 'footer.php';
?>