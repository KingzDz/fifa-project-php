<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 3-4-2019
 * Time: 17:40
 */

require 'config.php';
session_start();

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$hashedpassword = password_hash ( $password , PASSWORD_DEFAULT);

if($email == ""){
    echo "De email mag niet leeg zijn!";
}
else if(strlen($password) < 7){
    echo 'Wachtwoord is te kort, gebruik een wachtwoord van minimaal 7 karakters';
}

$sqlemail = "SELECT * FROM user WHERE email = :email";
$prepare = $db->prepare($sqlemail);
$prepare->execute([
    ':email' => $email
]);
$result = $query->fetch();

if ($email == $result['email']){
    echo "Er bestaat al een account met dit email";
}
else {
    $sql = "INSERT  INTO user (email, password, username) VALUES (:email, :password, :username)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':email'    => htmlentities($email),
        ':password' => htmlentities($hashedpassword),
        ':username' => htmlentities($username),
    ]);

    $id = $result['id'];

    header("Location: ../index.php");

}
