<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 15-4-2019
 * Time: 10:58
 */

require 'config.php';
session_start();

$teamname = $_POST['teamname'];
$players = $_POST['players'];
$username = $_SESSION['username'];

if(empty($teamname) || empty($players))
{
    echo "Je bent de teamnaam of spelers vergeten";
    header("refresh:6;url=create-team.php");
}
else if(strlen($teamname) < 3){
    echo 'Je teamname is te kort gebruik minimaal 3 karakters';
}

$sqlteam = "SELECT * FROM team WHERE teamname = '$teamname'";
$query =$db->query($sqlteam);
$result = $query->fetch();

if ($teamname == $result['teamname']){
    echo "Er bestaat al een team met deze naam";
}
else {
    $sql = "INSERT  INTO team (teamname, players, leader) VALUES (:teamname, :players, :leader)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':teamname' => $teamname,
        ':players' => $players,
        ':leader' => $username,
    ]);

    echo "Team succesvol aangemaakt";
    header("Location: user-home.php");

}