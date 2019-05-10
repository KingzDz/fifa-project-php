<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION['loggedin'] == true){
?>
<header>
    <div class="nav">
        <div class="navigation">
            <a href="index.php">Home</a>
            <img src="img/FIFA-logo.png" alt="FIFA-logo">
            <?php
            if(!isset($_SESSION['admin'])){
                ?>
                <a href="admin-page.php">Account</a>
                <?php
            }
            else{
                ?>
                <a href="user-home.php">Account</a>
                <?php
            }
            ?>
        </div>
    </div>
</header>

<?php
}
else{
    ?>
    <header>
        <div class="nav">
            <div class="navigation">
                <a href="index.php">Home</a>
                <img src="img/FIFA-logo.png" alt="FIFA-logo">
                <a href="user-login.php">Login</a>
            </div>
        </div>
    </header>
<?php
}
?>


