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

if (isset($_GET['id']))
{
    $sql = "UPDATE team SET teamname = :teamname, players = :players WHERE id = :id";

    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':teamname'             => $teamname,
        ':players'              => $players,
        ':id'                   => $id
    ]);
    echo "Team is succesvol aangepast, je word nu teruggestuurd";
    header( "refresh:6;url=../user-home.php" );
}
else
{
    header("admin-page.php");
}
?>
