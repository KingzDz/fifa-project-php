<?php
/**
 * Created by PhpStorm.
 * User: Isabella
 * Date: 20-5-2019
 * Time: 11:16
 */
require '../config.php';
session_start();

$starttimemin = $_POST['starttimeminutes'];
$starttimehour = $_POST['starttimehours'];
$pause = $_POST['pause'];
$matchtime = $_POST['matchtime'];
$field = $_POST['field'];
$id = 1;

    if (isset($_POST['submit'])) {

        $sql = "UPDATE `match-schedule` SET starttimehour = :starth, starttimemin = :startm, matchtime = :matchtime, pause = :pause, fields = :fields WHERE id = :id";

        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':starth'   => $starttimehour,
            ':startm'   => $starttimemin,
            ':matchtime'=> $matchtime,
            ':pause'    => $pause,
            ':fields'   => $field,
            ':id'       => $id
        ]);


        echo "Schema is succesvol aangemaakt !";
        header("refresh:4;url=../admin-page.php");
    } else {
        echo "Schema toevoegen is mislukt,  je wordt nu terug gestuurd.";
        header("refresh:4;url=../new-match.php");
    }
