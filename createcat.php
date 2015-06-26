<?php
include_once 'header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    die();
}
if ($_SESSION['admin'] == 0) {
    header('Location: categories.php?error=1');
    die();
}
?>

<!-- Main -->
<section id="main" class="wrapper">
    <div class="container">

        <header class="major">
            <h2>Create new category</h2>
            <p>Create a category you belive will attract clever or funny listings. Start with Best of...</p>
            <br /><hr />

            <form method="post" enctype="multipart/form-data" action="cat_insert.php" >
                <div class="row uniform 50%">
                    <div class="6u 12u(4)">
                        <input class="text" type="text" name="name" placeholder="Name" />
                    </div>
                    <div class="6u 12u(4)">
                        <input type="text" class="text"  name="description" placeholder="Description" />
                    </div>
                    <div class="12u 12u(4)">
                        <input type="file" class="file"  name="photo" placeholder="Image" />
                    </div>
                    <div class="12u">
                        <ul class="actions">
                            <li><input type="submit" value="Create category" class="special" /></li>
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