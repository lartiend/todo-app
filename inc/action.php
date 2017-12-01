<?php
include 'task.php';

if (isset($_POST['add'])) {
	$tasks 	= new Task;
	$data 	= $tasks->addTask($_POST['task']);
}

if (isset($_POST['delete'])) {
	$tasks 	= new Task;
	$data 	= $tasks->deleteTask($_POST['delete']);
}

if (isset($_POST['deleteAll'])) {
	$tasks 	= new Task;
	$data 	= $tasks->deleteAllTasks();
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
	$data 	= $_REQUEST['data'];
	$task 	= new Task;
	$task 	= $task->updateTask($data['id'],$data['desc']);
	$response =
		array(
			'id' 		=> $data['id'],
			'desc'		=> $data['desc'],
		);
	echo json_encode($response);
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'lock') {
	$task 	= new Task;
	$task 	= $task->lock($_REQUEST['data']);
	echo $task; // current status
}
