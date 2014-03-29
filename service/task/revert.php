<?php
include '../include.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$user_id = $_SESSION['login']['id'];
	$task_id = $_POST['id'];
	if (!is_numeric($task_id)){
		status(400);
		print json_encode(array(
			"error" => array("task id must be numberic")
		));
		return;
	};
	$task = Task::getTaskByIdAndOwnerId($task_id,$user_id);
	if ($task==null){
		status(404);
		return;
	}
	$task->current_block = max(0, $task->current_block-1);
	if ($task->save()){
		status(200);
		print json_encode(array(
			"id" => $task->id,
			"description" => $task->description,
			"created_time" => $task->created_time,
			"name" => $task->name,
			"description" => $task->description,
			"num_blocks" => $task->blocks,
			"current_block" => $task->current_block
		));
	} else{
		status(400);
	}
}
?>
