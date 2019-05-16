<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 16-4-2019
 * Time: 12:18
 */

require '../config.php';

$email = $_POST['email'];

$sqlemail = "SELECT * FROM user WHERE email = :email";
$prepare = $db->prepare($sqlemail);
$prepare->execute([
    ':email' => $email
]);
$result = $prepare->fetch(PDO::FETCH_ASSOC);
$hashedpassword = $result['password'];

if ($email == $result['email']){
    header("refresh:4;url=../index.php");

    echo"Er is een mail verstuurd om je wachtwoord te reseten, je wordt nu teruggestuurd";

    $to      = $email;
    $subject = 'Wachtwoord vergeten';
    $messagemail = '
 
Oh nee... je bent je wachtwoord vergeten!
Druk hieronder op de link om je wachtwoord aan te passen
 
sybrandbos.nl/website/newpassword.php?hashedpassword='.$hashedpassword.'
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



