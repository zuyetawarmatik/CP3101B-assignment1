<?php
include '../include.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$task_id = $_POST['id'];
	$name = $_POST["name"];
	$desc = $_POST["description"];
	$blocks = $_POST["num_blocks"];
	$error = array();
	if (!is_numeric($task_id)){
		array_push($error,"wrong task id");
	}
	if (!Util::strLengthLimit($name,1,50)){
		array_push($error,"Task name must not be empty or longer than 50.\n");
	}
	if (!Util::strLengthLimit($desc,1,200)){
		array_push($error,"Task description must not be empty or longer than 200.\n");
	}
	if (!is_numeric($blocks)){
		array_push($error,"Blocks must be numeric.");
	}

	if(count($error)==0){
		$task = Task::getTaskByIdAndOwnerId($task_id,$_SESSION['login']['id']);
		if($task!=null){
			$task->name = $name;
			$task->description = $desc;
			$task->blocks = $blocks;
			$task->current_block = min($task->current_block,$blocks);
			if($task->save()){
				status(200);
				print json_encode(array(
					"id" => $task->id,
					"description" => $task->description,
					"created_time" => $task->created_time,
					"name" => $name,
					"description" => $desc,
					"num_blocks" => $blocks,
					"current_block" => $task->current_block
				));
			}else{
				status(400);
				print "{}";
			};
		}
	}else{
		status(400);
		print json_encode(array(
			"error" => $error
		));
	}
	return;
}
?>
