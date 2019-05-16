<?php
session_start();
?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>FIFA-project</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">

    <meta name="theme-color" content="#fafafa">
</head>

<body>
<!--[if IE]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Add your site or application content here -->
<main>
    <div class="main-content">
        <div class="nav-index">
            <div class="navigation">
                <a href="index.php">Home</a>
                <img src="img/FIFA-logo.png" alt="FIFA-logo">

                <?php 
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo '<a href="user-home.php">Account</a>';
                }
                else {
                    echo '<a href="user-login.php">Login</a>';
                }
                ?>
            </div>
        </div>

        <div class="title">
            <h1>Welkom op FIFA project</h1>
            <h2>Bekijk hieronder de schema's</h2>
            <button onclick="window.location.href = 'match-schedule.php';">Schema's</button>
            <button onclick="window.location.href = 'about.php';">Meer info?</button>
        </div>


    </div>
    <div class="bar"></div>
    <div class="intro-home">
        <div class="title-home">
            <h3>Info</h3>
            <p>Alles over het toernooi</p>
        </div>
        <div class="text-home">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aspernatur
                at beatae, blanditiis debitis delectus dicta expedita facilis hic illum ipsa pariatur
                possimus quas qui quisquam rem similique tempore velit?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aspernatur
                at beatae, blanditiis debitis delectus dicta expedita facilis hic illum ipsa pariatur
                possimus quas qui quisquam rem similique tempore velit?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aspernatur
                at beatae, blanditiis debitis delectus dicta expedita facilis hic illum ipsa pariatur
                possimus quas qui quisquam rem similique tempore velit?</p>
        </div>
    </div>
    <?php require 'footer.php'?>
</main>


<script src="js/vendor/modernizr-3.7.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('set','transport','beacon'); ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>

</html>
