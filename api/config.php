<?php 

$dbHost = 'localhost';
$dbUser = 'jai';
$dbPass = '';
$dbName = 'users';

$db = new PDO(
    "mysql:host=$dbHost;dbname=$dbName",
    $dbUser,
    $dbPass
);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );