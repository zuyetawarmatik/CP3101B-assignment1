<?php

class UserController extends BaseController {
	public function index(){
		header("Location :" . __BASE_URL . "user/profile");
	}
	public function profile() {
		$this->require_login();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$email = $_POST['email'];
			$oldpassword = $_POST['oldpassword'];
			$newpassword = Util::hash($_POST['newpassword']);

			if($oldpassword!="" && $newpassword!=""){
				$user = User::getAuthenticatedUser($_SESSION['login']['username'],$oldpassword);
				if (!$user==null){
					echo $newpassword;
					$user->password = $newpassword;
				}
			}else{
				$user = User::getUserById($_SESSION['login']['id']);
			}
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
		$this->registry->template->highlight = "account";
		$this->registry->template->username = $_SESSION['login']["username"];
		$this->registry->template->email = $_SESSION['login']["email"];
		$this->registry->template->show('profile');
	}
}

?>
