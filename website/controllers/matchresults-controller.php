<?php
/**
 * Created by PhpStorm.
 * User: timo0
 * Date: 20-5-2019
 * Time: 12:20
 */
require '../config.php';
session_start();

$firstscore = $_POST['teamone'];
$secondscore = $_POST['teamtwo'];

$matches = $_POST['matches'];
$teams = explode('-', $matches);

if ($firstscore != null && $secondscore != null && $_SESSION['admin'] == true){
    $sql = "INSERT INTO matchresults (firstteam, firstscore, secondteam, secondscore) VALUES (:firstteam, :firstscore, :secondteam, :secondscore)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':firstteam'    => trim($teams[0]),
        ':firstscore'   => $firstscore,
        ':secondteam'   => trim($teams[1]),
        ':secondscore'  => $secondscore
    ]);
    header("Location: ../admin-page.php");

    $pointsteamone = "SELECT * FROM team WHERE teamname = :id";
    $prepare = $db->prepare($pointsteamone);
    $prepare->execute([
        ':id' => trim($teams[0])
    ]);
    $team1 = $prepare->fetch(PDO::FETCH_ASSOC);

    $pointsteamtwo = "SELECT * FROM team WHERE teamname = :id";
    $prepare = $db->prepare($pointsteamtwo);
    $prepare->execute([
        ':id' => trim($teams[1])
    ]);
    $team2 = $prepare->fetch(PDO::FETCH_ASSOC);

    if($firstscore > $secondscore){
        $score = 3 + $team1['points'];

        $sql = "UPDATE team SET points = :points WHERE teamname = :teamname";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':points' => $score,
            ':teamname' => trim($teams[0])
        ]);
    }
    else if($firstscore == $secondscore){
        $score1 = 1 + $team1['points'];
        $score2 = 1 + $team2['points'];

        $sql = "UPDATE team SET points = :points WHERE teamname = :teamname";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':points' => $score1,
            ':teamname' => trim($teams[0])
        ]);

        $sql = "UPDATE team SET points = :points WHERE teamname = :teamname";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':points' => $score2,
            ':teamname' => trim($teams[1])
        ]);
    }
    else if($secondscore > $firstscore){
        $score = 3 + $team2['points'];

        $sql = "UPDATE team SET points = :points WHERE teamname = :teamname";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':points' => $score,
            ':teamname' => trim($teams[1])
        ]);
    }
}
else{
    echo 'Geef de score mee! Je word nu teruggestuurd';
    header( "refresh:4;url=../admin-matchresults.php" );
}


