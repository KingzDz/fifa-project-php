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

$zero =0;

$sql = "SELECT * FROM team WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':id' => $id
]);
$team = $prepare->fetch(PDO::FETCH_ASSOC);

$teamleader = $team['leader'];

$sql2 = "SELECT * FROM user WHERE id = :id";
$prepare = $db->prepare($sql2);
$prepare->execute([
    ':id' => $teamleader
]);
$user = $prepare->fetch(PDO::FETCH_ASSOC);

$playernames = "SELECT * FROM user WHERE team = $id";
$query = $db->query($playernames);
$players = $query->fetchAll(PDO::FETCH_ASSOC);

$teamname = $team['teamname'];

$match = "SELECT * FROM `goals` WHERE `teamid` = $id";
$query = $db->query($match);
$matches = $query->fetchAll(PDO::FETCH_ASSOC);

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
            <div class="info-table">
            <table>
                <tr>
                    <th>Teamnaam</th>
                    <th>Punten</th>
                    <th>Aantal spelers</th>
                    <th>Leider</th>
                </tr>
                <tr>
                    <td><?php echo $team['teamname'] ?></td>
                    <td><?php echo $team['points'] ?></td>
                    <td><?php echo $team['players']?></td>
                    <td><?php echo $user['username'] ?></td>
                </tr>
            </table>
            </div>

            <div class="player-table" align="center">
                <p>Spelers</p>
            <table>
                <tr>
                </tr>
                <tr>
                    <?php foreach ($players as $player)
                    {
                        $playername = htmlentities($player['username']);

                        echo "<td>$playername</td>";

                    }?>
                </tr>
            </table>
            </div>
            <p>Scoorders</p>
            <div class="info-table">
                <table>
                    <tr>
                        <th>Wedstrijd</th>
                        <th>Speler</th>
                        <th>Goals</th>
                    </tr>

                        <?php foreach ($matches as $match) {
//                            table voor de goals per speler per wedstrijd
                            echo"<tr>";
//                            haalt de wedstrijden op uit de database
                            $teamid = $match['matchid'];
                            $matchinfo = "SELECT * FROM `matches` WHERE `id` = $teamid";
                            $query = $db->query($matchinfo);
                            $matchesinfo = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($matchesinfo as $item) {
                                $team1 = $item['team1'];
                                $team2 = $item['team2'];

                                echo "<th>$team1 tegen $team2</th>";
                            }
//                            haalt de spelers uit het team op
                            $playerid = $match['playerid'];
                            $playerinfo = "SELECT `username` FROM `user` WHERE `id` = $playerid";
                            $query = $db->query($playerinfo);
                            $playersinfo = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($playersinfo as $item) {
                                $playername = $item['username'];

                                echo "<th>$playername</th>";
                            }

                            $goals = $match['goals'];
                            echo "<th>$goals</th>";
                            echo "</tr>";
                        }
                        ?>
                </table>
            </div>


        </div>
        <div class="edit-del">
            <?php if($_SESSION['admin'] == true){
                ?>
                <a href="admin-page.php">Ga terug</a>
                <?php
            }else{
                ?>
                <a href="user-home.php">Ga terug</a>
            <?php
            }
            ?>
            <?php
//            kijkt of je leider van het team ben, zo ja heb je meer rechten
            if($teamleader == $username){
                ?>
                <a href="change-team.php?id=<?php echo $team['id'] ?>">Veranderen</a>
                <a href="add-players.php?id=<?php echo $team['id'] ?>">Spelers toevoegen</a>
                <a href="add-goals.php?id=<?php echo $team['id'] ?>">Scoorders toevoegen</a>
            <?php
            }
            //            kijkt of je admin bent, zo ja heb je meer rechten
            else if($_SESSION['admin'] == true){
                ?><a href="controllers/delete-team.php?id=<?php echo $team['id'] ?>">Verwijderen</a>
                <a href="change-team.php?id=<?php echo $team['id'] ?>">Veranderen</a><?php
            }
            ?>
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


