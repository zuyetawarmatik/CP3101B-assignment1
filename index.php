<?php
    /*** error reporting on ***/
    error_reporting(E_ALL);

    /*** define the site path constant ***/
    $site_path = realpath(dirname(__FILE__));
    define ('__SITE_PATH', $site_path);

    /*** include the init.php file ***/
    include 'include/init.php';
    $registry->router = new Router($registry);
    $registry->router->setPath(__SITE_PATH . 'controller');
?>