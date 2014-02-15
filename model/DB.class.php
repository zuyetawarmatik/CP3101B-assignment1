<?php

class DB {
	/* Singleton */
	private static $instance = NULL;
	
	private function __construct() {
		/* Hiding the class initialization function */
	}

	private function __clone(){
		/* Hiding the class clone function */
	}
	
	public static function getInstance() {
		/*** include database config ***/
		include __SITE_PATH . '/config/' . 'database.php';
		
		if (!self::$instance)
		{
      $db_conn_string = sprintf('%s:dbname=%s;host=%s;user=%s;password=%s',$db_config['db_type'],$db_config['db_name'],$db_config['db_host'],$db_config['db_username'],$db_config['db_password']);

			self::$instance = new PDO($db_conn_string);
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		return self::$instance;
	}

}

?>
