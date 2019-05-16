<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 3-4-2019
 * Time: 16:42
 */

require '../config.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if(empty($username) || empty($password))
{
    echo "Je wachtwoord of gebruikersnaam is onjuist, je wordt nu teruggestuurd";
    header("refresh:4;url=../user-login.php");
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

        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $user['id'];

        if($user['admin'] == 1){

            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['admin'] = true;

            header("Location: ../admin-page.php");
        }
        else{
            header("Location: ../user-home.php");
        }


    }

    else {
        echo "Je wachtwoord of gebruikersnaam is onjuist, je wordt nu teruggestuurd";
        header("refresh:4;url=../user-login.php");
    }
}