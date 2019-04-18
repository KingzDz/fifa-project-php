<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 16-4-2019
 * Time: 10:26
 */

require 'config.php';
session_start();

$id = $_GET['id'];
$username = $_SESSION['id'];

$sql = "SELECT * FROM team WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':id' => $id
]);
$team = $prepare->fetch(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM user WHERE id = :id";
$prepare = $db->prepare($sql2);
$prepare->execute([
    ':id' => $username
]);
$user = $prepare->fetch(PDO::FETCH_ASSOC);
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
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a
        href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

    <?php require 'header.php' ?>
    <main>
        <div class="main-team">
            <h2>Teamnaam: <?php echo $team['teamname'] ?></h2>
            <p>Aantal spelers: <?php echo $team['players']?></p>
            <p>Leider: <?php echo $user['username'] ?></p>
        </div>
        <div class="edit-del">
            <a href="user-home.php">Ga terug</a>
            <a href="change-team.php?id=<?php echo $team['id'] ?>">Veranderen</a>
            <a href="controllers/delete-team.php?id=<?php echo $team['id'] ?>">Verwijderen</a>
        </div>
    </main>
    <?php require 'footer.php' ?>

    <script src="js/vendor/modernizr-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function () {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('set', 'transport', 'beacon');
        ga('send', 'pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    </body>

    </html>


