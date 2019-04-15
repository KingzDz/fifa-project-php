<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 15-4-2019
 * Time: 10:58
 */

require 'config.php';

session_start();
if(!isset($_SESSION['username'])){
    header("Location:user-login.php");
}

$teamname = $_GET['teamname'];
$players = $_GET['players'];

if(empty($teamname) || empty($players))
{
    echo "Je bent de teamnaam of spelers vergeten";
    header("refresh:6;url=create-team.php");
}
else if(strlen($teamname) < 3){
    echo 'Je teamname is te kort gebruik minimaal 3 karakters';
}

$sqlteam = "SELECT * FROM team WHERE teamname = '$teamname'";
$query =$db->query($sqlemail);
$result = $query->fetch();

if ($teamname == $result['teamname']){
    echo "Er bestaat al een team met deze naam";
}
else {
    $sql = "INSERT  INTO team (email, password, username) VALUES (:email, :password, :username)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':email' => $email,
        ':password' => $hashedpassword,
        ':username' => $username,
    ]);

    echo "Team succesvol aangemaakt";
    header("Location: user.php");

}