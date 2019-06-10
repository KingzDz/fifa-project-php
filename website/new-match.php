<?php
/**
 * Created by PhpStorm.
 * User: Isabella
 * Date: 20-5-2019
 * Time: 10:48
 */

session_start();

//kijkt of je admin bent

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['admin'] == true) {
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

<?php require 'header.php' ?>
<main>
    <div class="main-form">
        <img src="img/footballer.png" alt="footballer">
        <div class="create-form-background">
            <div class="title-form">
                <h3>Toernooi tijden opgeven: </h3>
            </div>
            <form id="create-team-form" action="controllers/new-match-controller.php" method="post">

                <label for="game-start">Aanvang toernooi <small><i>(vanaf 09.00u)</i></small>:</label>
                <div class="starttime">
                    <input id="starttime" type="number" name="starttimehours"  min="9" max="20" required value="9">
                    <input id="starttime1" type="number" step="10" name="starttimeminutes"  min="00" max="59" required value="00">
                </div>

                <br>

                <label for="game-break">Pauze :</label>
                <input type="number" name="pause"  min="0" max="30" required value="5">
                <br>

                <label for="game-duration">Hoelang duurt een wedstrijd :</label>
                <input type="number" name="matchtime"  min="0" max="60" required value="20">
                <br>

                <label for="fields">Aantal speelvelden :</label>
                <select name = "field" required>
                    <option value = "">Selecteer een veld</option>
                    <option value = "1">1</option>
                    <option selected value = "2">2</option>
                    <option value = "3">3</option>
                    <option value = "4">4</option>
                    <option value = "5">5</option>
                    <option value = "6">6</option>
                    <option value = "7">7</option>
                </select>
                <br>

                <label for="pouleSelect">Kies een poule :</label>
                <select name = "pouleSelect" required>
                    <option value = "A">A</option>
                    <option value = "B">B</option>
                    <option value = "C">C</option>
                    <option value = "D">D</option>
                    <option value = "E">E</option>
                    <option value = "F">F</option>
                </select>
                <br>

                <input id="submit-team" type="submit" name="submit" value="Opslaan">

            </form>
        </div>

    </div>
</main>
<?php
}
else{
    header("Location: user-login.php");
    exit();
}
?>
<?php require'footer.php' ?>


