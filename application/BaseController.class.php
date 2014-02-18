<?php

abstract class BaseController {

	protected $registry;

	function __construct($registry) {
		$this->registry = $registry;
	}
	function require_login(){
		if (!isset($_SESSION['login'])){
			header("Location: " . __BASE_URL . "home/login");
			exit();
		}
	}

	abstract function index();
}

?>
