<?php

session_start();
require 'config.php';

if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['admin'] == true)) {
	header('Location: index.php');
	exit;
}

$sql = "UPDATE `match-schedule` SET `match-active` = 1 WHERE `id` = 1;";
$prepare = $db->prepare($sql);
$prepare->execute();

header('Location: match-schedule.php');