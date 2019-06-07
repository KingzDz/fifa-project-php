<?php

session_start();

require 'config.php';
$id = $_GET['id'];

$team = "SELECT * FROM `team` WHERE id = $id";
$query = $db->query($team);
$teaminfo = $query->fetchAll(PDO::FETCH_ASSOC);


//slaat teamname op in een variable
$teamname = $teaminfo[0]['teamname'];

//haalt alle wedstrijden op uit de database
$match = "SELECT * FROM `matches` WHERE `team1` = '$teamname' OR `team2` = '$teamname'";
$query = $db->query($match);
$matches = $query->fetchAll(PDO::FETCH_ASSOC);

//haalt alle spelers die in dit team zitten op
$user = "SELECT * FROM user WHERE `team` = $id";
$query = $db->query($user);
$usernames = $query->fetchAll(PDO::FETCH_ASSOC);


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
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Add your site or application content here -->

<?php require 'header.php' ?>
<main>
    <div class="main-form">
        <img src="img/footballer.png" alt="footballer">
        <div class="create-form-background">
            <div class="title-form">
                <h3>Voeg goals toe</h3>
            </div>
            <form id="create-team-form" action="controllers/add-goals-controller.php?id=<?php echo $id; ?>" method="post">
                <label for="players">Speler die gescoord heeft</label>
<!--                loopt door alle spelers heen-->
                <select name="player" required="">
                    <?php foreach ($usernames as $username)
                    {
                        $title = htmlentities($username['username']);
                        ?>
                        <option value="<?php echo $username['id'] ?>"><?php echo $title ?></option>
                        <?php
                    }
                    ?>
                </select>
                <label for="players">Wedstrijd</label>
<!--                Loopt door alle wedstrijden heen-->
                <select name="match" required="">
                    <?php foreach ($matches as $match)
                    {       $team1 = $match['team1'];
                            $team2 = $match['team2'];
                        ?>
                        <option value="<?php echo $match['id'] ?>"><?php echo "$team1 tegen $team2" ?></option>
                        <?php
                    }
                    ?>
                </select>
                <label for="goals">Aantal goals:</label>
                <input type="number" step="1" name="goals"  min="1" max="15" required value="1">
                <input id="submit-team" type="submit" value="Toevoegen">
            </form>
            <button onclick="window.location.href = 'detail-team.php?id=<?php echo $id ?>';">Ga terug</button>
        </div>

    </div>
</main>
<?php require'footer.php' ?>

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

