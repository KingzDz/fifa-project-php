<?php 

require 'database.php';

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

$db = new Database("localhost", "jai", "", "users");
$db = $db->getConnection();

/*$hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO `user` (`username`, `password`) VALUES ('$username', '$hash');";
$prepare = $db->prepare($sql);
$prepare->execute(); exit;*/

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
