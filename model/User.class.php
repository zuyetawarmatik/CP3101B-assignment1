<?php

Class User extends BaseModel{
	public function save(){
		$stmt = self::$db->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
		if ($stmt->execute(array($this->email,$this->password,$this->id))) {
			return true;
		}else{
			return false;
		}
	}
	public function create() {
		$stmt = self::$db->prepare("INSERT INTO USERS (username,email,password) VALUES (?,?,?)");
		if ($stmt->execute(array($this->username,$this->email,$this->password))) {
			return true;
		}else{
			return false;
		}
	}
	public static function getUserById($id){
		$stmt = self::$db->prepare("SELECT * FROM USERS WHERE id = ?");
		if ($stmt->execute(array($id))) {
			while ($row = $stmt->fetch()) {
				$user = new User();

				$user->username = $row['username'];
				$user->email = $row['email'];
				$user->id = $row['id'];
				$user->password = $row['password'];

				return $user;
			}
		}else{
			return null;
		}
	}
	public static function getUserByUsernameAndPassword($username,$password){
		$stmt = self::$db->prepare("SELECT * FROM USERS WHERE username = ?  AND password = ?");
		if ($stmt->execute(array($username,$password))) {
			while ($row = $stmt->fetch()) {
				$user = new User();

				$user->username = $row['username'];
				$user->email = $row['email'];
				$user->id = $row['id'];
				$user->password = $row['password'];

				return $user;
			}
		}else{
			return null;
		}
	}

}

?>
