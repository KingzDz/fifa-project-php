<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 3-4-2019
 * Time: 17:40
 */

require '../config.php';

session_start();

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$hashedpassword = password_hash ( $password , PASSWORD_DEFAULT);

//kijkt of de email niet leeg is
if($email == ""){
    echo "De email mag niet leeg zijn, je wordt nu teruggestuurd";
    header( "refresh:4;url=../user-login.php" );
    exit();
}
//kijkt of het wachtwoord groter is dan 7 karakters
else if(strlen($password) < 7){
    echo 'Wachtwoord is te kort, gebruik een wachtwoord van minimaal 7 karakters, je wordt nu teruggestuurd';
    header( "refresh:4;url=../user-login.php" );
    exit();
}

//kijkt of het een geldig email is
else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $sqlemail = "SELECT * FROM user WHERE email = :email AND username = :username";
    $prepare = $db->prepare($sqlemail);
    $prepare->execute([
        ':email'        => $email,
        ':username'     => $username
    ]);
    $result = $prepare->fetch(PDO::FETCH_ASSOC);

//    kijkt of er al een account bestaat met deze info
    if ($email == $result['email'] || $username == $result['username']) {
        echo "Er bestaat al een account met dit email/gebruiksernaam, je word teruggestuurd";
        header( "refresh:4;url=../user-login.php" );
        exit();

    } else {
        $sql = "INSERT  INTO user (email, password, username) VALUES (:email, :password, :username)";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':email'    => $email,
            ':password' => $hashedpassword,
            ':username' => $username,
        ]);

        echo "Account succesvol aangemaakt, je word nu teruggestuurd";
        header( "refresh:4;url=../user-login.php" );
        exit();

    }
}
else{
    echo "Email klopt niet, je word teruggestuurd";
    header( "refresh:4;url=../user-login.php" );
    exit();
}
