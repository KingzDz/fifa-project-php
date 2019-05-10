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
$id = $_SESSION['id'];
$count = count($teamname);

if(empty($teamname) || empty($players))
{
    echo "Je bent de teamnaam of spelers vergeten";
    header("refresh:6;url=create-team.php");
    exit();
}
else if($count < 3 || $count > 15){
    echo 'Je teamname klopt niet gebruik minimaal 3 karakters en maximaal 15';
    header( "refresh:6;url=../create-team.php" );
    exit();
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
        ':leader' => $id,
    ]);

    echo "Team succesvol aangemaakt";
    header("Location: ../user-home.php");

}