<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 16-4-2019
 * Time: 12:18
 */

require '../config.php';

session_start();


$email = $_POST['email'];

$sqlemail = "SELECT * FROM user WHERE email = :email";
$prepare = $db->prepare($sqlemail);
$prepare->execute([
    ':email' => $email
]);
$result = $prepare->fetch(PDO::FETCH_ASSOC);
$hashedpassword = $result['password'];

//kijkt of er een mail is opgegeven
if(empty($email)){
    echo 'Je hebt geen email opgegeven, je wordt nu teruggestuurd';
    header( "refresh:4;url=../forgot-pass.php" );
    exit();
}

//kijkt of het een geldig email is
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo 'Dit is geen geldig email, je wordt nu teruggestuurd';
    header( "refresh:4;url=../forgot-pass.php" );
    exit();
}

//kijkt of er een account bestaat met deze email
//zo ja verstuurd hij een email
else if ($email == $result['email']){
    header("refresh:4;url=../index.php");

    echo"Er is een mail verstuurd om je wachtwoord te reseten, je wordt nu teruggestuurd";

    $to      = $email;
    $subject = 'Wachtwoord vergeten';
    $messagemail = '
 
Oh nee... je bent je wachtwoord vergeten!
Druk hieronder op de link om je wachtwoord aan te passen
 
sybrandbos.nl/website/newpassword.php?hashedpassword='.$hashedpassword.'
------------------------

Ken jij deze activiteit niet? dan kan je deze mail negeren.
';

    $headers = 'From:noreply@fifa-project.nl';
    mail($to, $subject, $messagemail, $headers);
}
else {
    echo "Er bestaat geen account met deze email, je wordt nu teruggestuurd";
    header( "refresh:4;url=../user-login.php" );
    exit();
}



