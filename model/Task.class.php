<?php

Class Task extends BaseModel{
	public function save(){
		$stmt = self::$db->prepare("UPDATE tasks SET name = ?, description = ?, blocks = ?, current_block = ? WHERE id = ? ");
		if ($stmt->execute(array($this->name,$this->description,$this->blocks,$this->current_block,$this->id))) {
			return true;
		}else{
			return false;
		}
	}
	public function create() {
		$stmt = self::$db->prepare("INSERT INTO TASKS (user_id,name,description,blocks) VALUES (?,?,?,?)");
		if ($stmt->execute(array($this->user_id,$this->name,$this->description,$this->blocks))) {
			//TODO:  update id
			return true;
		}else{
			return false;
		}
	}
	public static function getTaskByIdAndOwnerId($id,$user_id){
		$stmt = self::$db->prepare("SELECT * FROM TASKS WHERE id = ? AND user_id = ?");
		if ($stmt->execute(array($id,$user_id))) {
			while ($row = $stmt->fetch()) {
				$task = new Task();

				$task->id = $row['id'];
				$task->user_id = $row['user_id'];
				$task->name = $row['name'];
				$task->description = $row['description'];
				$task->blocks = $row['blocks'];
				$task->current_block = $row['current_block'];

				return $task;
			}
		}else{
			return null;
		}
	}
	public static function getTaskById($id){
		$stmt = self::$db->prepare("SELECT * FROM TASKS WHERE id = ?");
		if ($stmt->execute(array($id))) {
			while ($row = $stmt->fetch()) {
				$task = new Task();

				$task->id = $row['id'];
				$task->user_id = $row['user_id'];
				$task->name = $row['name'];
				$task->description = $row['description'];
				$task->blocks = $row['blocks'];
				$task->current_block = $row['current_block'];

				return $task;
			}
		}else{
			return null;
		}
	}

	//to return an array of tasks of a user
	//return empty array if no tasks or user found 
	//TODO: sort completed task at the bottom
	public static function getTasksByUserId($userid){
		$stmt = self::$db->prepare("SELECT * FROM TASKS WHERE user_id = ? ORDER BY id");
		if ($stmt->execute(array($userid))) {
			$tasks = array();
			while ($row = $stmt->fetch()) {
				$task = new Task();

				$task->id = $row['id'];
				$task->user_id = $row['user_id'];
				$task->name = $row['name'];
				$task->description = $row['description'];
				$task->blocks = $row['blocks'];
				$task->current_block = $row['current_block'];

				array_push($tasks,$task);
			}
			return $tasks;
		}else{
			return array();
		}
	}

}

?>
