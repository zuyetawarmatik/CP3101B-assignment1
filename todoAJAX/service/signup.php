<?php
include 'include.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$error = "";
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = Util::hash($_POST["password"]);

	$error = array();
	if (!Util::validUsername($username)){
		array_push($error, "Username must contain only alpha-numeric characters and is 5-50 characters long.\n");
	}
	if (!Util::validEmail($email)){
		array_push($error, "Email address is invalid.\n");
	}
	if (User::usernameExists($username)){
		array_push($error, "Username is already in use.\n");
	}
	if (User::emailExists($email)){
		array_push($error, "Email is already in use.\n");
	}
	if (!Util::validPassword($_POST["password"])){
		array_push($error, "Password must not be empty.\n");
	}
	if ($_POST["password"]!=$_POST["retype_password"]){
		array_push($error, "Retype password does not match.\n");
	}
	if (count($error)>0){
		status(400);
		print json_encode(array(
			"error" => $error
		));
		return;
	}else{
		status(201);
		$new_user = new User();
		$new_user->username = $username;
		$new_user->email = $email;
		$new_user->password = $password;
		if ($new_user->create()){
			print "{}";
		}else{
			status(500);
			print "{}";
		}

		return;
	}



}
?>
