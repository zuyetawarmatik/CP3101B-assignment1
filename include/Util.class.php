<?php 
class Util {
	private static $TIME_FORMAT_INPUT = 'Y-m-d H:i:s';
	private static $TIME_FORMAT_DISPLAY = 'H:i:s d-m-Y';
	private static $salt= "re057u098vrl";
	public static function hashAndSalt($pass){
		return $pass;
	}
	public static function timestampToString($time)
	{
		return date(self::$TIME_FORMAT_DISPLAY,$time);
	} 
}
?>
