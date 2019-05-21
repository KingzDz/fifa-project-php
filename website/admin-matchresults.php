<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 15-4-2019
 * Time: 14:20
 */

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['admin'] == true) {

    $username = $_SESSION['id'];
    require 'config.php';

    $sql = "SELECT * FROM team";
    $query =$db->query($sql);
    $teams = $query->fetchAll(PDO::FETCH_ASSOC);

    $competition = array();
    $competition['matches'] = array();

    foreach ($teams as $team){
        $teams = array_slice($teams, 1 , count($teams));
        foreach ($teams as $opponoment) {

            if($team['teamname'] != $opponoment['teamname']){
                array_push($competition['matches'], $team['teamname'] . ' - ' . $opponoment['teamname']);

            }
        }
    }
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
        <style>
            form .score{
                margin: 50px;
                display: flex;
                justify-content: space-around;
            }
            form .score input{
                width: 60px;
            }
        </style>
    </head>

    <body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a
        href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

    <?php require 'header.php' ?>
    <main>
        <div class="main-form">
            <img src="img/footballer.png" alt="footballer">
            <div class="create-form-background">
                <div class="title-form">
                    <h3>Wedstrijdresultaten instellen</h3>
                </div>
                <form id="result-form" action="controllers/matchresults-controller.php" method="post">
                    <label for="matches">Wedstrijd</label>
                    <select name="matches">
                        <?php
                        foreach ($competition['matches'] as $matches){
                            echo "<option value='$matches'>$matches</option>";
                        }
                        ?>

                    </select>
                    <div class="score">
                        <input type="number" min="0" max="15" value="0" name="teamone">
                        <p> : </p>
                        <input type="number" min="0" max="15" value="0" name="teamtwo">
                    </div>
                    <input id="submit-team" type="submit" value="Instellen">
                </form>
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


