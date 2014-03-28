<?php
include 'include.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if ($_SESSION['login']!=null){
		status(200);

		$tasks = Task::getTasksByUserId($_SESSION['login']['id']);
		$task_array = array();
		foreach ($tasks as $task) {
			array_push($task_array,array(
				"id" => $task->id,
				"description" => $task->description,
				"num_blocks" => $task->blocks
			));
		};
		print json_encode($task_array);
	}else{
		status(401);
		print "{}";
	}

}
?>
