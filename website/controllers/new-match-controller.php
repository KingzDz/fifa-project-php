<?php
/**
 * Created by PhpStorm.
 * User: Isabella
 * Date: 20-5-2019
 * Time: 11:16
 */
require '../config.php';
session_start();

$starttimemin = $_POST['starttimeminutes'];
$starttimehour = $_POST['starttimehours'];
$pause = $_POST['pause'];
$matchtime = $_POST['matchtime'];
$fields = $_POST['field'];
$id = 1;

    if($starttimehour < 9 || $starttimehour > 20 || $starttimemin < 0 || $starttimemin > 60 || $pause < 0 || $pause > 30 || $matchtime < 0 || $matchtime > 60 || $fields < 1 || $fields > 7){
        echo "Je hebt verkeerde info ingevoerd,  je wordt nu terug gestuurd.";
        header("refresh:4;url=../new-match.php");
        exit();
    }
    if (isset($_POST['submit'])) {

        $sql = "UPDATE `match-schedule` SET starttimehour = :starth, starttimemin = :startm, matchtime = :matchtime, pause = :pause, fields = :fields WHERE id = :id";

        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':starth'   => $starttimehour,
            ':startm'   => $starttimemin,
            ':matchtime'=> $matchtime,
            ':pause'    => $pause,
            ':fields'   => $fields,
            ':id'       => $id
        ]);

        $sql = "SELECT * FROM `match-schedule` WHERE `id` = 1;";
        $prepare = $db->prepare($sql);
        $prepare->execute();
        $scheduleInfo = $prepare->fetchAll(PDO::FETCH_ASSOC);


        $sql = "SELECT * FROM `team`;";
        $prepare = $db->prepare($sql);
        $prepare->execute();

        $teams = $prepare->fetchAll(PDO::FETCH_ASSOC);

        $teamsLength = count($teams);

        $hour = $scheduleInfo[0]['starttimehour'];
        $matchDuration = $scheduleInfo[0]['matchtime'];
        $rest = $scheduleInfo[0]['pause'];
        $zero = 0;
        $minutes = $scheduleInfo[0]['starttimemin'];
        $fields = $scheduleInfo[0]['fields'];
        $matches = 0;
        $played = 0;
        $field = 1;
        $referee = 0;

        $startTime = date($hour.':'.$minutes); // Time when the first matches are played

        if ($teamsLength > 1) {

            // This generates the match schedule
            foreach ($teams as $team) {

                $teams = array_slice($teams, 1, $teamsLength); // Removes the first team everytime so you get a half competition

                foreach ($teams as $rivalTeam) {

                    // Time when this match ends
                    $endTime = date('h:i', strtotime('+'.$matchDuration.' minutes', strtotime($startTime)));

                    $teamName = $team['teamname'];
                    $rivalTeamName = $rivalTeam['teamname'];

                    $sqlmatch = "INSERT  INTO matches (team1, team2, field, timematch, referee) VALUES (:team1, :team2, :field, :timematch, :referee)";
                    $prepare = $db->prepare($sqlmatch);
                    $prepare->execute([
                        ':team1'    => $teamName,
                        ':team2'    => $rivalTeamName,
                        ':field'    => $field,
                        ':timematch'=> $startTime,
                        ':referee'  => $referee,
                    ]);


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
        }

        echo "Schema is succesvol aangemaakt !";
        header("refresh:4;url=../admin-page.php");
    } else {
        echo "Schema toevoegen is mislukt,  je wordt nu terug gestuurd.";
        header("refresh:4;url=../new-match.php");
    }
