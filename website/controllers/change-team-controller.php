<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 1-4-2019
 * Time: 09:42
 */
require 'config.php';
$id = $_GET['id'];
$teamname = $_POST['teamname'];
$players = $_POST['players'];

$sql = "UPDATE team SET teamname = :teamname, players = :players WHERE id = :id";

$prepare = $db->prepare($sql);
$prepare->execute([
    ':teamname'             => $teamname,
    ':players'              => $players,
    ':id'                   => $id
]);
echo "Team is succesvol aangepast, je word nu teruggestuurd";
header( "refresh:6;url=../user-home.php" );
?>
