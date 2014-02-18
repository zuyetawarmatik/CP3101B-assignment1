<?php

abstract class BaseController {

	protected $registry;

	function __construct($registry) {
		$this->registry = $registry;

		//enforce https
		if($_SERVER["HTTPS"] != "on")
		{
			header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
			exit();
		}
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
