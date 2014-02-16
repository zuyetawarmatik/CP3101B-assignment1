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
				$username = $_POST["username"];
				$email = $_POST["email"];
				$password = $_POST["password"];
				// $user_id = $this->model->user->register($username,$email,$password);
				$new_user = new User($this->registry);
				//TODO: check unique and empty username/email

				$new_user->username = $username;
				$new_user->email = $email;
				$new_user->password = $password;
				if ($new_user->create()){
					header("Location:". __BASE_URL . "home/login");
				} else{
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
				// TODO: hash and salt
				$password = $_POST["password"];
				$user = User::getUserByUsernameAndPassword($username,$password);
				if ($user != null){
					$_SESSION['login'] = Array(
						"id" => $user->id,
						"username" => $user->username,
						"email" => $user->email
					);
					// TODO: redirect to all tasks pages
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
	//TODO: remove this method
	public function test_session(){
		print_r($_SESSION);
	}
}

?>
