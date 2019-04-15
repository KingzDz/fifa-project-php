<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 3-4-2019
 * Time: 16:42
 */

require 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

if(empty($username) || empty($password))
{
    echo "Je wachtwoord of gebruikersnaam is onjuist";
    header("refresh:6;url=user-login.php");
}
else {
    $sql = "SELECT * FROM user WHERE username = :username";

    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':username' => $username
    ]);
    $user = $prepare->fetch(PDO::FETCH_ASSOC);


    $hashedPassword = $user['password'];

    if (password_verify($password, $hashedPassword)) {

        $_SESSION['username'] = $username;
        header("Location: create-team.php");
    }

    else {
        echo "Je wachtwoord of gebruikersnaam is onjuist";
        header("refresh:6;url=user-login.php");
    }
}