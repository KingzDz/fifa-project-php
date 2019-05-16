<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 18-4-2019
 * Time: 09:34
 */

require '../config.php';

session_start();

$mainpassword = $_POST['password-main'];
$secupassword = $_POST['password-secu'];
$hash = $_SESSION['hashedpassword'];

$sql = "SELECT * FROM user WHERE password = :password";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':password' => $hash
]);
$result = $prepare->fetch(PDO::FETCH_ASSOC);

$email = $result['email'];

if($mainpassword == $secupassword && $mainpassword != "" && $hash == $result['password']){

    $hashedpassword = password_hash ( $mainpassword , PASSWORD_DEFAULT);

    $sql = "UPDATE user SET password = :password WHERE email = :email";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':email'                => $email,
        ':password'             => $hashedpassword
    ]);

    echo "Je wachtwoord is succesvol aangepast, je word nu teruggestuurd";
    header("refresh:4;url=../user-login.php");
}
else if($hash != $result['password']){
	echo "FOUT";
}
else{
    echo "Je wachtwoorden komen niet overeen, je word teruggestuurd";
    header("refresh:4;url=../newpassword.php?hashedpassword='.$hashedpassword.'");
}