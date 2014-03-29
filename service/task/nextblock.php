
<?php
include '../include.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$task_id = $_POST['id'];
	$task = Task::getTaskByIdAndOwnerId($task_id,$_SESSION['login']['id']);
	if ($task!=null){
		$task->current_block = min($task->blocks, $task->current_block+1);
		if ($task->save()){
			status(200);
			print json_encode(array(
				"id" => $task->id,
				"name" => $task->name,
				"description" => $task->description,
				"num_blocks" => $task->blocks,
				"current_block" => $task->current_block,
				"created_time" => $task->created_time,
				"estimation" => $task->getEstFinishTime()

			));
			return;
		} else{
			status(500);
			print "{}";
			return;
		}
	}else{
		status(404);
		print"{}";
		return;
	}
}
?>
