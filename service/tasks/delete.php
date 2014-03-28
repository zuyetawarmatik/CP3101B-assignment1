<?php
//TODO: check empty post/get request
include '../include.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$id = $_POST['id'];
	if(Task::deleteTaskByUserAndId($id,$_SESSION['login']['id'])){
		status(200);

	}else{
		status(404);
		print "{}";
	}
}
?>
