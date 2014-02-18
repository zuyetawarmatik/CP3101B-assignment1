<?php

class UserController extends BaseController {
	public function index(){
		header("Location :" . __BASE_URL . "user/profile");
	}
	public function profile() {
		$this->require_login();
		$error="";
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$email = $_POST['email'];
			$oldpassword = $_POST['oldpassword'];
			$newpassword = ($_POST['newpassword']);

			if (!Util::validEmail($email)){
				$error .= "Email address is invalid.\n";
			}
			if($oldpassword!=""){
				if (!Util::validPassword($_POST["newpassword"])){
					$error .= "Password must not be empty.\n";
				}
				if ($_POST["newpassword"]!=$_POST["retype_password"]){
					$error .= "Retype password does not match.\n";
				}
			}

			if($oldpassword!=""){
				$user = User::getAuthenticatedUser($_SESSION['login']['username'],$oldpassword);
				if (!$user==null){
					echo $newpassword;
					$user->password = Util::hash($newpassword);
				}else{
					$error .= "Wrong password.\n";
				}
			}else{
				$user = User::getUserById($_SESSION['login']['id']);
			}
			if($error!=""){
				if($user!=null){
					$user->email = $email;
					if ($user->save()){
						$_SESSION['login'] = Array(
							"id" => $user->id,
							"username" => $user->username,
							"email" => $user->email
						);
					};
				}
			}
		}
		if($error!=""){
			$this->registry->template->error = $error;
		}
		$this->registry->template->highlight = "account";
		$this->registry->template->username = $_SESSION['login']["username"];
		$this->registry->template->email = $_SESSION['login']["email"];
		$this->registry->template->show('profile');
	}
}

?>
