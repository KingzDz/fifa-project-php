<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 1-4-2019
 * Time: 09:50
 */
require 'config.php';
session_start();
$isAdmin = $_SESSION['admin'];
if ($isAdmin == 1){
    $id = $_GET['id'];
    $sql = "DELETE FROM team WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $id
    ]);
    echo "Team is succesvol verwijderd, je word nu teruggestuurd";
    header( "refresh:6;url=../user-home.php" );
}
else{
    echo "Je het adminsrechten nodig om teams te verwijderen!";
    header( "refresh:6;url=../user-home.php" );
}

?>