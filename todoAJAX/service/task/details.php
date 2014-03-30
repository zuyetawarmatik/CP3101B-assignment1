<?php
include '../include.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if ($_SESSION['login']!=null){
		require_params("id");

		$task_id = $_REQUEST['id'];
		$task = Task::getTaskByIdAndOwnerId($task_id,$_SESSION['login']['id']);
		if ($task==null){
			status(404);
			print "{}";
			return;
		}

		status(200);
		print json_encode(array(
				"id" => $task->id,
				"name" => $task->name,
				"description" => $task->description,
				"blocks" => $task->blocks,
				"current_block" => $task->current_block,
				"created_time" => $task->created_time,
				"estimation" => $task->getEstFinishTime()
			
		));
	}else{
		status(401);
		print "{}";
	}

}
?>
