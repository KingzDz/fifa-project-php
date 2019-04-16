<?php

class Database {

	private $dbHost;
	private $dbUser;
	private $dbPass;
	private $dbName;

	public $connection;

	public function __construct($dbHost, $dbUser, $dbPass, $dbName) {
		$this->dbHost = $dbHost;
		$this->dbUser = $dbUser;
		$this->dbPass = $dbPass;
		$this->dbName = $dbName;
	}

	public function getConnection() {
		$this->connection = null;

		try {
			$this->connection = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUser, $this->dbPass);
			$this->connection->exec("set names utf8");
		}
		catch (PDOException $e) {
			echo "Connection error: $e->getMessage()";
		}

		return $this->connection;
	}

}