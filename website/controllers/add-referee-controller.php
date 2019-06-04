<?php
require '../config.php';

$match = explode(' - ',$_POST['match']);
$team1 = trim($match[0]);
$team2 = trim($match[1]);
$referee = $_POST['referee'];

if(!empty($team1) && !empty($team2) && !empty($referee)){
    $sql = "UPDATE matches SET referee = :referee WHERE team1 = :team1 AND team2 = :team2";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':referee'  => $referee,
        ':team1'    => $team1,
        ':team2'    => $team2
    ]);
}
else{
    echo 'Voer eerst het formulier in! Je word nu teruggestuurd';
    header("Location: ../add-referee");
}
