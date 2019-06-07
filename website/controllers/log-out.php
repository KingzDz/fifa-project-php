<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 6-5-2019
 * Time: 12:26
 */

session_start();

//logt je uit op alle sessies

if($_SESSION['admin'] == true) {
    $_SESSION['admin'] = false;
    $_SESSION['loggedin'] = false;
}
else{
    $_SESSION['loggedin'] = false;
}

header("Location: ../index.php?logout=success");
exit();