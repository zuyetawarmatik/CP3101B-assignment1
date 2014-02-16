<?php

class TaskController extends BaseController {
	public function index() {
		//if (isset($_SESSION['login'])) {
		$this->registry->template->highlight = "tasks";
		$this->registry->template->username = $_SESSION['login']['username'];
		$tasks = Task::getTasksByUserId($_SESSION['login']['id']);
		$this->registry->template->tasks = $tasks;

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
			}else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$name = $_POST["name"];
				$desc = $_POST["description"];
				$blocks = $_POST["blocks"];

				$task = new Task();

				$task->user_id =$_SESSION['login']['id'];
				$task->name =$name;
				$task->description = $desc;
				$task->blocks = $blocks;

				if ($task->save()){
					echo 'saved';
					header('Location:' . __BASE_URL . 'task/');
				}else{
					echo 'error';
				};
			}
		//} else {
			//return (new Error404Controller($this->registry))->index();	
		//}
	}
}

?>
