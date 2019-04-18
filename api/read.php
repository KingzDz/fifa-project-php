<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UFT-8");

require 'config.php';
include_once 'recipe.php';

$recipe = new Recipe($db);

$stmt = $recipe->Read();
$num = $stmt->rowCount();

if($num > 0) {

	$recipes_arr=array();
	$recipes_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$recipe_item=array(
			"id" => $id,
			"category_id" => $category_id,
			"updated_at" => $updated_at,
			"created_at" => $created_at,
			"user_id" => $user_id,
			"title" => $title,
			"description" => $description,
			"ingredients" => $ingredients,
			"picture_url" => $picture_url
		);

		array_push($recipes_arr["records"], $recipe_item);
	}

	http_response_code(200);

	echo json_encode($recipes_arr);

}
else {
	http_response_code(404);

	echo json_encode(
		array("message" => "No recipes found.")
	);
}