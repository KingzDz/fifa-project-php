<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UFT-8");

require 'config.php';
include_once 'team.php';

$team = new Team($db);

$stmt = $team->Read();
$num = $stmt->rowCount();

if($num > 0) {

	$teamsArray=array();
	$teamsArray["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$team_item=array(
			"id" => $id,
			"teamname" => $teamname,
			"players" => $players,
			"leader" => $leader
		);

		array_push($teamsArray["records"], $team_item);
	}

	http_response_code(200);

	echo json_encode($teamsArray);

}
else {
	http_response_code(404);

	echo json_encode(
		array("message" => "No teams found.")
	);
}