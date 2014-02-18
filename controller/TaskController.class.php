<?php

class TaskController extends BaseController {

	public function index() {
		$this->require_login();
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

		$this->require_login();
		$user_id = $_SESSION['login']['id'];
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$task_id = $_GET['task_id'];
			if (is_numeric($task_id)) {
				$task = Task::getTaskByIdAndOwnerId($task_id,$user_id);
				if ($task==null){
					return (new Error404Controller($this->registry))->index();	
				}
				$this->registry->template->task_id = $task_id;
				$this->registry->template->name = $task->name;
				$this->registry->template->description = $task->description;
				$this->registry->template->blocks = $task->blocks;
				$this->registry->template->current_block = $task->current_block;

				$this->registry->template->highlight = "tasks";
				$this->registry->template->show('task_edit');
			}else{
				return (new Error404Controller($this->registry))->index();	
			}

		} else if ($_SERVER['REQUEST_METHOD'] == 'POST'){

			$task_id = $_POST['task_id'];
			$name = $_POST["name"];
			$desc = $_POST["description"];
			$blocks = $_POST["blocks"];
			$error = "";
			if (!is_numeric($task_id)){
				$error .= "wrong task_id\n";
			}
			if (!Util::strLengthLimit($name,1,50)){
				$error .= "Task name must not be empty or longer than 50.\n";
			}
			if (!Util::strLengthLimit($desc,1,200)){
				$error .= "Task description must not be empty or longer than 200.\n";
			}
			if (!is_numeric($blocks)){
				$error .= "Blocks must be numeric.";
			}

			if($error==""){
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
			}else{

				$task = Task::getTaskByIdAndOwnerId($task_id,$user_id);
				$this->registry->template->error = $error;
				$this->registry->template->task_id = $task_id;
				$this->registry->template->name = $name;
				$this->registry->template->description = $desc;
				$this->registry->template->blocks = $blocks;
				$this->registry->template->current_block = $task->current_block;

				$this->registry->template->highlight = "tasks";
				$this->registry->template->show('task_edit');
			}
		}
	}
	
	public function revertblock(){

		$this->require_login();
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

		$this->require_login();
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

		$this->require_login();
		if (isset($_SESSION['login'])) {
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				$this->registry->template->highlight = "tasks";
				$this->registry->template->show('task_create');
			} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$error = "";
				$name = $_POST["name"];
				$desc = $_POST["description"];
				$blocks = $_POST["blocks"];
				if (!Util::strLengthLimit($name,1,50)){
					$error .= "Task name must not be empty or longer than 50.\n";
				}
				if (!Util::strLengthLimit($desc,1,200)){
					$error .= "Task description must not be empty or longer than 200.\n";
				}
				if (!is_numeric($blocks)){
					$error .= "Blocks must be numeric.";
				}
				if ($error==""){
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
				}else{
					$this->registry->template->error = $error;
					$this->registry->template->blocks = $blocks;
					$this->registry->template->description = $desc;
					$this->registry->template->taskname = $name;
					$this->registry->template->highlight = "tasks";
					$this->registry->template->show('task_create');
				}
			}
		} else {
			return (new Error404Controller($this->registry))->index();	
		}
	}
}

?>
