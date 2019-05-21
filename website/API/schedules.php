<?php
require 'config.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UFT-8");

$sql = "SELECT teamname FROM team";
$query = $db->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);
$key = $_GET['key'];

$competition = array();
$competition['matches'] = array();

foreach ($teams as $team){
    $teams = array_slice($teams, 1 , count($teams));
    foreach ($teams as $opponoment) {

        if($team['teamname'] != $opponoment['teamname']){
            array_push($competition['matches'], $team['teamname'] . ' - ' . $opponoment['teamname']);

        }
    }
}

if (isset($competition) && $key == 'J93hdb4Ua83AkVWo0cbxIsn2ibw3nlxX3') {
    http_response_code(200);
    echo json_encode($competition);

}
else{
    http_response_code(404);
}
