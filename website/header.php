<?php
if (session_status() == PHP_SESSION_NONE) {

}
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

?>
<header>
    <div class="nav">
        <div class="navigation">

            <?php
            if($_SESSION['admin'] == true){
                ?>
                <a href="index.php?login=admin">Home</a>
                <img src="img/FIFA-logo.png" alt="FIFA-logo">
                <a href="admin-page.php">Account</a>
                <?php
            }
            else{
                ?>
                <a href="index.php?login=user">Home</a>
                <img src="img/FIFA-logo.png" alt="FIFA-logo">
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


