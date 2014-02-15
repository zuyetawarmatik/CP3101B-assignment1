<?php

class IndexController extends BaseController {
	public function index() {
		$this->registry->template->show('index');
	}
	
	public function about() {
		$this->registry->template->highlight = 'about';
		$this->registry->template->show('about');
	}
	
	public function login() {
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$this->registry->template->highlight = 'login';
			$this->registry->template->show('login');
		} else if ($_SERVER['REQUEST_METHOD'] == 'POST');
	}
	
	public function register() {
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$this->registry->template->highlight = 'register';
			$this->registry->template->show('register');
		} else if ($_SERVER['REQUEST_METHOD'] == 'POST');
	}
}

?>
