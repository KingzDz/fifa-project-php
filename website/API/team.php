<?php

class Team {

	private $conn;
	private $tableName = 'team';

	public $id;
	public $teamname;
	public $players;
	public $leader;

	public function __construct($db) {
		$this->conn = $db;
	}

	// gets data from table
	function read() {
		$sql = "SELECT * FROM `team`;";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt;
	}

}