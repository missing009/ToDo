<?php session_start();
/** @var PDO $pdo */
require_once './pdo_ini.php';
if (empty($_SESSION['email'])) {
    header("location:index.php");
}
$date = date('Y-m-d');
$time = date('H:i:s');
$id = $_SESSION['id'];
if (isset($_POST['newTodo'])) {

    $task = $_POST['task'];

    $taskin = $pdo->prepare("INSERT INTO `task` (`id`, `user_id`, `name`,`date`,`time`,`status`) VALUES (NULL,$id,'$task','$date','$time',1);");

    $taskin->execute();
    header("location:profile.php");

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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

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


        <div class="col-sm-4">            <h1>This is your task list</h1>

            <form class="add-new-task" autocomplete="off" METHOD="post">
                <input type="text" name="task" placeholder="Add a new item..."/>
                <input type="submit" name="newTodo" value="Create"/>

            </form>
        </div>
        <div class="col-sm-8">
            <div class="wrap">
                <div class="task-list">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">task</th>
                            <th scope="col">date </th>
                            <th scope="col">time </th>

                            <th scope="col">Status</th>
                            <th scope="col"></th>

                        </tr>
                        </thead>
                        <tbody>


                        <?php

            $sth = $pdo->prepare("SELECT * FROM task where user_id='$id' and status='1'");
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute();
            $items = $sth->fetchAll();
            foreach ($items as $row) {
              echo  "<tr>";

                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['time']  . "</td>";

                echo "<td><a class='btn btn-primary'  value='1' role='button' href='status_upd.php?done=".$row['id']."'>Done</td>";

                echo "<td><a class='btn btn-primary' role='button' href='delete_task.php?did=".$row['id']."'>Delete</td>";

            }

            ?>
                        </tr>
                        </tbody>
                        <tbody>

                        <?php

                        $sth = $pdo->prepare("SELECT * FROM task where user_id='$id' and status='2'");
                        $sth->setFetchMode(PDO::FETCH_ASSOC);
                        $sth->execute();
                        $items = $sth->fetchAll();
                        foreach ($items as $row) {
                            echo  "<tr>";

                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['date']  . "</td>";
                            echo "<td>" . $row['time']  . "</td>";
                            echo "<td> Status Done </td>";



                        }

                        ?>
                        </tbody>
                    </table>

                </div>
        </div>
    </div>
</div>

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>

</body>
</html>



