<?php
class DB {

	private static $instance = NULL;

	private function __construct() {
		/* Hiding the class initialization function */
	}

	private function __clone(){
		/* Hiding the class clone function */
	}

	public static function getInstance() {
		include dirname(__DIR__) . '/config.inc';

		if (!self::$instance)
		{
			$db_conn_string = sprintf('%s:host=%s;port=%s;dbname=%s','pgsql','localhost',5432,$db_name);
			self::$instance = new PDO($db_conn_string,$db_user,$db_password);
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		return self::$instance;
	}
}
?>
