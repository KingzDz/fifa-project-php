<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 18-4-2019
 * Time: 09:31
 */
require 'config.php';

session_start();

$_SESSION['forgot-pass-email'] = $_GET['email'];
$_SESSION['forgot-pass-hashed-email'] = $_GET['hashedemail'];

?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>FIFA-project</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">

    <meta name="theme-color" content="#fafafa">
</head>

<body>
<!--[if IE]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a
    href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Add your site or application content here -->

<?php require 'header.php' ?>
<main>
    <div class="forgot-pass-content">
        <form action="controllers/newpassword-controller.php" id="login-account-form" method="post">
            <label for="password">Nieuw wachtwoord</label>
            <input type="password" name="password-main" required>
            <label for="password-repeat">Herhaal wachtwoord</label>
            <input type="password" required name="password-secu">
            <input type="submit" value="Versturen" id="submit-team">
        </form>
    </div>

</main>
<?php require 'footer.php' ?>

<script src="js/vendor/modernizr-3.7.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga = function () {
        ga.q.push(arguments)
    };
    ga.q = [];
    ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto');
    ga('set', 'transport', 'beacon');
    ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>

</html>


