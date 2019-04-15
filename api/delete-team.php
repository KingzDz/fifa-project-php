<?php
require 'config.php';

if($_SESSION['admin'] == 1){
    $id = $_GET['id'];
    $sql = "DELETE FROM teams WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $id
    ]);

    header('Location: index.html');
    exit;
}
else{
    echo 'Jij hebt geen administrator rechten!';
}