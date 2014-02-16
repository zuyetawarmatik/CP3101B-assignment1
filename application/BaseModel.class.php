<?php

Abstract Class BaseModel {

	protected $vars = array();
	protected static $db = null;

	function __construct() {
	}
	public static function init(){
		self::$db = DB::getInstance();
	}
	public function __set($index, $value)
	{
		$this->vars[$index] = $value;
	}

	public function __get($index)
	{
		return $this->vars[$index];
	}
	protected static function getDb(){
		return DB::getInstance();
	
	}

}
BaseModel::init();

?>
