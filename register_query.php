<?php
/** @var PDO $pdo */

require_once './pdo_ini.php';
if(isset($_POST['signup'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $insert = $pdo->prepare("INSERT INTO users (name,email,pass)
values(:name,:email,:pass) ");
    $insert->bindParam(':name',$name);
    $insert->bindParam(':email',$email);
    $insert->bindParam(':pass',$pass);
    $insert->execute();
    header('location:index.php');

}