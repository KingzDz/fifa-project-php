<?php
session_start();

require '../config.php';

$teamid = $_GET['team'];
$playerid = $_POST['player'];

$places = "SELECT * FROM team WHERE id = :teamid";
$prepare = $db->prepare($places);
$prepare->execute([
    ':teamid' => $teamid
]);
$place = $prepare->fetch();

$players = "SELECT * FROM user WHERE team = :teamid";
$prepare = $db->prepare($players);
$prepare->execute([
    ':teamid' => $teamid
]);
$player = $prepare->fetch();

$empty = $place['players'];
$members = count($player);

if($members >= $empty){
    echo "Je probeert te veel spelers aan je team toe te voegen, je wordt teruggestuurd";
    header( "refresh:6;url=../add-players.php?id=$teamid" );
}
else{
    $sql = "UPDATE user SET team = :team WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':team' => $teamid,
        ':id' => $playerid
    ]);

    header("Location: ../add-players.php?id=$teamid");
}



?>