<?php

class Recipe {

	private $conn;
	private $table_name = "recipes";

	public $id;
	public $category_id;
	public $updated_at;
	public $created_at;
	public $user_id;
	public $title;
	public $description;
	public $ingredients;
	public $picture_url;

	public function __construct($db) {
		$this->conn = $db;
	}

	function read() {
		$query = "SELECT * FROM `recipes`;";

		$stmt = $this->conn->prepare($query);

		$stmt->execute();

		return $stmt;
	}



}