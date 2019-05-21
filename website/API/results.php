<?php
require '../config.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UFT-8");

$sql = "SELECT * FROM matchresults";
$query = $db->query($sql);
$results = $query->fetchAll(PDO::FETCH_ASSOC);
$key = $_GET['key'];

if (isset($results) && $key == 'J93hdb4Ua83AkVWo0cbxIsn2ibw3nlxX3') {
    http_response_code(200);
    echo json_encode($results);

}
else{
    http_response_code(404);
}
