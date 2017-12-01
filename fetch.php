<?php
include 'inc/task.php';

if(isset($_GET["modal_taskID"]))  
{  
	$id = $_GET["modal_taskID"];
	$tasks = new Task;
	$data = $tasks->viewTask($id);
	echo json_encode($data);
}

