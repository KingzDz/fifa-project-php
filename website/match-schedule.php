<?php session_start(); ?>

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

// Fetches match info like time, match duration, etc. from database
$sql = "SELECT * FROM `match-schedule` WHERE `id` = 1;";
$prepare = $db->prepare($sql);
$prepare->execute();
$scheduleInfo = $prepare->fetchAll(PDO::FETCH_ASSOC);

//
$hour = $scheduleInfo[0]['starttimehour'];
$matchDuration = $scheduleInfo[0]['matchtime'];
$rest = $scheduleInfo[0]['pause'];
$zero = 0;
$minutes = $scheduleInfo[0]['starttimemin'];
$fields = $scheduleInfo[0]['fields'];
$matches = 0;
$played = 0;
$field = 1;

$startTime = date($hour.':'.$minutes); // Time when the first matches are played

// Checks whether the competition is already generated
if ($scheduleInfo[0]['match-active'] == 1) {

    // Fetches all teams from the database
	$sql = "SELECT `teamname` FROM `team`;";
	$prepare = $db->prepare($sql);
	$prepare->execute();

	$teams = $prepare->fetchAll(PDO::FETCH_ASSOC);

	$teamsLength = count($teams);
    ?>

        <table align="center">
            <tr>
                <th>Wedstrijden</th>
                <th>Tijd</th>
                <th>Veld</th>
            </tr>

    <?php

    // When there is more then one team
	if ($teamsLength > 1) {

        // This generates the match schedule
	    foreach ($teams as $team) {

	        $teams = array_slice($teams, 1, $teamsLength); // Removes the first team everytime so you get a half competition

            foreach ($teams as $rivalTeam) {

                // Time when this match ends
                $endTime = date('h:i', strtotime('+'.$matchDuration.' minutes', strtotime($startTime)));

                echo '<tr>';
                    $teamName = $team['teamname'];
                    $rivalTeamName = $rivalTeam['teamname'];
                    echo "<td>$teamName tegen $rivalTeamName</td>";
                    echo "<td>$startTime</td>";
                    echo"<td>$field</td>";
                echo '</tr>';

                // Time when the next game gets played
                $startTime = date('h:i', strtotime('+'.$rest.' minutes', strtotime($endTime)));
            }

            // If there are fields available
            if ($field < $fields) {

                $field++; // Next team plays on next field

                // Resets time so different matches can play on the same time
                $startTime = date($hour.':'.$minutes);
            }
            // When all fields are ocupied
            else {
                $startTime = date('h:i', strtotime('+'.$rest.' minutes', strtotime($endTime)));
            }
        }


	    echo "</table>";
        echo "<p>*Een wedstrijd duurt $matchDuration min</p>";
        echo "<p>*Tussen de wedstrijden zit $rest min pauze</p>";
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
// When competition is not yet generated
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
    <?php require 'footer.php'; ?>
</main>