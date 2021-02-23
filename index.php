<?php
session_start();
/** @var PDO $pdo */

require_once './pdo_ini.php';

try{
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
    }elseif(isset($_POST['signin'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $select = $pdo->prepare("SELECT * FROM users WHERE  email='$email' and pass='$pass'");
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $select->execute();
        $data=$select->fetch();
        $chekmail=$data['email'];
        $chekpass=$data['pass'];
        if($chekmail!=$email and $chekpass!=$pass)
        {
            echo '  <p class="message"> error</p>';
        }
        elseif($data['email']==$_POST['email'] and $data['pass']==$_POST['pass'] )
        {
            $_SESSION['email']=$data['email'];
            $_SESSION['name']=$data['name'];
            $_SESSION['id']=$data['id'];
            header("location:profile.php");
        }
    }



}
catch(PDOException $e)
{
    echo "error".$e->getMessage();
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script type="text/javascript" >
    $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });
</script>

<div class="login-page">
    <div class="form">
        <form method="post" class="register-form">
            <input type="text" name="name" placeholder="name"/>
            <input type="password" name="pass" placeholder="password"/>
            <input type="text" name="email" placeholder="email address"/>
            <button type="submit" name="signup" >create</button>
            <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form>
        <form method="post" class="login-form">
            <input type="text" name="email" placeholder="username"/>
            <input type="password" name="pass" placeholder="password"/>
            <button type="submit" name="signin">login</button>
            <p class="message">Not registered? <a href="#">Create an account</a></p>
        </form>
    </div>
</div>
</body>

</html>


