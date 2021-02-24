<?php
session_start();
/** @var PDO $pdo */
require_once './pdo_ini.php';
$date = date('Y-m-d');
$time = date('H:i:s');
$id = $_SESSION['id'];
if (isset($_POST['newTodo'])) {
    if (!empty($_POST['task'])) {
        $task = $_POST['task'];

        $taskin = $pdo->prepare("INSERT INTO `task` (`id`, `user_id`, `name`,`date`,`time`,`status`) VALUES (NULL,$id,'$task','$date','$time',1);");

        $taskin->execute();
        header("location:profile.php");

    } else {
        echo '<p>empty</p>';

        header("location:profile.php");

    }
}
