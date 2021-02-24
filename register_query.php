<?php
/** @var PDO $pdo */

require_once './pdo_ini.php';
if (isset($_POST['signup'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL) !== FALSE) {
        $select = $pdo->prepare("select * from  users where email='$email' and name='$name'");
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $select->execute();
        $data = $select->fetch();

        $chekmail = $data['email'];
        $chekname=$data['name'];
        if ($email != $chekmail and  $name!=$chekname ) {
            $insert = $pdo->prepare("INSERT INTO users (name,email,pass)
values(:name,:email,:pass) ");
            $insert->bindParam(':name', $name);
            $insert->bindParam(':email', $email);
            $insert->bindParam(':pass', $pass);
            $insert->execute();

            header('location:index.php');
        } else {
            echo 'no exist';
            header('Refresh: 2; URL=registration.php');

        }
    } else {
        echo "no valid";
        header('Refresh: 2; URL=registration.php');


    }
}