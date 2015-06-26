<?php
include_once 'db.php';
include_once 'session.php';
?>

<!DOCTYPE html>
<!--
        Transit by TEMPLATED
        templated.co @templatedco
        Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>BestOf by VJ</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="js/jquery.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-layers.min.js"></script>
        <script src="js/init.js"></script>
        <noscript>
        <link rel="stylesheet" href="css/skel.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-xlarge.css" />
        </noscript>
        <link rel="stylesheet" href="css/messi.css" />
        <script src="js/messi.js"></script>
    </head>
    <body>

        <!-- Header -->
        <header id="header">
            <h1><a href="index.php">BestOf by VJ</a></h1>
            <nav id="nav">
                <ul>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<li class="active"><a href="index.php">Homepage</a></li>';
                        echo '<li><a href="categories.php">Categories</a></li>';
                        echo '<li><a id="messi" href="logout.php">Log out</a></li>';
                    } else {
                        echo '<li class="active"><a href="index.php">Homepage</a></li>';
                        echo '<li><a href="signin.php">Sign In</a></li>';
                        echo '<li><a href="login.php">Log In</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </header>
		
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60786160-1', 'auto');
  ga('send', 'pageview');

</script>