<?php

class TaskController extends BaseController {
	public function index() {
		if (isset($_SESSION['login'])) {
			$this->registry->template->highlight = "tasks";
			$this->registry->template->username = $_SESSION['login']['username'];
			$tasks = Task::getTasksByUserId($_SESSION['login']['id']);
			$this->registry->template->tasks = $tasks;
	
			$this->registry->template->show('tasks');
		} else {
			return (new Error404Controller($this->registry))->index();	
		}
	}
	
	public function edit() {
		if (isset($_SESSION['login'])) {
			$user_id = $_SESSION['login']['id'];
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				$task_id = $_GET['task_id'];
				if (is_numeric($task_id)) {
					$task = Task::getTaskByIdAndOwnerId($task_id,$user_id);
					$this->registry->template->task_id = $task_id;
					$this->registry->template->name = $task->name;
					$this->registry->template->description = $task->description;
					$this->registry->template->blocks = $task->blocks;
					$this->registry->template->current_block = $task->current_block;
	
					$this->registry->template->highlight = "tasks";
					$this->registry->template->show('task_edit');
				}
	
			} else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$task_id = $_POST['task_id'];
				$name = $_POST["name"];
				$desc = $_POST["description"];
				$blocks = $_POST["blocks"];
	
				$task = Task::getTaskByIdAndOwnerId($task_id,$user_id);
				if($task!=null){
					$task->name = $name;
					$task->description = $desc;
					$task->blocks = $blocks;
					$task->current_block = min($task->current_block,$blocks);
					if($task->save()){
						header("Location: " . __BASE_URL . "task/");
					};
				}
			}
		} else {
			return (new Error404Controller($this->registry))->index();
		}
	}
	
	public function revertblock(){
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$user_id = $_SESSION['login']['id'];
			$task_id = $_GET['task_id'];
			$task = Task::getTaskByIdAndOwnerId($task_id,$user_id);
			$task->current_block = max(0, $task->current_block-1);
			if ($task->save()){
				header("Location: " . __BASE_URL . "task/");
			} else{
				echo "error saving task current_block";
			}
		}
	}
	
	public function nextblock(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$task_id = $_POST['task_id'];
			$task = Task::getTaskById($task_id);
			$task->current_block = min($task->blocks, $task->current_block+1);

			if ($task->save()){
				header("Location: " . __BASE_URL . "task/");
			} else{
				echo "error saving task current_block";
			}
		}
	}
	
	public function create() {
		if (isset($_SESSION['login'])) {
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				$this->registry->template->highlight = "tasks";
				$this->registry->template->show('task_create');
			} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$name = $_POST["name"];
				$desc = $_POST["description"];
				$blocks = $_POST["blocks"];

				$task = new Task();

				$task->user_id =$_SESSION['login']['id'];
				$task->name =$name;
				$task->description = $desc;
				$task->blocks = $blocks;

				if ($task->create()){
					echo 'saved';
					header('Location:' . __BASE_URL . 'task/');
				}else{
					echo 'error';
				};
			}
		} else {
			return (new Error404Controller($this->registry))->index();	
		}
	}
}

?>
