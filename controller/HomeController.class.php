<?php

class HomeController extends BaseController {
	public function index() {
		$this->registry->template->show('index');
	}
	
	public function about() {
		$this->registry->template->show('about');
	}
	
	public function login() {
		if ($_SERVER['REQUEST_METHOD'] == 'GET')
			$this->registry->template->show('login');
		if ($_SERVER['REQUEST_METHOD'] == 'POST');
	}
}

?>
