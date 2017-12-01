<?php
include 'dbh.php';
/**
* 
*/
class Task extends Dbh
{
	// all tasks
	public function viewTasks() {
		$sql = "SELECT * FROM tasks ORDER BY created_at DESC";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows>0) {
			while ($row=$result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}
	}
	// single task
	public function viewTask($itemID) {
		$sql 	= "SELECT * FROM tasks WHERE id='$itemID'";
		$result = $this->connect()->query($sql);
		$data 	= $result->fetch_assoc();
		return $data;
	}
	// add task
	public function addTask($item) {
		$sql = "INSERT INTO tasks SET description='$item'";
		$result = $this->connect()->query($sql);
		header("location: ../index.php");
	}
	// delete task
	public function deleteTask($itemID) {
		$sql = "DELETE FROM tasks WHERE id='$itemID'";
		$result = $this->connect()->query($sql);
		header("location: ../index.php");
	}
	// delete all tasks
	public function deleteAllTasks() {
		$sql = "DELETE FROM tasks WHERE status=1";
		$result = $this->connect()->query($sql);
		header("location: ../index.php");
	}
	// update a task
	public function updateTask($itemID, $itemDesc) {
		$sql = "UPDATE tasks SET description='$itemDesc' WHERE id='$itemID'";
		$result = $this->connect()->query($sql);
	}
	// lock/unlock
	public function lock($itemID) {
		$data 	= $this->findLockStatus($itemID);
		$status = $data['status'] == 1 ? 0 : 1; // status switch 1=unlock,0=lock
		$sql 	= "UPDATE tasks SET status='$status' WHERE id='$itemID'";
		$result = $this->connect()->query($sql);
		return $status;
	}

	public function findLockStatus($itemID) {
		$sql 	= "SELECT status FROM tasks WHERE id='$itemID'";
		$result = $this->connect()->query($sql);
		$data 	= $result->fetch_assoc();
		return $data;
	}

}