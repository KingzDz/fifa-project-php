<?php
require 'config.php';
session_start();

$team = $_GET['team'];
$player = $_POST['player'];

echo $team;
echo $player;

$sql = "UPDATE user SET team = :team WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':team' => $team,
    ':id' => $player
]);

header("Location: ../add-players.php?id=$team");










?>