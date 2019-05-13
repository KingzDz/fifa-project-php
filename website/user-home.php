<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 15-4-2019
 * Time: 14:20
 */

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

    $username = $_SESSION['id'];
    require 'config.php';

    $sql = "SELECT * FROM team";

    $query =$db->query($sql);
    $teams = $query->fetchAll(PDO::FETCH_ASSOC);

    $sqluser = "SELECT * FROM team WHERE leader = '$username'";

    $query =$db->query($sqluser);
    $teamuser = $query->fetchAll(PDO::FETCH_ASSOC);

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
        <div class="main-user">
            <div class="teams">
                <h2>Teams die meedoen</h2>

                <?php
                if(empty($teams))
                {
                    ?>
                    <h2>Er zijn nog geen teams aangemaakt</h2>
                    <?php
                }
                else
                {
                    foreach ($teams as $team)
                    {
                        $title = htmlentities($team['teamname']);
                        if($team['leader'] != $username){
                            echo "<li><a href='detail-team.php?id={$team['id']}'> $title</a></li>";
                        }
                        else{

                        }

                    }

                    $countuser = count($teamuser);

                    if($countuser == 1)
                    {
                        echo  "<h2>Je bent leider van $countuser team</h2>";

                    }
                    else
                    {
                        echo  "<h2>Je bent leider van $countuser teams</h2>";
                    }
                    foreach ($teams as $team)
                    {
                        $title = htmlentities($team['teamname']);
                        if($team['leader'] == $username){
                            echo "<li><a href='detail-team.php?id={$team['id']}'> $title</a></li>";
                        }
                        else{

                        }

                    }

                }
                ?>
            </div>
            <div class="create-team-button">
                <button onclick="window.location.href = 'create-team.php';">Team maken</button>
                <button onclick="window.location.href = 'controllers/log-out.php';">Uitloggen</button>
                <button onclick="window.open('Fifa-projectapp.zip')">Download</button>
            </div>
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
    <?php
}
else{
    header("Location: user-login.php");
    exit();
}
?>


