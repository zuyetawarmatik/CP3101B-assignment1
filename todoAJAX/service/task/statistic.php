<?php 

include '../include.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

	$est = Task::getUserTaskStats($_SESSION['login']['id']);
	if ($est!=null){
		status(200);
		print json_encode(array(
			"estimation" => Task::getUserTaskStats($_SESSION['login']['id'])
		));
		return;
	}else{
		status(500);
		print_r("{}");
		return;
	};
}
?>
