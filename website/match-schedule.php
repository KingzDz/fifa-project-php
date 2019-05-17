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

<?php require 'header.php'; ?>

<main class="main">
    <div class="container">
    	<h2>Wedstrijd Schema</h2>

<?php

require 'config.php';

$sql = "SELECT * FROM `match-schedule` WHERE `id` = 1;";
$prepare = $db->prepare($sql);
$prepare->execute();

$scheduleInfo = $prepare->fetchAll(PDO::FETCH_ASSOC);

// If match schedule is already generated
if ($scheduleInfo[0]['match-active'] == 1) {
	$sql = "SELECT `teamname` FROM `team`;";
	$prepare = $db->prepare($sql);
	$prepare->execute();

	$teams = $prepare->fetchAll(PDO::FETCH_ASSOC);

	$teamsLength = count($teams);
    ?>
        <table align="center">
            <tr>
                <th>Wedstrijden</th>
            </tr>
        <?php

	if ($teamsLength > 1) {

	    foreach ($teams as $team) {

	        $teams = array_slice($teams, 1, $teamsLength);

            foreach ($teams as $otherTeam) {
                echo '<tr>';
                $teamName = $team['teamname'];
                $otherTeamName = $otherTeam['teamname'];
                echo "<td>$teamName tegen $otherTeamName</td>";
                echo '</tr>';
            }
        }


	}
	else if ($teamsLength == 1) {
		echo 'Er is maar 1 team in de competitie. Het is dus niet mogelijk om een wedstrijd te spelen.';
	}
	else if ($teamsLength == 0) {
		echo 'Er zitten geen teams in de competitie.';
	}
        ?>
        </table>
    <?php



}
else {
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['admin'] == true) {
		echo 'Er is op dit moment geen competitie actief, klik op de knop hieronder om een competitie te genereren.';
		echo '<button onclick="window.location.href = \'generate-competition.php\';">Maak aan</button>';
	} else {
		echo 'Er is op dit moment geen competitie actief, voor meer info contact de organisator.';
	}
}
?>




	</div>
</main>