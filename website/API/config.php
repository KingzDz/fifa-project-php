<?php 

    /*$dbHost = "localhost";
    $dbName = "u39777p35334_fifa";
    $dbUser = "root";
    $dbPass = "";
 
    $dsn = ("mysql:host=$dbHost;dbname=$dbName");
    

    try{
        $db = new PDO($dsn, $dbUser, $dbPass);
    }
    catch(PDOException $exception) {
        echo "Connection error: " . $exception->getMessage();
    }*/


$dbHost = 'localhost';
$dbUser = 'u39777p35334_Sybrand';
$dbPass = 'Sybrand123';
$dbName = 'u39777p35334_fifa';

$db = new PDO(
    "mysql:host=$dbHost;dbname=$dbName",
    $dbUser,
    $dbPass
);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );