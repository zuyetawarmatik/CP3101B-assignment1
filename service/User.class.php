<?php 
class User extends BaseModel{
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
	public function save(){
		$stmt = self::$db->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
		if ($stmt->execute(array($this->email,$this->password,$this->id))) {
			return true;
		}else{
			return false;
		}
	}
	public static function usernameExists($username){
		$stmt = self::$db->prepare("SELECT * FROM USERS WHERE username = ?");
		if ($stmt->execute(array($username))) {
			while ($row = $stmt->fetch()) {
				return true;
			}
			return false;
		}else{
			return null;
		}
	}
	public static function emailExists($email){
		$stmt = self::$db->prepare("SELECT * FROM USERS WHERE email = ?");
		if ($stmt->execute(array($email))) {
			while ($row = $stmt->fetch()) {
				return true;
			}
			return false;
		}else{
			return null;
		}
	}
	public static function getAuthenticatedUser($username,$input_pass){
		$stmt = self::$db->prepare("SELECT * FROM USERS WHERE username = ?");
		if ($stmt->execute(array($username))) {
			while ($row = $stmt->fetch()) {
				if (!Util::hash_compare($input_pass,$row['password'])){
					return null;
				}
				$user = new User();

				$user->username = $row['username'];
				$user->email = $row['email'];
				$user->id = $row['id'];
				$user->password = $row['password'];

				return $user;
			}
			return null;
		}else{
			return null;
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

}
?>
