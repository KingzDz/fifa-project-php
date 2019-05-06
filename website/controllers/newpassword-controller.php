<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 18-4-2019
 * Time: 09:34
 */

require 'config.php';

session_start();

$mainpassword = $_POST['password-main'];
$secupassword = $_POST['password-secu'];
$email = $_SESSION['forgot-pass-email'];
$hashedemail = $_SESSION['forgot-pass-hashed-email'];

if($mainpassword == $secupassword && $mainpassword != "" && password_verify($email, $hashedemail) == true){

    $hashedpassword = password_hash ( $mainpassword , PASSWORD_DEFAULT);

    $sql = "UPDATE user SET password = :password WHERE email = :email";

    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':email'                => $email,
        ':password'             => $hashedpassword
    ]);

    echo "Je wachtwoord is succesvol aangepast, je word nu teruggestuurd";
    header("refresh:6;url=../user-login.php");
}

else{
    echo"Je wachtwoorden/emails komen niet overeen, je word teruggestuurd";
    header("refresh:6;url=../newpassword.php?email=$email");
}