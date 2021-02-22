<?php session_start();
/** @var PDO $pdo */
require_once './pdo_ini.php';
if (empty($_SESSION['email'])) {
    header("location:index.php");
}

$id = $_SESSION['id'];
if (!empty($_POST['newTodo'])) {
    header("location:create_task.php");

    $task = $_POST['task'];

    $taskin = $pdo->prepare("INSERT INTO `task` (`id`, `user_id`, `name`) VALUES (NULL,$id,'$task');");

    $taskin->execute();
}
if (isset($_POST['del'])) {
    $task = $_POST['task'];

    $taskin = $pdo->prepare("INSERT INTO `task` (`id`, `user_id`, `name`) VALUES (NULL,$id,'$task');");

    $taskin->execute();
}
//$task_id = strip_tags( $_POST['task_id'] );


//mysql_query("DELETE FROM tasks WHERE id='$task_id'");
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<nav class="navbar navbar-dark bg-dark">WELCOME :<?php echo $_SESSION['name']; ?>
    <a href="logout.php">Logout</a>

</nav>
<div class="container">
    <div class="row">


        <div class="col-sm-4">            <h1>ToDo</h1>

            <form class="add-new-task" autocomplete="off" METHOD="post">
                <input type="text" name="task" placeholder="Add a new item..."/>
                <input type="submit" name="newTodo" value="Create">

            </form>
        </div>
        <div class="col-sm-8">            <div class="wrap">
                <div class="task-list">
                    <ul>
            <?php

            $sth = $pdo->prepare("SELECT * FROM task where user_id='$id'");
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute();
            $items = $sth->fetchAll();
            foreach ($items as $i) {

                $task_id = $i['id'];
                $task_name = $i['name'];
                echo '<li>
								<span>' . $task_name . '</span>
								
								<img id="' . $task_id . '" class="delete-button" width="10px" src="close.png" name="del" method="post" >
							  </li>';

            }

            ?>

                    </ul>
                </div>
        </div>
    </div>
</div>

</body>
</html>




