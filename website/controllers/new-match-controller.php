<?php
/**
 * Created by PhpStorm.
 * User: Isabella
 * Date: 20-5-2019
 * Time: 11:16
 */
require '../config.php';
session_start();

$starttime = $_POST['starttime'];
$pause = $_POST['pause'];
$matchtime = $_POST['matchtime'];
$field = $_POST['field'];

    if (isset($_POST['submit'])) {

        $sql = "INSERT INTO `match-schedule` (starttime, matchtime, pause, fields) VALUES(:starttime, :matchtime, :pause, :fields)";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':starttime' => $starttime,
            ':matchtime' => $matchtime,
            ':pause' => $pause,
            ':fields' => $field
        ]);
        echo "Schema is succesvol aangemaakt !";
        header("refresh:4;url=../tijd-schema.php");
    } else {
        echo "Schema toevoegen is mislukt,  je wordt nu terug gestuurd.";
        header("refresh:4;url=../admin-page.php");
    }
