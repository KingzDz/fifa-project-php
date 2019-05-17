<?php

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UFT-8");

// Checks if the API key has been given
if (!isset($_GET['key'])) {

	$msg = 'ERROR -  No API key has been given.';
	echo json_encode(
		array("message" => $msg)
	);
	exit;
}
else if (isset($_GET['key']) && empty($_GET['key'])) {

	$msg = 'ERROR -  API key cannot be empty.';
	echo json_encode(
		array("message" => $msg)
	);
	exit;
}
else if (isset($_GET['key']) && $_GET['key'] != 'J93hdb4Ua83AkVWo0cbxIsn2ibw3nlxX3') {

	$msg = 'ERROR -  API key is not valid.';
	echo json_encode(
		array("message" => $msg)
	);
	exit;
}
else if (isset($_GET['key']) && $_GET['key'] == 'J93hdb4Ua83AkVWo0cbxIsn2ibw3nlxX3') {

	//$_SESSION['api-key'] = 'J93hdb4Ua83AkVWo0cbxIsn2ibw3nlxX3';
	//header('Location: api.php');
	
	// de C# app word niet doorgestuurd naar api.php
	require '../config.php';
	include_once 'team.php';

	$team = new Team($db);

	$stmt = $team->Read();
	$num = $stmt->rowCount();

	if($num > 0) {

		$teamsArray=array();
		$teamsArray["records"]=array();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$teamItem=array(
				"id" => $id,
				"teamname" => $teamname,
				"players" => $players,
				"leader" => $leader
			);

			array_push($teamsArray["records"], $teamItem);
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
	exit;
}