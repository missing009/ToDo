<?php
//delete.php


/** @var PDO $pdo */

require_once 'pdo_ini.php';
if (isset($_GET['did'])) {
    $task_id = strip_tags($_GET['did']);

    $sql = $pdo->prepare("DELETE FROM task WHERE id = '" . $task_id . "'");
    $sql->execute();
    header('location:profile.php');


    if ($sql) {
    } else {
        echo "ERROR";
    }
}
?>