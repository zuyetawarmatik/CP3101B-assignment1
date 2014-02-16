<?php

class TaskController extends BaseController {
	public function index() {
		//if (isset($_SESSION['login'])) {
    		$this->registry->template->highlight = "tasks";
			$this->registry->template->show('tasks');
		//} else {
			//return (new Error404Controller($this->registry))->index();	
		//}
	}
	
	public function create() {
		//if (isset($_SESSION['login'])) {
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				$this->registry->template->highlight = "tasks";
				$this->registry->template->show('task_create');
			}
		//} else {
			//return (new Error404Controller($this->registry))->index();	
		//}
	}
}

?>
