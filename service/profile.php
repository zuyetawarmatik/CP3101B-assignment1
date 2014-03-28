<?php
include 'include.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = $_POST['email'];
	$error = array();
	$oldpassword = $_POST['oldpassword'];
	$newpassword = ($_POST['newpassword']);

	if (!Util::validEmail($email)){
		array_push ($error, "Email address is invalid.\n");
	}
	if($oldpassword!=""){
		if (!Util::validPassword($_POST["newpassword"])){
		array_push ($error, "Password must not be empty.\n");
		}
		if ($_POST["newpassword"]!=$_POST["retype_password"]){
		array_push ($error, "Retype password does not match.\n");
		}
	}

	if($oldpassword!=""){
		$user = User::getAuthenticatedUser($_SESSION['login']['username'],$oldpassword);
		if (!$user==null){
			$user->password = Util::hash($newpassword);
		}else{
			array_push ($error, "Wrong password.\n");
		}
	}else{
		$user = User::getUserById($_SESSION['login']['id']);
	}
	if(count($error)==0){
		if($user!=null){
			$user->email = $email;
			if ($user->save()){
				$_SESSION['login'] = Array(
					"id" => $user->id,
					"username" => $user->username,
					"email" => $user->email
				);

				status(200);
				print json_encode(array(
					"username" => $user->username
				));
			};
		}
	}
}
if(count($error)!=0){
	status(400);
	print json_encode(array(
		"error" => $error
	));
	return;
}

?>
