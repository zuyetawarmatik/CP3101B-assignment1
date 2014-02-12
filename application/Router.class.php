<?php
class Router {
    private $registry;

    private $path;

    private $args = array();

    public $file;

    public $controller;
    
    public $action;
    
    function __construct($registry) {
        $this->registry = $registry;
    }
    
    /* Set controller dir path */
    function setPath($path) {
        if (is_dir($path) == false)
        {
            throw new Exception('Invalid controller path: `' . $path . '`');
        }
        $this->path = $path;
    }

    /* Router load the controller */
    public function loader()
    {
        /*** check the route ***/
        $this->getController();
        
        /*** if the file is not there diaf ***/
        if (is_readable($this->file) == false)
        {
            $this->file = $this->path.'/error404.php';
            $this->controller = 'error404';
        }
    
        /*** include the controller ***/
        include $this->file;
        
        /*** a new controller class instance ***/
        $class = $this->controller . 'Controller';
        $controller = new $class($this->registry);
        
        /*** check if the action is callable ***/
        if (is_callable(array($controller, $this->action)) == false)
        {
            $action = 'index';
        }
        else
        {
            $action = $this->action;
        }
        /*** run the action ***/
        $controller->$action();
    }

}
?>