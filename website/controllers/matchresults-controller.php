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
}
else{
    echo 'Geef de score mee! Je word nu teruggestuurd';
    header( "refresh:4;url=../admin-matchresults.php" );
}


