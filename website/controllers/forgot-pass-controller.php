<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 16-4-2019
 * Time: 12:18
 */

require 'config.php';

$email = $_POST['email'];
$hashedemail = password_hash($email, PASSWORD_DEFAULT);

$sqlemail = "SELECT * FROM user WHERE email = :email";
$prepare = $db->prepare($sqlemail);
$prepare->execute([
    ':email' => $email
]);
$result = $query->fetch();

if ($email == $result['email']){
    header("refresh:8;url=../index.php");

    echo"Er is een mail verstuurd om je wachtwoord te reseten";

    $to      = $email;
    $subject = 'Wachtwoord vergeten';
    $messagemail = '
 
Oh nee... je bent je wachtwoord vergeten!
Druk hieronder op de link om je wachtwoord aan te passen
 
sybrandbos.nl/website/newpassword.php?email='.$email.$hashedemail.'
------------------------

Ken jij deze activiteit niet? dan kan je deze mail negeren
 t
';

    $headers = 'From:noreply@fifa-project.nl';
    mail($to, $subject, $messagemail, $headers);
}
else {
    echo "Er bestaat geen account met deze email";
}



