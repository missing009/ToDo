<?php
/** @var PDO $pdo */

require_once './pdo_ini.php';
if(isset($_GET['done'])) {
    $task_id = strip_tags( $_GET['done'] );

    $sql = $pdo->prepare("UPDATE  task  SET status='2' WHERE id = '".$task_id."'");
    $sql->execute();
    header('location:profile.php');

    if($sql) {
    } else {
        echo "ERROR";
    }
}
?>