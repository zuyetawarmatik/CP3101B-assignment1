<?php

class HomeController extends BaseController {
	public function index() {
		$this->registry->template->highlight = "index";
		$this->registry->template->show('index');
	}

	public function about() {
		$this->registry->template->highlight = "about";
		$this->registry->template->show('about');
	}
	public function register() {
		if (!isset($_SESSION['login'])) {
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				$this->registry->template->highlight = 'register';
				$this->registry->template->show('register');
			} else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$error = "";
				$username = $_POST["username"];
				$email = $_POST["email"];
				$password = Util::hash($_POST["password"]);

				$new_user = new User($this->registry);
				if (!Util::validUsername($username)){
					$error .= "Username must contain only alpha-numeric characters.<br/>";
				}
				if (!Util::validEmail($email)){
					$error .= "Email address is invalid. <br/>";
				}
				if (User::usernameExists($username)){
					$error .= "Username is already in use. <br/>";
				}
				if (User::emailExists($email)){
					$error .= "Email is already in use.<br/>";
				}
				if (!Util::validPassword($_POST["password"])){
					$error .= "Password must not be empty.<br/>";
				}
				if ($_POST["password"]!=$_POST["retype_password"]){
					$error .= "Retype password does not match.<br/>";
				}


				if ($error==""){

					$new_user->username = $username;
					$new_user->email = $email;
					$new_user->password = $password;
					if ($new_user->create()){
						header("Location:". __BASE_URL . "home/login");
					} else{
						$this->registry->template->highlight = 'register';
						$this->registry->template->show('register');
					}
				}else{
					$this->registry->template->error = $error;
					$this->registry->template->username = $username;
					$this->registry->template->email = $email;
					$this->registry->template->highlight = 'register';
					$this->registry->template->show('register');
				}
			};
		} else {
			self::index();
		}
	}
	public function login() {
		if (!isset($_SESSION['login'])) {
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				$this->registry->template->highlight = 'login';
				$this->registry->template->show('login');
			} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$username = $_POST["username"];
				$password = $_POST["password"];
				$user = User::getAuthenticatedUser($username,$password);
				if ($user != null){
					$_SESSION['login'] = Array(
						"id" => $user->id,
						"username" => $user->username,
						"email" => $user->email
					);
					header("Location:". __BASE_URL . 'task/index');
				} else {
					$this->registry->template->error = "Wrong username or password, or user doesn't exist.";
					$this->registry->template->username = $username;
					$this->registry->template->highlight = 'login';
					$this->registry->template->show('login');
				}
			};
		} else {
			self::index();
		}
	}
	public function logout(){
		unset($_SESSION['login']);
		header('Location:' . __BASE_URL);
	}
}

?>
