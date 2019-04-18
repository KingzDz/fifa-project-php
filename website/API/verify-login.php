<?php 

require 'config.php';

header("Content-Type: application/json; charset=UTF-8");

// when username and password are empty return 'failed'
if (!isset($_GET["username"]) || !isset($_GET["password"])) {
	echo json_encode(
		array("message" => "failed")
	);
	exit;
}

// gets username and password
$username = htmlspecialchars($_GET["username"]);
$password = htmlspecialchars($_GET["password"]);

// SQL query
$sql = "SELECT `password`, `username` FROM `user`;";
$prepare = $db->prepare($sql);
$prepare->execute();

$userDetails = $prepare->fetchAll(PDO::FETCH_ASSOC);

// checks if there is a record with the specified username and password
foreach ($userDetails as $userDetail) {
	if (password_verify($password, $userDetail["password"]) && $username == $userDetail["username"]) {
		echo json_encode(
			array("message" => "successful")
		);
		exit;
	}
}
// when there are no matching password & username
echo json_encode(
	array("message" => "failed")
);
exit;
