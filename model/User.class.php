<?php

Class User extends BaseModel{
	public function save() {
		$stmt = self::$db->prepare("INSERT INTO USERS (username,email,password) VALUES (?,?,?)");
		if ($stmt->execute(array($this->username,$this->email,$this->password))) {
			return true;
		}else{
			return false;
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

				return $user;
			}
		}else{
			return null;
		}
	}

}

?>
