<?php
//delete.php



/** @var PDO $pdo */

require_once './pdo_ini.php';
if(isset($_POST["id"]))
{
    foreach($_POST["id"] as $id)
    {
        $sth = $pdo->prepare("DELETE  FROM task where id='$id'");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();    }
}
?>