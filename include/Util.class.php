<?php 
class Util {
	private static $TIME_FORMAT_INPUT = 'Y-m-d H:i:s';
	private static $TIME_FORMAT_DISPLAY = 'H:i:s d-m-Y';
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
}
?>
