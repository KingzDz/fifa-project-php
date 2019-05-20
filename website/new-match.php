<?php
/**
 * Created by PhpStorm.
 * User: Isabella
 * Date: 20-5-2019
 * Time: 10:48
 */

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
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
                <h3>Nieuwe wedstrijd aanmaken: </h3>
            </div>
            <form id="create-team-form" action="controllers/tijd-schema-controller.php" method="post">

                <label for="game-start">Start tijd <small><i>(vanaf 09.00u)</i></small>:</label>
                <input type="time" name="starttime"  min="09:00" max="21:00" required>
                <br>

                <label for="game-break">Pauze :</label>
                <input type="time" name="pause"  min="00:00" max="00:30" required>
                <br>

                <label for="game-duration">Hoelang duurt het :</label>
                <input type="time" name="matchtime"  min="00:00" max="03:00" required>
                <br>

                <label for="fields">Veld :</label>
                <select name = "field" required>
                    <option value = "">Selecteer een veld</option>
                    <option value = "1">1</option>
                    <option value = "2">2</option>
                    <option value = "3">3</option>
                    <option value = "4">4</option>
                    <option value = "5">5</option>
                    <option value = "6">6</option>
                    <option value = "7">7</option>
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


