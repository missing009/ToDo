<?php session_start();
/** @var PDO $pdo */
require_once './pdo_ini.php';
if (empty($_SESSION['email'])) {
    header("location:index.php");
}
$id = $_SESSION['id'];

$query = "SELECT * FROM task where user_id='$id' and status='1'";
if (isset($_GET['sort'])) {
    $query .= " ORDER BY {$_GET['sort']}";
}

$sth = $pdo->prepare($query);
$sth->setFetchMode(PDO::FETCH_ASSOC);
$sth->execute();
$items = $sth->fetchAll();
$login=$_SESSION['name'];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<nav class="navbar navbar-light bg-light"><?php echo "<p  >" . $login . "</p>" ; ?>
    <a class="btns" href="logout.php">Logout</a>

</nav>


<div class="container">
    <div class="row">


        <div class="col-sm-4">
            <h3>This is your task list</h3>

            <form class="add-new-task" autocomplete="off" METHOD="post" action="newtodo.php">
                <input type="text" name="task" placeholder="Add a new item..."/>
                <input type="submit" name="newTodo" value="Create"/>

            </form>
        </div>
        <div class="col-sm-8">
            <div class="wrap">
                <div class="task-list">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col"><a class='sort' role='button'
                                               href="?<?= http_build_query(array_merge($_GET, ['sort' => 'name'])) ?>">Task</a>
                            </th>
                            <th scope="col"><a class=' sort' role='button'
                                               href="?<?= http_build_query(array_merge($_GET, ['sort' => 'date'])) ?>">Date</a>
                            </th>
                            <th scope="col"></th>

                            <th scope="col"></th>
                            <th scope="col"></th>

                        </tr>
                        </thead>
                        <tbody>


                        <?php


                        foreach ($items as $row) {
                            echo "<tr>";

                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['time'] . "</td>";

                            echo "<td><a  type='button' class='btn  done '  value='1' role='button' href='status_upd.php?done=" . $row['id'] . "'>Done</td>";
                            echo "<td><a type='button' class='btn  delete ' role='button' href='delete_task.php?did=" . $row['id'] . "'>Delete</td>";

                        }

                        ?>
                        </tr>
                        </tbody>
                    </table>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btns btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Do you want to look at the completed tasks?                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Well done)</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group">


                                    <?php

                                    $sth = $pdo->prepare("SELECT * FROM task where user_id='$id' and status='2'");
                                    $sth->setFetchMode(PDO::FETCH_ASSOC);
                                    $sth->execute();
                                    $items = $sth->fetchAll();
                                    foreach ($items as $row) {

                                        echo "<li class='list-group-item'> <strike>" . $row['name'] . "</strike>".$row['date']. "</li>";


                                    }

                                    ?>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>



