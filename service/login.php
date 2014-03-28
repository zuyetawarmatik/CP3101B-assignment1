<?php
include 'include.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = $_POST["username"];
	$password = $_POST["password"];
	$user = User::getAuthenticatedUser($username,$password);
	if ($user != null){
		$_SESSION['login'] = Array(
			"id" => $user->id,
			"username" => $user->username,
			"email" => $user->email
		);
		print json_encode(array(
			"username" => $user->username
		));
		return;
		header("Location:". __BASE_URL . 'task/index');
	} else {
		status(400);
		$error = array("Wrong username or password, or user doesn't exist.");
		print json_encode(array(
			"error" => $error
		));
		return;
		
	}
}
?>
