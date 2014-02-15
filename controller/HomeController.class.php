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
      } else if ($_SERVER['REQUEST_METHOD'] == 'POST');
    } else {
      index();
    }
  }
  public function login() {
    if (!isset($_SESSION['login'])) {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $this->registry->template->highlight = 'login';
        $this->registry->template->show('login');
      } else if ($_SERVER['REQUEST_METHOD'] == 'POST');
    } else {
      index();
    }
  }
}

?>
