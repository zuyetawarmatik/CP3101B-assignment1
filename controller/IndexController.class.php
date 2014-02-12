<?php

class IndexController extends BaseController {
	public function index() {
		//$this->registry->template->welcome = 'Welcome to PHPRO MVC';
		$this->registry->template->show('index');
	}
}

?>
