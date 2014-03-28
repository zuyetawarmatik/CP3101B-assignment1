<?php
include '../include.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$error = array();
	$name = $_POST["name"];
	$desc = $_POST["description"];
	$blocks = $_POST["blocks"];


	if (!Util::strLengthLimit($name,1,50)){
		array_push ($error, "Task name must not be empty or longer than 50.\n");
	}
	if (!Util::strLengthLimit($desc,1,200)){
		array_push ($error, "Task description must not be empty or longer than 200.\n");
	}
	if (!is_numeric($blocks)){
		array_push ($error, "Blocks must be numeric.");
	}
	if (count($error)==0){
		$task = new Task();

		$task->user_id =$_SESSION['login']['id'];
		$task->name =$name;
		$task->description = $desc;
		$task->blocks = $blocks;

		if ($task->create()){
			status(201);
			print_r( json_encode(array(
				"id" => $task->id,
				"name" => $name,
				"description" => $desc,
				"num_blocks" => $blocks,
				"current_block" => $task->current_block,
				"created_time" => $task->created_time
			)));
		}else{
			status(400);
		print "{}";
		};
	}else{
		status(400);
		print json_encode($error);
	}
	return;

}
?>
