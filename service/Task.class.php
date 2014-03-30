<?php

Class Task extends BaseModel{
	public static function getUserTaskStats($user_id){
		$stmt = self::$db->prepare("SELECT count(*) AS num_tasks, sum(case when current_block=blocks then 1 else 0 end) AS num_finished_tasks, min(created_time) AS start, now() AS now FROM tasks WHERE user_id = ?");
	
		if ($stmt->execute(array($user_id))) {
			while ($row = $stmt->fetch()) {

				$now = $row['now'];
				$start = $row['start'];
				$num_tasks = $row['num_tasks'];
				$num_finished_tasks = $row['num_finished_tasks'];
				if ($num_finished_tasks==null) return "No tasks in task list.";
				if ($start==null) return "No task is finished, thus no estimation available.";

				$num_tasks--;

				$now = date_create($now);
				$start = date_create($start);
				
				$days = (int) date_diff($now,$start)->format("%a"); 
				if ($days==0){
					$hours = (int) date_diff($now,$start)->format("%h");  
					if ($hours ==0){
						$minutes = (int) date_diff($now,$start)->format("%i");  
						$est = round(($num_tasks/$num_finished_tasks)*($minutes)) . " minutes";
					}else{
						$est = round(($num_tasks/$num_finished_tasks)*($hours)) . " hours";
					}
				}else{
					$est = round(($num_tasks/$num_finished_tasks)*($days)) . " days";
				}

				return sprintf("Finished %d/%d task(s), the remaining %d task(s) is/are estimated be done in %s.",$num_finished_tasks,$num_tasks, $num_tasks-$num_finished_tasks, $est);


			}
		}else{
			return null;
		}
	}
	public function save(){
		$stmt = self::$db->prepare("UPDATE tasks SET name = ?, description = ?, blocks = ?, current_block = ? WHERE id = ? ");
		if ($stmt->execute(array($this->name,$this->description,$this->blocks,$this->current_block,$this->id))) {
			return true;
		}else{
			return false;
		}
	}
	public function getEstFinishTime(){
		if ($this->current_block==0){
			return "Finish on (est.): waiting for 1st work unit to be done.";
		}else if ($this->blocks == $this->current_block){
			return "Task completed.";
		}

		$then = $this->created_time;
		$now = time();
		$estimated = $then + ($now-$then)*($this->blocks/$this->current_block);
		return "Finish on (est.): " . Util::timestampToString($estimated);
	}
	public function create() {
		$this->current_block = 0;
		$this->created_time = date('Y-m-d H:i:s');
		$stmt = self::$db->prepare("INSERT INTO TASKS (user_id,name,description,blocks,created_time) VALUES (?,?,?,?,?);");
		if ($stmt->execute(array($this->user_id,$this->name,$this->description,$this->blocks,$this->created_time))) {
			$tmp = Task::getTaskById(self::$db->lastInsertId('task_id_seq'));
			$this->created_time = $tmp->created_time;
			$this->id = $tmp->id;
			return true;
		}else{
			return false;
		}
	}
	public static function deleteTaskByUserAndId($id,$user_id){
		$stmt = self::$db->prepare("DELETE FROM TASKS WHERE user_id = ? AND id = ?");
		if ($stmt->execute(array($user_id,$id))) {
			if($stmt->rowCount()!=0){
				return true;
			}else{
				return false;
			}
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
				$task->created_time = strtotime($row['created_time']);

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
				$task->created_time = strtotime($row['created_time']);

				return $task;
			}
		}else{
			return null;
		}
	}

	//to return an array of tasks of a user
	//return empty array if no tasks or user found 
	public static function getTasksByUserId($userid){
		$stmt = self::$db->prepare("SELECT *,(blocks=current_block) as completed FROM TASKS WHERE user_id = ? ORDER BY completed,id");
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
				$task->created_time = strtotime($row['created_time']);

				array_push($tasks,$task);
			}
			return $tasks;
		}else{
			return array();
		}
	}

}

?>
