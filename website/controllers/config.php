<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 1-4-2019
 * Time: 15:37
 */

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