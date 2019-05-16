<?php
require 'config.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UFT-8");

$sql = "SELECT teamname FROM team";
$query = $db->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);

$competition = array();

foreach ($teams as $team){
    foreach ($teams as $opponoment) {
        if($team['teamname'] != $opponoment['teamname']){
            array_push($competition, $team['teamname'] . ' - ' . $opponoment['teamname']);

        }
    }
}

if (isset($competition)) {
    http_response_code(200);
    echo json_encode($competition);

}
else{
    http_response_code(404);
}
