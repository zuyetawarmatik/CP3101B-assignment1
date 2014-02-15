<?php
class Router {
    private $registry;

    private $controllerPath;

    private $args = array();

    public $controllerFile;

    public $controller;
    
    public $action;
    
    function __construct($registry) {
        $this->registry = $registry;
    }
    
    /* Set controller dir path */
    function setPath($path) {
        if (is_dir($path) == false)
        {
            throw new Exception('Invalid controller path: ' . $path);
        }
        $this->controllerPath = $path;
    }

    /* Router load the controller */
    public function loader()
    {
    	include $this->controllerPath.'/Error404Controller.class.php';
    	
    	/* Check the route */
    	$this->getController();
    	
    	if (!is_readable($this->controllerFile))
    	{
    		return (new Error404Controller($this->registry))->index();
    	}
        
        include $this->controllerFile;
        
        /* Load a new controller instance */
        $controller = new $this->controller($this->registry);
        
        /* Check if the action is callable */
        if (!is_callable(array($controller, $this->action))) {
        	return (new Error404Controller($this->registry))->index();
        } else {
            $action = $this->action;
            
            /* Run the action */
            return $controller->$action();
        }
    }
    
    private function getController() {
		/* Parse the URL: index?rt=controller/action */
    	$route = (empty($_REQUEST['rt'])) ? '' : $_REQUEST['rt'];

    	if (empty($route))
    	{
    		$route = 'home';
    	}
    	else
    	{
    		/* Get the parts of the route */
    		$parts = explode('/', $route);
    		$this->controller = ucfirst($parts[0]).'Controller';
    		if (isset($parts[1]))
    		{
    			$this->action = $parts[1];
    		}
    	}

    	if (empty($this->controller))
    	{
    		$this->controller = 'HomeController';
    	}

    	/* Get action */
    	if (empty($this->action))
    	{
    		$this->action = 'index';
    	}

    	/* Set the file path */
    	$this->controllerFile = $this->controllerPath .'/'. $this->controller . '.class.php';
    }

}
?>
