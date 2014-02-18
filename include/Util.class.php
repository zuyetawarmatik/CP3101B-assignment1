<?php 
class Util {
	private static $TIME_FORMAT_INPUT = 'Y-m-d H:i:s';
	private static $TIME_FORMAT_DISPLAY = 'H:i:s d-m-Y';
	private static $USERNAME_REGEXP = '/^[A-Za-z][A-Za-z0-9]{5,50}$/';
	public static function hash($pass){
		return crypt($pass);
	}
	public static function hash_compare($input_pass,$hash){
		return crypt($input_pass,$hash) == $hash;
	}
	public static function timestampToString($time)
	{
		return date(self::$TIME_FORMAT_DISPLAY,$time);
	} 
	public static function strLengthLimit($str,$min,$max){
		$count = strlen($str);
		return ($min <= $count) && ($count <= $max);
	}
	public static function validUsername($username){
		return preg_match(self::$USERNAME_REGEXP, $username);
	}
	public static function validPassword($pass){
		return $pass!="";
	}
	public static function validEmail($email){
		return filter_var($email, FILTER_VALIDATE_EMAIL)!=""?true:false;
	}
}
?>
