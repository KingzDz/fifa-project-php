<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 28-5-2019
 * Time: 11:02
 */

require '../config.php';
session_start();

//haalt data op uit de forms

$player = $_POST['player'];
$match = $_POST['match'];
$team = $_GET['id'];
$goals = $_POST['goals'];

if(empty($player) || empty($match) || empty($goals) || $goals < 1 || $goals > 15){
    echo"Er is iets fout gegaan bij het invullen, je wordt teruggestuurd";
    header("refresh:6;url=../add-goals.php?id=$team");
}
else{
    $sqlgoals = "INSERT  INTO goals (matchid, playerid, teamid, goals) VALUES (:matchid, :playerid, :teamid, :goals)";
    $prepare = $db->prepare($sqlgoals);
    $prepare->execute([
        ':matchid'      => $match,
        ':playerid'     => $player,
        ':teamid'       => $team,
        ':goals'        => $goals
    ]);

    echo"Score succesvol toegevoegd, je wordt teruggestuurd";
    header("refresh:6;url=../add-goals.php?id=$team");
}
