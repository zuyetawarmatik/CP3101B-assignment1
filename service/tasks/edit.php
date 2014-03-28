<?php
include '../include.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$task_id = $_POST['task_id'];
	$name = $_POST["name"];
	$desc = $_POST["description"];
	$blocks = $_POST["blocks"];
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

	if(count($error)>0){
		$task = Task::getTaskByIdAndOwnerId($task_id,$user_id);
		if($task!=null){
			$task->name = $name;
			$task->description = $desc;
			$task->blocks = $blocks;
			$task->current_block = min($task->current_block,$blocks);
			if($task->save()){
				status(200);
				print json_encode(array(
					"name" => $name,
					"desc" => $desc,
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
