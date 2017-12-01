<?php 
include 'inc/task.php';

?>

<!doctype html>
<html lang="en">
<head>
    <title>ToDo App</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="jumbotron">
      <h1 class="display-3 text-center">What do you want to do today?</h1>
      <p class="text-center"><small id="time"></small></p>
        <div class="container mt-2">
            <form action="inc/action.php" method="post" class="">
                <div class="form-group mx-auto" style="width: 50%">
                    <input type="text" class="form-control" name="task" placeholder="Type new task" autocomplete="off" required>
                    <input type="submit" name="add" value='Add Task' class="btn btn-outline-primary my-2">
                </div>
            </form>
        </div>
    </section>

    <section class="container" id="task-container">
        <ul class="list-group mx-auto" id="tasks">
                    <?php 
                        $tasks = new Task;
                        $data = $tasks->viewTasks();
                        if ($data) {
            echo "  <form action='inc/action.php' method='post' id='deleteAll' class='my-2'>
                        <input type='submit' name='deleteAll' value='Delete All Tasks' class='btn btn-outline-warning'>
                    </form>";
            echo "  <form action='inc/action.php' method='post'>
                        <div class='form-group mx-auto'>";
                            foreach ($data as $datum) {

$task     = new Task;
$status   = $task->findLockStatus($datum['id']);
$status   = $status['status'];
$res      = ($status==1) ? 'btn-outline-success' : 'btn-outline-danger';
$lock     = ($status==1) ? 'fa-unlock' : 'fa-lock';
$disabled = ($status==1) ? '' : 'disabled';

                            echo "<li class='list-group-item list-group-item-action'>";
                            echo "<div class='row'>";
                            echo "<div class='col-3 px-1 text-center'>";
                                echo "<button type='submit' id='delete_".$datum['id']."' name='delete' value='".$datum['id']."' class='btn btn-danger btn-sm'".$disabled.">";
                                echo "<i class='fa fa-fw fa-trash-o' aria-hidden='true'></i></button>";
                                echo "<a role='button' class='btn btn-outline-primary btn-sm mx-1 edit_data' id='".$datum['id']."' value='Edit'>
                                        <i class='fa fa-fw fa-pencil-square-o' aria-hidden='true'></i>
                                        </a>";
                            echo "  <button name='lock' id='".$datum['id']."' type='button' class='btn btn-sm
                            ".$res."'>
                            <i class='fa fa-fw ".$lock."' aria-hidden='true'></i></button>";
                            echo "</div>";
                            echo "<div class='col-9'>";
                                echo "<span id='descFromTable_".$datum['id']."'>";
                                echo $datum['description'];
                                echo "</span>";
                            echo "</div>";
                            echo "</div>";
                            echo "</li>";
                            }
            echo "      </div>";
            echo "  </form>";
                        } // if data exists
                    ?>
        </ul>
    </section>




<!-- Modal -->
<div class='modal fade' id='modal_structure' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-body'>
                <form action='inc/action.php' method='post' id="modal_form">
                    <div class='form-group mx-auto'>
                        <input type='text' class='form-control' name='taskDesc' id="modal_taskDesc" autocomplete='off' required>
                    </div>
                    <div class='modal-footer p-1 m-0'>
                        <input type="hidden" name="taskID" id="modal_taskID" /> 
                        <input type='submit' name='edit' id="update" value='Update' class='btn btn-outline-primary m-0'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="main.js"></script>
</body>
</html>