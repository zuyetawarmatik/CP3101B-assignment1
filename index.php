<?php
    /* Turn on Error reporting */
    error_reporting(E_ALL);

    /* Site path constant */
    $site_path = realpath(dirname(__FILE__));
    define ('__SITE_PATH', $site_path);

    /* Include init.php */
    include 'include/init.php';
    
    /* Load the router */
    $registry->router = new Router($registry);
    $registry->router->setPath(__SITE_PATH . '/controller');
    
    /* Load the template */
    $registry->template = new Template($registry);
    
    /* Load the controller */
    $registry->router->loader();
    
?>