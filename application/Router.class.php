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

}
?>