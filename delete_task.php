<?php
$task_id = strip_tags( $_POST['task_id'] );
/** @var PDO $pdo */

require_once './pdo_ini.php';

$insert = $pdo->prepare("DELETE FROM tasks WHERE id='$task_id'");
?>