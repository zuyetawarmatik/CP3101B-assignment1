<?php
//TODO: check empty post/get request
include '../include.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	require_params("id");
	$id = $_POST['id'];
	if(Task::deleteTaskByUserAndId($id,$_SESSION['login']['id'])){
		status(200);
		print '{}';
	}else{
		status(404);
		print '{}';
	}
}
?>
