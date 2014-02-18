<?php

class Template {

	private $registry;

	private $vars = array();

	function __construct($registry) {
		$this->registry = $registry;
		$this->vars["highlight"] = -1;
	}
	private function escape($value){
		if(gettype($value)=="array"){
			$escaped=array();
			foreach ($value as $el) {
				array_push($escaped,$this->escape($el));
			}
			return $escaped;
		} else if (gettype($value)=="string"){
			return nl2br(htmlentities($value));
		}elseif (gettype($value)=="object"){
			if ($value instanceof Task){
				$value->name = nl2br(htmlentities($value->name));
				$value->description = nl2br(htmlentities($value->description));
				return $value;
			}else{
				throw	"Passing unknown object type to view is not allowed.";
			}
		}else {
			return $value;
		}
	}

	public function __set($index, $value)
	{
		$this->vars[$index] = $this->escape($value);
	}

	function show($name) {
		$path = __SITE_PATH . '/view' . '/' . $name . '.view.php';

		if (file_exists($path) == false)
		{
			throw new Exception('Template not found in '. $path);
			return false;
		}

		/* Load variables (render variable) */
		foreach ($this->vars as $key => $value)
		{
			$$key = $value;
		}

		/* Render by including */
		include ($path);
	}


}

?>
