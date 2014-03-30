<?php
include 'include.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if ($_SESSION['login'] != null){
		status(200);
		print json_encode(array(
				"username" => $_SESSION['login']['username']
		));
	}else{
		status(401);
		print '{}';
	}
}
?>
