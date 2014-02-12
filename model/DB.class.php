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
			self::$instance = new PDO($db_config['db_type'].':host='.$db_config['db_host'].';port='.$db_config['db_port'].';dbname='.$db_config['db_name'], $db_config['db_username'], $db_config['db_password']);
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		return self::$instance;
	}

}

?>
