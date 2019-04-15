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
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Add your site or application content here -->

<header>
    <div class="nav">
        <div class="navigation">
            <a href="index.html">Home</a>
            <img src="img/FIFA-logo.png" alt="FIFA-logo">
            <a href="login.html">Login</a>
        </div>
    </div>
</header>
<main>
    <div class="main-form">
        <div class="create-form-background">
            <div class="title-form">
                <h3>Registreren</h3>
            </div>
            <form id="create-account-form" action="create-account.php" method="post">
                <label for="name">Gebruikersnaam</label>
                <input type="text" name="username" required="">
                <label for="players">Email</label>
                <input type="text" name="email" required="">
                <label for="players">Wachtwoord</label>
                <input type="password" name="password" required="">
                <input id="submit-team" type="submit" value="Registreren">
            </form>
        </div>
        <div class="create-form-background">
            <div class="title-form">
                <h3>Inloggen</h3>
            </div>
            <form id="login-account-form" action="login-account.php" method="post">
                <label for="name">Gebruikersnaam</label>
                <input type="text" name="username" required="">
                <label for="players">Wachtwoord</label>
                <input type="password" name="password" required="">
                <input id="submit-team" type="submit" value="Inloggen">
            </form>
        </div>
    </div>
</main>
<footer>
</footer>

<script src="js/vendor/modernizr-3.7.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('set','transport','beacon'); ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>

</html>
