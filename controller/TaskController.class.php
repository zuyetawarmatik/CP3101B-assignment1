<?php

class TaskController extends BaseController {
	public function index() {
    	$this->registry->template->highlight = "tasks";
		$this->registry->template->show('tasks');
	}
}

?>
