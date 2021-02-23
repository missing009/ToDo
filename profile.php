<?php session_start();
/** @var PDO $pdo */
require_once './pdo_ini.php';
if (empty($_SESSION['email'])) {
    header("location:index.php");
}

$id = $_SESSION['id'];
if (isset($_POST['newTodo'])) {
 //   header("location:create_task.php");

    $task = $_POST['task'];

    $taskin = $pdo->prepare("INSERT INTO `task` (`id`, `user_id`, `name`) VALUES (NULL,$id,'$task');");

    $taskin->execute();
    header("location:profile.php");

}

if(isset($_GET['did'])) {
    $task_id = strip_tags( $_GET['did'] );

    $sql = $pdo->prepare("DELETE FROM task WHERE id = '".$task_id."'");
    $sql->execute();

    if($sql) {
        echo "<br/><br/><span>deleted successfully...!!</span>";
    } else {
        echo "ERROR";
    }
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
            foreach ($items as $row) {

           //     $task_id = $i['id'];
             //   $task_name = $i['name'];
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td><a href='profile.php?did=".$row['id']."'>Delete</a></td>";
                echo "</tr>";
            }

            ?>

                    </ul>
                    <div align="center">
                        <button type="button" name="btn_delete" id="btn_delete" class="btn btn-success">Delete</button>
                    </div>
                </div>
        </div>
    </div>
</div>

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>

</body>
</html>

<script>
    delete_task();
    function delete_task() {

        $('.delete-button').click(function(){

            var current_element = $(this);

            var id = $(this).attr('id');

            $.post('profile.php', { task_id: id }, function() {

                current_element.parent().fadeOut("fast", function() { $(this).remove(); });
            });
        });
    }

</script>


