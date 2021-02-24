<?php
session_start();
/** @var PDO $pdo */

require_once './pdo_ini.php';
$chekpass[] = 0;
$chekmail[] = 0;
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $select = $pdo->prepare("SELECT * FROM users WHERE  email='$email' and pass='$pass'");
    $select->setFetchMode(PDO::FETCH_ASSOC);
    $select->execute();
    $data = $select->fetch();

    $chekmail = $data['email'];
    $chekpass = $data['pass'];
    if ($chekmail != $email and $chekpass != $pass) {
        echo '  <p class="message"> error</p>';
    } elseif ($data['email'] == $_POST['email'] and $data['pass'] == $_POST['pass']) {
        $_SESSION['email'] = $data['email'];
        $_SESSION['name'] = $data['name'];
        $_SESSION['id'] = $data['id'];
        header("location:profile.php");
    }
}
