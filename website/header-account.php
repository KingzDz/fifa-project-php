<?php
/**
 * Created by PhpStorm.
 * User: sybra
 * Date: 15-4-2019
 * Time: 11:25
 */
?>
<header>
    <div class="nav">
        <div class="navigation">
            <a href="index.php">Home</a>
            <img src="img/FIFA-logo.png" alt="FIFA-logo">
            <?php
                if($_SESSION['admin'] == true){
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
