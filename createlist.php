<?php
include_once 'header.php';
$ct_id = $_GET['ct'];
?>

<section id="main" class="wrapper">
    <div class="container">
        <header class="major">
            <h2>Add a new listing</h2>

            <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                if ($error == 1) {
                    echo '<h5>Sorry, there was a problem uploading your file.</h5>';
                }
                if ($error == 2) {
                    echo '<h5>Sorry, there was a problem creating a listing.</h5>';
                }
                if ($error == 3) {
                    echo '<h5>Please enter all data.</h5>';
                }
            }
            ?>

            <form method="post" enctype="multipart/form-data" action="list_insert.php?ct=<?php echo $ct_id; ?>" >
                <div class="row uniform 50%">
                    <div class="6u 12u(4)">
                        <input class="text" type="text" name="name" placeholder="Name" />
                    </div>
                    <div class="6u 12u(4)">
                        <input type="text" class="text" name="description" placeholder="Description" />
                    </div>
                    <div class="12u 12u(4)">
                        <input type="file" class="file" name="photo" placeholder="Image" />
                    </div>
                    <div class="12u">
                        <ul class="actions">
                            <li><input type="submit" value="Add listing" class="special" /></li>
                            <li><input type="reset" value="Reset" /></li>
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